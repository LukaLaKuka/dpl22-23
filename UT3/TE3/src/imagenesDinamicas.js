/**
 * Metodo que modifica las imagenes segun los parametros introducidos, 
 * ademas de quitarles la clase hide para que ya no esten ocultas
 * @param {int} tamanio ancho y alto de la imagen
 * @param {int} borderWidth grosor del borde de la imagen
 * @param {String} borderColor color del borde de la imagen
 * @param {int} enfoqueRadio radio de enfoque
 * @param {int} desenfoqueRadio radio de desenfoque
 * @param {int} enfoqueMount cantidad de enfoque
 * @param {int} desenfoqueMount cantidad de desenfoque
 */
function modificarImagenes (tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount) {
    const imagenes = document.body.children['container'].children['main'].children['imagenes'];
    const totalImagenes = imagenes.childElementCount;
    imagenes.classList.remove("hide");
    for (let i=0; i<totalImagenes; i++) {
        imagenes.children[i].src = `img/${imagenes.children[i].name}.jpg?bw=${borderWidth}&bh=${borderWidth}&bc=${borderColor}&dh=${tamanio}&dw=${tamanio}&sharpen=${enfoqueRadio}x${enfoqueMount}&blur=${desenfoqueRadio}x${desenfoqueMount}`;
    }
}

/**
 * Metodo que es llamado al pulsar el boton "generar" del html. Este metodo recoge los datos necesarios del formulario y llama
 * al metodo modificarImagenes() para modificar las imagenes del html
 */
function imagenesDinamicas () {
    let tamanio = parseInt(getValorElemento("size"));
    let borderWidth = parseInt(getValorElemento("width"));
    let borderColor = getValorElemento("color").replace("#","");
    let enfoqueRadio = parseInt(getValorElemento("focus"));
    let desenfoqueRadio = parseInt(getValorElemento("nofocus"));
    let enfoqueMount = parseInt(getValorElemento("focusMount"));
    let desenfoqueMount = parseInt(getValorElemento("nofocusMount"));
    modificarImagenes(tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount);
}

/**
 * Metodo que devuelve el valor del objeto del html con el id deseado
 * @param {String} id del elemento del html deseado
 * @returns String
 */
function getValorElemento(id) {
    return document.getElementById(id).value;
}