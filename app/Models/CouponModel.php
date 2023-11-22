<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CouponModel extends Model
{
    use HasFactory;
    protected $table = 'coupon';

    private $folderUpload = 'coupon';
    private $fileImage = [
        'thumb' => ['width' => 150],
        'standard' => ['width' => 300],
    ];


    private $paramFilter = [
        'id',
        'name',
        'description'
    ];

    public function discount($total){
        if($this->type == 'fixed'){
            return $this->value;
        }elseif($this->type == 'percent'){
            return number_format(($this->value/100),2)*str_replace(',', '', $total);
        }else{
            return 0;
        }
    }


    public function listItem($params = null)
    {
        $query = $this->select('*');
        if ($params['select_filter']['status'] != 'default') {
            $query->where('status', $params['select_filter']['status'])->get();
        }
        if (!empty($params['search']['value'])) {
            if ($params['search']['field'] != 'all') {
                $paramFilter = in_array($params['search']['field'], $this->paramFilter) ? $params['search']['field'] : 'id';
                $query->where($paramFilter, 'LIKE', '%' . $params['search']['value'] . '%');
            } else {
                foreach ($this->paramFilter as $value) {
                    $query->orWhere($value, 'LIKE', '%' . $params['search']['value'] . '%');
                }
            }
        }
        $query = $query->orderBy("id", "DESC")->get();
        return $query;
    }

    public function saveItem($params)
    {
        $data = $params['form'];
        $data['created_at'] = Carbon::now();
        $this->insert($data);
    }

    public function getImage($options = null)
    {
        if ($options == null) {
            $img = asset('admin/img/' . $this->folderUpload . '/' . $this->picture);
            return $img;
        }
    }
}
