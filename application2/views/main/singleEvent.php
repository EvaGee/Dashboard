<!-- Basic datatable -->
<div class="panel panel-flat">
	<?php
	if ($this->session->flashdata('success')) {
	?>
	<div class="alert alert-success">
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<?php }
	if ($this->session->flashdata('error')) { 
	?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php } ?>

			<div id="<?php echo $single_event->id; ?>" class="">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><?php echo strtoupper(($single_event->event_title)); ?></h5>
						</div>
						<hr>

						<div class="modal-body">
							
							<a href="<?php echo $single_event->video; ?>" target="_blank">
								<span class="label bg-blue">Event video</span>
							</a>

							<a href="<?php echo $single_event->sponsor_logo; ?>" target="_blank">
								<span class="label bg-blue">Sponsor Logo</span>
							</a>

							<a href="<?php echo $single_event->slider_image; ?>" target="_blank">
								<span class="label bg-blue">Slider Image</span>
							</a>
							<a href="<?php echo $single_event->cover_image; ?>" target="_blank">
								<span class="label bg-blue">Cover Image</span>
							</a>

							<p style="padding-top: 20px; background-color: white; color: black"><u><b>Event Title</b></u></p>
							<p><?php echo $single_event->event_title; ?></p>

							<p style="padding-top: 20px"><u><b>Event Description</b></u></p>
							<p><?php echo $single_event->event_description; ?></p>

							<p style="padding-top: 20px"><u><b>Ticket Types</b></u></p>

							<?php
							foreach ($eventtype as $val) {								
								?>

								<p>
									<b> TYPE: <?php echo strtoupper(($val['type_name'])); ?></b><br>
									<b> AMOUNT: </b><?php echo strtoupper(($val['amount'])); ?><br>
									<b> TOTAL TICKET: </b><?php echo strtoupper(($val['total_tickets'])); ?><br>
									<b> AVAILABLE TICKETS: </b><?php echo strtoupper(($val['available_tickets'])); ?><br>
									<b> CLOSE DATE: </b><?php echo strtoupper(($val['ticket_close_on'])); ?><br>
									<i>CREATED ON</i> <b>:</b> <?php echo strtoupper(($val['created_at'])); ?>
									<br>
									<?php
									if ($this->session->userdata('account_id') == $single_event->account_id) {
									?>
									<a href="<?php echo base_url('index.php/Welcome/edit_ticket_type/'.$val['id']); ?>"><button><b>Edit</b></button></a>
									<a href="<?php echo base_url('index.php/Welcome/del_ticket_type/'.$val['id']); ?>"><button><b>Del</b></button></a>
									<?php
								}
									?>
								</p>
								<hr />
								<?php
							}
							?>

							<b><i>Created By:</i></b> <a style="background-color: white; color: black" href="<?php echo $single_event->user_name; ?>" target="_blank">
								<span class="label bg-blue"><?php echo $single_event->user_name; ?></span>
							</a>&nbsp &nbsp &nbsp &nbsp

							<b>On:</b> <a href="<?php echo $single_event->sponsor_logo; ?>" target="_blank">
								<span class="label bg-blue"><?php echo $single_event->created_at; ?></span>
							</a>
							<?php
							if ($this->session->userdata('role') == 1 && $single_event->event_status == 0 ) {
							?>
							<p style="padding-top: 20px">
								<a href="<?php echo base_url(); ?>index.php/Welcome/approveEvent/<?php echo $single_event->event_id; ?>"><button style="color: black; font-weight: bold">Aprove</button></a>
								<a href="<?php echo base_url(); ?>index.php/Welcome/deleteEvent/<?php echo $single_event->event_id; ?>"><button style="color: black; font-weight: bold">Delete</button></a>
							</p>

							<?php
						}
							?>

							
						</div>
					</div>
				</div>
			</div>
		
</div>
<!-- /basic datatable -->