// Para obtener el JSON, se utiliza un API llamada XMLHttpRequest
// ----------------------------------------------------------------------------------------

/**
 * Se obtienen las Categorías a partir de un archivo de texto de formato JSON
 */
function obtenerCategorias() {
    // Se crea una solicitud XMLHttpRequest (abreviada XHR)
    var solicitud = new XMLHttpRequest();
    
    // Se abre una nueva solicitud
    // 1er parámetro: GET, el método HTTP a usar cuando se hace la solicitud en la red
    // 2do parámetro: la URL a la que se realiza la solicitud
    solicitud.open('GET', './obtener_categorias.php');
    // Se define el tipo de respuesta 'responseType' en JSON
    // de esta forma esa solicitud XHR sabe que el servidor estará retornando un JSON, 
    // y que esto debería ser convertido en segundo plano en un objeto JavaScript
    solicitud.responseType = 'json';
    // Se envía la solicitud
    solicitud.send();
    // Al completarse la solicitud
    solicitud.onload = function() {
        //console.log(solicitud.response);
        // Se muestra la respuesta
        mostrarCategorias(solicitud.response);
    }
}

/**
 * Se muestran las categorias del objeto_json
 * @param {json} objeto_json 
 */
function mostrarCategorias(objeto_json) {
    //console.log(objeto_json);

    // Se toman las categorias del objeto json
    var categorias = objeto_json;
    // Se asigna la referencia al menú de categorias
    var lista_categorias = document.getElementById('menu_categorias');

    // Para cada categoria
    for (var i = 0; i < categorias.length; i++) {
        // Se crea un ítem de la lista
        var item_categoria = document.createElement('li');
        // Se crea el enlace del item
        var enlace_categoria = document.createElement('a');
        
        // Se define el texto del enlace (el nombre de la Categoria)
        enlace_categoria.textContent = categorias[i].c_nombre;
        
        // Se define la ruta del enlace
        // Más adelante vamos a reemplazar el # por el uso de: 
        // 'lista_productos.php?id_categoria='+categorias[i].c_id;
        // para obtener sólo los productos de la categoría respectiva
        enlace_categoria.href = '#';
        
        // Se agrega el enlace al ítem respectivo
        item_categoria.appendChild(enlace_categoria);
        
        // Se agrega el ítem a la lista del menú
        lista_categorias.appendChild(item_categoria);
    }
}