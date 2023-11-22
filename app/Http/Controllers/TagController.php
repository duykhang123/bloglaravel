<?php

namespace App\Http\Controllers;


use App\Models\TagModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    private $pathView = 'admin.tag.';

    private $linkView = 'tag';

    public function addTag(Request $request){
        MainModel::insert([
            'name' => $request->tagname,
            'slug' => Str::slug($request->tagname, '-'),
        ]);
        return $this->showTag();
    }

    public function showTag(){
        $tags = MainModel::orderBy('id', 'DESC')->get();
        $xhtml = '';
        foreach($tags as $key => $value){
            $xhtml .= '<div class="checkbox">
                            <label><input type="checkbox">'.$value->name.'</label>
                            <a href="javascript:removeTag(\''.route('admin.tag.removeTag').'\',\''.$value->id.'\')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                        </div>';
        }
        return $xhtml;
    }
    
    public function removeTag(Request $request){
        $stores = MainModel::find($request->id);
        $stores->posts()->detach();

        $stores->delete();
        return $this->showTag();
    }
}
