<?php

namespace App\Http\Controllers;

use App\Models\AboutUsModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    private $pathView = 'admin.aboutus.';

    private $linkView = 'aboutus';

    public function __construct()
    {
        view()->share("controllerName", $this->pathView);

        view()->share("linkView", $this->linkView);
    }

    public function form(Request $request)
    {
        $mainModel = new MainModel();
        $item = $mainModel->first();
        if ($setting = $request->post('form')) {
            $params = $request->all();
            if (!isset($item)) {
                $mainModel->saveItem($params);
                return redirect()->back()->with('status', 'Create category!');
            } else {
                $setting['slug'] = Str::slug($setting['name'], '-');
                $mainModel->where('id', $item->id)->update($setting);
                return redirect()->back()->with('status', 'Updated category!');
            }
        }
        return view($this->pathView . 'form', compact('item'));
    }
}
