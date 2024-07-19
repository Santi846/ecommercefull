<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido</title>
    <style>
        body {
              background: rgb(14, 14, 22);
              color: white;
              font-family: Arial, Helvetica, sans-serif;
            }
        input, textarea {
            border:solid #000;
            border-radius: 5px;
            margin-bottom: 1%;
        }
        .errors {
            justify-content: center;
            background: rgb(201, 0, 0);
            height: 105px;
            width: 500px;
            color: whitesmoke;
            margin-bottom: 20px;
            border-radius: 5px;
             
        }
        .errors_list {
            padding: 5px;
            color: rgb(193, 62, 55);
            background: rgb(255, 255, 255);
            border-radius: 5px;
            list-style-type: none;
        }
        a.start{display:absolute;margin-right:10%; color:aqua}
    </style>
</head>
<body>
<div class="w-4/5 mx-auto">
    <div class="text-center pt-20">
        <h1 class="text-3xl text-gray-700">
            Agregar productos a pedido
        </h1>
        <a class="start" href="{{ url('/') }}">Inicio</a>
        <a class="start" href="{{ url('/customer') }}">Menú comprador</a>
        <hr class="border border-1 border-gray-300 mt-10">
    </div>

<div class="m-auto pt-20">
    <div class="pb-8">
        @if ($errors->any())
            <div class='errors'>Algo salio mal, revise los campos por favor
                <ul class="errors_list">
                    @foreach ( $errors->all() as $error )
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            
        @endif
    </div>

     <div>
                @if($productItems)
                    @foreach ($productItems as $productItem)
                        <ul>
                            <li>Titulo: {{ $productItem->title }}</li>
                            <li>Descripción: {{ $productItem->description }}</li>
                            <li>Moneda: {{ $productItem->currency }}</li>
                            <li>Precio: {{ $productItem->prize }}</li>
                            <li>Stock: {{ $productItem->stock }}</li>
                        </ul>
                        <form action="{{ route('addToOrder', $productItem->id)}}" method="POST">
                            @csrf
                            <button id='add' type="submit">Agregar</button>
                        </form>
                        <form action="{{ route('destroy', $productItem->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id='destroy' type="submit">Eliminar</button>
                        </form>
                        <br>   

                    @endforeach
                @endif

    </div>  

</div>
</body>
</html>