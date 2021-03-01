<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasFactory;

    //protected $fillable=['id','variety_id','description'];
    protected $guarded = [];
    public function varieties() 
    {
        return $this->belongsTo(Variety::class,'variety_id');
    }

    public function selectionDetail()
    {
        return $this->hasMany(DetailSelection::class);
    }
}
