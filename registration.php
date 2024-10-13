<?php require_once "includes/header.php"; ?>

<!-- Navbar -->
<?php require_once "includes/navbar.php"; ?>

<!-- Registration Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Create Your Account</h4>
                </div>
                <div class="card-body">
                    <form action="authregister.php" method="POST" onsubmit="return validatePassword()">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                        </div>
                        <!-- Error Message Display -->
                        <div id="error-message" class="text-danger border border-danger p-2 mb-3" style="display: none;">
                            Passwords do not match. Please try again.
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <p>Already have an account? <a href="login.html" class="text-primary">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validatePassword() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const errorMessage = document.getElementById("error-message");

        if (password !== confirmPassword) {
            errorMessage.style.display = "block";
            return false; // Prevent form submission
        } else {
            errorMessage.style.display = "none";
            return true; // Allow form submission if passwords match
        }
    }
</script>

<?php require_once "includes/footer.php"; ?>
