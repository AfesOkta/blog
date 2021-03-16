<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    // User Register Page
    public function register_user_page()
    {
        return view('frontend.modules.register');
    }

    // User Register Store
    public function register_user(Request $request) {
        $validator  =   Validator::make($request->all(), [
            "name"  =>  "required",
            "email"  =>  "required|email",
            "phone"  =>  "required",
            "password"  =>  "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $inputs = $request->all();
        $inputs["password"] = Hash::make($request->password);

        $user   =   User::create($inputs);

        if(!is_null($user)) {
            session()->flash('success', 'Success! registration completed.');
            return redirect('login.user');
        }
        else {
            session()->flash('errors', 'Registration failed!.');
            return back();
        }
    }

    public function authenticate(Request  $request)
    {
        # code...
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Jika berhasil login
            return redirect(route('home'));
            //return redirect()->intended('/details');
        }
        // Jika Gagal
        return redirect('login');
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function json()
    {
        # code...
        $data = $this->userRepo->findAll();
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
}
