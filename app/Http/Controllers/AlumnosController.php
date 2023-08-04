<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $texto = trim($request->get('texto'));
        $alumnos = Alumno::with('nivel') // Carga la relación con el modelo Nivel
            ->select('id', 'matricula', 'nombre', 'fecha_nacimiento', 'telefono', 'email', 'nivel_id')
            ->where('nombre', 'LIKE', '%' . $texto . '%')
            ->orWhere('matricula', 'LIKE', '%' . $texto . '%')
            ->orderBy('nombre', 'asc')
            ->paginate(2);
           // dd($alumnos->toArray());


    
        return view('alumnos.index', compact('alumnos', 'texto'));
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // En el create donde se formula el formulario Este es el que inserta los registros
    {
       $niveles=Nivel::all(); //De esta forma se manda a llamar la tabla nivel de la base de datos
       return view('alumnos.create', ['niveles' => $niveles]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //El store donde aplica la validacion al formulario como tambien
    //donde se crea el objeto el cual se encargara de insertar el registro a la base de datos
    {
        $request->validate([
            'matricula'=> 'required|unique:alumnos|max:10',
            'nombre' => 'required|max:255',
            'fecha'=>'required|date',
            'telefono' =>'required',
            'email'=> 'nullable|email',
            'nivel'=>'required'
        ]);

        Alumno::create([
            'matricula' => $request->input('matricula'),
            'nombre' => $request->input('nombre'),
            'fecha_nacimiento' => $request->input('fecha'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'nivel_id' => $request->input('nivel'),
        ]);
        

        return view("alumnos.menssage",['msg'=> "Registro guardado"]); //Este reurn va a mostrar un msn cuando el regsitra
        //se haya guardado correctamente para esto se crea otra vista menssage.blade.php
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) //Actualizar
    {
        $alumno=Alumno::find($id);
        $a=['alumno' => $alumno, 'niveles' => Nivel::all()];
        return view('alumnos.edit',$a);
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) //Actualizar
    {
        $request->validate([
            'matricula' => 'required|max:10|unique:alumnos,matricula,'.$id,//Se esta agregando una excepcion  de que se va omitir la validacion de la matricula si el id pertenece al registro
            'nombre' => 'required|max:255',
            'fecha' => 'required|date',
            'telefono' => 'required',
            'email' => 'nullable|email',
            'nivel' => 'required'
        ]);
        
//Los input se encapsula en un request se accede de esta manera $request->input
        $alumno=Alumno::find($id);
        $alumno->matricula= $request->input('matricula');
        $alumno->nombre= $request->input('nombre');
        $alumno->fecha_nacimiento= $request->input('fecha');
        $alumno->telefono= $request->input('telefono');
        $alumno->email= $request->input('email');
        $alumno->nivel_id= $request->input('nivel');
        $alumno->save();
        return view("alumnos.menssage",['msg'=> "Registro Correctamente Actualizado"]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) //Eliminar
    {
        $alumno= Alumno::find($id);
        $alumno->delete();

        return redirect("alumnos");
        
        
    }

    public function boton(Request $request)
    {
       $numero=2;
       $num=10;
       $resultado=$numero+$num;
        echo ('El resultado de la suma es '.$resultado);
    }
    

}
