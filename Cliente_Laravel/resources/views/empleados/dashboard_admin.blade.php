<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard Admin – MACUIN</title>
    <link rel="stylesheet" href="{{asset('public/resources/css/styles.css')}}">
    </head>
    <body>

    <header>
        <strong class="logo">MACUIN</strong>
        <nav>
        <button class="icono" aria-label="Mi cuenta"></button>
        <button class="icono" aria-label="Carrito"></button>
        <button>Cerrar Sesión</button>
        </nav>
    </header>

    <main>
        <h1>Administración de Refacciones de Alta Precisión</h1>
        

        <form class="filtros">
        <input type="text" placeholder="Nombre"/>
        <select>
            <option>Marca de Carro</option>
            <option>Toyota</option>
            <option>Ford</option>
            <option>Chevrolet</option>
            <option>Nissan</option>
            <option>BMW</option>
        </select>
        <select>
            <option>Tipo de Pieza</option>
            <option>Balatas</option>
            <option>Bujías</option>
            <option>Filtros</option>
            <option>Aceite</option>
        </select>
        <button class="primario" type="submit">Filtrar</button>
        <button class="primario" type="button">Agregar</button>
        </form>

        <ul class="productos">

        <li>
            <span class="agotado">Agotado</span>
            <figure>BALATAS</figure>
            <article>
            <h3>Bujías Delanteras</h3>
            <p>SKU: FR-2145</p>
            <footer>
                <strong>$890</strong>
                <button class="primario">Editar</button>
            </footer>
            </article>
        </li>

        <li>
            <span class="disponible">Disponible</span>
            <figure>BALATAS</figure>
            <article>
            <h3>Bujías Delanteras</h3>
            <p>SKU: FR-2145</p>
            <footer>
                <strong>$890</strong>
                <button class="primario">Editar</button>
            </footer>
            </article>
        </li>

        <li>
            <span class="bajo-stock">Bajo Stock</span>
            <figure>BALATAS</figure>
            <article>
            <h3>Bujías Delanteras</h3>
            <p>SKU: FR-2145</p>
            <footer>
                <strong>$890</strong>
                <button class="primario">Editar</button>
            </footer>
            </article>
        </li>
        
        </ul>
    </main>

</body>
</html>