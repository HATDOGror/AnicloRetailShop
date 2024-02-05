var selectedColor = ''; // Variable to store the selected color

function selectColor(color) {
    selectedColor = color;
}

function addToCart() {
    var productName = "Japanese Horror Comic Printed"; // You can customize this
    var quantity = parseInt(document.getElementById('quantityInput').value);
    var itemPrice = parseFloat(document.querySelector('h4').innerText.replace('₱', ''));

    if (selectedColor) {
        // Use localStorage to get the current cart items
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the product with the selected color already exists in the cart
        var existingProduct = cart.find(item => item.name === productName + ' - ' + selectedColor);

        if (existingProduct) {
            // If the product exists, update the quantity
            existingProduct.quantity += quantity;
        } else {
            // If the product doesn't exist, create a new item
            var item = {
                name: productName + ' - ' + selectedColor,
                quantity: quantity,
                price: itemPrice
            };
            cart.push(item);
        }

        // Update the cart in localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Redirect to the cart page
        window.location.href = 'cart.html';
    } else {
        alert('Please select a color before adding to cart.');
    }
}
