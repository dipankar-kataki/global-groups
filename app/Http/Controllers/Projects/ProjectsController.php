<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function allOngoingProjects(){
        return view('content.projects.ongoing.all-ongoing');
    }
}
