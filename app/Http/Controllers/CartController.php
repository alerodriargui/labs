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
            $totalPrice += $plant->unit_price;
        }

        // Devolver la vista del carrito con las plantas y el precio total
        return view('cart', ['plantsInCart' => $plantsInCart, 'totalPrice' => $totalPrice]);
    }


    public function addToCart(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
        ]);

        // Obtener el ID de la planta del formulario
        $plantId = $request->input('plant_id');

        // Obtener las plantas del carrito desde la sesión
        $cartItems = $request->session()->get('cart.items', []);

        // Agregar la planta al carrito
        $cartItems[$plantId] = true;

        // Guardar los elementos del carrito en la sesión
        $request->session()->put('cart.items', $cartItems);

        // Redireccionar de nuevo a la página de productos
        return redirect()->back()->with('success', 'Planta añadida al carrito.');
    }

    public function removeFromCart(Request $request, $id)
    {
        // Obtener los elementos del carrito desde la sesión
        $cartItems = $request->session()->get('cart.items', []);

        // Verificar si la planta está en el carrito y eliminarla
        if (isset($cartItems[$id])) {
            unset($cartItems[$id]);
        }

        // Actualizar los elementos del carrito en la sesión
        $request->session()->put('cart.items', $cartItems);

        // Redireccionar de nuevo a la página del carrito
        return redirect()->route('cart')->with('success', 'Planta eliminada del carrito.');
    }

}
