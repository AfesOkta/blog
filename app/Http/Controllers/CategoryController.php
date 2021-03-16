<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repository\CategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.category.index');
    }

    public function json()
    {
        # code...
        $data = $this->categoryRepo->findAll();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<a href="javascript:void(0)" onclick="edit('.$row->id.')"
                    title="Edit '.$row->name.'" class="btn btn-info btn-sm btn-icon" data-dismiss="modal"><i class="fas fa-edit">&nbsp;edit</i></a>
                    <a href="javascript:void(0)" onclick="hapus('.$row->id.')"
                    title="Delete '.$row->name.'" class="btn btn-danger btn-sm btn-icon" data-dismiss="modal"><i class="fas fa-trash">&nbsp;delete</i></a>
                    ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $this->validate($request, [
                'name' => 'required|min:3'
            ]);

            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ];

            $find = $this->categoryRepo->findByName($request->name);
            if(is_null($find)) {
                DB::beginTransaction();
                $category = $this->categoryRepo->save($data);
                DB::commit();
                $data = [
                    'status' => true,
                    'message' => 'Kategori berhasil disimpan'
                ];
            } else {
                $data = [
                    'status' => false,
                    'message' => 'Kategori sudah ada'
                ];
            }

        }catch(Exception $ex) {
            DB::rollBack();
            Log::debug($ex->getMessage());
            $data = [
                'status' => false,
                'message' => 'Kategori tidak berhasil disimpan'
            ];
        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data   = $this->categoryRepo->findById($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);

            $category_data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ];

            DB::beginTransaction();
            $update = $this->categoryRepo->update($category_data, $request->category_id);
            DB::commit();

            $data = [
                'status' => true,
                'message' => 'Kategori berhasil disimpan'
            ];
        }catch(Exception $ex) {
            DB::rollBack();
            Log::debug($ex->getMessage());
            $data = [
                'status' => false,
                'message' => 'Kategori tidak berhasil disimpan'
            ];
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        //
        $category = $this->categoryRepo->delete($req->id);
        if($category) {
            $data = [
                'status' => true,
                'message' => 'Kategori berhasil dihapus'
            ];
        }else{
            $data = [
                'status' => false,
                'message' => 'Kategori tidak berhasil dihapus'
            ];
        }
        return response()->json($data);
    }
}
