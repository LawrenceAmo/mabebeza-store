function cart_qty_display() {
    let qty = JSON.parse(localStorage.getItem('cart')).length
    document.getElementById('cart_qty_display').innerHTML = qty;
}