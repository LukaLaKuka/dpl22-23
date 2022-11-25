function modificarImagenes (tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount) {
    const imagenes = document.body.children['container'].children['main'].children['imagenes'];
    const totalImagenes = imagenes.childElementCount;
    for (let i=0; i<totalImagenes; i++) {
        imagenes.children[i].classList.remove("hide");
        imagenes.children[i].src = `./img/${imagenes.children[i].name}.jpg?bw=${borderWidth}&bc=${borderColor}&dh=${tamanio}&dw=${tamanio}&sharpen=${enfoqueRadio}x${enfoqueMount}&blur=${desenfoqueRadio}x${desenfoqueMount}`;
    }
}

function imagenesDinamicas () {
    let tamanio = getValorElemento("size");
    let borderWidth = getValorElemento("width");
    let borderColor = getValorElemento("color");
    let enfoqueRadio = getValorElemento("focus");
    let desenfoqueRadio = getValorElemento("nofocus");
    let enfoqueMount = getValorElemento("focusMount");
    let desenfoqueMount = getValorElemento("nofocusMount");
    modificarImagenes(tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount);
}

function getValorElemento(elemento) {
    return document.getElementById(elemento).value;
}