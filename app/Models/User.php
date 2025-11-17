<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'staff_id',
        'firstname',
        'lastname',
        'gender',
        'birthdate',
        'phone_number',
        'email',
        'password',
        'role_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'created_by', 'id');
    }
    public function logins()
    {
        return $this->hasMany(Login::class);
    }
    //last login
    public function lastLogin()
    {
        return $this->logins()->latest()->first();
    }
    public function isOwner()
    {
        return $this->role->name == 'owner';
    }
    public function hasRole($role)
    {
        return $this->role->name == $role;
    }
    public static function laratablesCustomAction(User $user)
    {
        $data = array(
            'user'=>$user,
        );
        return view('actions.user_actions')->with($data)->render();
    }
    public static function laratablesCustomUserStatus(User $user)
    {
        $html = '';
        if($user->status == 1){
            $html = '<span class="badge bg-success">Active</span>';
        }else{
            $html = '<span class="badge bg-danger">Inactive</span>';
        }
        return $html;
    }
    //additional columns
    public static function laratablesAdditionalColumns()
    {
        return['id','status'];
    }
}
