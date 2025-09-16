<?php

namespace App\Http\Controllers;

use App\Models\Sucursales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modulos.users.Sucursales');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Obtener la abreviatura del nombre de la sucursal
        $abreviatura = strtoupper(substr($request->name, 0, 3));

        // 2. Obtener el último ID auto-incrementado para el correlativo
        $lastSucursal = Sucursales::latest('id')->first();
        $correlativo = 1;
        if ($lastSucursal) {
            $correlativo = $lastSucursal->id + 1;
        }

        // 3. Juntar las partes para el nuevo código de sucursal
        $newCodSucursal = 'Suc' . '-' . $abreviatura . '-' . $correlativo;

        // 4. Crear la sucursal en la base de datos
        Sucursales::create([
            'cod_sucursal' => $newCodSucursal,
            'name' => $request->name,
            'status' => 'Activo'
        ]);

        return redirect('Sucursales');
        }

    /**
     * Display the specified resource.
     */
    public function show(Sucursales $sucursales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sucursales $sucursales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sucursales $sucursales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sucursales $sucursales)
    {
        //
    }
}
