<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSelection extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    //protected $fillable=['selection_id','characteristic_id','tree_name','score'];
    protected $guarded = [];

    public function selections() 
    {
        return $this->belongsTo(Selection::class);
    }

    public function chars()
    {
        return $this->belongsTo(Characteristic::class,'characteristic_id');
    }
}
