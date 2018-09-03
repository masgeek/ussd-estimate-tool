<?php

namespace App\Http\Controllers;

use App\Repository\FilterRepository;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $repo;

    /**
     * FilterController constructor.
     * @param FilterRepository $repo
     */
    public function __construct(FilterRepository $repo)
    {
        $this->repo = $repo;
    }

    public function  fetch()
    {
        return response($this->repo->fetch());
    }
}
