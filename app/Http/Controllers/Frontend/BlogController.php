<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel as MainModel;
use App\Models\PostModel;
use App\Models\TagModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog(Request $request){
        $blog = PostModel::where('status',1)->get();
        $category_blog = CategoryModel::where('status',1)->with('posts')->get();
        $tag_blog = TagModel::get();
        return view('frontend.pages.blog',compact('blog','category_blog','tag_blog'));
    }

    public function single_blog($slug,Request $request){

        $single_blog = PostModel::where('status',1)->where('slug',$slug)->first();
        return view('frontend.pages.singer_blog',compact('single_blog'));
    }
}
