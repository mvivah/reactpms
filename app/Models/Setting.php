<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'company_name',
        'app_name',
        'company_phone',
        'currency_name',
        'currency_code',
        'from_email',
        'from_name',
        'company_address',
        'profit_percentage',
        'shelf_life',
        'credit_period',
    ];
}
