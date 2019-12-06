<div class="register-form">
    <div class="wrapper">
        <h2>Sign Up</h2>
        
        <p>Please fill this form to create an account.</p>
      
        <form action="/HR/register" method="post">
          
            <div class="form-group">
                <label>Username</label>
                <input type="text" id ="login" autocomplete="off" name="username" class="form-control" value="<?php /*echo $username; */?>" required>
                <span class="help-block-login"><?php echo $this->username_err; ?></span>
            </div>    

            <div class="form-group">
                <label>Password</label>
                <input type="password" autocomplete="off" name="password" class="form-control" value="<?php /*echo $password;*/ ?>" required>
                <span class="help-block"><?php echo $this->password_err; ?></span>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" autocomplete="off" name="password-confirm" class="form-control" value="<?php /*echo $confirm_password; */?>" required>
                <span class="help-block"><?php echo $this->confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p>Already have an account? <a href="/HR/login">Login here</a>.</p>

        </form>
    </div>   
    </div> 
    <script src="js/register.js"></script>