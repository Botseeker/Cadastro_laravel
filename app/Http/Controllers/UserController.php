<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar usuários
    public function index()
    {
        // Recuperação os registros do banco de dados
        $users = User::orderByDesc('id')->paginate(2);

        //Carregar a VIEW
        return view('users.index', ['users' => $users]);
    }

    // Detalhes do usuario
    public function show(User $user)
    {
        // Carregar view
        return view('users.show', ['user' => $user]);
    }
    // Cadastrar no banco de dados o novo registro
    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {

        try {
            // Cadastrar no banco de dados na tabela usuários
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            // Redirecionar o usuário, enviar a mensagem de sucesso

            return redirect()->route('user.show')
                ->with('success', 'Usuário cadastrado com sucesso');
        } catch (Exception $e) {
            // Redirecionar o usuário, enviar a mensagem de erro

            return back()->withInput()->with('error', 'Usuário já cadastrado!');
        }
    }
    // Carregar o formulário editar usuário
    public function edit(User $user)
    {
        // Carregar a view
        return view('users.edit', ['user' => $user]);
    }
    // Editar no banco de dados o usuário
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('user.show', ['user' =>
            $user->id])->with('success', 'Usuário editado com sucesso!');
        } catch (Exception $e) {

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não editado!');
        }
    }

    // Carregar o formulário editar senha do usuário
    public function editPassword(User $user)
    {

        // Carregar a VIEW
        return view('users.editPassword', ['user' => $user]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.'
        ]);

        try {
            // Editar as informações do registro no banco de dados
            $user->update([
                'password' => $request->password,
            ]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('user.show', ['user' => $user->id])
                ->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            //Redirecionar o usuário, enviar a msg de erro
            return back()->withInput()->with('error', 'Senha do usuário não editada');
        }
    }
}
