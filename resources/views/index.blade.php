@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
    </head>

    <body>


        <div class="container-fluid">
            <div class="row">
                <div class="col-3 bg-light border rounded-2">
                </div>
                <div class="col-9">
                <div class="row mx-5 my-2 p-3 bg-light border rounded-2">
                            <div class="col-4 flex-fill">
                                <div class="product-image-container">
                                    <img class="product-image" src="https://www.coope.com/wp-content/uploads/2018/09/logo-cooperativa-hosteleria-1.jpg">
                                </div>
                            </div>
                            <div class="col-8 flex-fill">
                                <h3>

                                    <p>
                                        Nombre del producto
                                    </p>
                                </h3>
                                <h5>Vendedor: Vendedor</h5>
                                <p class="text-wrap">Descripcion del producto</p>
                                <p>5€</p>
                                
                                            <button type="submit" class="btn btn-primary">Añadir al carrito</button>



                            </div>
                        </div>
                </div>
            </div>
        </div>

    </body>

    </html>
    
@endsection
