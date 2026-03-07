<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Panel Administrador – MACUIN</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}">
</head>
<body>

    <header>
        <strong class="logo">🕯 MACUIN</strong>
        <nav>
        <button class="icono" aria-label="Mi cuenta"></button>
        <button class="icono" aria-label="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        <header>
            <h1>Panel de Administrador</h1>
        </header>

        <div>
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
            <h2>Usuarios</h2>
            <button class="primario">Reportes</button>
            </div>

            <table>
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>luis eduardo santano delgado</td>
                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="670b120e14020312061503081406091306090827000a060e0b4904080a">[email&#160;protected]</a></td>
                <td>
                    <div>
                    <button class="editar" >&#9998;</button>
                    <button class="eliminar">&#128465;</button>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>

            <div class="paginacion">
                <button><</button