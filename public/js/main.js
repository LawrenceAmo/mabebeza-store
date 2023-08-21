function cart_qty_display() {
    document.getElementById('cart_qty_display_mobile').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    document.getElementById('cart_qty_display_desktop').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    set_location_display()
}


