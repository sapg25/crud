<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Guardias - Tienda</title>
    <style>
        /* Esto asegura que los botones de acción se vean alineados */
        td:last-child {
            display: flex;
            justify-content: center;
            gap: 10px;
            border: none;
            /* Opcional: quita el borde interno si prefieres */
        }

        /* Mejora para que el botón de eliminar no tenga bordes raros */
        .btn-eliminar {
            background: #dc3545;
            border: none;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        /* Botón de cambio de tema */
        .btn-theme {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 10px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            background: #493bde;
            color: white;
            font-size: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        /* Variables para Modo Oscuro */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        body.dark-mode .container {
            background-color: #2d2d2d;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode table,
        body.dark-mode th,
        body.dark-mode td {
            border-color: #444;
        }

        body.dark-mode td {
            color: #eee;
        }

        body.dark-mode tr:nth-child(even) {
            background-color: #383838;
        }

        body.dark-mode h1 {
            color: #ffffff;
        }

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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
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

        .btn-editar {
            background: #ffc107;
            color: black;
        }

        .btn-eliminar {
            background: #dc3545;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <button id="theme-toggle" class="btn-theme">🌙</button>

    <div class="container">
        <h1>Lista de Guardias Registrados</h1>

        <a href="{{ route('guardias.create') }}" class="btn-regresar">
            + Registrar Nuevo Guardia
        </a>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Doc.</th>
                    <th>Cédula/Doc.</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($guardias as $guardia)
                    <tr>
                        <td style="font-weight: bold; color: #493bde;">{{ $guardia->codigo_unico ?? 'N/A' }}</td>
                        <td>{{ $guardia->nombre }}</td>
                        <td>{{ $guardia->apellido }}</td>
                        <td style="text-transform: capitalize;">{{ $guardia->tipo_documento }}</td>
                        <td>{{ $guardia->cedula }}</td>
                        <td>{{ $guardia->turno }}</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('guardias.show', $guardia->id) }}"
                                    class="btn-accion" style="background: #493bde;">Ver Items</a>
                                <a href="{{ route('guardias.edit', $guardia->id) }}"
                                    class="btn-accion btn-editar">Editar</a>

                                <form action="{{ route('guardias.destroy', $guardia->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-accion btn-eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar este guardia?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        const btn = document.getElementById('theme-toggle');
        const body = document.body;

        // Recuperar preferencia guardada
        if (localStorage.getItem('dark-mode') === 'enabled') {
            body.classList.add('dark-mode');
            btn.innerText = '☀️';
        }

        btn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('dark-mode', 'enabled');
                btn.innerText = '☀️';
            } else {
                localStorage.setItem('dark-mode', 'disabled');
                btn.innerText = '🌙';
            }
        });
    </script>


</body>

</html>
