<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detalles - {{ $guardia->nombre }} {{ $guardia->apellido }}</title>
    <style>
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

        body.dark-mode h1,
        body.dark-mode h2 {
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
            max-width: 900px;
            margin-bottom: 20px;
        }

        .info-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #493bde;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-weight: bold;
            color: #493bde;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1em;
            color: #333;
        }

        .badge-id {
            display: inline-block;
            background: #493bde;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 15px;
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
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-right: 10px;
        }

        .btn-regresar:hover {
            background: #218838;
        }

        .btn-editar {
            display: inline-block;
            padding: 10px 20px;
            background: #ffc107;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-editar:hover {
            background: #e0a800;
        }

        .btn-eliminar {
            background: #dc3545;
            border: none;
            cursor: pointer;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-eliminar:hover {
            background: #c82333;
        }

        .alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .no-items {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }

        .btn-agregar {
            display: inline-block;
            padding: 10px 20px;
            background: #493bde;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-agregar:hover {
            background: #3a2ba8;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
        }

        body.dark-mode .modal-content {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        .modal-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        body.dark-mode .modal-close {
            color: #aaa;
        }

        .modal-body select {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn-modal {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }
    </style>
</head>

<body>
    <button id="theme-toggle" class="btn-theme">🌙</button>

    <div class="container">
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- ID Único del Guardia -->
        <div class="badge-id">ID: {{ $guardia->codigo_unico }}</div>

        <h1>{{ $guardia->nombre }} {{ $guardia->apellido }}</h1>

        <!-- Información del Guardia -->
        <div class="info-box">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Tipo de Documento</span>
                    <span class="info-value" style="text-transform: capitalize;">{{ $guardia->tipo_documento }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Número de Documento</span>
                    <span class="info-value">{{ $guardia->cedula }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Turno</span>
                    <span class="info-value">{{ $guardia->turno }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Registrado</span>
                    <span class="info-value">{{ $guardia->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Equipamiento Asignado -->
        <h2>Equipamiento Asignado</h2>

        @if ($guardia->items->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Ítem</th>
                        <th>Código del Inventario</th>
                        <th>Asignado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guardia->items as $item)
                        <tr>
                            <td>{{ $item->inventarioItem->nombre ?? $item->nombre_item ?? 'N/A' }}</td>
                            <td>{{ $item->inventarioItem->codigo_serie ?? $item->codigo_serie ?? 'N/A' }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 12px;"
                                        onclick="return confirm('¿Remover este ítem? Volverá al inventario.')">
                                        Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn-agregar" id="btn-add-items">+ Agregar Items</button>
        @else
            <div class="no-items">
                No hay equipamiento asignado a este guardia.
            </div>
            <button type="button" class="btn-agregar" id="btn-add-items">+ Agregar Items</button>
        @endif

        <!-- Botones de Acción -->
        <div class="button-group">
            <a href="{{ route('guardias.index') }}" class="btn-regresar">
                ← Volver a la lista
            </a>
            <a href="{{ route('guardias.edit', $guardia->id) }}" class="btn-editar">
                ✏️ Editar Guardia
            </a>
            <form action="{{ route('guardias.destroy', $guardia->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-eliminar"
                    onclick="return confirm('¿Estás seguro de que deseas eliminar este guardia y su equipamiento?')">
                    🗑️ Eliminar
                </button>
            </form>
        </div>
    </div>

    <!-- Modal para Agregar Items -->
    <div class="modal-overlay" id="modal-agregar-items">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Agregar Items al Equipamiento</h3>
                <button type="button" class="modal-close" id="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <label for="item-select" style="font-weight: bold; display: block; margin-bottom: 10px;">Selecciona un Ítem:</label>
                <select id="item-select">
                    <option value="">-- Selecciona un ítem disponible --</option>
                    @php
                        $inventoryItems = \App\Models\InventarioItem::where('cantidad', '>', 0)->get();
                        $assignedItemIds = $guardia->items()->pluck('inventario_item_id')->toArray();
                    @endphp
                    @forelse($inventoryItems as $invItem)
                        @if (!in_array($invItem->id, $assignedItemIds))
                            <option value="{{ $invItem->id }}">{{ $invItem->nombre }} ({{ $invItem->cantidad }} disponibles)</option>
                        @endif
                    @empty
                        <option value="" disabled>No hay items disponibles</option>
                    @endforelse
                </select>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-cancel" id="modal-cancel">Cancelar</button>
                <button type="button" class="btn-modal btn-success" id="modal-confirm">Agregar Item</button>
            </div>
        </div>
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

        // Lógica del Modal para Agregar Items
        const modalOverlay = document.getElementById('modal-agregar-items');
        const btnAddItems = document.getElementById('btn-add-items');
        const btnModalClose = document.getElementById('modal-close');
        const btnCancel = document.getElementById('modal-cancel');
        const btnConfirm = document.getElementById('modal-confirm');
        const itemSelect = document.getElementById('item-select');

        // Abrir modal
        btnAddItems.addEventListener('click', () => {
            itemSelect.value = '';
            modalOverlay.classList.add('active');
        });

        // Cerrar modal
        function closeModal() {
            modalOverlay.classList.remove('active');
        }

        btnModalClose.addEventListener('click', closeModal);
        btnCancel.addEventListener('click', closeModal);

        // Cerrar modal al hacer clic en el overlay
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });

        // Confirmar agregar item
        btnConfirm.addEventListener('click', () => {
            const itemId = itemSelect.value;

            if (!itemId) {
                alert('Por favor selecciona un ítem');
                return;
            }

            // Crear un formulario AJAX para agregar el item
            const guardia_id = {{ $guardia->id }};

            fetch(`/guardias/${guardia_id}/items`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    inventario_item_id: itemId
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al agregar item');
                // Recargar la página para ver los cambios
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al agregar el item. Intenta de nuevo.');
            });
        });
    </script>

</body>

</html>
