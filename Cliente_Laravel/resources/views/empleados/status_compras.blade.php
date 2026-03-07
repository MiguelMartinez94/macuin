<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MACUIN – Estatus de Compras</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}" />
    </head>
    <body style="min-height:100vh; display:flex; flex-direction:column;">

    <header>
        <a class="logo" href="#">MACUIN</a>
        <nav>
        <button class="icono" title="Perfil"></button>
        <button class="icono" title="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        
            <h1>Estatus de Compras</h1>
        

        <div>

            <div>
            <p>Pedido ID</p>
            <p>#i23046</p>
            </div>

            <ul>
            <li>
                <figure></figure>
                <div>
                <strong>Disco de freno (X2)</strong>
                <p>SKU: FR-2145</p>
                </div>
                <span>$1780</span>
            </li>
            <li>
                <figure></figure>
                <div>
                <strong>Disco de freno (X1)</strong>
                <p>SKU: FR-2135</p>
                </div>
                <span>$891</span>
            </li>
            </ul>

            <div>
            <label>Estado</label>
            <select>
                <option value="cancelado" selected>Cancelado</option>
                <option value="recibido">Recibido</option>
                <option value="en-proceso">En Proceso</option>
                <option value="enviado">Enviado</option>
                <option value="surtido">Surtido</option>
            </select>
            </div>


            <div>
            <button class="secundario">Cancelar</button>
            <button class="primario">Guardar Cambios</button>
            </div>

        </div>
        </article>
    </section>

</body>
</html>