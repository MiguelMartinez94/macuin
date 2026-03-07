<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Agregar Autoparte – MACUIN</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}">
    </head>
    <body>

    <header>
        <strong class="logo">MACUIN</strong>
        <nav>
        <button class="icono" ="Mi cuenta"></button>
        <button class="icono" ="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <section>
        <article>

        <header>
            <h2>Agregar Autoparte</h2>
        </header>

        <div>
            <div>

            <figure class="zona-foto" title="Haz clic para subir imagen de la autoparte">
                <span>+</span>
                <img  alt="Vista previa"/>
                <input type="file" style="display:none"/>
            </figure>

            <div>
                <div>
                <label>Nombre</label>
                <input type="text" value="Balatas" />
                </div>
                <div>
                <label>SKU</label>
                <input type="text" value="SKU: FR-2145"/>
                </div>
            </div>

            </div>

            <div>
            <div>
                <label >Estado</label>
                <select>
                <option>Bajo Stock</option>
                <option>Disponible</option>
                <option>Agotado</option>
                </select>
            </div>
            <div>
                <label>Precio</label>
                <input type="number"/>
            </div>
            </div>
        </div>

        <footer>
            <button class="secundario">Cancelar</button>
            <button class="primario">Guardar Autoparte</button>
        </footer>

        </article>
    </section>

</body>
</html>