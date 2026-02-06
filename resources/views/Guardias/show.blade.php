<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles - {{ $guardia->nombre }} {{ $guardia->apellido }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
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
            margin-bottom: 2rem;
        }

        body.dark-mode .card {
            background-color: #2d2d2d;
            color: #fff;
            border-color: #444;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #493bde;
        }

        body.dark-mode .info-item {
            background: #333;
            border-left-color: #667eea;
        }

        .info-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #666;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        body.dark-mode .info-label {
            color: #aaa;
        }

        .info-value {
            display: block;
            font-size: 1.25rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        body.dark-mode .info-value {
            color: #fff;
        }

        .badge-custom {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
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

        body.dark-mode .table tbody tr {
            border-color: #444;
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

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
        }

        body.dark-mode .empty-state-icon {
            color: #666;
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
                        <i class="fas fa-user-circle"></i> {{ $guardia->nombre }} {{ $guardia->apellido }}
                    </h1>
                    <p class="text-muted mb-0">Información y equipamiento asignado</p>
                </div>
                <div class="col-auto">
                    <span class="badge badge-custom bg-primary">{{ $guardia->codigo_unico ?? 'N/A'}}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-lg mb-5">
        <!-- Información del Guardia -->
        <div class="card">
            <div class="card-body p-4">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i> Información Personal
                </h2>
                
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Tipo de Documento</span>
                        <span class="info-value" style="text-transform: capitalize;">
                            <span class="badge bg-info text-dark">{{ $guardia->tipo_documento }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Número de Documento</span>
                        <span class="info-value"><code>{{ $guardia->cedula }}</code></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Turno</span>
                        <span class="info-value">
                            <span class="badge bg-warning text-dark">{{ $guardia->turno }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Registrado</span>
                        <span class="info-value">{{ $guardia->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Equipamiento Asignado -->
        <div class="card">
            <div class="card-body p-4">
                <h2 class="section-title">
                    <i class="fas fa-shopping-cart"></i> Equipamiento Asignado
                </h2>

                @if ($guardia->items->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h4>Sin equipamiento asignado</h4>
                        <p class="text-muted">Este guardia aún no tiene items asignados</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-box"></i> Nombre del Ítem</th>
                                    <th><i class="fas fa-barcode"></i> Código de Serie</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guardia->items as $item)
                                    <tr>
                                        <td><strong>{{ $item->nombre_item }}</strong></td>
                                        <td><code>{{ $item->codigo_serie ?? 'N/A' }}</code></td>
                                        <td class="text-center">
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Deseas devolver este ítem al inventario?')" title="Eliminar">
                                                    <i class="fas fa-trash"></i> Devolver
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Agregar Nuevo Equipamiento -->
        <div class="card">
            <div class="card-body p-4">
                <h2 class="section-title">
                    <i class="fas fa-plus-circle"></i> Agregar Equipamiento
                </h2>

                <form id="add-item-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="inventario-select" class="form-label">
                                <i class="fas fa-list"></i> Seleccionar Ítem del Inventario
                            </label>
                            <select id="inventario-select" class="form-select" required>
                                <option value="">-- Selecciona un ítem --</option>
                                @foreach(\App\Models\InventarioItem::where('cantidad', '>', 0)->get() as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nombre }} ({{ $item->cantidad }} disponible)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-success w-100" id="add-item-btn">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="d-grid gap-2 d-sm-flex">
            <a href="{{ route('guardias.edit', $guardia->id) }}" class="btn btn-warning btn-lg text-dark">
                <i class="fas fa-edit"></i> Editar Guardia
            </a>
            <a href="{{ route('guardias.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-arrow-left"></i> Volver a la Lista
            </a>
            <form action="{{ route('guardias.destroy', $guardia->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg"
                    onclick="return confirm('¿Seguro que deseas eliminar este guardia y su equipamiento?')">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </form>
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

        // Agregar item
        document.getElementById('add-item-btn').addEventListener('click', function() {
            const select = document.getElementById('inventario-select');
            const itemId = select.value;

            if (!itemId) {
                alert('Por favor selecciona un ítem');
                return;
            }

            // Enviar solicitud AJAX
            fetch('{{ route("guardias.addItem", $guardia->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    inventario_item_id: itemId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                alert('Error al agregar el ítem');
                console.error(error);
            });
        });
    </script>
</body>

</html>
