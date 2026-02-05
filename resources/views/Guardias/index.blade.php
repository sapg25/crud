<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Guardias - Tienda</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #493bde;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-regresar {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn-regresar:hover {
            background: #218838;
        }
        .btn-accion {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            margin: 2px;
        }
        .btn-editar { background: #ffc107; color: black; }
        .btn-eliminar { background: #dc3545; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Lista de Guardias Registrados</h1>

        <a href="{{ route('guardias.create') }}" class="btn-regresar">
            + Registrar Nuevo Guardia
        </a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guardias as $guardia)
                <tr>
                    <td>{{ $guardia->nombre }}</td>
                    <td>{{ $guardia->apellido }}</td>
                    <td>{{ $guardia->cedula }}</td>
                    <td>{{ $guardia->turno }}</td>
                    <td>
                        <a href="{{ route('guardias.edit', $guardia->id) }}" class="btn-accion btn-editar">Editar</a>
                        
                        <form action="{{ route('guardias.destroy', $guardia->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-accion btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar este guardia?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>