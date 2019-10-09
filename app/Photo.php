<?php

namespace App;

use QCod\ImageUp\HasImageUploads;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasImageUploads;
    protected $fillable = [
        'description', 'share_mode'
    ];

    protected $imageFields = [
        'image'
    ];
}
