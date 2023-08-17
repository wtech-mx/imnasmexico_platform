<?php

namespace App\Http\Controllers\Cam;

use App\Http\Controllers\Controller;
use App\Models\Cam\CamEstandares;
use App\Models\Cam\CamNotas;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use App\Models\Cam\CamChecklist;
use App\Models\Cam\CamNotEstandares;
use App\Models\Cam\CamCitas;
use App\Models\Cam\CamDocumentosUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotasCamController extends Controller
{
    public function index(){
        $estandares_cam = CamEstandares::get();
        $notas_cam = CamNotas::get();

        $ultimaNota = CamNotas::latest('id')->first();
        $ultimoId = $ultimaNota ? $ultimaNota->id : 0;
        $siguienteId = $ultimoId + 1;

        $fecha = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [del] YYYY');

        return view('cam.admin.notas.index', compact('estandares_cam', 'notas_cam', 'siguienteId', 'fecha'));
    }

    public function crear(Request $request){
        $code = Str::random(8);
        if (User::where('telefono', $request->celular)->exists() || User::where('email', $request->email)->exists()) {
            if (User::where('telefono', $request->celular)->exists()) {
                $user = User::where('telefono', $request->celular)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            $payer = $user;
        } else {
            $payer = new User();
            $payer->name = $request->get('name') . " " . $request->get('apellido');
            $payer->email = $request->get('email');
            $payer->username = $request->get('celular');
            $payer->code = $code;
            $payer->telefono = $request->get('celular');
            $payer->celular_casa = $request->get('telefono');
            $payer->facebook = $request->get('facebook');
            $payer->tiktok = $request->get('tiktok');
            $payer->instagram = $request->get('instagram');

            if($request->get('tipo') == 'Centro Evaluación'){
                $payer->cliente = '4';
            }else{
                $payer->cliente = '3';
            }

            $payer->membresia = $request->get('membresia');
            $payer->password = Hash::make($request->get('celular'));
            $payer->save();
            $datos = User::where('id', '=', $payer->id)->first();
            // Mail::to($payer->email)->send(new PlantillaNuevoUser($datos));
        }

        $dominio = $request->getHost();
        if($dominio == 'plataforma.imnasmexico.com'){
            $cam_notas = base_path('../public_html/plataforma.imnasmexico.com/cam_notas');
        }else{
            $cam_notas = public_path() . '/cam_notas';
        }

        $notas_cam = new CamNotas;
        $notas_cam->id_cliente = $payer->id;
        $notas_cam->tipo = $request->get('tipo');
        $notas_cam->membresia = $request->get('membresia');
        $notas_cam->monto1 = $request->get('monto1');
        $notas_cam->metodo_pago = $request->get('metodo_pago');
        $notas_cam->nota = $request->get('nota');
        $notas_cam->referencia = $request->get('referencia');
        $notas_cam->id_usuario = auth()->user()->id;
        if ($request->hasFile("comprobante")) {
            $file = $request->file('comprobante');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante = $fileName;
        }

        $notas_cam->monto2 = $request->get('monto2');
        $notas_cam->metodo_pago2 = $request->get('metodo_pago2');
        $notas_cam->comprobante2 = $request->get('comprobante2');
        $notas_cam->descuento = $request->get('descuento');
        if ($request->hasFile("comprobante2")) {
            $file = $request->file('comprobante2');
            $path = $cam_notas;
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $notas_cam->comprobante2 = $fileName;
        }
        $notas_cam->save();

        $estandares = $request->input('estandares');

        for ($count = 0; $count < count($estandares); $count++) {
            $data = array(
                'id_nota' => $notas_cam->id,
                'id_estandar' => $estandares[$count],
                'estatus' => 'Pendiente',
                'id_usuario' => auth()->user()->id,
            );
            $insert_data[] = $data;
        }
        CamNotEstandares::insert($insert_data);

        $checklist = new CamChecklist;
        $checklist->id_nota = $notas_cam->id;
        $checklist->save();

        $citas = new CamCitas;
        $citas->id_nota = $notas_cam->id;
        $citas->save();

        $documentos = new CamDocumentosUsers;
        $documentos->id_nota = $notas_cam->id;
        $documentos->save();

        return redirect()->route('index.notas')
            ->with('success', 'Nota CAM creada con exito.');
    }

}
