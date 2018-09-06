<?php

use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed();
    }

    public function seed(){
        //planting dates
        $this->insert("planting_dates", \App\Constants\DefaultData::PLANTING_DATES);
        //harvesting dates
        $this->insert("harvesting_dates", \App\Constants\DefaultData::HARVESTING_DATES);
        //field areas
        $this->insert("field_areas", \App\Constants\DefaultData::FIELD_AREAS);
        //fertilizers
        $this->insert("fertilizers", \App\Constants\DefaultData::FERTILIZERS);
        //price_ranges
        $this->insert("price_ranges", \App\Constants\DefaultData::PRICE_RANGES);
        //units of sale
        $this->insert("unit_of_sales", \App\Constants\DefaultData::UNITS_OF_SALE);
        //unit_prices
        $this->insert("unit_prices", \App\Constants\DefaultData::UNIT_PRICES);
        //investments
        $this->insert("investments", \App\Constants\DefaultData::MAXIMAL_INVESTMENTS);
    }

    public function insert($table, array $data)
    {
        foreach ($data as $datum) {
            DB::table($table)->insert($datum);
        }
    }
}
