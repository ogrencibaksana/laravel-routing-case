require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window._deleteItem = (form, route) => {
    const element = typeof form === "string"
        ? document.getElementById(form)
        : form;
    element.setAttribute('action', route);
    element.submit();
    return false;
}
