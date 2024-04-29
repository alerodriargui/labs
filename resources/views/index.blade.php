@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
<<<<<<< HEAD
        <div class="col-9">
=======
        <div class="col-12">
>>>>>>> 9c2cf15942b3a7c55684ee7645e956ff4759e49b
            <div class="row mx-5 my-1 p-3 bg-light border rounded-2">
                <!-- Filtros -->
                    <div class="col-3">
                        <h4 class="mb-3">Filtros</h4>
                        <div class="mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="scientific_name">Nombre científico:</label>
                        <input type="text" id="scientific_name" class="form-control">
                    </div>
                    <!-- Selector para las estaciones del año -->
                    <div class="mb-3">
                        <label for="season">Estación del año:</label>
                        <select id="season" class="form-select">
                            <option value="">Todas</option>
                            <option value="spring">Primavera</option>
                            <option value="summer">Verano</option>
                            <option value="autum">Otoño</option>
                            <option value="winter">Invierno</option>
                        </select>
                    </div>

                    <!-- Selector para indicar precio de mayor a menor -->
                    <div class="mb-3">
                        <label for="price">Precio:</label>
                        <select id="price" class="form-select">
                            <option value="">Todos los precios</option>
                            <option value="asc">Menor a mayor</option>
                            <option value="desc">Mayor a menor</option>
                        </select>
                    </div>

                    <!-- Botón para aplicar filtros -->
                    <button onclick="applyFilters()" class="btn btn-primary">Aplicar filtros</button>
                </div>

                <!-- Productos -->
                <div id="products-container" class="col-9">
                    @foreach($plants as $plant)
                    <div class="col-12 mb-3 d-flex align-items-center">
                        <div class="product-image-container">
                            <img class="product-image" src="{{asset('storage/uploads/' . basename($plant->img_path)) }}" alt="{{ $plant->name }}" style="max-width: 300px; height: auto; padding-right: 50px">
                        </div>
                        <div class="product-info ml-3">
                        <a href="{{route('detalles_planta',['id_plant' => $plant->id]) }}">
                            <h3>{{ $plant->name }}</h3>
                            </a>
                            <p class="text-wrap">{{ $plant->description }}</p>
                            <p>{{ $plant->unit_price }}€</p>
                            <form method="POST" action="{{ route('add-to-cart') }}">
                                @csrf
                                <input type="hidden" name="plant_id" value="{{ $plant->id }}">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decrementQuantity(this)">-</button>
                                    <input type="text" name="quantity" class="form-control text-center" style="width: 20px;" value="1" readonly>
                                    <button type="button" class="btn btn-outline-secondary" onclick="incrementQuantity(this)">+</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                            </form>                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        function applyFilters() {
            var season = document.getElementById('season').value;
            var price = document.getElementById('price').value;

            // Realizar una petición AJAX para obtener los productos filtrados
            axios.get('/products', {
                params: {
                    season: season,
                    price: price
                }
            })
            .then(function (response) {
                // Actualizar la lista de productos en la página
                document.getElementById('products-container').innerHTML = response.data;
            })
            .catch(function (error) {
                console.error('Error al obtener los productos filtrados:', error);
            });
        }
    </script>
    <script>
        function incrementQuantity(button) {
            var input = button.parentElement.querySelector('input[name="quantity"]');
            var value = parseInt(input.value);
            input.value = value + 1;
        }

        function decrementQuantity(button) {
            var input = button.parentElement.querySelector('input[name="quantity"]');
            var value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }
    </script>

@endsection
