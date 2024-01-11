<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Module extends Model
{
    use HasFactory;

    
    public function cycles()
{
    return $this->belongsToMany(Cycle::class, 'modules_cycles_users', 'module_id', 'cycle_id');
}

    public function users()
{
    return $this->belongsToMany(User::class, 'modules_cycles_users', 'module_id', 'user_id');
}


protected $fillable = ['name', 'code', 'numberhours', 'year'];

}
