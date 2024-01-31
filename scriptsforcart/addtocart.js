document.addEventListener('DOMContentLoaded', function () {
    var addToCartBtn = document.querySelector('.btn');
    addToCartBtn.addEventListener('click', addToCart);

    function addToCart() {
        var productName = document.querySelector('h1').innerText;
        var quantity = parseInt(document.querySelector('input[type="number"]').value);
        var itemPrice = parseFloat(document.querySelector('h4').innerText.replace('₱', ''));

        // Use localStorage to store the cart items
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the product already exists in the cart
        var existingProduct = cart.find(item => item.name === productName);

        if (existingProduct) {
            // If the product exists, update the quantity
            existingProduct.quantity += quantity;
        } else {
            // If the product doesn't exist, create a new item
            var item = {
                name: productName,
                quantity: quantity,
                price: itemPrice
            };
            cart.push(item);
        }

        // Update the cart in localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Redirect to the cart page
        window.location.href = 'cart.html';
    }
});
