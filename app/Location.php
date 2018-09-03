<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'country_id', 'county_id', 'sub_county_id', 'ward_id'];

    public function ward()
    {
        return $this->belongsTo('App\Ward', 'ward_id');

    }

    public function subLocations()
    {
        return $this->hasMany('App\SubLocation', 'location_id');

    }

}
