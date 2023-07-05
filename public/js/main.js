function cart_qty_display() {
    let qty = JSON.parse(localStorage.getItem('cart')).length
    document.getElementById('cart_qty_display').innerHTML = qty;
}
function wish_list_qty_display() {
    let qty = JSON.parse(localStorage.getItem('wish_list')).length
    document.getElementById('wish_list_qty_display').innerHTML = qty;
}

