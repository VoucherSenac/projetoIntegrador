<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->level !== 'admin') {
                abort(403, 'Acesso negado. Somente administradores podem editar usuários.');
            }
            return $next($request);
        })->only('edit');
    }

    public function index()
    {
        return view("users.index",[
            'users' => DB::table('users')-> orderBy('name')->paginate('5')
        ]);
    }

    public function edit($id)
    {
        return view('users.edit',[
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect()->route('user.index');
    }
}
