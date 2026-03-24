<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Panel de Compras</title>
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
</head>

<body>

    <header>
        <a href="/dashboard" class="logo-link">MACUIN</a>
        <nav>
            <a href="/dashboard">INICIO</a>
            <a href="/productos/nuevo">NUEVO PRODUCTO</a>
            <a href="/compras">COMPRAS</a>
            <a href="/panel-accesos">PANEL DE ACCESOS</a>
            <button class="btn-red" onclick="window.location.href='/logout'">CERRAR SESIÓN</button>
        </nav>
    </header>

    <div class="main-wrap">
        <h1>PANEL DE COMPRAS</h1>
        <p class="tagline">Gestiona y actualiza el estado de los pedidos de clientes.</p>

        @if(session('success'))
        <div
            style="background: rgba(34,197,94,0.2); border: 2px solid #22c55e; color: #4ade80; padding: 12px; border-radius: 10px; margin-bottom: 30px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div
            style="background: rgba(239,68,68,0.15); border: 2px solid #ef4444; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 30px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
            {{ session('error') }}
        </div>
        @endif

        <div class="tabs-row" id="tabs" style="margin-bottom: 30px;">
            <button class="activo" data-filtro="todos" type="button">Todos</button>
            <button data-filtro="recibido" type="button">Recibido</button>
            <button data-filtro="en proceso" type="button">En Proceso</button>
            <button data-filtro="enviado" type="button">Enviado</button>
            <button data-filtro="cancelado" type="button">Cancelado</button>
        </div>

        <table class="panel-table" id="tabla-compras">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>ARTÍCULOS</th>
                    <th>FECHA</th>
                    <th>MÉTODO</th>
                    <th>TOTAL</th>
                    <th>ESTADO</th>
                    <th style="text-align:right;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @forelse($compras as $c)
                @php
                $estado = $c['estado'] ?? 'En Proceso';
                $estadoClass = match($estado) {
                'Recibido' => 'disponible',
                'Enviado' => 'bajo-stock',
                'Cancelado' => 'agotado',
                default => 'bajo-stock',
                };
                $fecha = $c['fecha'] ? \Carbon\Carbon::parse($c['fecha'])->format('d/m/Y') : 'N/A';
                @endphp
                <tr data-estado="{{ $estado }}">
                    <td style="color:#aaa;">#{{ $c['id'] }}</td>
                    <td style="text-transform:uppercase; font-weight:700;">{{ $c['usuario_nombre'] }}</td>
                    <td style="font-size:12px; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"
                        title="{{ $c['articulos'] }}">{{ $c['articulos'] }}</td>
                    <td style="color:#aaa; font-size:12px;">{{ $fecha }}</td>
                    <td style="font-size:12px;">{{ $c['metodo'] ?? '—' }}</td>
                    <td><strong>${{ number_format($c['total'], 2) }}</strong></td>
                    <td><span class="pill-status {{ $estadoClass }}">{{ strtoupper($estado) }}</span></td>
                    <td style="text-align:right;">
                        <form action="/compras/{{ $c['id'] }}/estado" method="POST"
                            style="display:flex; gap:8px; align-items:center; justify-content:flex-end;">
                            @csrf
                            <select name="estado"
                                style="padding:6px 10px; border-radius:6px; font-size:11px; font-weight:700; background:#1a1a1a; color:#fff; border:1px solid #333;">
                                <option value="En Proceso" {{ $estado==='En Proceso' ? 'selected' : '' }}>EN PROCESO
                                </option>
                                <option value="Enviado" {{ $estado==='Enviado' ? 'selected' : '' }}>ENVIADO</option>
                                <option value="Recibido" {{ $estado==='Recibido' ? 'selected' : '' }}>RECIBIDO</option>
                                <option value="Cancelado" {{ $estado==='Cancelado' ? 'selected' : '' }}>CANCELADO
                                </option>
                            </select>
                            <button type="submit"
                                style="background:#F5C518; color:#111; border:none; padding:8px 14px; border-radius:6px; font-weight:900; font-size:10px; cursor:pointer; text-transform:uppercase; white-space:nowrap;">GUARDAR</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8"
                        style="text-align:center; padding:80px; color:#888; font-weight:700; letter-spacing:1px;">SIN
                        COMPRAS REGISTRADAS</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.querySelectorAll('#tabs button').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('#tabs button').forEach(b => b.classList.remove('activo'));
                btn.classList.add('activo');

                const filtro = btn.dataset.filtro;
                document.querySelectorAll('#tabla-compras tbody tr[data-estado]').forEach(row => {
                    if (filtro === 'todos' || row.dataset.estado.toLowerCase() === filtro) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>