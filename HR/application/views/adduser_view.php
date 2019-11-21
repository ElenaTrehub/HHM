<div class="register-form">
    <div class="wrapper">
        <h2>Add User</h2>
        
        <p>Füllen Sie das Formular aus, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen.</p>
      
        <form action="/HR/adduser" method="post">
          
            <div class="form-group <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
                <label>User e-mail</label>
                <input type="hidden" name="action" value="submit" />
                <input type="text" name="useremail" autocomplete="off" class="form-control" required>
                <span class="answer-block"><?php echo $this->useremail_answer;?></span>
                <span class="help-block"><?php echo $this->useremail_err;?></span>
            </div>    

            <div class="form-group <?php echo (!empty($role_err)) ? 'has-error' : ''; ?>">
                <label>Role</label>
                <input list="Roles" autocomplete="off" type="text" name="role" class="form-control" value="<?php /*echo $password;*/ ?>" required>
                <datalist id="Roles">
                    <?php if(isset($this->roles[0])){
                        foreach($this->roles as $role){
                            print '<option>' . $role->RoleTitle . '</option>';
                        }
                    } ?>
                </datalist>
                <span class="answer-block"><?php echo $this->role_answer;?></span>
                <span class="help-block"><?php echo $this->role_err;?></span>   
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

        </form>
    </div>