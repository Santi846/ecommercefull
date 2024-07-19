<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
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
            Publicar producto
        </h1>
        <a class="start" href="{{ url('/') }}">Inicio</a>
        <a class="start" href="{{ url('/seller') }}">Menú vendedor</a>
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
    
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input
            type="text"
            name="title"
            placeholder="Titulo..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">
        <br>
        
        <textarea
            name="description"
            placeholder="Descripción..."
            class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none"></textarea>

        <br>
        <input
            type="text"
            name="currency"
            placeholder="Moneda..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">
        <br>
        <input
            type="number"
            name="prize"
            placeholder="Precio..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">
        <br>
        <input
            type="number"
            name="stock"
            placeholder="Stock..."
            class="bg-transparent block border-b-2 w-full h-20 text-2xl outline-none">
        <br>

        <button
            type="submit"
            class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
            Publicar producto
        </button>
    </form>
</div>
</body>
</html>