<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['estudiantes']=Estudiante::paginate(3);  
        return view('estudiante.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('estudiante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos,$mensaje);

        //$datosEstudiante = request()->all();

        $datosEstudiante = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosEstudiante['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Estudiante::insert($datosEstudiante);


        //return response()->json($datosEstudiante);
        return redirect('estudiante')->with('mensaje','Estudiante agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $estudiante=Estudiante::findOrFail($id);
        return view('estudiante.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Correo'=>'required|email',
            
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request, $campos,$mensaje);


        //
        $datosEstudiante = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){

            $estudiante=Estudiante::findOrFail($id);

            Storage::delete('public/'.$estudiante->Foto);

            $datosEstudiante['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Estudiante::where('id','=',$id)->update($datosEstudiante);
        $estudiante=Estudiante::findOrFail($id);
        //return view('estudiante.edit', compact('estudiante'));
        return redirect('estudiante')->with('mensaje','Empleado Modificado');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $estudiante=Estudiante::findOrFail($id);
        if(Storage::delete('public/'.$estudiante->Foto)){

            Estudiante::destroy($id);
        }
        
        return redirect('estudiante')->with('mensaje','Empleado Borrado');
    }
}
