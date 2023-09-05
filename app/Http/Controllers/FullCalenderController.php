<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Auth;
class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        $id_profesor = auth::user()->id;
        $tipo_profesor = auth::user()->cliente;

        if($tipo_profesor == '2'){
            if($request->ajax()) {

                $data = Event::whereDate('start', '>=', $request->start)
                            ->whereDate('end',   '<=', $request->end)
                            ->where('id_profesor', '=', $id_profesor)
                            ->get(['id', 'title', 'start', 'end']);
            }

        }else if($tipo_profesor == '5'){

            $data = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title', 'start', 'end']);

        }

        // Modificar el título para eliminar el prefijo "Curso de"
        foreach ($data as $event) {
            $event->title = str_replace(['Curso de', 'Curso'], '', $event->title);
        }

            return response()->json($data);

        return view('fullcalender');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Event::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # code...
             break;
        }
    }
}
