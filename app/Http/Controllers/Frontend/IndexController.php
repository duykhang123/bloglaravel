<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function home()
    {
        $banner = BannerModel::where('status', '1')->orderBy('id', 'DESC')->limit('5')->get();
        $product_category = ProductCategoryModel::where('status', '1')->orderBy('id', 'DESC')->limit('5')->get();

        $items = DB::table('product_order')->select('product_model_id', DB::raw('COUNT(product_model_id) as count'))->groupBy('product_model_id')->orderBy('count', 'DESC')->get();

        $special_product = ProductModel::where('status', 1)->where('special', 1)->orderBy('id', 'DESC')->limit('5')->get();

        $product_ids = [];
        foreach ($items as $item) {
            array_push($product_ids, $item->product_model_id);
        }
        $best_sellings = ProductModel::whereIn('id', $product_ids)->get();

        $items_rated = DB::table('product_review')->select('product_id', DB::raw('AVG(rate) as count'))->groupBy('product_id')->orderBy('count', 'DESC')->get();
        $product_ids = [];
        foreach ($items_rated as $item) {
            array_push($product_ids, $item->product_id);
        }
        $best_rated = ProductModel::whereIn('id', $product_ids)->get();



        return view('frontend.component.index', compact('banner', 'product_category', 'best_sellings','best_rated','special_product'));
    }

    public function shop(Request $request)
    {
        $products = ProductModel::query();
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_id = ProductCategoryModel::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('p_category_id', $cat_id);
        }
        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_id = BrandModel::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brand_id);
        }
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status' => 1])->orderBy('price', 'ASC')->paginate(12);
            }
            if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status' => 1])->orderBy('price', 'DESC')->paginate(12);
            }
            if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 1])->orderBy('name', 'ASC')->paginate(12);
            }
            if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 1])->orderBy('name', 'DESC')->paginate(12);
            }
        }
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('price', $price)->where(['status' => 1])->paginate(6);
        } else {
            $products = $products->where('status', 1)->paginate(6);
        }
        $cats = ProductCategoryModel::where('status', '1')->with('products')->orderBy('id', 'DESC')->get();
        $brands = BrandModel::where('status', '1')->with('products')->orderBy('id', 'DESC')->get();
        return view('frontend.pages.shop.shop', compact('products', 'cats', 'brands'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }

        $sortByUrl = "";
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' .  $data['sortBy'];
        }


        $price_range_url = "";
        if (!empty($data['price_range'])) {
            $price_range_url .= '&price=' .  $data['price_range'];
        }


        $brandUrl = '';
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }
        return \redirect()->route('shop', $catUrl . $sortByUrl . $price_range_url . $brandUrl);
    }

    public function autoSearch(Request $request)
    {
        $query = $request->get('term');
        $products = ProductModel::where('name', 'LIKE', '%' . $query . '%')->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'value' => $product->name,
                'id' => $product->id
            ];
        }

        if (count($data)) {
            return $data;
        } else {
            return [
                'value' => 'No Result Found',
                'id' => ''
            ];
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = ProductModel::where('name', 'LIKE', '%' . $query . '%')->paginate(12);
        $cats = ProductCategoryModel::where('status', '1')->with('products')->orderBy('id', 'DESC')->get();
        $brands = BrandModel::where('status', '1')->with('products')->orderBy('id', 'DESC')->get();
        return view('frontend.pages.shop.shop', compact('products', 'cats', 'brands'));
    }


    public function productCategory(Request $request, $slug)
    {
        $category = ProductCategoryModel::with('products')->where('slug', $slug)->first();
        $route = 'product-cate';

        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($sort == 'priceAsc') {
            $product = ProductModel::where(['status' => 1, 'p_category_id' => $category->id])->orderBy('price', 'ASC')->paginate(12);
        } elseif ($sort == 'priceDesc') {
            $product = ProductModel::where(['status' => 1, 'p_category_id' => $category->id])->orderBy('price', 'DESC')->paginate(12);
        } elseif ($sort == 'titleAsc') {
            $product = ProductModel::where(['status' => 1, 'p_category_id' => $category->id])->orderBy('name', 'ASC')->paginate(12);
        } elseif ($sort == 'titleDesc') {
            $product = ProductModel::where(['status' => 1, 'p_category_id' => $category->id])->orderBy('name', 'DESC')->paginate(12);
        } else {
            $product = ProductModel::where(['status' => 1, 'p_category_id' => $category->id])->paginate(12);
        }

        if ($request->ajax()) {
            $view = view('frontend.pages._singer-product', compact('product'))->render();
            return response()->json(['html' => $view]);
        }
        if (isset($category)) {
            return view('frontend.pages.product-category', compact(['category', 'route', 'product', 'sort']));
        } else {
            return view('error.404');
        }
    }

    public function productDetail($slug)
    {
        $products = ProductModel::with('rel_product')->where('slug', $slug)->first();
        if (isset($products)) {
            return view('frontend.pages.product-detail')->with('products', $products);
        } else {
            return view('error.404');
        }
    }

    public function userAuth()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.auth.auth');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            Session::put('user', $request->email);
            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            } else {
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        } else {
            return back()->with('error', 'Invalid email & password');
        }
    }

    public function userRegister(Request $request)
    {
        $request->validate(
            [
                'form.name' => 'required|min:3|max:100',
                'email' => 'required|email|unique:users',
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
                'email' => 'Email',
                'password' => 'Password'
            ]
        );
        $params = $request->all();

        $mainModel = new User();
        $mainModel->saveItem($params);
        Session::put('user', $params['email']);
        return back()->with('success', 'Successfully Register');
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }


    public function userDashboard()
    {
        $user = Auth::user();
        return view('frontend.user.dashboard', compact(['user']));
    }

    public function userOrder()
    {
        return view('frontend.user.order');
    }

    public function userAddresses()
    {
        $user = auth()->user();
        return view('frontend.user.addresses', compact('user'));
    }

    public function editAddresses(Request $request)
    {
        $user = auth()->user();
        User::where('id', $user->id)->update([
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state,
        ]);
        return redirect()->back()->with('status', 'Updated Addresses success!');
    }

    public function editShippingAddresses(Request $request)
    {
        $user = auth()->user();
        User::where('id', $user->id)->update([
            'saddress' => $request->saddress,
            'scountry' => $request->scountry,
            'scity' => $request->scity,
            'spostcode' => $request->spostcode,
            'sstate' => $request->sstate,
        ]);
        return redirect()->back()->with('status', 'Updated Shipping Addresses success!');
    }

    public function userDetails(Request $request)
    {
        $user = auth()->user();
        $mainModel = new User();
        if ($edituser = $request->post('user')) {
            $objUser = $request->all();
            if (isset($objUser['user']['picture'])) {
                $mainModel->find($user->id)->removeImage();
                $edituser['picture'] = $mainModel->saveImage($objUser['user']['picture']);
            }
            if (!empty($objUser['forgot']['old_password'])) {
                $forgot = $objUser['forgot'];
                if ($forgot['new_password'] !== $forgot['confirm_password']) {
                    return redirect()->back()->with('message', "New passwords do not match.");
                }
                if (!Hash::check($forgot['old_password'], $user->password)) {
                    return redirect()->back()->with('message', "Old password is incorrect.");
                }
                $user['password'] = Hash::make($forgot['new_password']);
                $user['updated_at'] = date('Y-m-d H:i:s');
                if ($mainModel->where('id', $user->id)->update($user)) {
                    return redirect()->back()->with('message', "Change password succesfully.");
                }
            }
            $mainModel->where('id', $user->id)->update($edituser);
            return redirect()->back()->with('message', 'Updated user!');
        }
        return view('frontend.user.details', compact('user'));
    }
}
