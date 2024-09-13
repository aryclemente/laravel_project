<?php

namespace App\Http\Controllers;

use App\Models\Persona;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return view('modules.personas.index', compact('personas'));
    }
}
