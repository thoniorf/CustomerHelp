<?php
require_once $INCLUDES_PATH . '/addticket.php';
if(empty($addticket_status)):
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h3>Create a new ticket</h3>
        <p>Please fill in the required information to create a new ticket.</p>
        <?php
            require_once $CONTENTS_PATH . '/addticket_error.php';
        ?>
        <hr>
        <form class="form-horizontal" action="" method="POST" onsubmit="">
            <div class="form-group">
                <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"
                        id="inputSubject" name="inputSubject"
                        placeholder="Ticket subject" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCategory" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputCategory" name="inputCategory" required>
                    <?php 
                    	foreach ($categories as $key => $category) 
                    	{
    						print "<option value=\"" .$key. "\">".$category."</option>";
                   		}
					?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputProduct" class="col-sm-2 control-label">Product</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputProduct" name="inputProduct" required>
                    <?php 
                    	foreach ($products as $key => $product) 
                    	{
    						print "<option value=\"" .$key. "\">".$product."</option>";
                   		}
					?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputDescription" name="inputDescription" rows="20" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
else:
header("refresh:3;url=index.php");
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <p>
            <strong>Your ticket has been sent</strong>, and you will be
            redirected. If not, return to the <a href="index.php">main page</a>
        </p>
    </div>
</div>
<?php endif;?>