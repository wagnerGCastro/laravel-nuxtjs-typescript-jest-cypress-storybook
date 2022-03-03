<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable =  ['name', 'description', 'status'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
