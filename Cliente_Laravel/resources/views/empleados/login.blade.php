<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Acceso Administrativo</title>
    <link rel="stylesheet" href="{{ asset('resources/css/styles.css') }}">
</head>

<body class="registro-view">

    <article class="macuin-box">
        <div class="header-area">
            <h2>MACUIN</h2>
            <p class="meta-tag">Portal para personal autorizado Macuin</p>
        </div>

        @if(session('error'))
        <div
            style="background: rgba(239, 68, 68, 0.1); border: 1.5px solid #ef4444; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; font-weight: 700; text-align:center;">
            {{ session('error') }}
        </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div>
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="admin@macuin.com" required>
            </div>
            <div style="margin-top:15px;">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-macuin">INICIAR SESIÓN</button>
        </form>

        <div style="text-align:center; margin-top:25px;">
            <p style="font-size:10px; color:#aaa; text-transform:uppercase; letter-spacing:1px;">© 2026 Macuin
                Refaccionaria</p>
        </div>
    </article>

</body>

</html>