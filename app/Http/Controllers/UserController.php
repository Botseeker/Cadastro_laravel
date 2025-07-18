<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;


class UserController extends Controller
{
    // Listar usuários
    public function index()
    {
        // Recuperação os registros do banco de dados
        $users = User::orderByDesc('id')->paginate(10);

        //Carregar a VIEW
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return redirect()->route('user.create')->with('success', 'Usuário cadastrado com sucesso');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Usuário já cadastrado!');
        }
    }

    public function edit(User $user) 
    {
        // Carregar a view
        return view('users.edit', ['user' => $user]);
    }
}
