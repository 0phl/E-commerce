<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION)){
    session_start();
}

// Log the start of the script
error_log("Add to cart process started");

require_once(__DIR__."/../config/Directories.php"); //to handle folder specific path
include(__DIR__."/../config/DatabaseConnect.php"); //to access database connection

//force the user to login if not currently logged in
if(!isset($_SESSION["user_id"])){
    $_SESSION["error"] = "Please login to add to cart";
    error_log("User not logged in");
    header("location: ".BASE_URL."login.php");
    exit;
}

$db = new DatabaseConnect(); //make a new database instance

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //retrieve user input
    $productId = isset($_POST["id"]) ? htmlspecialchars($_POST["id"]) : '';
    $quantity = isset($_POST["quantity"]) ? htmlspecialchars($_POST["quantity"]) : '';
    $userId = $_SESSION["user_id"];

    // Log the received data
    error_log("Received data - Product ID: " . $productId . ", Quantity: " . $quantity . ", User ID: " . $userId);

    //validate user input
    if(trim($productId) == "" || empty($productId)) {
        $_SESSION["error"] = "Product ID field is empty";
        error_log("Empty product ID");

        header("location: ".BASE_URL."views/product/product.php?id=".$productId);
        exit;
    }
    
    if(trim($quantity) == "" || empty($quantity) || $quantity < 1) {
        $_SESSION["error"] = "Quantity field is empty or invalid";
        error_log("Invalid quantity");

        header("location: ".BASE_URL."views/product/product.php?id=".$productId);
        exit;
    }

    if(trim($userId) == "" || empty($userId)) {
        $_SESSION["error"] = "User ID field is empty";
        error_log("Empty user ID");

        header("location: ".BASE_URL."views/product/product.php?id=".$productId);
        exit;
    }
    //validation end  

    //insert record to database
    try {
        $conn = $db->connectDB();
        $sql = "SELECT * FROM products WHERE products.id = :p_product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":p_product_id", $productId);
        if ($stmt->execute()) {
            
        }
        $product = $stmt->fetch(); //return only 1 record


            $computedPrice = $product["unit_price"] * $quantity;
            $sql = "INSERT INTO carts SET 
            user_id = :p_user_id, 
            product_id = :p_product_id, 
            quantity = :p_quantity, 
            unit_price = :p_unit_price, 
            total_price = :p_total_price, 
            created_at = Now(), 
            updated_at = Now()";

        $stmt = $conn->prepare($sql);

        $data = [':p_user_id'        => $userId,
            ':p_product_id'          => $productId,
            ':p_quantity'            => $quantity,
            ':p_unit_price'          => $product["unit_price"],
            ':p_total_price'         => $computedPrice ];

        if (!$stmt->execute($data)){
            $_SESSION["error"] = "Failed to add to cart";
            error_log("Failed to add to cart");
            header("location: ".BASE_URL."views/product/product.php?id=".$productId);
            exit;
        }

        


        $_SESSION["success"] = "Added to cart successfully!";
        error_log("Added to cart successfully");
        header("location: ".BASE_URL."views/product/product.php?id=".$productId);
        exit;

    } catch (PDOException $e){
        echo "Connection Failed: " . $e->getMessage();
        error_log("Connection Failed: " . $e->getMessage());
        $db = null;
    }
}
?>
