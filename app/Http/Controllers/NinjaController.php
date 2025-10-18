<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use App\Models\Ninja;
use Illuminate\Http\Request;

class NinjaController extends Controller
{
    public function create()
    {
        return redirect('/dojos');
    }

    public function store(Request $request)
    {
        $ninja = new Ninja();
        $ninja->name = $request->name;
        $ninja->skill = $request->skill;
        $ninja->bio = $request->bio;
        $ninja->dojo_id = $request->dojo_id;
        $ninja->save();

        return redirect('/dojos');
    }

    public function index()
    {
        return redirect('/dojos');
    }

    public function show(Ninja $ninja)
    {
        return redirect('/dojos');
    }
}
