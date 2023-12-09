<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('type','tecnologies')->paginate(9);
        return response()->json($projects);
    }

    public function getProject($slug) {
        $project = Project::where('slug', $slug)->with('type','tecnologies')->first();

        if($project){
            // riformatto il dato dell'url img per averlo direttamente dall'API
            if($project['image']){
                $project['image'] = asset('storage/' . $project->image);
            }else{
                $project['image'] = asset('img/placeholder.png');
            }
        }else{
            // se la query non trova nessuna corrispondenza, restituisco un array vuoto
            $project = [];
        }
        return response()->json($project);
    }
}
