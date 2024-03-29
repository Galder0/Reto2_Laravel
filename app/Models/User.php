<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    // protected static function boot()
    // {
    //     parent::boot();

    //     // Listen for the 'created' event
    //     static::created(function ($user) {
    //         // Check if roles are specified, if not, assign the 'user' role
    //         if (!$user->roles || $user->roles->isEmpty()) {
    //             $user->roles()->attach(Role::where('name', 'student')->first()->id);
    //         }
    //     });
    // }

    public function users() 
    {
        return $this->belongsToMany(User::class, 'cycles_users');
    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }    

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');

    }

    public function cycles()
    {
        return $this->belongsToMany(Cycle::class, 'modules_cycles_users', 'user_id', 'cycle_id');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'modules_cycles_users', 'user_id', 'module_id');
    }

    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function chat()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'surnames', 'DNI', 'email', 'direction', 'phone_number', 'fct_dual', 'password', 'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
