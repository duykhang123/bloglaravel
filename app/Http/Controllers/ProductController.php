<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use App\Models\ProductModel as MainModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $pathView = 'admin.product.';

    private $linkView = 'product';

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
    public function form(Request $request)
    {
        $mainModel = new MainModel();
        $id = $request->id;
        if (isset($id)) {
            $product = $mainModel->where('id', $id)->first();
            $attribute = ProductAttribute::where('product_id', $id)->get();
            return view($this->pathView . 'product-attribute', compact('product', 'attribute'));
        } else {
            return view($this->pathView . 'form');
        }
    }
    public function delete(Request $request)
    {
        dd($request->all());
        $mainModel = new MainModel();
        $item = $request->cid;
        if (!empty($item)) {
            foreach ($item as $id) {
                $arrGallary = $mainModel->find($id);
                if ($arrGallary->gallary) {
                    $gallary = unserialize($arrGallary->gallary);
                    foreach ($gallary as $value) {
                        $mainModel->removeGallary($value);
                    }
                }
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

    public function deleteOnly($id)
    {
        $productAttribute = new ProductAttribute();
        $product = new ProductModel();
        $item = $product->where('id', $id)->first();
        if (isset($item->name)) {
            $product->where('id', $id)->delete();
            return redirect()->back()->with('status', 'Xóa sản phẩm thành công');
        } else {
            $productAttribute->where('id', $id)->delete();
            return redirect()->back()->with('status', 'Xóa chức năng thành công');
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

    public function changeSpecial($special, Request $request)
    {
        $special = ($special == 1) ? 0 : 1;
        $mainModel = new MainModel();
        $mainModel->where('id', $request->id)->update(['special' => $special]);
        $response = [
            'link' => route($this->pathView . 'changeSpecial', $special),
            'special' => $special,
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
                'form.price' => 'required|numeric|',
                'form.sale_off' => 'required|numeric|',
            ],
            [
                'required' => ':attribute không được rỗng',
                'min' => ':attribute không được ít hơn :min ký tự',
                'max' => ':attribute không được nhiều hơn :max ký tự',
                'in' => ':attribute chưa được chọn',
                'numeric' => ':attribute phải là số'
            ],
            [
                'form.name' => 'Tên',
                'form.description' => 'Mô tả',
                'form.status' => 'Trạng thái',
                'form.sale_off' => 'Sale off',
            ]
        );
        $params = $request->all();
        $mainModel = new MainModel();
        $mainModel->saveItem($params);
        return redirect()->route($this->pathView . 'index');
    }

    public function edit($id, Request $request)
    {
        $mainModel = new MainModel();
        $item = $mainModel->where('id', $id)->first();
        if ($product = $request->post('form')) {
            $picture = $request->all();
            if (isset($picture['form']['picture'])) {
                $mainModel->find($id)->removeImage();
                $product['picture'] = $mainModel->saveImage($picture['form']['picture']);
            }
            if (isset($picture['gallary'])) {
                $arrGallary = $mainModel->find($id);
                if ($arrGallary->gallary != null) {
                    $gallary = unserialize($arrGallary->gallary);
                    foreach ($gallary as $value) {
                        $mainModel->removeGallary($value);
                    }
                    foreach ($picture['gallary'] as $value) {
                        $objImg[] = $mainModel->saveImage($value);
                    }
                    $product['gallary'] = serialize($objImg);
                } else {
                    foreach ($picture['gallary'] as $key => $value) {
                        $sub_Img[] = $mainModel->saveImage($value);
                    }
                    $product['gallary'] = serialize($sub_Img);
                }
            }
            $product['slug'] = Str::slug($product['name'], '-');
            $mainModel->where('id', $id)->update($product);
            return redirect()->back()->with('status', 'Updated product!');
        }
        return view($this->pathView . 'edit', ['id' => $id])->with('item', $item);
    }


    public function attribute($id, Request $request)
    {

        // $request->validate(
        //     [
        //         'size' => 'required|string',
        //         'original_price' => 'required|numeric',
        //         'price' => 'required|numeric|',
        //     ],
        // );

        $data = $request->all();

        foreach ($data['original_price'] as $key => $val) {
            if (!empty($val)) {
                $attribute = new ProductAttribute();
                $attribute['original_price'] = $val;
                $attribute['price'] = $data['price'][$key];
                $attribute['size'] = $data['size'][$key];
                $attribute['product_id'] = $id;
                $attribute->save();
            }
        }
        return redirect()->back()->with('status', 'Updated product attribute!');
    }
}
