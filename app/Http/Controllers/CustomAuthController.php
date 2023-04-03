<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('perfil')
                        ->withSuccess('Registrado');
        }

        return redirect("calendario")->withSuccess('Los datos de inicio de sesión no son válidos');
    }

    public function registration()
    {
        return view('user.home');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|min:10|unique:users',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("/")->withSuccess('has iniciado sesión');
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

        return Redirect('/');
    }
}
