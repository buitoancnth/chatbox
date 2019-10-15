<?php

namespace App;

// use QCod\ImageUp\HasImageUploads;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // use HasImageUploads;
    protected $fillable = [
        'user_id','description', 'share_mode','image','published_at'
    ];

    // protected $imageFields = [
    //     'image'
    // ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
