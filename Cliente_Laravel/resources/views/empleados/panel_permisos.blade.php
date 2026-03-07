<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MACUIN – Panel de Permisos</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}" />
    </head>
    <body style="min-height:100vh; display:flex; flex-direction:column;">

    <header>
        <div class="logo">MACUIN</div>
        <nav>
        <button class="icono" title="Perfil"></button>
        <button class="icono" title="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        
            <h1>Panel de Permisos</h1>
        

        <div>

            <p>Usuario</p>

            <table>
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>luis eduardo santano delgado</td>
                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="2a465f43594f4e5f4b584e45594b445e4b44456a4d474b434604494547">[email&#160;protected]</a></td>
                </tr>
            </tbody>
            </table>

            <div>
            <label>Estado</label>
            <select>
                <option value="admin" selected>Admin</option>
                <option value="usuario">Usuario</option>
                <option value="editor">Editor</option>
            </select>
            </div>

            <div class="separador"></div>

            <div class="botones-final">
            <button class="secundario">Cancelar</button>
            <button clas