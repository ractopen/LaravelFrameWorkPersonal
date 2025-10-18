<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Http\Request;

class DojoController extends Controller
{
    public function index()
    {
        $dojos = Dojo::all();
        $ninjas = Ninja::all();
        return view('index', compact('dojos', 'ninjas'));
    }

    public function create()
    {
        return view('dojos.create');
    }

    public function store(Request $request)
    {
        $dojo = new Dojo();
        $dojo->name = $request->name;
        $dojo->description = $request->description;
        $dojo->save();

        return redirect('/dojos');
    }

    public function show(Dojo $dojo)
    {
        return view('dojos.show', compact('dojo'));
    }
}
