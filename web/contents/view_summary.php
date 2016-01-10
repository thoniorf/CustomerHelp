<?php
require_once $INCLUDES_PATH . '/viewtickets.php';
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h3>Tickets Summary</h3>
        <p>Use the search's options to filter your tickets, if any.</p>
        <?php
            require_once $CONTENTS_PATH . '/viewsummary_error.php';
        ?>
        <hr>
        <form class="form" action="" method="GET" onsubmit="">
            <div class="row">
	            <div class="form-group">
		            <div class="col-md-8 col-xs-12">
			                <label for="inputSubject" class="control-label"> Subject:</label>
			                    <input type="text" class="form-control"
			                        id="inputSubject" name="inputSubject"
			                        placeholder="Ticket subject">
		            </div>
	            
		            <div class="col-md-4 col-xs-12">
			                <label for="inputDate" class="control-label"> From:</label>
			                    <input type="date" class="form-control"
			                        id="inputDate" name="inputDate"
			                        placeholder="Ticket subject">
		            </div>
	            </div>
            </div>
            <div class="row">
	            <div class="form-group">
		            <div class="col-md-6 col-xs-12">
			                <label for="inputAssignment" class="control-label"> Assigned to:</label>
			                    <input type="text" class="form-control"
			                        id="inputAssignment" name="inputAssignment"
			                        placeholder="Ticket Assignment">
		            </div>
                    
		            <div class="col-md-6 col-xs-12">
		                    <label for="inputLabel" class="control-label"> Labeled:</label>
                            <select class="form-control" id="inputLabel" name="inputLabel">
                            <option value="0">Open</option>
                            <option value="1">Solved</option>
                            <option value="2">Closed</option>
                            </select>
		            </div>
	            </div>
            </div>
            <div class="row">
            <div class="form-group">
            <div class="col-md-2 col-xs-2">
                    <br/>
                    <button type="submit" class="btn btn-default">Submit</button>
            </div>
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
                        <th></th>
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
		                	print "<td> <a href=\"index.php?content=view_ticket&idTicket=" . $ticket->id . "\">Open</a></td>";
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