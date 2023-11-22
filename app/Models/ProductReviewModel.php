<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductReviewModel extends Model
{
    use HasFactory;
    protected $table = 'product_review';

    public function saveItem($params)
    {
        $data = $params['form'];
        $data['created_at'] = Carbon::now();
        $this->insert($data);
    }

}
