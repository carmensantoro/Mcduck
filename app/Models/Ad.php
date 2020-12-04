<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'price'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
