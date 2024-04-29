<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;


class CartController extends Controller
{
    public function showCart(Request $request)
{
    // Obtener las plantas del carrito desde la sesión
    $cartItems = $request->session()->get('cart.items', []);

    // Obtener los detalles completos de las plantas
    $plantsInCart = Plant::whereIn('id', array_keys($cartItems))->get();

    // Calcular el precio total
    $totalPrice = 0;
    foreach ($plantsInCart as $plant) {
        // Multiplicar el precio unitario por la cantidad en el carrito de cada planta
        $totalPrice += $plant->unit_price * $cartItems[$plant->id];
    }

    // Devolver la vista del carrito con las plantas, el precio total y los elementos del carrito
    return view('cart', ['plantsInCart' => $plantsInCart, 'totalPrice' => $totalPrice, 'cartItems' => $cartItems]);
}



    public function addToCart(Request $request)
{
    // Validar la solicitud
    $request->validate([
        'plant_id' => 'required|exists:plant,id',
    ]);

    // Obtener el ID de la planta del formulario
    $plantId = $request->input('plant_id');

    // Obtener las plantas del carrito desde la sesión
    $cartItems = $request->session()->get('cart.items', []);

    // Verificar si la planta ya está en el carrito
    if(array_key_exists($plantId, $cartItems)) {
        // Si la planta ya está en el carrito, aumentar la cantidad en uno
        $cartItems[$plantId]++;
    } else {
        // Si la planta no está en el carrito, agregarla con cantidad 1
        $cartItems[$plantId] = 1;
    }

    // Guardar los elementos del carrito en la sesión
    $request->session()->put('cart.items', $cartItems);

    // Redireccionar de nuevo a la página de productos
    return redirect()->back()->with('success', 'Planta añadida al carrito.');
}

public function removeFromCart(Request $request, $id)
{
    // Obtener los elementos del carrito desde la sesión
    $cartItems = $request->session()->get('cart.items', []);

    // Verificar si la planta está en el carrito
    if (isset($cartItems[$id])) {
        // Si la cantidad es mayor que uno, decrementarla
        if ($cartItems[$id] > 1) {
            $cartItems[$id]--;
        } else {
            // Si la cantidad es uno, eliminar completamente la entrada del carrito
            unset($cartItems[$id]);
        }
    }

    // Actualizar los elementos del carrito en la sesión
    $request->session()->put('cart.items', $cartItems);

    // Redireccionar de nuevo a la página del carrito
    return redirect()->route('cart')->with('success', 'Planta eliminada del carrito.');
}


}
