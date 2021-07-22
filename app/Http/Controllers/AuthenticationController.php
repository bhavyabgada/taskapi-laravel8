<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|size:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            if(!$request->is('api/*')){
                $tasks = Task::where('user_id',Auth::id())->get();
                return redirect()->intended('dashboard')
                ->with(['tasks'=>$tasks, 'token'=>$token])
                ->withSuccess('Signed in');
            }
            else{ 
                return response()->json(['token' => $token], 200);
            }
        }else{
            return response()->json(['error' => 'Unauthorised | Invalid API Key'], 401);
        }

    }


    public function register(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|max:255|alpha',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|size:8',
        ]);

        $data = $request->all();
        $user = $this->create_user($data);

        if ($user) {
            if(!$request->is('api/*')){
                Auth::login($user);
                return redirect("/dashboard")->withSuccess('You have signed-in');
            }
            else{ 
                $token = $user->createToken('helloatg')->accessToken;
                return response()->json(['token' => $token], 200);
            }
        }else {
            return response()->json(['error' => 'User Not Created'], 502);
        }

    }

    public function create_user(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    } 

    public function logout() 
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }   
}
