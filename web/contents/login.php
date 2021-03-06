<?php
require_once $INCLUDES_PATH . '/login_verification.php';

if (!isset($_SESSION['user_id'])) :
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <h3>Welcome to our Customer Ticket System</h3>
        <p>Please login below or <a href="index.php?content=registration">signup.</a></p>
        <?php
			require_once $CONTENTS_PATH . '/login_input_error.php';
		?>
        <hr>
        <form class="form-horizontal" action="" method="POST"
            onsubmit="">
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control"
                        id="inputEmail" name="inputEmail"
                        placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword"
                    class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control"
                        id="inputPassword" name="inputPassword"
                        placeholder="Password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign
                        in</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
else :
header("refresh:3;url=index.php");
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <p>
            <strong>You are now logged in</strong>, and will be
            redirected. If not, return to the <a href="index.php">main page</a>
        </p>
    </div>
</div>
<?php endif;?>
