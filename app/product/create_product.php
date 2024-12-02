<?php

if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__."/../config/Directories.php"); //to handle folder specific path
include(__DIR__ . "/../config/DatabaseConnect.php"); //to access database connection

$db = new DatabaseConnect(); //make a new database instance

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //retrieve user input
    $productName      = htmlspecialchars($_POST["productName"]);
    $productDesc      = htmlspecialchars($_POST["description"]);
    $category         = htmlspecialchars($_POST["category"]);
    $basePrice        = htmlspecialchars($_POST["basePrice"]);
    $numberOfStocks   = htmlspecialchars($_POST["numberOfStocks"]);
    $unitPrice        = htmlspecialchars($_POST["unitPrice"]);
    $totalPrice       = htmlspecialchars($_POST["totalPrice"]);
    
    //validate user input
    if(trim($productName) == "" || empty($productName)) {
        $_SESSION["error"] = "Product Name field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }
    
    if(trim($productDesc) == "" || empty($productDesc)) {
        $_SESSION["error"] = "Product Description field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    if(trim($category) == "Choose a category" || empty($category)) {
        $_SESSION["error"] = "Product Category field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    if(trim($basePrice) == "" || empty($basePrice)) {
        $_SESSION["error"] = "Base Price field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    if(trim($numberOfStocks) == "" || empty($numberOfStocks)) {
        $_SESSION["error"] = "Number of Stocks field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    if(trim($unitPrice) == "" || empty($unitPrice)) {
        $_SESSION["error"] = "Unit Price field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    if(trim($totalPrice) == "" || empty($totalPrice)) {
        $_SESSION["error"] = "Total Price field is empty";

        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }

    if (!isset($_FILES['productImage']) || $_FILES['productImage']['error'] !== 0) {
        $_SESSION["error"] = "No image attached";
        
        header("location: ".BASE_URL."views/admin/products/add.php");
        exit;
    }   

    //insert record to database
    try {
        $conn = $db->connectDB();
        $sql  = "INSERT INTO products (product_name, product_description, category_id, base_price, stocks, 
            unit_price, total_price, created_at, updated_at) values (:p_product_name, 
            :p_product_description, :p_category_id, :p_base_price, :p_stocks, :p_unit_price, 
            :p_total_price, NOW(), NOW())";
        $stmt = $conn->prepare($sql);

        $data = [':p_product_name'        => $productName,
                ':p_product_description' => $productDesc,
                ':p_category_id'         => $category,
                ':p_base_price'          => $basePrice,
                ':p_stocks'              => $numberOfStocks,
                ':p_unit_price'          => $unitPrice,
                ':p_total_price'         => $totalPrice ];
        if(!$stmt->execute($data)){
            $_SESSION["error"] = "Failed to insert record";
            header("location: ".BASE_URL."views/admin/products/index.php");
            exit;
        }

        $lastId = $conn->lastInsertId();

        $error = processImage($lastId);
        if($error){
            $_SESSION["error"] = $error;
            header("location: ".BASE_URL."views/admin/products/add.php");
            exit;
        }

        $_SESSION["success"] = "Product added successfully";
        header("location: ".BASE_URL."views/admin/products/index.php");
        exit;
    } catch (PDOException $e){
        echo "Connection Failed: " . $e->getMessage();
        $db = null;
    }
}

function processImage($id){
    global $db;
    
    error_log("Starting image upload process...");
    
    //retrieve $_FILES
    $path = $_FILES['productImage']['tmp_name'];
    $fileName = $_FILES['productImage']['name'];
    $fileType = mime_content_type($path);
    
    error_log("File details - Name: $fileName, Type: $fileType, Temp path: $path");

    //check if the file type is not an image
    if($fileType != 'image/jpeg' && $fileType != 'image/png'){
        error_log("Invalid file type: $fileType");
        return "File must be a JPG or PNG image";
    }

    //rename image uploaded
    $newFileName = md5(uniqid($fileName, true));
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $hashedName = $newFileName . '.' . $fileExt;
    
    // Set the upload paths - using absolute server path
    $serverRoot = '/home/rdelacruz/ftp/files';  // Your actual server root path
    $uploadDir = $serverRoot . '/public/uploads/products/';
    $webPath = 'public/uploads/products/';  // Path for database storage
    $destination = $uploadDir . $hashedName;
    
    error_log("Upload directory: $uploadDir");
    error_log("Destination path: $destination");

    // Create directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        error_log("Creating directory: $uploadDir");
        if (!mkdir($uploadDir, 0755, true)) {
            error_log("Failed to create directory: $uploadDir");
            return "Failed to create upload directory. Contact server administrator.";
        }
    }

    // Try to move the uploaded file
    if(!move_uploaded_file($path, $destination)) {
        $uploadError = error_get_last();
        error_log("Failed to move uploaded file. PHP Error: " . print_r($uploadError, true));
        error_log("Upload path: " . $path);
        error_log("Destination: " . $destination);
        return "Failed to move uploaded file. Contact server administrator.";
    }

    error_log("File successfully moved to: $destination");

    try {
        // Store the relative URL in the database
        $imageUrl = $webPath . $hashedName;
        error_log("Image URL to save in DB: $imageUrl");
        
        $conn = $db->connectDB();
        $sql = 'UPDATE products SET image_url = :p_image_url WHERE id = :p_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':p_image_url', $imageUrl);
        $stmt->bindParam(':p_id', $id);
        
        if(!$stmt->execute()){
            error_log("Database update failed for image_url");
            @unlink($destination);
            return "Failed to update the image url in database";
        }
        
        error_log("Database updated successfully with image URL");
        return null;
        
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        @unlink($destination);
        return "Database error: " . $e->getMessage();
    }
}
?>