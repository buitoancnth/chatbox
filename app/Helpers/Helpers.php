<?php

namespace App\Helpers;

use Carbon\Carbon;
Class Helper {
    public static function getAge($birth_day){
        return Carbon::parse($birth_day)->age;
    }
}
