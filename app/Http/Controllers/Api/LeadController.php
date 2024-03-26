<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        $validator = Validator::make($data,
        [
            'name' => 'required|min:2|max:255',
            'email' => 'required|min:2|max:255',
            'message' => 'required|min:2',
        ],
        [
            'name.required' => 'Il nome è un campo obbligatori',
            'name.min' => 'Il nome deve avere almeno :min caratteri',
            'name.max' => 'Il nome deve avere non più di :max caratteri',
            'email.required' => 'Il email è un campo obbligatori',
            'email.min' => 'Il email deve avere almeno :min caratteri',
            'email.max' => 'Il email deve avere non più di :max caratteri',
            'message.required' => 'Il message è un campo obbligatori',
            'message.min' => 'Il message deve avere almeno :min caratteri',
        ]
    );

    // se i dati non sono validi restituisco [success = false], e i messaggi di errore
    if($validator->fails()){
        $success = false;
        $errors = $validator->errors();

        return response()->json(compact('success','errors'));
    }
    // se non ci sono errori:
    //1- conservo i dati nel DB

    //2- invio email,

    //3- restituisco [success = true]
    $success = true;
        return response()->json(compact('success','data'));
    }
}
