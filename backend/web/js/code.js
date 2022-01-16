if(document.querySelector(`.nav-sidebar li a[href^='${location.pathname.split('/'[1])}']`)) {
    document.querySelector(`.nav-sidebar li a[href^='${location.pathname.split('/'[1])}']`).className = 'nav-link active';
}