<?php
?>


<div class="row">
    <div class="col-xs-4 col-xs-offset-4">
        <p>
        <h3>Welcome to our Customer Ticket System</h3>
        </p>
        <p>Please login below or signup.</p>
        <hr>
        <form class="form-horizontal"
            action="./includes/user_verification.php" method="post"
            onsubmit="">
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control"
                        id="inputEmail" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword"
                    class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control"
                        id="inputPassword" placeholder="Password"
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
        <p>
        <h4>Forgot your password ?</h4>
       </p>
    </div>
</div>