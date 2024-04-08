<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;


class PedidoController extends Controller
{
    public function realizarPedido(Request $request)
    {
        // Aquí colocarás la lógica para crear el pedido
        // Puedes acceder a los datos enviados en la solicitud usando $request

        // Por ejemplo, podrías crear un nuevo pedido en la base de datos y redirigir a una página de confirmación
        // Ejemplo:
        // Pedido::create([...]);

        // Después de crear el pedido, puedes redirigir a una página de confirmación
        return redirect()->route('index');
    }

    public function mostrarFormularioPedido(Request $request)
{
    // Fetch the plants in the cart from the database or wherever it's stored
    $cartItems = $request->session()->get('cart.items', []);

    // Obtener los detalles completos de las plantas
    $plantsInCart = Plant::whereIn('id', array_keys($cartItems))->get();

    // Pass $plantsInCart to the view
    return view('formulario-pedido', ['plantsInCart' => $plantsInCart]);
}

}
