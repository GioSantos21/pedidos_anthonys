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
        if(auth()->user()->rol != 'Administrador') {
            return redirect('Inicio');
        }
        $sucursales = Sucursales::all();
        return view('modulos.users.Sucursales', compact('sucursales'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Obtener la abreviatura del nombre de la sucursal (ej: "Matriz" -> "Mat")
        $abreviatura = ucfirst(strtolower(substr($request->name, 0, 5)));

        // 2. Lógica Clave: Obtener el correlativo basado en la abreviatura existente

        // Patrón a buscar: 'Suc-Mat-%' (para Matriz)
        $searchPattern = 'Suc-' . $abreviatura . '-%';

        // Contar cuántas sucursales existen con esa abreviatura.
        // El nuevo correlativo será el conteo existente + 1.
        $count = Sucursales::where('cod_sucursal', 'like', $searchPattern)->count();

        // Si es la primera vez (count=0), el correlativo es 1.
        // Si ya existen 2 (count=2), el nuevo correlativo es 3.
        $correlativo = $count + 1;


        // 3. Juntar las partes para el nuevo código de sucursal
        // Ejemplo: Suc-Mat-1 o Suc-Met-2
        $newCodSucursal = 'Suc' . '-' . $abreviatura . '-' . $correlativo;

        // 4. Crear la sucursal en la base de datos
        Sucursales::create([
            'cod_sucursal' => $newCodSucursal,
            'name' => $request->name,
            'status' => 'Activo'
        ]);

        return redirect('Sucursales')->with('success','La sucursal se agrego correctamente');
        }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($cod_sucursal)
    {
        $sucursal = Sucursales::find($cod_sucursal);
        return response()->json($sucursal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Sucursales::where('id', $request->id)->update(['name'=>$request->name]);
        return redirect('Sucursales')->with('success', 'La sucursal ha sido actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CambiarEstado($status, $cod_sucursal)
    {
        Sucursales::find($cod_sucursal)->update(['status'=>$status]);

        return redirect('Sucursales');
    }
}
