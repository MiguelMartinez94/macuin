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
            <a href="/admins/nuevo">USUARIOS</a>
            <button class="btn-red" onclick="window.location.href='/logout'">CERRAR SESIÓN</button>
        </nav>
    </header>

    <div style="max-width: 1000px; margin: 0 auto; padding-top: 100px; padding-bottom: 60px;">
        
        <article class="macuin-box" style="margin: 0 auto;">
            <div class="header-area">
                <h2>GESTIÓN PERSONAL</h2>
                <p class="meta-tag">Asigna acceso administrativo al sistema Macuin</p>
            </div>

            @if(session('success'))
                <div style="background: rgba(34, 197, 94, 0.1); border: 2px solid #22c55e; color: #166534; padding: 12px; border-radius: 10px; margin-bottom: 25px; font-weight: 800; text-align:center; text-transform:uppercase; font-size:11px;">
                    {{ session('success') }}
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
                    <label>Contraseña Acceso</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-macuin">REGISTRAR ADMINISTRADOR</button>
            </form>
        </article>

        <h2 style="font-family:'Oswald'; color:#F5C518; font-size:3.5rem; text-transform:uppercase; text-align:center; margin-top:100px; letter-spacing:1px; line-height:1;">PANEL DE ACCESOS</h2>
        
        <table class="panel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DEL EMPLEADO</th>
                    <th>EMAIL INSTITUCIONAL</th>
                    <th>ROL</th>
                    <th style="text-align: right;">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $u)
                <tr>
                    <td style="color:#aaa;">#{{ $u['id'] }}</td>
                    <td style="text-transform:uppercase;">{{ $u['nombre'] }}</td>
                    <td>{{ $u['email'] }}</td>
                    <td><span class="badge-role">{{ strtoupper($u['role']) }}</span></td>
                    <td style="text-align: right;">
                        <form action="/admins/borrar/{{ $u['id'] }}" method="POST">
                            @csrf
                            <button type="submit" style="background:#111; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-weight:900; font-size:10px; cursor:pointer;" onsubmit="return confirm('¿Baja definitiva?')">DAR DE BAJA</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
