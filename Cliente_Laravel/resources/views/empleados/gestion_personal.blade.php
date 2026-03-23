<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Gestión de Personal</title>
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
</head>
<body class="registro-view" style="display: block;">

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

    <div style="max-width: 600px; margin: 0 auto; padding-top: 100px; padding-bottom: 60px;">

        <article class="macuin-box" style="margin: 0 auto;">
            <div class="header-area">
                <h2>GESTIÓN DE PERSONAL</h2>
                <p class="meta-tag">Asigna acceso administrativo al sistema Macuin</p>
            </div>

            @if(session('success'))
                <div style="background: rgba(34,197,94,0.1); border: 2px solid #22c55e; color: #4ade80; padding: 12px; border-radius: 10px; margin-bottom: 25px; font-weight: 800; text-align:center; text-transform:uppercase; font-size:11px; letter-spacing:1px;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: rgba(239,68,68,0.1); border: 2px solid #ef4444; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 25px; font-weight: 800; text-align:center; text-transform:uppercase; font-size:11px; letter-spacing:1px;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/admins/agregar" method="POST">
                @csrf
                <div>
                    <label>Nombre Completo</label>
                    <input type="text" name="nombre" placeholder="Nombre completo" required>
                </div>
                <div style="margin-top:15px;">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" placeholder="usuario@macuin.com" required>
                </div>
                <div style="margin-top:15px;">
                    <label>Contraseña de Acceso</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-macuin" style="margin-top: 20px;">REGISTRAR ADMINISTRADOR</button>
            </form>

            <div style="text-align:center; margin-top:30px;">
                <a href="/panel-accesos" style="color:#F5C518; font-weight:800; text-transform:uppercase; font-size:12px; letter-spacing:1px; text-decoration:none;">
                    VER PANEL DE ACCESOS →
                </a>
            </div>
        </article>
    </div>

</body>
</html>
