<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Editar Producto</title>
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
</head>
<body class="registro-view">

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

    <article class="macuin-box">
        <div class="header-area">
            <h2>EDITAR PRODUCTO</h2>
            <p class="meta-tag">Modificando SKU: {{ $producto['sku'] }}</p>
        </div>

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.15); border: 2px solid #ef4444; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="/productos/actualizar/{{ $producto['id'] }}" method="POST">
            @csrf

            <div>
                <label>Nombre de la Refacción</label>
                <input type="text" name="nombre" value="{{ $producto['nombre'] }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>SKU (Código)</label>
                    <input type="text" name="sku" value="{{ $producto['sku'] }}" required>
                </div>
                <div>
                    <label>Precio Unitario ($)</label>
                    <input type="number" step="0.01" name="precio" value="{{ $producto['precio'] }}" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>Stock Actual</label>
                    <input type="number" name="stock" value="{{ $producto['stock'] }}" required>
                </div>
                <div>
                    <label>Marca de Auto</label>
                    <input type="text" name="marca_auto" value="{{ $producto['marca_auto'] ?? '' }}" placeholder="Ej: Toyota, Ford, Nissan">
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label>Descripción</label>
                <textarea name="descripcion" style="width:100%; min-height:80px; resize:vertical;">{{ $producto['descripcion'] ?? '' }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>Imagen del Producto</label>
                    <select name="imagen">
                        <option value="motor.png"     {{ ($producto['imagen'] ?? '') == 'motor.png'     ? 'selected' : '' }}>Motor</option>
                        <option value="frenos.png"    {{ ($producto['imagen'] ?? '') == 'frenos.png'    ? 'selected' : '' }}>Frenos</option>
                        <option value="suspension.png"{{ ($producto['imagen'] ?? '') == 'suspension.png'? 'selected' : '' }}>Suspensión</option>
                    </select>
                </div>
                <div>
                    <label>Categoría</label>
                    <select name="categoria" required>
                        <option value="Motor"      {{ ($producto['categoria'] ?? '') == 'Motor'      ? 'selected' : '' }}>Motor</option>
                        <option value="Frenos"     {{ ($producto['categoria'] ?? '') == 'Frenos'     ? 'selected' : '' }}>Frenos</option>
                        <option value="Suspensión" {{ ($producto['categoria'] ?? '') == 'Suspensión' ? 'selected' : '' }}>Suspensión</option>
                        <option value="Accesorios" {{ ($producto['categoria'] ?? '') == 'Accesorios' ? 'selected' : '' }}>Accesorios</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-macuin" style="margin-top: 20px;">ACTUALIZAR DATOS</button>
        </form>

        <div style="text-align:center; margin-top:20px;">
            <a href="/dashboard" style="color:#999; font-weight:700; text-transform:uppercase; font-size:11px; text-decoration:none;">← Volver al inventario</a>
        </div>
    </article>

</body>
</html>
