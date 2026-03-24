<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Nuevo Producto</title>
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
            <h2>NUEVO PRODUCTO</h2>
            <p class="meta-tag">Sincronización con catálogo nacional Macuin</p>
        </div>

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.15); border: 2px solid #ef4444; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 20px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="/productos/agregar" method="POST">
            @csrf

            <div>
                <label>Nombre de la Refacción</label>
                <input type="text" name="nombre" placeholder="Ej: Kit Distribución V8" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>SKU (Código)</label>
                    <input type="text" name="sku" placeholder="MAC-000" required>
                </div>
                <div>
                    <label>Precio Unitario ($)</label>
                    <input type="number" step="0.01" name="precio" placeholder="0.00" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>Stock Inicial</label>
                    <input type="number" name="stock" value="1" required>
                </div>
                <div>
                    <label>Marca de Auto</label>
                    <input type="text" name="marca_auto" placeholder="Ej: Toyota, Ford, Nissan">
                </div>
            </div>

            <div style="margin-top: 15px;">
                <label>Descripción</label>
                <textarea name="descripcion" placeholder="Descripción del producto..." style="width:100%; min-height:80px; resize:vertical;"></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div>
                    <label>Imagen del Producto</label>
                    <select name="imagen">
                        <option value="motor.png">Motor</option>
                        <option value="frenos.png">Frenos</option>
                        <option value="suspension.png">Suspensión</option>
                    </select>
                </div>
                <div>
                    <label>Categoría</label>
                    <select name="categoria" required>
                        <option value="Motor">Motor</option>
                        <option value="Frenos">Frenos</option>
                        <option value="Suspensión">Suspensión</option>
                        <option value="Accesorios">Accesorios</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-macuin" style="margin-top: 20px;">GUARDAR PRODUCTO</button>
        </form>
    </article>

</body>
</html>
