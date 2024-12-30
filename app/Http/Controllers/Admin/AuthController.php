<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
    public function index()
    {
        return view("admin.auth.login");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "login" => ["required"],
            "password" =>  ["required"],
        ]);
        
        if(auth("admin")->attempt($data))
        {
            return redirect(route("admin.tasks.index"));
        }

        return redirect(route("admin.login"))->withErrors(["error" => "Данные введены неверно"]);
    }

    public function logout()
    {
        auth("admin")->logout();

        return redirect(route("admin.login"));
    }
}