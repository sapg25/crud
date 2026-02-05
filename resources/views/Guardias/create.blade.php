<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Guardia</title>
    <style>
        /* Contenedor que envuelve ambos cuadros */
        .flex-container {
            display: flex;
            flex-direction: row;
            /* Alineación horizontal */
            gap: 20px;
            /* Espacio entre los dos cuadros */
            justify-content: center;
            align-items: flex-start;
            /* Alinea los cuadros por la parte superior */
            width: 100%;
            max-width: 900px;
            /* Aumentamos el ancho total para que quepan ambos */
        }

        /* Ajuste para que los cuadros no se vean tan grandes individualmente */
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            /* Tamaño fijo para cada cuadro */
        }

        /* Responsivo: Si la pantalla es pequeña (celular), se ponen uno debajo del otro */
        @media (max-width: 800px) {
            .flex-container {
                flex-direction: column;
                align-items: center;
            }
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            /* Evita que se salga del contenedor */
        }

        /* Ajuste para modo oscuro */
        body.dark-mode select,
        body.dark-mode input[type="text"] {
            background-color: #444;
            color: white;
            border: 1px solid #666;
        }

        /* Botón de cambio de tema */
        .btn-theme {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 45px;
            /* Ancho fijo */
            height: 45px;
            /* Alto fijo */
            border-radius: 50%;
            /* Lo hace circular */
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
            transition: transform 0.2s ease;
        }

        .btn-theme:hover {
            transform: scale(1.1);
            /* Efecto de aumento al pasar el mouse */
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            /* Centra el texto y los botones */
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
            /* Evita que el input se salga del cuadro */
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
    <button id="theme-toggle" class="btn-theme">🌙</button>

    <div class="flex-container">
        <!-- SECCIÓN IZQUIERDA: REGISTRO DE GUARDIA -->
        <div class="container">
            @if (session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h1>Registrar Guardia</h1>

            <form action="{{ route('guardias.store') }}" method="POST" id="form-guardia">
                @csrf

                <label>Nombre</label>
                <input type="text" name="nombre" placeholder="Ej: Rafael" required>

                <label>Apellido</label>
                <input type="text" name="apellido" placeholder="Ej: Bermeo" required>

                <label for="tipo_documento">Tipo de Documento</label>
                <select name="tipo_documento" id="tipo_documento" class="form-control">
                    <option value="cedula">Cédula</option>
                    <option value="pasaporte">Pasaporte</option>
                    <option value="otro">Otro</option>
                </select>

                <label for="cedula">Número de Documento</label>
                <input type="text" name="cedula" id="cedula" placeholder="Ej: 09XXXXXXXX o PAS12345"
                    maxlength="10" oninput="validarDocumento(this)" style="text-transform: uppercase;" required>

                <script>
                    function validarDocumento(input) {
                        // 1. Solo permite letras y números (quita símbolos o espacios)
                        input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');

                        // 2. Convierte todo a mayúsculas automáticamente
                        input.value = input.value.toUpperCase();
                    }
                </script>
                <label>Turno</label>
                <select name="turno">
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Noche">Noche</option>
                </select>
            </form>

            <a href="{{ route('guardias.index') }}" class="btn-consultar">
                Consultar lista de guardias
            </a>
        </div>

        <!-- SECCIÓN DERECHA: EQUIPAMIENTO -->
        <div class="container">
            <h3>Equipamiento Obligatorio</h3>
            <p style="font-size: 0.9em; color: #666;">Selecciona al menos un ítem del inventario.</p>

            @if($inventarioItems->count() > 0)
                <div style="margin-bottom: 15px;">
                    <label for="inventario-select" style="display: block; margin-bottom: 8px; font-weight: bold;">Seleccionar Ítem del Inventario:</label>
                    <select id="inventario-select" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">-- Selecciona un ítem --</option>
                        @foreach($inventarioItems as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }} ({{ $item->cantidad }} disponibles)</option>
                        @endforeach
                    </select>
                </div>

                <table id="items-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; display: none;">
                    <thead>
                        <tr style="background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                            <th style="padding: 10px; text-align: left; font-weight: bold;">Ítem</th>
                            <th style="padding: 10px; text-align: left; font-weight: bold;">Código</th>
                            <th style="padding: 10px; text-align: center; width: 60px; font-weight: bold;">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="items-tbody">
                    </tbody>
                </table>

                <button type="button" id="add-item-btn"
                    style="background-color: #493bde; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 20px;">
                    + Agregar Ítem Seleccionado
                </button>

                <button type="submit" form="form-guardia"
                    style="background-color: #28a745; color: white; font-weight: bold; width: 100%; padding: 12px;">
                    Guardar Registro Completo
                </button>
            @else
                <div style="padding: 20px; background-color: #fff3cd; border: 1px solid #ffc107; border-radius: 4px; color: #856404;">
                    <strong>⚠️ No hay equipamiento disponible</strong><br>
                    No hay items en el inventario con cantidad disponible. Por favor, agrega items al inventario primero.
                </div>
            @endif
        </div>
    </div>
    <script>
        const btn = document.getElementById('theme-toggle');
        const body = document.body;
        let items = [];

        // Función para permitir letras y números (Pasaporte/Cédula)
        function validarDocumento(input) {
            const tipoDoc = document.getElementById('tipo_documento').value;

            if (tipoDoc === 'cedula') {
                input.value = input.value.replace(/[^0-9]/g, '');
            } else {
                input.value = input.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
            }
        }

        // Limpiar el campo si el usuario cambia el tipo de documento
        document.getElementById('tipo_documento').addEventListener('change', function() {
            document.getElementById('cedula').value = '';
            document.getElementById('cedula').placeholder = this.value === 'cedula' ? 'Ej: 09XXXXXXXX' : 'Ej: ABC12345';
        });

        // Lógica del Modo Oscuro
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

        // Lógica para agregar items del inventario
        const addBtn = document.getElementById('add-item-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                const select = document.getElementById('inventario-select');
                const itemId = select.value;
                const selectedOption = select.options[select.selectedIndex];

                if (!itemId) {
                    alert('Por favor selecciona un ítem');
                    return;
                }

                // Extraer nombre y cantidad del texto de la opción
                const text = selectedOption.text;
                const nombre = text.substring(0, text.indexOf('(')).trim();

                // Verificar si ya está agregado
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

            items.push({ id: itemId, nombre: nombre });
            const rowIndex = items.length - 1;

            const row = document.createElement('tr');
            row.style.borderBottom = '1px solid #ddd';
            row.innerHTML = `
                <td style="padding: 10px;">${nombre}</td>
                <td style="padding: 10px;">Del Inventario</td>
                <td style="padding: 10px; text-align: center;">
                    <button type="button" class="btn-delete" data-index="${rowIndex}"
                        style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 12px;">
                        Eliminar
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
                document.getElementById('items-table').style.display = 'none';
            }

            updateHiddenInputs();
        }

        function updateHiddenInputs() {
            const form = document.getElementById('form-guardia');

            // Remove all previously added hidden inputs (to avoid duplicates)
            const oldInputs = form.querySelectorAll('input[name^="items"]');
            oldInputs.forEach(input => input.remove());

            // Add new hidden inputs directly to the form
            items.forEach((item, index) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `items[${index}]`;
                input.value = item.id;

                // Append directly to the form element
                form.appendChild(input);
            });
        }

        // Validar que haya al menos un item antes de enviar
        const form = document.getElementById('form-guardia');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (items.length === 0) {
                    e.preventDefault();
                    alert('Debe asignar al menos un ítem');
                    return false;
                }
            });
        }

        // Limpiar formulario si hay mensaje de éxito
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            setTimeout(() => {
                // Limpiar campos de texto
                document.querySelectorAll('input[type="text"]').forEach(input => {
                    input.value = '';
                });

                // Resetear selects
                document.querySelectorAll('select').forEach(select => {
                    select.selectedIndex = 0;
                });

                // Limpiar items agregados
                items = [];
                const tbody = document.getElementById('items-tbody');
                if (tbody) {
                    tbody.innerHTML = '';
                }
                const table = document.getElementById('items-table');
                if (table) {
                    table.style.display = 'none';
                }

                // Limpiar inputs hidden
                const oldInputs = form.querySelectorAll('input[name^="items"]');
                oldInputs.forEach(input => input.remove());
            }, 1500);
        }
    </script>
</body>

</html>
