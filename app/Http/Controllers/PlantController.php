<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    /**
     * Display the homepage with all plants.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener todas las plantas
        $plants = Plant::all();

        // Pasar las plantas a la vista index.blade.php
        return view('index', compact('plants'));
    }
}
