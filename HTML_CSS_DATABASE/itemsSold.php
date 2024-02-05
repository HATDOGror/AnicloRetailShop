<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "aniclo"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$check_stmt = $conn->prepare("SELECT id, quantity, price FROM cart_items WHERE name = ? AND size = ?");
$check_stmt->bind_param("ss", $name, $size);
$update_stmt = $conn->prepare("UPDATE cart_items SET quantity = ?, price = ? WHERE id = ?");
$insert_stmt = $conn->prepare("INSERT INTO cart_items (name, size, quantity, price) VALUES (?, ?, ?, ?)");

foreach ($data as $item) {
    $name = $item['name'];
    $size = isset($item['size']) ? $item['size'] : null;
    $quantity = $item['quantity'];
    $price = $item['price'] * $item['quantity']; 
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $check_stmt->bind_result($existing_id, $existing_quantity, $existing_price);
        $check_stmt->fetch();
		
        $new_quantity = $existing_quantity + $quantity;
        $new_price = $existing_price + $price; 
		
        $update_stmt->bind_param("idi", $new_quantity, $new_price, $existing_id);
        $update_stmt->execute();
    } else {
        $insert_stmt->bind_param("ssdd", $name, $size, $quantity, $price);
        $insert_stmt->execute();
    }
}

echo "CART YPDATED";

$check_stmt->close();
$update_stmt->close();
$insert_stmt->close();
$conn->close();
?>
