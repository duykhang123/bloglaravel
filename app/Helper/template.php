<?php 

namespace App\Helper;

use Illuminate\Support\Facades\Session;

class Template{
    public static function showStatus($status,$id,$link){
        $class = ($status == 1) ? 'btn-success' : 'btn-danger';
        $title = ($status == 1) ? 'Actice' : 'Inactive';
        $xhtml = '<a id="status-'.$id.'" href="javascript:ajaxStatus(\''.$link.'\','.$id.')" class="btn btn-round '.$class.'">'.$title.'</a>';
        return $xhtml;
    }

    public static function showSpecial($special,$id,$link){
        $class = ($special == 1) ? 'btn-success' : 'btn-danger';
        $title = ($special == 1) ? 'Actice' : 'Inactive';
        $xhtml = '<a id="special-'.$id.'" href="javascript:ajaxSpecial(\''.$link.'\','.$id.')" class="btn btn-round '.$class.'">'.$title.'</a>';
        return $xhtml;
    }

    public static function minPrice(){
        return floor(\App\Models\ProductModel::min('price'));
    }
    public static function maxPrice(){
        return floor(\App\Models\ProductModel::max('price'));
    }

    public static function currency_load(){
        if(session()->has('system_default_currency_info') == false){
            session()->put('system_default_currency_info',\App\Models\CurrencyModel::find(1));
        }
    }

    public static function currency_converter($amount){
        return format_price(convert_price($amount));
    }

}
if(!function_exists('convert_price')){
    function convert_price($price){
        Template::currency_load();
        $system_default_currency_info = session('system_default_currency_info');
        $price = floatval($price)/floatval($system_default_currency_info->exchange_rate);

        if(Session::has('currency_exchange_rate')){
            $exchange = session('currency_exchange_rate');
        }else{
            $exchange = $system_default_currency_info->exchange_rate;
        }
        $price = floatval($price) * floatval($exchange);
        return $price;
    }
}

if(!function_exists('currency_symbol')){
    function currency_symbol(){
        Template::currency_load();
        if(session()->has('currency_symbol')){
            $symbol = session('currency_symbol');
        }else{
            $system_default_currency_info = session('system_default_currency_info');
            $symbol = $system_default_currency_info->symbol;
        }
        return $symbol;
    }
}

if(!function_exists('format_price')){
    function format_price($price){
        return currency_symbol() . number_format($price,2);
    }
}