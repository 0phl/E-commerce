<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MyShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>

                <!-- Dropdown for Signed-in User -->
                <!-- if naka set yung $_SESSION["fullname"], dun lang lalabas yung name ng user-->
                <?php if(isset($_SESSION["fullname"])){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION["fullname"]; ?> <!-- Replace with dynamic username -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
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
        background-color: #007bff; /* You can change this color to match your design */
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after {
        transform: scaleX(1);
    }

    /* Ensure the underline doesn't appear for the dropdown toggle */
    .navbar-nav .dropdown-toggle::after {
        display: none;
    }

    /* Show dropdown on hover */
    @media (min-width: 992px) {
        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    if (dropdownToggle && dropdownMenu) {
        var showDropdown = function() {
            dropdownMenu.style.display = 'block';
        };

        var hideDropdown = function() {
            dropdownMenu.style.display = '';
        };

        dropdownToggle.addEventListener('mouseenter', showDropdown);
        dropdownToggle.addEventListener('focusin', showDropdown);
        dropdownToggle.parentNode.addEventListener('mouseleave', hideDropdown);
        dropdownToggle.addEventListener('focusout', function(e) {
            if (!dropdownMenu.contains(e.relatedTarget)) {
                hideDropdown();
            }
        });

        // For touch devices
        dropdownToggle.addEventListener('click', function(e) {
            if (window.innerWidth > 991) {
                e.preventDefault();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            }
        });
    }
});
</script>