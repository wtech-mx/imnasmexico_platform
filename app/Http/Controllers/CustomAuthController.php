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

        $input = $request->all();

        $request->validate([
            'password' => 'required',
        ]);

        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('perfil')
        //                 ->withSuccess('Registrado');
        // }


        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            return redirect("calendario")->withSuccess('Los datos de inicio de sesión no son válidos');
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }


    }

    public function registration()
    {
        return view('user.home');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'username' => 'required|unique:users',
            'email' => 'required',
            'telefono' => 'required',
        ]);

        $creat_user = new User;
        $creat_user->name = $request->get('name');
        $creat_user->email = $request->get('email');
        $creat_user->telefono = $request->get('telefono');
        $creat_user->username = $request->get('telefono');
        $creat_user->code = rand(0, 1000);
        $creat_user->password = Hash::make($request->get('telefono'));
        $creat_user->save();

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
