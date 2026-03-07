<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>MACUIN - Generar Reportes</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}" />
    </head>
    <body style="min-height:100vh; display:flex; flex-direction:column;">

    <header>
        <div class="logo">MACUIN</div>
        <nav>
        <button class="icono"></button>
        <button class="icono"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        <div>
            <h2>Generar Reportes</h2>
        </div>

        <div>

            <label>Selecciona el tipo de reporte:</label>

            <div class="tipos-reporte">
            <button class="activo">
                Pedidos
            </button>
            <button>
                Usuarios
            </button>
            <button>
                Ventas
            </button>
            </div>

            <Label>Periodo de Tiempo:</Label>

            <div>
                <label>Desde:</label>
                <input type="date">
            </div>
            <div>
                <label>Hasta:</label>
                <input type="date">
            </div>
            </div>

        </div>

        <footer>
            <button class="secundario">Cancelar</button>
            <button class="primario">Generar Reporte</button>
        </footer>

        </article>
    </section>

</body>
</html>