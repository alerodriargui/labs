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



    /**
     *Guardam el producte creat a la base de dades
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'description' => 'required',
            'season' => 'required',
            'unit_price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        echo $request;

        // Sube la imagen a storage/app/public/images publicly
        $imagePath = $request->file('image')->store('uploads', 'public');

        // Crea una nueva planta y almacena la ruta de la imagen en la base de datos
        $plant = new Plant([
            'name' => $request->input('name'),
            'scientific_name' => $request->input('scientific_name'),
            'description' => $request->input('description'),
            'season' => $request->input('season'),
            'unit_price' => $request->input('unit_price'),
            'img_path' => $imagePath, // Almacena la ruta de la imagen en la base de datos
        ]);

        echo $plant;


        $plant->save();



        // Guardam la relació entre producte i producteStock

        return redirect()->route('subir_producto')->with('success', 'Producto subido con éxito.');
    }

    public function create(){
        return view('plants.create');
    }

    //Aques
    public function details($id_plant){
        $plant = Plant::findOrFail($id_plant);
        return response(view('plants.details', compact('plant')));
    }
}
