<?php
    include('../index.php');
?>
<div class="signup-form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h2>Register</h2>
        <p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
                <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
            </div>        	
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
    <div class="text-center">Already have an account? <p><a href="./login.php">Sign in</a></p></div>
</div>

<?php
    include('../includes/footer.php');
?>