<!-- Main content -->
<div class="content-wrapper" >

    <!-- Wizard with validation -->
    <div style="margin-top: -7%; display: block; margin-left: 10%">

    	<form class="stepy-validation" id="myform" action="<?php echo base_url(); ?>index.php/Welcome/updateTicketType/<?php echo $ticket->id; ?>" method="post" enctype="multipart/form-data"  >
			
		<div class="modal-dialog"> 
			<div class="modal-content">
				
				<hr>
				<div class="modal-body">
					
					<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket Type: <span class="text-danger">*</span></label>
							<select name="ticket_type" class="form-control">
								<option value="<?php echo $ticket->ticket_type; ?>"><?php if ($ticket) {
									echo $ticket->type_name;
								} ?></option>
								<?php 
								foreach ($ticket_type as $key => $value) { ?>
								<option value="<?php echo($value['typeid']);?>"> <?php echo($value['type_name']); ?> </option>
								<?php } ?>
							</select>
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket amount: <span class="text-danger">*</span></label>
							<input type="number" id="amount_ticket" name="amount_ticket" class="form-control" required placeholder="Ticket amount e.g 1000" value="<?php echo $ticket->amount; ?>">
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Number of Tickets: <span class="text-danger">*</span></label>
							<input type="number" id="number_ticket" name="number_ticket" class="form-control" required placeholder="Number of Tickets e.g 1000" value="<?php echo $ticket->total_tickets; ?>">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Close Ticket on Date: <span class="text-danger">*</span></label>
							<input type="date" id="date_ticket" name="date_ticket" class="form-control" required placeholder="Close Ticket on Date" value="<?php echo $ticket->ticket_close_on; ?>">
                        </div>
					</div>
				</div>

				</div>

				
			</div>
		</div>

			<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
		</form>
    </div>
</div>