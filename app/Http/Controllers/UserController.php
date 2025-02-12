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

    public function imprimir($id){
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $today =  date('d-m-Y');

        $idsPermitidos = [1950, 1949, 1948, 1947, 1946, 1945, 1820];

        $notasAprobadasCosmicaComision = NotasProductosCosmica::whereBetween('fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('tipo_nota', '=', 'Cotizacion')
        ->where('id_admin_venta', '=', $id) // Filtrar por id_admin_venta
        ->where(function ($query) use ($idsPermitidos) {
            $query->whereNotIn('id_kit', $idsPermitidos)
                  ->orWhereNotIn('id_kit2', $idsPermitidos)
                  ->orWhereNotIn('id_kit3', $idsPermitidos)
                  ->orWhereNotIn('id_kit4', $idsPermitidos)
                  ->orWhereNotIn('id_kit5', $idsPermitidos)
                  ->orWhereNotIn('id_kit6', $idsPermitidos);
        })
        ->where(function ($query) {
            $query->whereNotNull('id_kit')
                  ->orWhereNotNull('id_kit2')
                  ->orWhereNotNull('id_kit3')
                  ->orWhereNotNull('id_kit4')
                  ->orWhereNotNull('id_kit5')
                  ->orWhereNotNull('id_kit6');
        })
        ->orderBy('id', 'DESC')
        ->get();

        $notasAprobadasMatutino = NotasProductosCosmica::join('users', 'notas_productos_cosmica.id_admin_venta', '=', 'users.id')
        ->leftJoin('products as p1', 'notas_productos_cosmica.id_kit', '=', 'p1.id')
        ->leftJoin('products as p2', 'notas_productos_cosmica.id_kit2', '=', 'p2.id')
        ->leftJoin('products as p3', 'notas_productos_cosmica.id_kit3', '=', 'p3.id')
        ->leftJoin('products as p4', 'notas_productos_cosmica.id_kit4', '=', 'p4.id')
        ->leftJoin('products as p5', 'notas_productos_cosmica.id_kit5', '=', 'p5.id')
        ->leftJoin('products as p6', 'notas_productos_cosmica.id_kit6', '=', 'p6.id')
        ->whereBetween('notas_productos_cosmica.fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('notas_productos_cosmica.tipo_nota', '=', 'Cotizacion')
        ->where('users.turno', '=', 'Matutino')
        ->selectRaw("
            SUM(
                CASE WHEN id_kit IN (" . implode(',', $idsPermitidos) . ") THEN p1.precio_normal ELSE 0 END +
                CASE WHEN id_kit2 IN (" . implode(',', $idsPermitidos) . ") THEN p2.precio_normal ELSE 0 END +
                CASE WHEN id_kit3 IN (" . implode(',', $idsPermitidos) . ") THEN p3.precio_normal ELSE 0 END +
                CASE WHEN id_kit4 IN (" . implode(',', $idsPermitidos) . ") THEN p4.precio_normal ELSE 0 END +
                CASE WHEN id_kit5 IN (" . implode(',', $idsPermitidos) . ") THEN p5.precio_normal ELSE 0 END +
                CASE WHEN id_kit6 IN (" . implode(',', $idsPermitidos) . ") THEN p6.precio_normal ELSE 0 END
            ) AS total_precio_kits
        ")
        ->value('total_precio_kits');

            $notasAprobadasMatutinoReg = NotasProductosCosmica::join('users', 'notas_productos_cosmica.id_admin_venta', '=', 'users.id')
            ->whereBetween('notas_productos_cosmica.fecha_aprobada', [$startOfWeek, $endOfWeek])
            ->where('notas_productos_cosmica.tipo_nota', '=', 'Cotizacion')
            ->where('users.turno', '=', 'Matutino')
            ->where(function ($query) use ($idsPermitidos) {
                $query->whereIn('notas_productos_cosmica.id_kit', $idsPermitidos)
                      ->orWhereIn('notas_productos_cosmica.id_kit2', $idsPermitidos)
                      ->orWhereIn('notas_productos_cosmica.id_kit3', $idsPermitidos)
                      ->orWhereIn('notas_productos_cosmica.id_kit4', $idsPermitidos)
                      ->orWhereIn('notas_productos_cosmica.id_kit5', $idsPermitidos)
                      ->orWhereIn('notas_productos_cosmica.id_kit6', $idsPermitidos);
            })
            ->get();

        $notasAprobadasVespertino = NotasProductosCosmica::join('users', 'notas_productos_cosmica.id_admin_venta', '=', 'users.id')
        ->leftJoin('products as p1', 'notas_productos_cosmica.id_kit', '=', 'p1.id')
        ->leftJoin('products as p2', 'notas_productos_cosmica.id_kit2', '=', 'p2.id')
        ->leftJoin('products as p3', 'notas_productos_cosmica.id_kit3', '=', 'p3.id')
        ->leftJoin('products as p4', 'notas_productos_cosmica.id_kit4', '=', 'p4.id')
        ->leftJoin('products as p5', 'notas_productos_cosmica.id_kit5', '=', 'p5.id')
        ->leftJoin('products as p6', 'notas_productos_cosmica.id_kit6', '=', 'p6.id')
        ->whereBetween('notas_productos_cosmica.fecha_aprobada', [$startOfWeek, $endOfWeek])
        ->where('notas_productos_cosmica.tipo_nota', '=', 'Cotizacion')
        ->where('users.turno', '=', 'Vespertino')
        ->selectRaw("
            SUM(
                CASE WHEN id_kit IN (" . implode(',', $idsPermitidos) . ") THEN p1.precio_normal ELSE 0 END +
                CASE WHEN id_kit2 IN (" . implode(',', $idsPermitidos) . ") THEN p2.precio_normal ELSE 0 END +
                CASE WHEN id_kit3 IN (" . implode(',', $idsPermitidos) . ") THEN p3.precio_normal ELSE 0 END +
                CASE WHEN id_kit4 IN (" . implode(',', $idsPermitidos) . ") THEN p4.precio_normal ELSE 0 END +
                CASE WHEN id_kit5 IN (" . implode(',', $idsPermitidos) . ") THEN p5.precio_normal ELSE 0 END +
                CASE WHEN id_kit6 IN (" . implode(',', $idsPermitidos) . ") THEN p6.precio_normal ELSE 0 END
            ) AS total_precio_kits
        ")
        ->value('total_precio_kits');

        $user_comision_kit = User::where('id', $id)->first();

        $comision = 0;
        $comisionVespertino = 0;

        if ($notasAprobadasMatutino >= 4000 && $notasAprobadasMatutino <= 5999) {
            $comision = 0.03;
        } elseif ($notasAprobadasMatutino >= 6000 && $notasAprobadasMatutino <= 7999) {
            $comision = 0.04;
        } elseif ($notasAprobadasMatutino >= 8000 && $notasAprobadasMatutino <= 9999) {
            $comision = 0.05;
        } elseif ($notasAprobadasMatutino >= 10000 && $notasAprobadasMatutino <= 14999) {
            $comision = 0.06;
        } elseif ($notasAprobadasMatutino >= 15000 && $notasAprobadasMatutino <= 19999) {
            $comision = 0.07;
        } elseif ($notasAprobadasMatutino >= 20000) {
            $comision = 0.08;
        }

        // Calcular el monto de la comisión
        $montoComisionVespertino = $notasAprobadasVespertino * $comisionVespertino;

        if ($notasAprobadasVespertino >= 4000 && $notasAprobadasVespertino <= 5999) {
            $comisionVespertino = 0.03;
        } elseif ($notasAprobadasVespertino >= 6000 && $notasAprobadasVespertino <= 7999) {
            $comisionVespertino = 0.04;
        } elseif ($notasAprobadasVespertino >= 8000 && $notasAprobadasVespertino <= 9999) {
            $comisionVespertino = 0.05;
        } elseif ($notasAprobadasVespertino >= 10000 && $notasAprobadasVespertino <= 14999) {
            $comisionVespertino = 0.06;
        } elseif ($notasAprobadasVespertino >= 15000 && $notasAprobadasVespertino <= 19999) {
            $comisionVespertino = 0.07;
        } elseif ($notasAprobadasVespertino >= 20000) {
            $comisionVespertino = 0.08;
        }

        // Calcular el monto de la comisión
        $montoComisionMatutino = $notasAprobadasMatutino * $comision;
        $montoComisionVespertino = $notasAprobadasVespertino * $comisionVespertino;

        // Calcular el monto de la comisión individual
        $user_comisionmatutino = User::where('turno', '=', 'Matutino')->count();
        $user_comisionvespertino = User::where('turno', '=', 'Vespertino')->count();

        $comision_individual = 0;
        $comisionVespertino_individual = 0;

        $comision_individual = $montoComisionMatutino / $user_comisionmatutino;
        $comisionVespertino_individual = $montoComisionVespertino / $user_comisionvespertino;

        $pdf = \PDF::loadView('admin.users.pdf_comision_new', compact('today', 'user_comision_kit', 'notasAprobadasMatutinoReg', 'notasAprobadasCosmicaComision', 'notasAprobadasMatutino', 'notasAprobadasVespertino', 'comision', 'comisionVespertino', 'comision_individual', 'comisionVespertino_individual'));
       return $pdf->stream();

        //  return $pdf->download('Nota curso'. $nota->id .'/'.$today.'.pdf');
    }
}
