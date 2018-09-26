<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class USSDSession extends Model
{
    // 'plantingDate','harvestDate','investment','fieldArea','unitPrice','unitOfSale'

    public function plantingDate()
    {
        return $this->belongsTo('App\PlantingDate', 'planting_date_id');
    }

    public function harvestQuantity()
    {
        return $this->belongsTo('App\Quantity', 'harvest_quantity_id');
    }

    public function harvestDate()
    {
        return $this->belongsTo('App\HarvestingDate', 'planting_date_id');
    }

    public function investment()
    {
        return $this->belongsTo('App\Investment', 'investment_id');
    }

    public function fieldArea()
    {
        return $this->belongsTo('App\FieldArea', 'field_area_id');
    }

    public function unitPrice()
    {
        return $this->belongsTo('App\UnitPrice', 'unit_price_id');
    }

    public function unitOfSale()
    {
        return $this->belongsTo('App\UnitOfSale', 'unit_of_sale_id');
    }

}
