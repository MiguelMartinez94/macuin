<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MACUIN – Panel de Compras</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}" />
    </head>
    <body>

    <header>
        <a class="logo" href="#"><strong>Macuin</strong></a>
        <nav>
        <button class="icono" title="Perfil"></button>
        <button class="icono" title="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        <header>
            <h1>Panel de Compras</h1>
        </header>

        <nav class="pestañas">
            <button class="activo">Todos</button>
            <button>Recibido</button>
            <button>En Proceso</button>
            <button>Enviado</button>
            <button>Cancelado</button>
        </nav>

        <div>
            <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Artículos</th>
                <th>Estatus</th>
                <th>Total</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>1</td>
                <td>19/01/26</td>
                <td>1 X Disco de freno (SKU: FR-2145). 1 X B-</td>
                <td>Recibido</td>
                <td>$890</td>
                <td>
                    <button class="editar" title="Editar">&#9998;</button>
                </td>
                </tr>
                <tr>
                <td>2</td>
                <td>19/01/26</td>
                <td>1 X Disco de freno (SKU: FR-2145)</td>
                <td>Enviado</td>
                <td>$890</td>
                <td>
                    <button class="editar" title="Editar">&#9998;</button>
                </td>
                </tr>
                <tr>
                <td>3</td>
                <td>19/01/26</td>
                <td>1 X Disco de freno (SKU: FR-2145)</td>
                <td>Surtido</td>
                <td>$890</td>
                <td>
                    <button class="editar" title="Editar">&#9998;</button>
                </td>
                </tr>
            </tbody>
            </table>
        </div>

        <div class="paginacion">
            <button><</button>
            <button>></button>
        </div>
        </article>
    </section>

</body>
</html>