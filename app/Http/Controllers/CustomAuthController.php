<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'telefono' => $data['telefono'],
        'password' => Hash::make($data['telefono']),
        'cliente' => $data['cliente'],
      ]);
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
