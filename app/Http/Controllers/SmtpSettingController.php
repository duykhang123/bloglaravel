<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SmtpSettingController extends Controller
{
    private $pathView = 'admin.smtp.';

    private $linkView = 'smtp';

    public function __construct()
    {
        view()->share("controllerName", $this->pathView);

        view()->share("linkView", $this->linkView);
    }


    public function form(Request $request)
    {
        if ($setting = $request->post('form')) {
            foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
            }
            return back()->with('status', 'Updated SMTP!');
        }
        return view($this->pathView . 'form');
    }

    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';

            if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
            }else{
                file_put_contents($path,file_get_contents($path)."\r\n\"" . $type . '=' . $val);
            }
        }
    }
}
