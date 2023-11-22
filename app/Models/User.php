<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    private $folderUpload = 'user';
    private $fileImage = [
        'thumb' => ['width' => 150],
        'standard' => ['width' => 300],
    ];


    private $paramFilter = [
        'id',
        'name',
        'description'
    ];


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
        $data['email'] = $params['email'];
        if(isset($data['picture'])){
            $picture = $this->saveImage($data['picture']);
            $data['picture'] = $picture;
        }
        $data['password'] = Hash::make($params['password']);
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
