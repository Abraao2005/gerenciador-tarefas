<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        return view('tarefas.index'); // Liste as tarefas aqui
    }

    public function showRegisterForm()
    {
        return view("tarefas.register");
    }
}
