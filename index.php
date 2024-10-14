<?php 
session_start();
require_once("includes/header.php")
?>

<!-- Navbar -->
<?php require_once("includes/navbar.php")?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        line-height: 1.6;
        color: #333;
    }
    .hero-section {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        padding: 4rem 0;
        text-align: center;
        color: white;
    }
    .hero-section h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    .hero-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }
    .btn-hero {
        background-color: white;
        color: #6a11cb;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-hero:hover {
        background-color: #f0f0f0;
        transform: translateY(-3px);
    }
    .category-section, .products-section {
        padding: 4rem 0;
    }
    .section-title {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 3rem;
        color: #2c3e50;
    }
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin: 1rem 0;
    }
    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }
    .btn-primary:hover {
        background-color: #2980b9;
    }
    .btn-success {
        background-color: #2ecc71;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }
    .btn-success:hover {
        background-color: #27ae60;
    }
</style>



<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <h1>Welcome to MyShop!</h1>
        <p>Your one-stop destination for amazing deals</p>
        <a href="#products" class="btn-hero">Shop Now</a>
    </div>
</div>

<!-- Product Categories -->
<div class="category-section">
    <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Electronics</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Fashion</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Category 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Home & Kitchen</h5>
                        <a href="#" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<div class="products-section" id="products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/250x250" class="card-img-top" alt="Product 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$49.99</p>
                        <a href="#" class="btn btn-success">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/250x250" class="card-img-top" alt="Product 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$79.99</p>
                        <a href="#" class="btn btn-success">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/250x250" class="card-img-top" alt="Product 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$29.99</p>
                        <a href="#" class="btn btn-success">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/250x250" class="card-img-top" alt="Product 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">$99.99</p>
                        <a href="#" class="btn btn-success">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<?php require_once("includes/footer.php")?>
</body>
</html>