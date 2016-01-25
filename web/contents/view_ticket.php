<div class="row">
    <div class="col-md-8 col-xs-12 col-md-offset-2">
    
		<?php
		require_once $INCLUDES_PATH . '/singleticket.php';
		?>
        <h3>Ticket review</h3>
        <p>Use the message box to append a new message.</p>
        <?php
            require_once $CONTENTS_PATH . '/viewticket_error.php';
        ?>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
		                <p><strong>Id:</strong> <?php print $ticket->id?></p>
				        <p><strong>Subject:</strong> <?php print $ticket->subject?></p>
				        <p><strong>Creation date:</strong> <?php print $ticket->date?></p>
                        <p><strong>Last edit:</strong> <?php print $ticket->edit?>
				        <p><strong>Assigned to:</strong> <?php print $ticket->assignedTo?></p>
				        <p><strong>Label:</strong> <?php print $ticket->label?></p>
				        <p><strong>Category:</strong> <?php print $ticket->category?></p>
				        <p><strong>Product:</strong> <?php print $ticket->product?></p>
                    </div>
                    <div class="col-md-6 col-xs-12">
			            <p><strong>Ticket text:</strong> <br/> <?php print $ticket->description?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
// FETCH ALL MESSAGES
if(!isset($_GET['reply'])):
require_once $INCLUDES_PATH . '/fetchmessage.php';
?>
        <hr>
        <div class="row">
	        <div class="col-xs-8 col-xs-offset-2">
               <?php
               		if($_SESSION['user_role']=="Tecnico"):
               ?>
               <a class="btn btn-primary btn-block" href="<?php print $INCLUDES_PATH . '/assignticket.php?' . "idTicket=" . $_GET['idTicket'];?>" >Self assign the ticket</a>
               <?php
               		endif;
               ?>
	           <a class="btn btn-primary btn-block" href="<?php print "/index.php?content=view_ticket&idTicket=" . $_GET['idTicket'] . "&reply=r"?>" >Send a new message</a>
               <a class="btn btn-primary btn-block" href="<?php print "/index.php?content=modifyticket&idTicket=" . $_GET['idTicket'] ?>" >Edit this ticket</a>
	        </div>
        </div>
        <hr>
        <div class="row">
	        <div class="col-xs-12">
		        <p class="lead">Messages: </p>
		        <?php 
		        	if($num_rows >0): 
		        ?>
		        <div class="panel panel-default">
		            <div class="table-responsive">
		                <table class="table table-striped">
		                    <?php
		                    	foreach ($messages as $key => $message):
		                    ?>
		                    <tr>
			                    <td>
		                            <p><strong>User:</strong> <?php print $message->user;?></p>
		                            <p><strong>Date:</strong> <?php print $message->date;?></p>
		                            <p><strong>Message text:</strong> <br/> <?php print $message->text;?></p>
			                    </td>
		                    </tr>
		                    <?php
		                    	endforeach;
		                    ?>
		                </table>
		            </div>
		        </div>
	            <nav>
	              <ul class="pager">
	                <li class="previous <?php print $lower; ?> "><a <?php if($lower !== "disabled") print "href=\"" . buildURI("GET",'content','idTicket') . "limit=". $lower . "\"";?>><span aria-hidden="true">&larr;</span> Previous</a></li>
	                <li class="next <?php print $upper; ?>" ><a <?php if($upper !== "disabled") print "href=\"". buildURI("GET",'content','idTicket') . "limit=". $upper . "\"";?>>Next <span aria-hidden="true">&rarr;</span></a></li>
	              </ul>
	            </nav>
	            <?php 
	            	else:
	            ?>
	            <p>No messages at all.</p>
	            <?php 
	            	endif;
	            ?>
	        </div>
        </div>
<?php
// SEND NEW REPLY FORM
else:
	require_once $INCLUDES_PATH . '/sendmessage.php';
	if(!empty($reply_sent)):
	header("refresh:3;url=index.php?content=view_ticket&idTicket=" . $_GET['idTicket'] );
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <p>
            <strong>You message has been sent</strong>, and you will be
            redirected. If not, return to the <a href="index.php">main page</a>
        </p>
    </div>
</div>
<?php
else:
?>
        <hr>
        <div class="row">
        <div class="col-xs-12">
        <?php 
        	require_once $CONTENTS_PATH . '/sendmessage_error.php';
        ?>
        <p class="lead">New Message: </p>
            <form class="form" action="" method="POST" onsubmit="">
                <div class="form-group">
                    <textarea class="form-control" id="inputMessage" name="inputMessage" rows="5" placeholder="Insert you message here ..."></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default" >Submit</button>
                    <a class="btn btn-default " href="<?php print "index.php?content=view_ticket&idTicket=" . $_GET['idTicket']?>" >Back</a>
                </div>
        </form>
        </div>
        </div>
<?php
endif;
endif;
?>
    </div>
</div>