<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Guardias</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #493bde;
            --secondary-color: #6f42c1;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1e 100%);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        body.dark-mode .card {
            background-color: #2d2d2d;
            color: #fff;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .table {
            background: white;
        }

        body.dark-mode .table {
            background-color: #2d2d2d;
            color: #eee;
        }

        body.dark-mode .table thead {
            background-color: #333;
        }

        .search-input {
            border: 2px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(73, 59, 222, 0.3);
        }

        body.dark-mode .search-input {
            background-color: #444;
            color: white;
            border-color: #666;
        }

        body.dark-mode .search-input:focus {
            background-color: #555;
            border-color: var(--primary-color);
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }
        }

        .no-results {
            text-align: center;
            padding: 3rem 1rem;
        }

        .container-custom {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        body.dark-mode .container-custom {
            background-color: #2d2d2d;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Botón de cambio de tema -->
    <button class="theme-toggle" id="theme-toggle">🌙</button>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" style="margin-bottom: 0;">
        <div class="container-lg">
            <a class="navbar-brand text-primary" href="#">
                <i class="fas fa-users"></i> Gestión de Guardias
            </a>
            <span class="badge bg-primary rounded-pill ms-auto">Sistema de Control</span>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="mb-2">
                        <i class="fas fa-shield-alt"></i> Guardias Registrados
                    </h1>
                    <p class="text-muted mb-0">Gestiona y consulta los guardias del sistema</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-lg mb-5">
        <!-- Botones de acción -->
        <div class="row mb-4">
            <div class="col-md-6">
                <a href="{{ route('guardias.create') }}" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-plus"></i> Registrar Nuevo Guardia
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" id="search-input" class="form-control search-input btn-lg" 
                    placeholder="🔍 Buscar por nombre, apellido, cédula o código...">
            </div>
        </div>

        <!-- Tabla de Guardias -->
        <div class="container-custom">
            <div class="table-responsive">
                <table id="guardias-table" class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-barcode"></i> Código</th>
                            <th><i class="fas fa-user"></i> Nombre</th>
                            <th><i class="fas fa-user"></i> Apellido</th>
                            <th><i class="fas fa-id-card"></i> Tipo Doc.</th>
                            <th><i class="fas fa-id-card"></i> Cédula/Doc.</th>
                            <th><i class="fas fa-clock"></i> Turno</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guardias as $guardia)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $guardia->codigo_unico ?? 'N/A' }}</span>
                                </td>
                                <td><strong>{{ $guardia->nombre }}</strong></td>
                                <td>{{ $guardia->apellido }}</td>
                                <td>
                                    <span class="badge bg-info text-dark" style="text-transform: capitalize;">
                                        {{ $guardia->tipo_documento }}
                                    </span>
                                </td>
                                <td><code>{{ $guardia->cedula }}</code></td>
                                <td>
                                    <span class="badge bg-warning text-dark">{{ $guardia->turno }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons justify-content-center">
                                        <a href="{{ route('guardias.show', $guardia->id) }}" 
                                            class="btn btn-sm btn-info" title="Ver equipamiento">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('guardias.edit', $guardia->id) }}" 
                                            class="btn btn-sm btn-warning text-dark" title="Editar">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('guardias.destroy', $guardia->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('¿Seguro que deseas eliminar este guardia?')" title="Eliminar">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        // Funcionalidad de búsqueda y filtro
        const searchInput = document.getElementById('search-input');
        const table = document.getElementById('guardias-table');
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleRows = 0;

            rows.forEach(row => {
                // Obtener el contenido de las celdas relevantes
                const codigo = row.cells[0].textContent.toLowerCase();
                const nombre = row.cells[1].textContent.toLowerCase();
                const apellido = row.cells[2].textContent.toLowerCase();
                const cedula = row.cells[4].textContent.toLowerCase();

                // Verificar si alguno coincide con el término de búsqueda
                if (codigo.includes(searchTerm) || 
                    nombre.includes(searchTerm) || 
                    apellido.includes(searchTerm) || 
                    cedula.includes(searchTerm)) {
                    row.style.display = '';
                    visibleRows++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Mostrar mensaje si no hay resultados
            let noResultsMsg = tbody.querySelector('.no-results');
            if (visibleRows === 0) {
                if (!noResultsMsg) {
                    noResultsMsg = document.createElement('tr');
                    noResultsMsg.className = 'no-results';
                    noResultsMsg.innerHTML = '<td colspan="7" class="no-results">No se encontraron guardias que coincidan con la búsqueda</td>';
                    tbody.appendChild(noResultsMsg);
                }
                noResultsMsg.style.display = '';
            } else if (noResultsMsg) {
                noResultsMsg.style.display = 'none';
            }
        });
    </script>


</body>

</html>
