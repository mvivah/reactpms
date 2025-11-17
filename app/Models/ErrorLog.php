<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    public static function log($messsage){
        $log = new Errorlog();
        $log->error_message = $messsage;
        $log->save();
    }
}
