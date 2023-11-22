<?php

namespace App\Http\Controllers;

use App\Models\User as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $pathView = 'admin.user.';

    private $linkView = 'user';

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
    public function delete(Request $request)
    {
        $mainModel = new MainModel();
        $item = $request->cid;
        if (!empty($item)) {
            foreach ($item as $id) {
                $mainModel->find($id)->removeImage();
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
                'email' => 'required|email|unique:users',
                'form.status' => 'in:1,0',
                'password' => 'required|confirmed|min:3',
            ],
            [
                'required' => ':attribute không được rỗng',
                'min' => ':attribute không được ít hơn :min ký tự',
                'max' => ':attribute không được nhiều hơn :max ký tự',
                'in' => ':attribute chưa được chọn',
                'email' => ':attribute không hợp lệ',
                'unique' => ':attribute đã tồn tại',
                'confirmed' => ':attribute không trùng khớp'
            ],
            [
                'form.name' => 'Tên',
                'form.status' => 'Trạng thái',
                'email' => 'Email',
                'password' => 'Password'
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
        if($resetPass = $request->post('resetPass')){
            $newPass = Str::random(8);
            $user['password'] = Hash::make($newPass);
            $user['updated_at'] = date('Y-m-d H:i:s');
            if ($mainModel->where('id',$id)->update($user)) {
                return redirect()->back()->with('message', "New password is {$newPass}");
            }
        }

        if($forgot = $request->post('forgot')){
            if ($forgot['new_password'] !== $forgot['confirm_password']) {
                return redirect()->back()->with('message', "New passwords do not match.");
            }
            if (!Hash::check($forgot['old_password'], $item->password)) {
                return redirect()->back()->with('message', "Old password is incorrect.");
            }
            $user['password'] = Hash::make($forgot['new_password']);
            $user['updated_at'] = date('Y-m-d H:i:s');
            if ($mainModel->where('id',$id)->update($user)) {
                return redirect()->back()->with('message', "Change password succesfully.");
            }
        }


        if($user = $request->post('user')){
            $picture = $request->all();
            if(isset($picture['user']['picture'])){
                $mainModel->find($id)->removeImage();
                $user['picture'] = $mainModel->saveImage($picture['user']['picture']);
            }
            $mainModel->where('id',$id)->update($user);
            return redirect()->back()->with('message', 'Updated user!');
        }
        return view($this->pathView . 'edit',['id' => $id])->with('item', $item);


    }
}
