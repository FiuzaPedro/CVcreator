<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    use HasFactory;

    protected $fillable = [
        'edu_date',
        'location',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
