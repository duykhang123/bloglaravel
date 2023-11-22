<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BrandModel extends Model
{
    use HasFactory;
    protected $table = 'brand';

    private $folderUpload = 'brand';
    private $fileImage = [
        'thumb' => ['width' => 150],
        'standard' => ['width' => 300],
    ];


    private $paramFilter = [
        'id',
        'name',
        'description'
    ];


    public function products()
    {
        return $this->hasMany(ProductModel::class,'brand_id');
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
}
