<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/config/directories.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Home</a>
                </li>
                <?php if(!isset($_SESSION["username"])){?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>registration.php">Register</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION["username"]) && (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == "1")) { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>views/admin/products/index.php">Products</a>
                </li> 
                <?php } ?>


                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>cart.php">Cart</a>
                </li>
                
                <!-- Dropdown for Signed-in User -->
                <?php if(isset($_SESSION["fullname"])){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["fullname"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Reset any overflow settings that might affect the body */
    html, body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    /* Navbar styling */
    .navbar-nav .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #007bff;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        transform: scaleX(1);
    }

    /* Remove default dropdown arrow */
    .navbar-nav .dropdown-toggle::after {
        display: none;
    }

    /* Dropdown menu styling */
    .dropdown-menu {
        min-width: 200px;
        padding: 0.5rem 0;
        margin: 0;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: 0.25rem;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
        right: 0; /* Align dropdown to the right */
        left: auto;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        clear: both;
        white-space: nowrap;
        border: 0;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    /* Show dropdown on hover for desktop */
    @media (min-width: 992px) {
        .dropdown:hover .dropdown-menu {
            display: block;
            transform: translate3d(0, 0, 0) !important;
            top: 100% !important;
        }
    }

    /* Ensure dropdown is always visible when open */
    .dropdown-menu.show {
        display: block;
        opacity: 1;
        visibility: visible;
        transform: translate3d(0, 0, 0) !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    if (dropdownToggle && dropdownMenu) {
        // For desktop
        if (window.innerWidth >= 992) {
            dropdownToggle.addEventListener('mouseenter', function() {
                dropdownMenu.classList.add('show');
            });

            dropdownToggle.parentNode.addEventListener('mouseleave', function() {
                dropdownMenu.classList.remove('show');
            });
        }

        // For mobile/tablet
        dropdownToggle.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                dropdownMenu.classList.toggle('show');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>