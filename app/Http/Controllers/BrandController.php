<?php

namespace App\Http\Controllers;


use App\Models\BrandModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    private $pathView = 'admin.brand.';

    private $linkView = 'brand';

    public function __construct()
    {
        view()->share("controllerName", $this->pathView);
        view()->share("linkView", $this->linkView);
    }


    public function index(Request $request)
    {
        $params['select_filter']['status'] = $request->input('select_filter', 'default');
        $params['search']['value'] = $request->input('search_value', '');
        $params['search']['field'] = $request->input('search_field', 'all');


        $mainModel = new MainModel();
        $items = $mainModel->listItem($params);
        return view($this->pathView . 'index')->with('items', $items)->with('params', $params);
    }
    public function form()
    {
        return view($this->pathView . 'form');
    }
    public function deleteOnly($id)
    {
        $mainModel = new MainModel();
        $item = $mainModel->where('id', $id)->first();
        if (!empty($item)) {
            $mainModel->where('id', $id)->delete();
            Session::flash('success', 'Đã xóa thành công');
            return redirect()->back();
        } else {
            Session::flash('error', 'Vui lòng chọn phần tử muốn xóa');
            return redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        $mainModel = new MainModel();
        $item = $request->cid;
        if (!empty($item)) {
            foreach ($item as $id) {
                $mainModel->where('id', $id)->delete();
            }
            Session::flash('success', 'Đã xóa thành công');
            return redirect()->back();
        } else {
            Session::flash('error', 'Vui lòng chọn phần tử muốn xóa');
            return redirect()->back();
        }
    }


    public function changeStatus($status, Request $request)
    {
        $status = ($status == 1) ? 0 : 1;
        $mainModel = new MainModel();
        $mainModel->where('id', $request->id)->update(['status' => $status]);
        $response = [
            'link' => route($this->pathView . 'changeStatus', $status),
            'status' => $status,
            'id' => $request->id
        ];
        return response()->json($response);
    }

    public function changePublish($status, Request $request)
    {
        $mainModel = new MainModel();
        $items = $request->cid;
        if (!empty($items)) {
            foreach ($items as $id) {
                $mainModel->where('id', $id)->update(['status' => $status]);
            }
            Session::flash('success', 'Đã cập nhật thành công');
            return redirect()->back();
        } else {
            Session::flash('error', 'Vui lòng chọn phần tử');
            return redirect()->back();
        }
    }

    public function save(Request $request)
    {
        $request->validate(
            [
                'form.name' => 'required|min:3|max:100',
                'form.description' => 'required|min:3|max:255',
                'form.status' => 'in:1,0',
            ],
            [
                'required' => ':attribute không được rỗng',
                'min' => ':attribute không được ít hơn :min ký tự',
                'max' => ':attribute không được nhiều hơn :max ký tự',
                'in' => ':attribute chưa được chọn',
            ],
            [
                'form.name' => 'Tên',
                'form.description' => 'Mô tả',
                'form.status' => 'Trạng thái',
            ]
        );
        $params = $request->all();
        $mainModel = new MainModel();
        $mainModel->saveItem($params);
        return redirect()->route($this->pathView . 'index');
    }

    public function edit($id,Request $request){
        $mainModel = new MainModel();
        $item = $mainModel->where('id',$id)->first();
        if($category = $request->post('form')){
            $picture = $request->all();
            if(isset($picture['form']['picture'])){
                $mainModel->find($id)->removeImage();
                $category['picture'] = $mainModel->saveImage($picture['form']['picture']);
            }
            $category['slug'] = Str::slug($category['name'], '-');
            $mainModel->where('id',$id)->update($category);
            return redirect()->back()->with('status', 'Updated category!');
        }
        return view($this->pathView . 'edit',['id' => $id])->with('item', $item);


    }
}
