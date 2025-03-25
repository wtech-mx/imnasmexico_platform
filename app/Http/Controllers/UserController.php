<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotasProductos;
use App\Models\NotasProductosCosmica;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Session;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where('cliente','=',null)->where('visibilidad', '=', NULL)->orderBy('id','DESC')->get();
                    // Actualizar productos_notas_id
                    DB::table('productos_notas_id')
                    ->join('products', 'productos_notas_id.producto', '=', 'products.nombre')
                    ->update(['productos_notas_id.id_producto' => DB::raw('products.id')]);

                // Actualizar productos_notas_cosmica
                DB::table('productos_notas_cosmica')
                    ->join('products', 'productos_notas_cosmica.producto', '=', 'products.nombre')
                    ->update(['productos_notas_cosmica.id_producto' => DB::raw('products.id')]);

                    DB::table('products_bundle_id')
                    ->join('products', 'products_bundle_id.producto', '=', 'products.nombre')
                    ->update(['products_bundle_id.id_producto' => DB::raw('products.id')]);
        return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->puesto = $request->get('puesto');
        $user->telefono = $request->get('telefono');
        $user->comision_kit = $request->get('comision_kit');
        $user->password = Hash::make($request->get('password'));
        $user->assignRole($request->input('roles'));
        $user->save();


        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->puesto = $request->get('puesto');
        $user->telefono = $request->get('telefono');
        $user->comision_kit = $request->get('comision_kit');
        if(!empty($request->get('password'))){
            $user->password = Hash::make($request->get('password'));
        }else{
            // $user = Arr::except($user,array('password'));
        }
        $user->assignRole($request->input('roles'));
        $user->update();

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $password = 'IMNAS@2022_Admin';
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->visibilidad = 0;
        $user->update();

        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function imprimir_old($id){
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $today =  date('d-m-Y');

        $notasAprobadasNASComision = NotasProductos::whereBetween('fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('tipo_nota', '=', 'Cotizacion')
        ->whereNotNull('id_kit')
        ->get();

        $notasAprobadasCosmicaComision = NotasProductosCosmica::whereBetween('fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('tipo_nota', '=', 'Cotizacion')
        ->whereNotNull('id_kit')
        ->orderBy('id', 'DESC')
        ->get();

        $user_comision_kit = User::where('id', $id)->first();

        $pdf = \PDF::loadView('admin.users.pdf_comision_kits', compact('today', 'notasAprobadasNASComision', 'user_comision_kit', 'notasAprobadasCosmicaComision'));
       return $pdf->stream();

        //  return $pdf->download('Nota curso'. $nota->id .'/'.$today.'.pdf');
    }

    public function imprimir(){
        $startOfWeek = Carbon::now()->startOfWeek();
       //  $startOfWeek = '2025-03-17';
        $endOfWeek = Carbon::now()->endOfWeek();
        //    $endOfWeek = '2025-03-23';
        $today =  date('d-m-Y');

        $notasAprobadasCosmicaComision = NotasProductosCosmica::whereBetween('fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('tipo_nota', 'Cotizacion')
        ->whereDoesntHave('productos', function ($query) {
            $query->where('id_producto', 1989);
        })
        ->orderBy('id', 'DESC')
        ->get();
        $totalVentas = $notasAprobadasCosmicaComision->sum('total');

        $pdf = \PDF::loadView('admin.users.pdf_comision_new', compact('today', 'notasAprobadasCosmicaComision', 'totalVentas'));
       return $pdf->stream();

        //  return $pdf->download('Nota curso'. $nota->id .'/'.$today.'.pdf');
    }
}
