function updateSelectedSize() {
    var sizeSelect = document.getElementById('sizeSelect');
    var selectedSize = sizeSelect.options[sizeSelect.selectedIndex].text;
    // You can perform additional actions based on the selected size if needed
}

function addToCart() {
    var productName = "Anime Face Print Aesthetic Loose Blue Jeans"; // Customize this as needed
    var sizeSelect = document.getElementById('sizeSelect');
    var selectedSize = sizeSelect.options[sizeSelect.selectedIndex].text;

    var quantity = parseInt(document.getElementById('quantityInput').value);
    var itemPrice = parseFloat(document.querySelector('h4').innerText.replace('₱', ''));

    if (selectedSize !== "Select Size") {
        // Use localStorage to get the current cart items
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the product with the selected size already exists in the cart
        var existingProduct = cart.find(item => item.name === productName && item.size === selectedSize);

        if (existingProduct) {
            // If the product exists, update the quantity
            existingProduct.quantity += quantity;
        } else {
            // If the product doesn't exist, create a new item
            var item = {
                name: productName,
                size: selectedSize,
                quantity: quantity,
                price: itemPrice
            };
            cart.push(item);
        }

        // Update the cart in localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Display the updated cart summary on the current page
        var cartSummaryElement = document.getElementById('cartSummary');
        cartSummaryElement.innerHTML = `<p>Product: ${productName} - Size: ${selectedSize}, Quantity: ${quantity}</p>`;
    } else {
        alert('Please select a size before adding to cart.');
    }
}