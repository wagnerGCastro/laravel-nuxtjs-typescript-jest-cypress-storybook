<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'status'];

    public $statusOptions = [
        'A' => 'Active',
        'I' => 'Inactive'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
