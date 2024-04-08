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


        // Crear una cookie
        $cookie = cookie('user', 'test', 60); // Cookie que dura 60 minutos

        // Devolver la vista con la cookie
        return response(view('index', compact('plants')))->withCookie($cookie);
    }


    public function store(){

    }
}
