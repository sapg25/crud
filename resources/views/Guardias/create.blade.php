<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Guardia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body.dark-mode .alert-success {
            background-color: #1b4332;
            color: #8fce00;
            border: 1px solid #2d6a4f;
        }

        body.dark-mode .alert-warning {
            background-color: #332b00;
            color: #ffe082;
            border-color: #665200;
        }

        body.dark-mode .alert-warning .btn-warning {
            background-color: #ffc107;
            color: #000;
        }

        /* Asegura que la columna de código no se mueva */
        #items-table td code {
            display: inline-block;
            width: 100%;
            text-align: center;
            background-color: #f0f0f0;
            /* Fondo gris claro para modo claro */
            color: #c7254e;
            /* Color rojizo clásico de code */
            padding: 2px 4px;
            border-radius: 4px;
            font-family: monospace;
        }

        /* Ajuste para modo oscuro */
        body.dark-mode #items-table td code {
            background-color: #444 !important;
            color: #ff79c6 !important;
            /* Un color que resalte en oscuro */
        }

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

        #items-table {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        #items-table thead {
            background-color: #333 !important;
        }

        #items-table th {
            background-color: #333 !important;
            color: #fff !important;
            font-weight: 600;
            border: 1px solid #555;
        }

        #items-table td {
            border: 1px solid #ddd;
            color: #000;
            padding: 12px;
        }

        #items-table tr {
            border-bottom: 1px solid #ddd;
        }

        body.dark-mode #items-table {
            background-color: #2d2d2d;
            border: 1px solid #444;
        }

        body.dark-mode #items-table thead {
            background-color: #333 !important;
        }

        body.dark-mode #items-table th {
            background-color: #333 !important;
            color: #fff !important;
            font-weight: 600;
            border: 1px solid #555;
            text-transform: none;
        }

        body.dark-mode #items-table tbody tr {
            background-color: #2d2d2d;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        body.dark-mode #items-table td {
            color: #fff;
            border: 1px solid #555;
            padding: 12px;
        }

        body.dark-mode #items-table .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        body.dark-mode #items-table code {
            background-color: #444;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* Asegurar que todo sea visible en modo oscuro */
        body.dark-mode .table {
            color: #fff;
        }

        body.dark-mode .table td {
            color: #fff !important;
        }

        body.dark-mode .table th {
            color: #fff !important;
            background-color: #333 !important;
        }

        body.dark-mode .table tbody tr {
            color: #fff;
        }

        body.dark-mode .table tbody tr td {
            color: #fff !important;
            background-color: transparent !important;
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

        .alert {
            border-radius: 8px;
            border: none;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }

        .badge-custom {
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
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
                        <i class="fas fa-user-plus"></i> Registrar Nuevo Guardia
                    </h1>
                    <p class="text-muted mb-0">Complete el formulario para registrar un guardia en el sistema</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-lg mb-5">
        <div class="row g-4">
            <!-- Left Column: Formulario de Guardia -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle"></i> Datos del Guardia
                        </h2>
                        @if (session('reactivar_id'))
                            <div class="alert alert-warning d-flex justify-content-between align-items-center shadow-sm"
                                style="border-left: 5px solid #ffc107;">
                                <div>
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>{{ session('warning') }}</strong>
                                </div>
                                <form action="{{ route('guardias.reactivar', session('reactivar_id')) }}" method="POST"
                                    class="mb-0">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm fw-bold">
                                        SÍ, REACTIVAR AHORA
                                    </button>
                                </form>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('guardias.store') }}" method="POST" id="form-guardia">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user"></i> Nombre
                                </label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ej: Rafael" required value="{{ old('nombre') }}">
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">
                                    <i class="fas fa-user"></i> Apellido
                                </label>
                                <input type="text" class="form-control" id="apellido" name="apellido"
                                    placeholder="Ej: Bermeo" required value="{{ old('apellido') }}">
                            </div>

                            <div class="mb-3">
                                <label for="tipo_documento" class="form-label">
                                    <i class="fas fa-id-card"></i> Tipo de Documento
                                </label>
                                <select name="tipo_documento" id="tipo_documento" class="form-select" required>
                                    <option value="cedula">Cédula</option>
                                    <option value="pasaporte">Pasaporte</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="cedula" class="form-label">
                                    <i class="fas fa-card-id"></i> Cédula/Documento
                                </label>
                                <input type="text" class="form-control" id="cedula" name="cedula"
                                    placeholder="Ej: 09XXXXXXXX" maxlength="10" required value="{{ old('cedula') }}"
                                    onkeyup="validarDocumento(this)">
                                <small class="text-muted">Solo números para cédula, alfanumérico para pasaporte</small>
                            </div>

                            <div class="mb-3">
                                <label for="turno" class="form-label">
                                    <i class="fas fa-clock"></i> Turno
                                </label>
                                <select name="turno" id="turno" class="form-select">
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noche">Noche</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Asignación de Items -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h2 class="section-title">
                            <i class="fas fa-shopping-cart"></i> Equipamiento
                        </h2>

                        @if ($inventarioItems->isEmpty())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> <strong>Sin disponibilidad</strong><br>
                                No hay equipamiento disponible. Por favor, agrega items al inventario.
                            </div>
                        @else
                            <div class="mb-3">
                                <label for="inventario-select" class="form-label">
                                    <i class="fas fa-list"></i> Seleccionar Equipamiento
                                </label>
                                <select id="inventario-select" class="form-select">
                                    <option value="">-- Selecciona un ítem --</option>
                                    @foreach ($inventarioItems as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nombre }}
                                            <span class="badge badge-custom bg-success">{{ $item->cantidad }}
                                                disponibles</span>
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" id="add-item-btn" class="btn btn-success w-100 mb-3">
                                <i class="fas fa-plus"></i> Agregar Equipamiento
                            </button>

                            <div class="table-responsive">
                                <table id="items-table" class="table table-sm table-hover mb-0"
                                    style="display: none;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th><i class="fas fa-box"></i> Ítem</th>
                                            <th><i class="fas fa-barcode"></i> Código</th>
                                            <th class="text-center" style="width: 90px;">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-tbody"></tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="mt-3 d-grid gap-2 d-sm-flex">
                    <button type="submit" form="form-guardia" class="btn btn-primary btn-lg" id="submit-btn">
                        <i class="fas fa-save"></i> Registrar Guardia
                    </button>
                    <button type="reset" form="form-guardia" class="btn btn-warning btn-lg text-dark">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <a href="{{ route('guardias.index') }}" class="btn btn-info btn-lg">
                        <i class="fas fa-list"></i> Consultar Guardias
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const btn = document.getElementById('theme-toggle');
        const body = document.body;
        let items = [];

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

        // Validar documento
        document.getElementById('tipo_documento').addEventListener('change', function() {
            const inputCedula = document.getElementById('cedula');
            inputCedula.value = '';

            if (this.value === 'cedula') {
                inputCedula.placeholder = 'Ej: 09XXXXXXXX';
                inputCedula.maxLength = '10';
                inputCedula.title = 'Máximo 10 números';
            } else {
                inputCedula.placeholder = 'Ej: ABC12345';
                inputCedula.maxLength = '30';
                inputCedula.title = 'Máximo 30 caracteres';
            }
        });

        function validarDocumento(input) {
            const tipoDoc = document.getElementById('tipo_documento').value;
            if (tipoDoc === 'cedula') {
                // Solo números para cédula
                input.value = input.value.replace(/[^0-9]/g, '');
                // Limitar a 10 dígitos
                if (input.value.length > 10) {
                    input.value = input.value.substring(0, 10);
                }
            } else {
                // Alfanumérico para pasaporte
                input.value = input.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
                // Limitar a 30 caracteres
                if (input.value.length > 30) {
                    input.value = input.value.substring(0, 30);
                }
            }
        }

        // Funcionalidad de agregar items
        const addBtn = document.getElementById('add-item-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const select = document.getElementById('inventario-select');
                const itemId = select.value;
                const selectedOption = select.options[select.selectedIndex];
                const itemText = selectedOption.text;

                // Extraer solo el nombre del item (quita el badge)
                const nombre = itemText.split(/\s+disponible/)[0].trim();

                if (!itemId) {
                    alert('Por favor selecciona un ítem');
                    return;
                }

                if (items.find(i => i.id == itemId)) {
                    alert('Este ítem ya está agregado');
                    return;
                }

                addItemToTable(itemId, nombre);
                select.value = '';
            });
        }

        function addItemToTable(itemId, nombre) {
            const table = document.getElementById('items-table');
            const tbody = document.getElementById('items-tbody');

            items.push({
                id: itemId,
                nombre: nombre
            });
            const rowIndex = items.length - 1;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${nombre}</td>
                <td><code>Del Inventario</code></td>
                <td class="text-center">
                    <button type="button" class="btn-delete btn btn-sm btn-danger" data-index="${rowIndex}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            `;

            tbody.appendChild(row);

            if (table.style.display === 'none') {
                table.style.display = 'table';
            }

            row.querySelector('.btn-delete').addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                deleteItem(index);
            });

            updateHiddenInputs();
        }

        function deleteItem(index) {
            items.splice(index, 1);
            const tbody = document.getElementById('items-tbody');
            tbody.deleteRow(index);

            if (items.length === 0) {
                const table = document.getElementById('items-table');
                table.style.display = 'none';
            }

            updateHiddenInputs();
        }

        function updateHiddenInputs() {
            const form = document.getElementById('form-guardia');
            const oldInputs = form.querySelectorAll('input[name^="items"]');
            oldInputs.forEach(input => input.remove());

            items.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `items[${index}]`;
                input.value = item.id;
                form.appendChild(input);
            });
        }

        // Validar que haya al menos un item
        document.getElementById('submit-btn').addEventListener('click', function(e) {
            if (items.length === 0) {
                e.preventDefault();
                alert('Debe asignar al menos un ítem');
                return false;
            }
            // Actualizar inputs hidden justo antes de enviar
            updateHiddenInputs();
        });

        // Limpiar formulario cuando se hace clic en reset (Cancelar)
        document.getElementById('form-guardia').addEventListener('reset', function() {
            items = [];
            const tbody = document.getElementById('items-tbody');
            if (tbody) tbody.innerHTML = '';
            const table = document.getElementById('items-table');
            if (table) table.style.display = 'none';
            const select = document.getElementById('inventario-select');
            if (select) select.value = '';
        });

        // Limpiar formulario después de éxito
        const alertElement = document.querySelector('.alert-success');
        if (alertElement) {
            setTimeout(() => {
                document.querySelectorAll('input[type="text"]').forEach(input => {
                    input.value = '';
                });
                document.querySelectorAll('select').forEach(select => {
                    select.selectedIndex = 0;
                });
                items = [];
                const tbody = document.getElementById('items-tbody');
                if (tbody) tbody.innerHTML = '';
                const table = document.getElementById('items-table');
                if (table) table.style.display = 'none';
            }, 1500);
        }
    </script>
</body>

</html>
