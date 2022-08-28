<?php
    include('../index.php');
?>
<div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input name="email" type="text" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input name="remember_me" type="checkbox"> Remember me</label>
        </div>        
    </form>
    <p class="text-center"><a href="./registration.php">Create an Account</a></p>
</div>
<?php
    include('../includes/footer.php');
?>