<?php
require_once $INCLUDES_PATH . '/allsummary.php';
?>
<div class="row">
    <div class="col-md-8 col-xs-12 col-md-offset-2">
        <h3>Tickets Summary</h3>
        <p>Use the search's options to filter your tickets, if any.</p>
        <?php
            require_once $CONTENTS_PATH . '/viewsummary_error.php';
        ?>
        <hr>
        <form class="form" action="index.php?content=admin" method="GET" onsubmit="">
            <div class="row">
	            <div class="form-group">
		            <div class="col-md-4 col-xs-12">
			                <label for="inputSubject" class="control-label"> Subject:</label>
			                    <input type="text" class="form-control"
			                        id="inputSubject" name="inputSubject"
			                        placeholder="Ticket subject">
		            </div>
                    
                    <div class="col-md-4 col-xs-12">
                            <label for="inputOwner" class="control-label"> Owner:</label>
                                <input type="text" class="form-control"
                                    id="inputOwner" name="inputOwner"
                                    placeholder="Ticket Owner">
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
		            <div class="col-md-4 col-xs-12">
			                <label for="inputAssignment" class="control-label"> Assigned to:</label>
			                    <input type="text" class="form-control"
			                        id="inputAssignment" name="inputAssignment"
			                        placeholder="Ticket Assignment">
		            </div>
                    
                    <div class="col-md-4 col-xs-12">
                            <label for="inputId" class="control-label"> Id:</label>
                            <input type="text" class="form-control"
			                        id="inputId" name="inputId"
			                        placeholder="Ticket Id">
                    </div>
           
		            <div class="col-md-4 col-xs-12">
		                    <label for="inputLabel" class="control-label"> Label:</label>
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
            <input type="hidden" name="content" value="admin">
        </form>
       <hr>
       <div class="row">
		<div class="col-xs-12">
        <?php if($num_rows >0):?>
			<div class="table-responsive">
				<table class="table table-hover">
                <thead>
                    <tr>
	                    <th>Id</th>
                        <th>Owner</th>
	                    <th class="hidden-xs">Subject</th>
	                    <th>Date</th>
	                    <th class="hidden-xs">Assigned to</th>
	                    <th>Label</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
	                <?php
			                foreach ($tickets as $key => $ticket)
			                {
			                	print "<tr>";
			                	print "<th scope=\"row\">" . $ticket->id . "</th>";
			                	print "<th>" . $ticket->owner . "</th>";
			                	print "<td class=\"hidden-xs\">" . $ticket->subject . "</td>";
			                	print "<td>" . $ticket->date . "</td>";
			                	print "<td class=\"hidden-xs\">" . $ticket->assignedTo . "</td>";
			                	print "<td>" . $ticket->label . "</td>";
			                	print "<td> <a href=\"index.php?content=view_ticket&idTicket=" . $ticket->id . "\">Open</a></td>";
	        					print "</tr>";
			                }
	                ?>
                </tbody>
				</table>
			</div>
            <nav>
              <ul class="pager">
                <li class="previous <?php print $lower; ?> "><a <?php if($lower !== "disabled"):?>href="<?php print buildURI("GET",'content','inputSubject','inputOwner','inputDate','inputLabel') . "limit=". $lower;?>"<?php endif;?>><span aria-hidden="true">&larr;</span> Previous</a></li>
                <li class="next <?php print $upper; ?>" ><a <?php if($upper !== "disabled"):?>href="<?php print buildURI("GET",'content','inputSubject','inputOwner','inputDate','inputLabel') . "limit=". $upper; ?>"<?php endif;?>>Next <span aria-hidden="true">&rarr;</span></a></li>
              </ul>
            </nav>
           <?php else:?>
            <p>The aren't tickets yet.</p>
           <?php endif;?>
		</div>
        </div>
    </div>
</div>