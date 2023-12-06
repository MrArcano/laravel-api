<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TecnologyRequest;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TecnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnologies = Tecnology::orderBy("id","desc")->paginate(10);
        return view('admin.tecnologies.index', compact('tecnologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // sto utilizzando direttamente la pagina index, che rimanda allo store per creare una nuova istanza
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TecnologyRequest $request)
    {
        $exist = Tecnology::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.tecnology.index')->with('error','Tecnologia già presente!');
        }else{
            $new_tecnologies = new Tecnology;
            $new_tecnologies->name = $request->name;
            $new_tecnologies->slug = Str::slug($request->name, '-');
            $new_tecnologies->save();
            return redirect()->route('admin.tecnology.index')->with('success','Tecnologia aggiunta con successo!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TecnologyRequest $request, Tecnology $tecnology)
    {
        $form_data = $request->all();

        $exist = Tecnology::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.tecnology.index')->with('error','Tecnologia già presente!');
        }

        $form_data['slug'] = Helper::generateSlug($request->name , Tecnology::class);
        $tecnology->update($form_data);
        return redirect()->route('admin.tecnology.index')->with('success','Modificato correttamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tecnology $tecnology)
    {
        $tecnology->delete();
        return redirect()->route('admin.tecnology.index')->with('success','Cancellato con successo!');
    }

    public function projectTecnology(Tecnology $tecnology){

        // Lista dei tipi
        $types = Type::all();

        // Progetti che hanno la tecnologia ricercata
        $projects = $tecnology->projects()->paginate(10);

        $type_id_form = null;
        $order='asc';

        return view('admin.projects.index', compact('projects','types','type_id_form','tecnology','order'));
    }
}
