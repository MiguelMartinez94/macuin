<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Dashboard Administrador</title>
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
        <h1>INVENTARIO DE ALTA PRECISIÓN</h1>
        <p class="tagline">Gestiona modelos, refacciones y stock en tiempo récord.</p>

        <div class="search-box">
            <input type="text" id="filtro-nombre" placeholder="NOMBRE" oninput="filtrarProductos()">
            <input type="text" id="filtro-marca"  placeholder="MARCA DE AUTO" oninput="filtrarProductos()">
            <input type="text" id="filtro-tipo"   placeholder="TIPO DE PIEZA" oninput="filtrarProductos()">
            <button class="btn-yellow" onclick="filtrarProductos()">FILTRAR</button>
        </div>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.2); border: 2px solid #22c55e; color: #4ade80; padding: 12px; border-radius: 10px; margin-bottom: 40px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
                {{ session('success') }}
            </div>
        @endif

        <ul class="product-list" id="lista-productos">
            @forelse($productos as $p)
            @php
                $stock       = $p['stock'] ?? 0;
                $statusClass = $stock == 0 ? 'agotado' : ($stock <= 5 ? 'bajo-stock' : 'disponible');
                $statusText  = $stock == 0 ? 'Agotado' : ($stock <= 5 ? 'Bajo Stock' : 'Disponible');
            @endphp
            <li data-nombre="{{ strtolower($p['nombre']) }}" data-marca="{{ strtolower($p['marca_auto'] ?? '') }}" data-categoria="{{ strtolower($p['categoria'] ?? '') }}">
                <span class="pill-status {{ $statusClass }}">{{ $statusText }}</span>
                <figure>
                    @if(isset($p['imagen']) && $p['imagen'])
                        <img src="{{ asset('resources/images/productos/' . $p['imagen']) }}" alt="{{ $p['nombre'] }}" style="width:100%; height:100%; object-fit:contain; padding:15px; box-sizing:border-box;">
                    @else
                        {{ $p['categoria'] ?? 'AUTOPARTE' }}
                    @endif
                </figure>
                <article>
                    <h3>{{ $p['nombre'] }}</h3>
                    <p>SKU: {{ $p['sku'] }} | STOCK: {{ $p['stock'] }}</p>
                    @if($p['marca_auto'] ?? false)<p style="font-size:11px; color:#aaa;">{{ $p['marca_auto'] }}</p>@endif
                    <footer>
                        <strong>${{ number_format($p['precio'], 2) }}</strong>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <a href="/productos/editar/{{ $p['id'] }}" class="action-link">EDITAR</a>
                            <form action="/productos/borrar/{{ $p['id'] }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Eliminar producto?')">
                                @csrf
                                <button type="submit" style="background:none; border:none; font-weight:900; font-size:12px; color:#ef4444; cursor:pointer; text-transform:uppercase;">BORRAR</button>
                            </form>
                        </div>
                    </footer>
                </article>
            </li>
            @empty
            <li style="grid-column: 1 / -1; text-align:center; padding: 80px; background: rgba(255,255,255,0.05); border: 1px dashed #444; border-radius: 14px;">
                <p style="color: #888; font-size: 1.2rem; font-weight: 700; letter-spacing:1px;">CATÁLOGO SIN REGISTROS</p>
            </li>
            @endforelse
        </ul>
    </div>

    <script>
        function filtrarProductos() {
            var nombre    = document.getElementById('filtro-nombre').value.toLowerCase();
            var marca     = document.getElementById('filtro-marca').value.toLowerCase();
            var categoria = document.getElementById('filtro-tipo').value.toLowerCase();

            document.querySelectorAll('#lista-productos li[data-nombre]').forEach(function(li) {
                var n = li.dataset.nombre    || '';
                var m = li.dataset.marca     || '';
                var c = li.dataset.categoria || '';
                var match = (!nombre    || n.includes(nombre))
                         && (!marca     || m.includes(marca))
                         && (!categoria || c.includes(categoria));
                li.style.display = match ? '' : 'none';
            });
        }
    </script>

</body>
</html>