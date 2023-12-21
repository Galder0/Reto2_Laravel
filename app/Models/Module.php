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
    return $this->belongsToMany(Cycle::class, 'cycles_modules', 'module_id', 'cycle_id');
}

protected $fillable = ['name', 'code', 'numberhours', 'year'];

}
