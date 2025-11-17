<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ExpenseType extends Model
{
    public static function laratablesCustomAction(ExpenseType $expense_type)
    {
        $data = array(
            'expense_type'=>$expense_type,
        );
        return view('actions.expense_type_actions')->with($data)->render();
    }

}
