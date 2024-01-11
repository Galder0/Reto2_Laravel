<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Cycle extends Model
{
    use HasFactory;

    // public function modules() {
    //     return $this->hasMany(Module::class);
    // }

public function cycles()
{
    return $this->belongsToMany(Cycle::class, 'cycles_users');
}

public function departments()
{
    return $this->belongsTo(Department::class);
}
public function modules()
{
    return $this->belongsToMany(Module::class, 'cycles_modules', 'cycle_id', 'module_id');
}

public function users()
{
    return $this->belongsToMany(User::class, 'modules_cycles_users', 'cycle_id', 'user_id');

}

    protected $fillable = ['name', 'code', 'department_id'];

}


