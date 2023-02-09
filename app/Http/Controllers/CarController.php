<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return view('car.index')->with('mycars', $user->cars()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'foto' => 'required|image'
        ]);

        try {
            $mycar = new Car();
            $mycar->matricula = $request->matricula;
            $mycar->marca = $request->marca;
            $mycar->modelo = $request->modelo;
            $mycar->year = $request->year;
            $mycar->color = $request->color;
            $mycar->fecha_ultima_revision = $request->fecha_ultima_revision;
            $mycar->precio = $request->precio;
            $mycar->user_id = Auth::id();
            $nombrefoto = time() . "-" . $request->file('foto')->getClientOriginalName();
            $mycar->foto = $nombrefoto;
            $mycar->save();
            $request->file('foto')->storeAs('public/img_cars', $nombrefoto);
            return redirect()->route('car.index')->with('status', "Coche creado correctamente");
        } catch (QueryException $e) {
            return redirect()->route('car.index')->with('status', "No se ha podido crear el coche");
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
        $car = Car::findOrFail($id);
        $url = 'storage/img_cars/';
        return view('car.show')->with('car', $car)->with('url', $url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $url = 'storage/img_cars/';
        return view('car.edit')->with('car', $car)->with('url', $url);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'matricula' => 'required',
            'marca' => 'required',
            'modelo' => 'required'
        ]);

        try {
            $mycar = Car::findOrFail($id);
            $mycar->matricula = $request->matricula;
            $mycar->marca = $request->marca;
            $mycar->modelo = $request->modelo;
            $mycar->year = $request->year;
            $mycar->color = $request->color;
            $mycar->fecha_ultima_revision = $request->fecha_ultima_revision;
            $mycar->precio = $request->precio;
            $mycar->user_id = Auth::id();
            if (is_uploaded_file($request->foto)) {
                $nombrefoto = time() . "-" . $request->file('foto')->getClientOriginalName();
                $mycar->foto = $nombrefoto;
                $request->file('foto')->storeAs('public/img_cars', $nombrefoto);
            }
            $mycar->save();
            return redirect()->route('car.index')->with('status', "Coche modificado correctamente");
        } catch (QueryException $e) {
            return redirect()->route('car.index')->with('status', "No se ha podido modificar el coche");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $mycar = Car::findOrFail($id);
            $mycar->delete();
            return redirect()->route('car.index')->with('status', "Coche eliminado correctamente");
        } catch (QueryException $e) {
            return redirect()->route('car.index')->with('status', "No se ha podido eliminado el coche");
        }
    }
}
