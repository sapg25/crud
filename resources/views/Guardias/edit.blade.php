<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Guardia - Tienda</title>
    <style>
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #ffc107;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
        }

        button:hover {
            background-color: #e0a800;
        }

        .btn-regresar {
            display: inline-block;
            margin-top: 15px;
            padding: 10px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-theme {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            background: #493bde;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        body.dark-mode .container {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        body.dark-mode input,
        body.dark-mode select {
            background-color: #444;
            color: white;
            border: 1px solid #666;
        }
    </style>
</head>

<body>
    <button id="theme-toggle" class="btn-theme">🌙</button>
    <div class="container">
        <h1>Editar Datos del Guardia</h1>

        <form action="{{ route('guardias.update', $guardia->id) }}" method="POST">
            @csrf
            @method('PUT') <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $guardia->nombre }}" required>

            <label>Apellido</label>
            <input type="text" name="apellido" value="{{ $guardia->apellido }}" required>

            <label>Cédula</label>
            <input type="text" name="cedula" value="{{ $guardia->cedula }}" required>

            <label>Turno Actual: {{ $guardia->turno }}</label>
            <select name="turno">
                <option value="Mañana" {{ $guardia->turno == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                <option value="Tarde" {{ $guardia->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                <option value="Noche" {{ $guardia->turno == 'Noche' ? 'selected' : '' }}>Noche</option>
            </select>

            <button type="submit">Actualizar Información</button>
        </form>

        <a href="{{ route('guardias.index') }}" class="btn-regresar">
            Cancelar y volver a la lista
        </a>
    </div>
    <script>
        const btn = document.getElementById('theme-toggle');
        const body = document.body;

        // 1. Cargar preferencia guardada en el navegador
        if (localStorage.getItem('dark-mode') === 'enabled') {
            body.classList.add('dark-mode');
            btn.innerText = '☀️';
        }

        // 2. Evento de clic para cambiar el tema
        btn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('dark-mode', isDark ? 'enabled' : 'disabled');
            btn.innerText = isDark ? '☀️' : '🌙';
        });
    </script>
</body>

</html>
