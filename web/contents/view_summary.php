<?php
require_once $INCLUDES_PATH . '/viewtickets.php';
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h3>Ticket Summary</h3>
        <p>Use the search's options to filter your tickets, if any.</p>
        <?php
            require_once $CONTENTS_PATH . '/viewsummary_error.php';
        ?>
        <hr>
        <form class="form" action="" method="POST" onsubmit="">
            <div class="form-group">
                <label for="inputSearch" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"
                        id="inputSubject" name="inputSubject"
                        placeholder="Ticket subject" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
       <hr>
       <div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-hover">
                <thead>
                    <tr>
	                    <th>#</th>
	                    <th>Subject</th>
	                    <th>Date</th>
	                    <th>Assigned to</th>
	                    <th>Label</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
	                <?php
		                foreach ($tickets as $key => $ticket)
		                {
		                	print "<tr>";
		                	print "<th scope=\"row\">" . $key . "</th>";
		                	print "<td>" . $ticket->subject . "</td>";
		                	print "<td>" . $ticket->date . "</td>";
		                	print "<td>" . $ticket->assignedTo . "</td>";
		                	print "<td>" . $ticket->label . "</td>";
		                	print "<td> Do something!</td>";
        					print "</tr>";
		                }
	                ?>
                </tbody>
				</table>
			</div>
		</div>
        </div>
    </div>
</div>