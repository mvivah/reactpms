<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $guarded = [];
    //user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
