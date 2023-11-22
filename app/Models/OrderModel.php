<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'order';



    public function products()
    {
        return $this->belongsToMany(ProductModel::class,'product_order')->withPivot('quantity');
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
        $data = $params;
        $data['created_at'] = Carbon::now();
        $this->insert($data);
    }
    
}
