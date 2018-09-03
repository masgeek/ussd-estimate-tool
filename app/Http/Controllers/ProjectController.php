<?php

namespace App\Http\Controllers;

use App\Repository\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $repo;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $repo
     */
    public function __construct(ProjectRepository $repo)
    {
        $this->repo = $repo;
    }


    public function  fetch(Request $request)
    {
        return response($this->repo->fetch($request->all()));
    }
}
