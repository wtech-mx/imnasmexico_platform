<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\PlantillaNuevoUser;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class CustomAuthController extends Controller
{

    public function customLogin(Request $request)
    {

        $input = $request->all();
        $request->validate([
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))){

            if(Auth::user()->cliente == '2' or  Auth::user()->cliente == '5'){
                return redirect('/profesor/inicio');

            }elseif(Auth::user()->cliente == '4' or Auth::user()->cliente == '3'){
                $code = Auth::user()->code;
                return redirect()->route('cam.index', ['code' => $code])->withSuccess('Sesión iniciada');

            }else{
                return redirect("calendario")->withSuccess('Sesión iniciada');
            }

        }else{
            return redirect()->back()
            ->with('warning', 'Telefono incorrecto.');;
        }

    }

    public function registration()
    {
        return view('user.home');
    }

    public function customRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'telefono' => 'required|unique:users',
        ]);

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $code = Str::random(8);
        if(User::where('telefono', $request->telefono)->exists()){
             return redirect()->back();
        }else{
            $creat_user = new User;
            $creat_user->name = $request->get('name');
            $creat_user->email = $request->get('email');
            $creat_user->telefono = $request->get('telefono');
            $creat_user->username = $request->get('telefono');
            $creat_user->code = $code;
            $creat_user->cliente = '1';
            $creat_user->password = Hash::make($request->get('telefono'));
            $creat_user->save();
            $datos = User::where('id', '=', $creat_user->id)->first();
            Mail::to($creat_user->email)->send(new PlantillaNuevoUser($datos));
        }

        Auth::login($creat_user);
        Session::flash('success', 'Se ha registrado Correctamente');
        return redirect()->back();
    }

    public function create(array $data)
    {
        $code = Str::random(8);
        $usuario = new User;
        $usuario->name = $data['name'];
        $usuario->email = $data['email'];
        $usuario->telefono = $data['telefono'];
        $usuario->password = $data['telefono'];
        $usuario->cliente = $data['cliente'];
        $usuario->code = $code;
        $usuario->cliente = '1';
        $usuario->save();
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('user.home');
        }

        return redirect("/")->withSuccess('No tienes permiso para acceder');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return redirect("calendario")->withSuccess('Sesión terminada');
    }
}
