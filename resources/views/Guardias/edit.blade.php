<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Guardia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Añade esto a tu sección de style en show.blade.php */
        body.dark-mode .page-header p.text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* También para el botón "Volver a la Lista" que mencionaste antes */
        body.dark-mode .btn-outline-secondary {
            color: #fff !important;
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1e 100%);
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #493bde;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        .page-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .page-header {
            background: rgba(45, 45, 45, 0.95);
            color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .card {
            background-color: #2d2d2d;
            color: #fff;
            border-color: #444;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 2px solid #ddd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #493bde;
            box-shadow: 0 0 10px rgba(73, 59, 222, 0.3);
        }

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #444;
            color: white;
            border-color: #666;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: #555;
            border-color: #493bde;
        }

        input[readonly] {
            background-color: #e9ecef;
            color: #333;
            font-weight: 600;
        }

        body.dark-mode input[readonly] {
            background-color: #555;
            color: #fff;
            font-weight: 600;
        }

        .section-title {
            border-bottom: 3px solid #493bde;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #493bde;
        }

        body.dark-mode .section-title {
            color: #667eea;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #493bde;
            border: none;
        }

        .btn-primary:hover {
            background: #6f42c1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(73, 59, 222, 0.4);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        body.dark-mode .info-card {
            background: #333;
        }

        .info-card strong {
            color: #493bde;
        }

        body.dark-mode .info-card strong {
            color: #667eea;
        }
    </style>
</head>

<body>
    <button class="theme-toggle" id="theme-toggle">🌙</button>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="mb-2">
                        <i class="fas fa-edit"></i> Editar Guardia
                    </h1>
                    <p class="text-muted mb-0">Modifica los datos del guardia</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-lg mb-5" style="max-width: 600px;">
        <div class="card">
            <div class="card-body p-4">
                <h2 class="section-title">
                    <i class="fas fa-user-edit"></i> Datos del Guardia
                </h2>

                <div class="info-card">
                    <strong><i class="fas fa-user"></i> Nombre:</strong> {{ $guardia->nombre }} {{ $guardia->apellido }}
                </div>

                <form action="{{ route('guardias.update', $guardia->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label">
                            <i class="fas fa-user"></i> Nombre
                        </label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $guardia->nombre }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">
                            <i class="fas fa-user"></i> Apellido
                        </label>
                        <input type="text" class="form-control" id="apellido" name="apellido"
                            value="{{ $guardia->apellido }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="cedula" class="form-label">
                            <i class="fas fa-id-card"></i> Cédula/Documento
                        </label>
                        <input type="text" class="form-control" id="cedula" name="cedula"
                            value="{{ $guardia->cedula }}" readonly>
                        <small class="text-muted">Este campo no se puede modificar</small>
                    </div>

                    <div class="mb-3">
                        <label for="turno" class="form-label">
                            <i class="fas fa-clock"></i> Turno
                        </label>
                        <select name="turno" id="turno" class="form-select" required>
                            <option value="Mañana" {{ $guardia->turno == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                            <option value="Tarde" {{ $guardia->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                            <option value="Noche" {{ $guardia->turno == 'Noche' ? 'selected' : '' }}>Noche</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2 d-sm-flex">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Actualizar Información
                        </button>
                        <a href="{{ route('guardias.show', $guardia->id) }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const btn = document.getElementById('theme-toggle');
        const body = document.body;

        // Modo Oscuro
        if (localStorage.getItem('dark-mode') === 'enabled') {
            body.classList.add('dark-mode');
            btn.innerText = '☀️';
        }

        btn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('dark-mode', isDark ? 'enabled' : 'disabled');
            btn.innerText = isDark ? '☀️' : '🌙';
        });
    </script>
</body>

</html>
