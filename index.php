<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Categor&iacute;as desde PHP con Ajax</title>
        <!-- Funciones JS para utilizar Ajax -->
        <script src="js/funciones.js"></script>
        <!-- CSS del ejercicio -->
        <link rel="stylesheet" href="css/estilos_menu.css">
    </head>
    <body>
        <aside>
            <!-- Aquí se insertará el menú con JS -->
            <ul id="menu_categorias"></ul>
        </aside>
        <section></section>

        <script>
            // Se obtienen y muestran las Categorías en el menú lateral "menu_categorias"
            obtenerCategorias();
        </script>
    </body>
</html>