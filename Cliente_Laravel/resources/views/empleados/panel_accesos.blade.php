<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACUIN — Panel de Accesos</title>
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
        <h1>PANEL DE ACCESOS</h1>
        <p class="tagline">Usuarios y permisos del sistema administrativo Macuin.</p>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 30px;">
            <a href="/personal" style="background:#F5C518; color:#111; font-weight:900; font-size:12px; text-transform:uppercase; letter-spacing:1px; padding:12px 24px; border-radius:8px; text-decoration:none;">
                + GESTIÓN DE PERSONAL
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.2); border: 2px solid #22c55e; color: #4ade80; padding: 12px; border-radius: 10px; margin-bottom: 30px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.15); border: 2px solid #ef4444; color: #f87171; padding: 12px; border-radius: 10px; margin-bottom: 30px; text-align: center; font-weight: 800; text-transform:uppercase; font-size:12px; letter-spacing:1px;">
                {{ session('error') }}
            </div>
        @endif

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
                @forelse($usuarios as $u)
                <tr>
                    <td style="color:#aaa;">#{{ $u['id'] }}</td>
                    <td style="text-transform:uppercase;">{{ $u['nombre'] }}</td>
                    <td>{{ $u['email'] }}</td>
                    <td><span class="badge-role">{{ strtoupper($u['role']) }}</span></td>
                    <td style="text-align: right;">
                        <form action="/admins/borrar/{{ $u['id'] }}" method="POST" onsubmit="return confirm('¿Dar de baja definitivamente?')">
                            @csrf
                            <button type="submit" style="background:#111; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-weight:900; font-size:10px; cursor:pointer; text-transform:uppercase;">DAR DE BAJA</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:60px; color:#888;">SIN USUARIOS REGISTRADOS</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
