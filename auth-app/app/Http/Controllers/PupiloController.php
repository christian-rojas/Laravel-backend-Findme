<?php

namespace App\Http\Controllers;

use App\Pupilo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PupiloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return  Pupilo::where('user_id',auth()->id())->get();

        /*if($request->ajax()){
            return Pupilo::where('user_id',auth()->id())->get();

        }else{
            return view ('home');
        }*/
        return response()->json(Pupilo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$product = new Pupilo;
        return view('pupilos.create', ['pupilos' => $product]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = new Pupilo();
        $nota->nombre = $request->nombre;
        $nota->enfermedad = $request->enfermedad;
        $nota->direccion = $request->direccion;
        $nota->telefono = $request->telefono;
        $nota->precauciones = $request->precauciones;
        $nota->user_id = auth()->id();
        $nota->save();

    return $nota;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pupilo  $pupilo
     * @return \Illuminate\Http\Response
     */
    public function show(Pupilo $pupilo,$id)
    {
        $product = Pupilo::find($id);
        //return view('products.show',['product' => $product]);*/
        //$nota = "hola edit";
        /*$nota->nombre = $request->nombre;
        $nota->enfermedad = $request->enfermedad;
        $nota->direccion = $request->direccion;
        $nota->telefono = $request->telefono;
        $nota->precauciones = $request->precauciones;
        $nota->save();*/
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pupilo  $pupilo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //$nota = Pupilo::find($id);
        $nota = "hola edit";
        /*$nota->nombre = $request->nombre;
        $nota->enfermedad = $request->enfermedad;
        $nota->direccion = $request->direccion;
        $nota->telefono = $request->telefono;
        $nota->precauciones = $request->precauciones;
        $nota->save();*/
        return $nota;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pupilo  $pupilo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nota = Pupilo::find($id);
        $nota->nombre = $request->nombre;
        $nota->enfermedad = $request->enfermedad;
        $nota->direccion = $request->direccion;
        $nota->telefono = $request->telefono;
        $nota->precauciones = $request->precauciones;
        $nota->save();
        return $nota;
    //$nota = "hola update";
    //return $nota;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pupilo  $pupilo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pupilo $pupilo,$id)
    {
        Pupilo::destroy($id);
        //$nota = Pupilo::find($id);
        //$nota->delete();
        //return redirect('/products');
    }
}
