<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $projects_count = count(Project::all());
        $tecnologies_count = count(Tecnology::all());
        $types_count = count(Type::all());
        return view('admin.home',compact('projects_count','tecnologies_count','types_count'));
    }
}
