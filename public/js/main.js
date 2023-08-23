function cart_qty_display() {
    document.getElementById('cart_qty_display_mobile').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    document.getElementById('cart_qty_display_desktop').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    
}

function check_delivery_area() {
    set_location_display()
}
