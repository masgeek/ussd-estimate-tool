<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 11/28/17
 * Time: 3:29 PM
 */

namespace App\Repository;


use App\FinancialYear;
use App\Location;
use App\SubLocation;
use App\Ward;

class FilterRepository
{
    public function fetch()
    {
        return [

            'financial_years' => FinancialYear::orderBy('name', 'desc')->get(),

            'wards' => Ward::orderBy('name', 'asc')->get(),

            'locations' => Location::orderBy('name', 'asc')->get(),

            'sub_locations' => SubLocation::orderBy('name', 'asc')->get()

        ];

    }
}