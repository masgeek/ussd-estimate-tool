<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public function locations(){
        return $this->hasMany('App\Location', 'ward_id');
    }

}
