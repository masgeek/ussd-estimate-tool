<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 11/28/17
 * Time: 3:45 PM
 */

namespace App\Repository;


use App\Project;

class ProjectRepository
{


    public function fetch($data)
    {
        //dd($data);
        $query = Project::query()
            ->join('financial_years','projects.financial_year_id','=','financial_years.id')
            ->join('wards','projects.ward_id','=','wards.id')
            ->join('locations','projects.location_id','=','locations.id')
            ->join('sub_locations','projects.sub_location_id','=','sub_locations.id');

        if (isset($data['financial_year'])) {
            $query->where('financial_year_id', $data['financial_year']);
        }

        if (isset($data['ward'])) {
            $query->where('ward_id', $data['ward']);
        }

        if (isset($data['location'])) {
            $query->where('location_id', $data['location']);
        }

        if (isset($data['sub_location'])) {
            $query->where('sub_location_id', $data['sub_location']);
        }

        if (isset($data['limit'])) {
            $query->take($data['limit']);
        }

        return $query->get([
            'projects.id','projects.name','projects.financial_year_id','financial_years.name as financial_year','projects.sector','projects.ward_id','wards.name as ward',
            'projects.location_id','locations.name as location','projects.sub_location_id',
            'sub_locations.name as sub_location','projects.activity','projects.allocation','projects.summary'
        ]);

    }


}