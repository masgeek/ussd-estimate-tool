<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    public $timestamps = false;

    protected $fillable = ['display', 'value'];

}
