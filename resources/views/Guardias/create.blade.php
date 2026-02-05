<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Guardia - Tienda</title>
    <style>
        /* Estilo para centrar todo en la pantalla */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center; /* Centra el texto y los botones */
            width: 100%;
            max-width: 400px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Evita que el input se salga del cuadro */
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .btn-consultar {
            display: inline-block;
            margin-top: 15px;
            padding: 10px;
            background: #493bde;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }
        .alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="container">
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Registrar Guardia</h1>

        <form action="{{ route('guardias.store') }}" method="POST">
            @csrf 
            
            <label>Nombre</label>
            <input type="text" name="nombre" placeholder="Ej: Rafael" required>

            <label>Apellido</label>
            <input type="text" name="apellido" placeholder="Ej: Bermeo" required>

            <label>Cédula</label>
            <input type="text" name="cedula" placeholder="09XXXXXXXX" required>

            <label>Turno</label>
            <select name="turno">
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
            </select>

            <button type="submit">Guardar Registro</button>
        </form>

        <a href="{{ route('guardias.index') }}" class="btn-consultar">
            Consultar lista de guardias
        </a>
    </div>

</body>
</html>