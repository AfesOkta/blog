<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function index(Posts $posts){
        $category_widget = Category::all();

    	$data = $posts->latest()->take(8)->get();
    	return view('frontend.modules.blog', compact('data','category_widget'));
    }

    public function isi_blog($slug){
        $category_widget = Category::all();

    	$data = Posts::where('slug', $slug)->get();
    	return view('frontend.modules.isi_post', compact('data','category_widget'));
    }

    public function list_blog(){
        $category_widget = Category::all();


    	$data = Posts::latest()->paginate(6);
    	return view('frontend.modules.list_post', compact('data','category_widget'));
    }

    public function list_category(category $category){
        $category_widget = Category::all();

        $data = $category->posts()->paginate(6);
        return view('frontend.modules.list_post', compact('data','category_widget'));
    }

    public function cari(request $request){
        $category_widget = Category::all();

        $data = Posts::where('judul', $request->cari)->orWhere('judul','like','%'.$request->cari.'%')->paginate(6);
        return view('frontend.modules.list_post', compact('data','category_widget'));
    }
}
