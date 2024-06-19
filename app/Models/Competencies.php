<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencies extends Model
{
    use HasFactory;
    protected $fillable = [
        'softskills',
        'techskills'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
