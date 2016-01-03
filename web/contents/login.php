<?php
function login_verification(){
	if (isset ( $_POST ['inputEmail'] ) && isset ( $_POST ['inputEmail'] )) {
		$error_page = '';
		// Create new connection
		$conn = new mysqli ( $host, $user, $pswd );
	
		// Check connection
		if ($conn->connect_error) {
			die ( "Connection failed: " . $conn->connect_error );
		}
		// Filter fieds
		$email = filter_var ( $_POST ['inputEmail'], FILTER_SANITIZE_STRING );
		$paswd = filter_var ( $_POST ['inputPassword'], FILTER_SANITIZE_STRING );
		// Encrypt passwd
		$paswd = password_hash ( $paswd, PASSWORD_BCRYPT );
		// Prepare the statemnt
		$stmt = $conn->prepare ( "SELECT idUser FROM ticketsys_db.User WHERE Email=? AND Passwd=?;" );
		if (! $stmt) {
			$conn->error;
		}
		// Bind vars
		$stmt->bind_param ( "ss", $email, $paswd );
		// Execute, get results and fetch
		$stmt->execute ();
		if ($stmt->bind_result ( $Bind_idUser )) {
			$stmt->fetch ();
			if (isset ( $Bind_idUser )) {
				$_SESSION ['user_id'] = $Bind_idUser;
			} else {
				$error_page = '/login_input_error.php';
			}
		}
	}
}
function login_error()
{
	if($error_page != "")
	{
		require_once $CONTENTS_PATH . $error_page;
	}
}
login_verification();
if(!isset($_SESSION['user_id'])):
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <h3>Welcome to our Customer Ticket System</h3>
        <p>Please login below or signup.</p>
        <?php login_error();?>
        <hr>
        <form class="form-horizontal"
            action="#" method="POST"
            onsubmit="">
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control"
                        id="inputEmail" name="inputEmail" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword"
                    class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control"
                        id="inputPassword" name="inputPassword" placeholder="Password"
                        required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign
                        in</button>
                </div>
            </div>
        </form>
        <hr>
        <h4>Forgot your password ?</h4>
    </div>
</div>
<?php
else:
header( "refresh:5;url=login.php" );
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <p class="lead">You are now logged in, and will be redirected. If not, return to the <a href="../index.html">main page</a></p>
    </div>
</div>
<?php endif;?>