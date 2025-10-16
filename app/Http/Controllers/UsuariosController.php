<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sucursales;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   /*  public function PrimerUsusario()
    {
        User::create([
            'name' => 'Gio Santos',
            'email' => 'admin@gmail.com',
            'foto' => '',
            'estado' => 1,
            'ultimo_login' => '',
            'rol' => 'Administrador',
            'password' => Hash::make('123'),
            'id_sucursal' => 0,
        ]);
    } */

    public function ActualizarMisDatos(Request $request)
    {
        if(auth()->user()->email != request('email')){
            if(request('password')){
                $datos = request()->validate([
                    'name'=> ['required','string','max:50'],
                    'email'=> ['required','email','unique:users'],
                    'passsword'=> ['required','string','min:3'],
                ]);
            } else {
                $datos = request()->validate([
                'name'=> ['required','string','max:50'],
                'email'=> ['required','email','unique:users'],
                ]);
            }
        } else {
            if(request('password')){
                $datos = request()->validate([
                'name'=> ['required','string','max:50'],
                'email'=> ['required','email'],
                'passsword'=> ['required','string','min:3'],
                ]);
            } else {
                $datos = request()->validate([
                'name'=> ['required','string','max:50'],
                'email'=> ['required','email'],
                ]);
            }
        }
        if(request('fotoPerfil')){
            if(auth()->user()->foto != ''){
                $path = storage_path('app/public/'.auth()->user()->foto);
                unlink($path);
            }
            $rutaImg = $request['fotoPerfil']->store('users','public');
        } else {
            $rutaImg = auth()->user()->foto;
        }

        if(isset($datos["password"])){
            DB::table('users')->where('id', auth()->user()->id)
            ->update([
                'name'=>$datos["name"],
                'email'=>$datos["email"],
                'foto'=>$rutaImg,
                'password'=>Hash::make($datos["password"]),
            ]);
        } else {
            DB::table('users')->where('id', auth()->user()->id)
            ->update([
                'name'=>$datos["name"],
                'email'=>$datos["email"],
                'foto'=>$rutaImg,
            ]);
        }
        return redirect('Mis-Datos');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->rol != 'Administrador'){
            return redirect('Inicio');
        }

        $usuarios = User::all();
        $sucursales = Sucursales::where('status',1)->get();
        return view('modulos.users.Usuarios', compact('usuarios','sucursales'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validarEmail = request()->validate([
            'email' => ['unique:users']
        ]);

        $datos = request();

        if($datos["rol"] != 'Administrador'){
            $cod_sucursal = 0;
        } else {
            $cod_sucursal = $datos["cod_sucursal"];
        }

        User::create([
            'name'=>$datos["name"],
            'email'=>$validarEmail["email"],
            'cod_sucursal'=>$cod_sucursal,
            'foto'=>'',
            'password'=>Hash::make($datos["password"]),
            'status'=>'Administrador',
            'ultimo_login'=>null,
            'rol'=>$datos["rol"]
        ]);
        redirect('Usuarios')->with('success','El usuarios ha sido creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
