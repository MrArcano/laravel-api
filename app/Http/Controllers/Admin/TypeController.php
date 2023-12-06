<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy("id","desc")->paginate(10);
        return view('admin.types.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $exist = Type::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.type.index')->with('error','Categoria già presente!');
        }else{
            $new_type = new Type;
            $new_type->name = $request->name;
            $new_type->slug = Str::slug($request->name, '-');
            $new_type->save();
            return redirect()->route('admin.type.index')->with('success','Categoria aggiunta con successo!');
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
    public function update(TypeRequest $request, Type $type)
    {
        $form_data = $request->all();

        $exist = Type::where('name', $request->name)->first();
        if ($exist) {
            return redirect()->route('admin.type.index')->with('error','Tipo già presente!');
        }

        $form_data['slug'] = Helper::generateSlug($request->name , Type::class);
        $type->update($form_data);
        return redirect()->route('admin.type.index')->with('success','Modificato correttamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.type.index')->with('success','Cancellato con successo !');
    }

    public function projectType(Request $request){

        // Lista dei tipi
        $types = Type::all();

        $type = $request->type_id;

        // Progetti che hanno la tecnologia ricercata
        $projects = Project::where("type_id",$type)->orderBy("id","desc")->paginate(10);

        $projects->appends(["type_id" => $type]);

        $type_id_form = $type;

        $tecnology = null;
        $order='asc';

        return view('admin.projects.index', compact('projects','types','type_id_form','tecnology','order'));
    }
}
