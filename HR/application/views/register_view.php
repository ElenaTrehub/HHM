<div class="register-form">
    <div class="wrapper">
        <h2>Sign Up</h2>
        
        <p>Please fill this form to create an account.</p>
      
        <form action="/HR/register" method="post">
          
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php /*echo $username; */?>">
                <span class="help-block"><?php /*echo $username_err; */?></span>
            </div>    

            <div class="form-group <?php /*echo (!empty($password_err)) ? 'has-error' : ''; */?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php /*echo $password;*/ ?>">
                <span class="help-block"><?php /*echo $password_err; */?></span>
            </div>

            <div class="form-group <?php /*echo (!empty($confirm_password_err)) ? 'has-error' : ''; */?>">
                <label>Confirm Password</label>
                <input type="password" name="password-confirm" class="form-control" value="<?php /*echo $confirm_password; */?>">
                <span class="help-block"><?php /*echo $confirm_password_err; */?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p>Already have an account? <a href="/HR/login">Login here</a>.</p>

        </form>
    </div>    