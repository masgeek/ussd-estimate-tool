<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FertilizerPriceRange extends Model
{
    public $timestamps = false;

    public function fertilizer()
    {
        return $this->belongsTo('App\Fertilizer','fertilizer_id');
    }
}
