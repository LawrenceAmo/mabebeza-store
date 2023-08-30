function cart_qty_display() {
    document.getElementById('cart_qty_display_mobile').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    document.getElementById('cart_qty_display_desktop').innerHTML = JSON.parse(localStorage.getItem('cart')).length
    
}
function check_delivery_area() {
    set_location_display()
}
// $(document).ready(function() {
//     $(".product-image-container").mouseenter(function(e) {
//         var parentOffset = $(this).offset();
//         var cursorX = e.pageX - parentOffset.left;
//         var cursorY = e.pageY - parentOffset.top;

//         var img = $(this).find("img");
//         var imgWidth = img.width();
//         var imgHeight = img.height();

//         var zoomFactor = 1.5; // Adjust the zoom factor as needed
//         console.log("amo amo")

//         img.css({
//             transformOrigin: cursorX + "px " + cursorY + "px",
//             transform: "scale(" + zoomFactor + ")",
//             transition: "transform 0.3s ease"
//         });
//     });

//     $(".product-image-container").mousemove(function(e) {
//         var parentOffset = $(this).offset();
//         var cursorX = e.pageX - parentOffset.left;
//         var cursorY = e.pageY - parentOffset.top;

//         var img = $(this).find("img");

//         img.css({
//             transformOrigin: cursorX + "px " + cursorY + "px",
//         });
//     });

//     $(".product-image-container").mouseleave(function() {
//         var img = $(this).find("img");
//         img.css({
//             transform: "scale(1)",
//             transition: "transform 0.3s ease"
//         });
//     });
// });
