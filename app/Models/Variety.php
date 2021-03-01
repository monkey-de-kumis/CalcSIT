<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','image','description','user_id'];

    public function selections() 
    {
        return $this->hasMany(Selection::class,'id');
    }
}
