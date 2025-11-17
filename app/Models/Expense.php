<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function expense_type(){
        return $this->belongsTo(ExpenseType::class);
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }
    public static function laratablesCustomStatus(Expense $expense)
    {
        if($expense->status == 'Unverified'){
            return '<span class="badge bg-warning">Unverified</span>';
        }elseif($expense->status == 'Verified'){
            return '<span class="badge bg-success">Verified</span>';
        }else{
            return '<span class="badge bg-danger">Rejected</span>';
        }
    }
    public static function laratablesCustomAction(Expense $expense)
    {
        $data = array(
            'expense'=>$expense,
        );
        return view('actions.expense_actions')->with($data)->render();
    }
    //additional columns
    public static function laratablesAdditionalColumns()
    {
        return ['id','status'];
    }
}
