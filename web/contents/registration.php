<?php
require_once $INCLUDES_PATH . '/adduser.php';

if(!empty($registration_completed)){
	header("refresh:0;url=index.php");
}

if (!isset($_SESSION['user_id'])) :
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <h3>Register a new user</h3>
        <p>Please fill in the required information to create a new user.</p>
        <?php
			require_once $CONTENTS_PATH . '/registration_input_error.php';
		?>
        <hr>
        <form class="form-horizontal" action="" method="POST"
            onsubmit="">
            <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">Your email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control"
                        id="inputEmail" name="inputEmail"
                        placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword"
                    class="col-sm-3 control-label">Your password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control"
                        id="inputPassword" name="inputPassword"
                        placeholder="Password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign
                        up</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
else :
header("refresh:5;url=index.php");
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <p>
            <strong>You are already logged-in</strong>, and will be
            redirected. If not, return to the <a href="#">main page</a>
        </p>
    </div>
</div>
<?php endif;?>
