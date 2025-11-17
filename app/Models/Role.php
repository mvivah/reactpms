<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public static function laratablesCustomAction(Role $role)
    {
        $data = array(
            'role'=>$role,
        );
        return view('actions.role_actions')->with($data)->render();
    }
    public static function laratablesCustomUsers(Role $role)
    {
        return $role->users->count();
    }

    public static function laratablesAdditionalColumns()
    {
        return ['id'];
    }
}
