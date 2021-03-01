<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;
    protected $fillable=['id','code','name','description','user_id','weight'];

    public function detailSelections() 
    {
        return $this->hasMany(DetailSelection::class);
    }
}
