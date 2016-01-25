<?php
require_once $INCLUDES_PATH . '/modifyticket.php';
if(empty($editticket_status)):
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h3>Modify the ticket</h3>
        <p>Edit the information you want and send the form to save them.</p>
        <?php
            require_once $CONTENTS_PATH . '/modifyticket_error.php';
        ?>
        <hr>
        <form class="form-horizontal" action="" method="POST" onsubmit="">
            <div class="form-group">
                <label for="inputSubject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"
                        id="inputSubject" name="inputSubject"
                        placeholder="Ticket subject" value="<?php print $ticket_subject;?>"required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputCategory" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputCategory" name="inputCategory" required>
                    <?php 
                    	foreach ($categories as $key => $category) 
                    	{
    						print "<option value=\"" .$key. "\"" .compareOption($ticket_category,$key) .">".$category."</option>";
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
    						print "<option value=\"" .$key. "\"" .compareOption($ticket_product,$key) .">".$product."</option>";
                   		}
					?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputLabel" class="col-sm-2 control-label">Label</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputLabel" name="inputLabel" required>
                        <option value="1" <?php print ($ticket_label == "Open")?"selected":""; ?>>Open</option>
                        <option value="2"<?php print ($ticket_label == "Solved")?"selected":""; ?>>Solved</option>
                        <option value="3"<?php print ($ticket_label == "Closed")?"selected":"";?>>Closed</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputDescription" name="inputDescription" rows="20" required><?php print $ticket_description;?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                    <a class="btn btn-default " href="<?php print "index.php?content=view_ticket&idTicket=" . $_GET['idTicket']?>" >Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
else:
header("refresh:3;url=index.php?content=view_ticket&idTicket=" . $_GET['idTicket']);
?>
<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <p>
            <strong>Your ticket has been edited</strong>, and you will be
            redirected. If not, return to the <a href="<?php print "index.php?content=view_ticket&idTicket=" . $_GET['idTicket']?>">main page</a>
        </p>
    </div>
</div>
<?php endif;?>