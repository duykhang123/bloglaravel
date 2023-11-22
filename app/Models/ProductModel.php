<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';

    private $folderUpload = 'product';
    private $fileImage = [
        'thumb' => ['width' => 150],
        'standard' => ['width' => 300],
    ];


    private $paramFilter = [
        'id',
        'name',
        'description'
    ];

    public function categories()
    {
        return $this->belongsTo(ProductCategoryModel::class,'p_category_id');
    }

    public function brands()
    {
        return $this->belongsTo(BrandModel::class,'brand_id');
    }

    public function rel_product()
    {
        return $this->hasMany(ProductModel::class,'p_category_id','p_category_id')->where('status',1)->limit(10);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReviewModel::class,'product_id');
    }

    public static function getProductByCart($id){
        return self::where('id',$id)->get()->toArray();
    }

    public function orders()
    {
        return $this->belongsToMany(OrderModel::class,'product_order')->withPivot('quantity');
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
        $query = $query->orderBy("id", "DESC")->paginate(7);
        return $query;
    }

    public function saveItem($params)
    {
        $data = $params['form'];
        if(isset($params['gallary'])){
            foreach($params['gallary'] as $key => $value){
                $arrGalarry[] = $this->saveImage($value);
            }
            $data['gallary'] = serialize($arrGalarry);
        }
        if(isset($data['picture'])){
            $picture = $this->saveImage($data['picture']);
            $data['picture'] = $picture;
        }
        $data['slug'] = Str::slug($data['name'], '-');
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

    public function saveImage($params)
    {
        $img = Image::make($params);
        $name = Str::random(8) . "." . $params->getClientOriginalExtension();
        $img->save('admin/img/' . $this->folderUpload . '/' . $name);
        if (!empty($this->fileImage)) {
            foreach ($this->fileImage as $key => $value) {
                $img->resize($value['width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('admin/img/' . $this->folderUpload . '/' . $key . '/' . $name);
            }
        }
        return $name;
    }

    public function removeImage()
    {
        $image_path = public_path() . "/admin/img/" . $this->folderUpload . '/' .$this->picture;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        if (!empty($this->fileImage)) {
            foreach ($this->fileImage as $key => $value) {
                $file_rezie = public_path() . "/admin/img/" . $this->folderUpload . '/' . $key . '/' .$this->picture;
                if (File::exists($file_rezie)) {
                    File::delete($file_rezie);
                }
            }
        }
    }

    public function removeGallary($arrGalarry){
        $gallary_path = public_path() . "/admin/img/" . $this->folderUpload . '/' .$arrGalarry;
        if (File::exists($gallary_path)) {
            File::delete($gallary_path);
        }
        if (!empty($this->fileImage)) {
            foreach ($this->fileImage as $key => $value) {
                $file_rezie = public_path() . "/admin/img/" . $this->folderUpload . '/' . $key . '/' .$arrGalarry;
                if (File::exists($file_rezie)) {
                    File::delete($file_rezie);
                }
            }
        }
    }

}
