<!-- Basic datatable -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">My Events</h5>
	</div>
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

	<div class="panel-body"></div>

	<table class="table datatable-basic">
		<thead>
			<tr>
				<th>Title</th>
				<th>Venue</th>
				<th>Event Date</th>
				<th>Created by</th>
				<th>Status</th>
				<th>More ...</th>
			</tr>
		</thead>
		<tbody>

		<?php 
			foreach ($event as $key => $value) {?>
			<tr>
				<td><a href="<?php echo base_url(); ?>index.php/Welcome/singleEvent/<?php echo $value['id']; ?>" ><?php echo($value['event_title']); ?></a></td>
				<td><?php echo($value['event_venue']); ?></td>
				<td><?php echo($value['event_date']); ?></td>
				<td><?php echo($value['event_created_by']); ?></td>
				<td><?php
				if ($value['event_status'] == 0) {
					echo "Pending";
				}else if ($value['event_status'] == 1) {
					echo "Approved";
				}else{
					echo "Rejected";
				}
				?></td>
				<td class="text-center">
						<ul class="icons-list">
			        		<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a data-toggle="modal" data-target="#modal<?php echo($value['id']); ?>"> View Event</a>
									</li>
									<li><a href="<?php echo base_url(); ?>index.php/my-ticket?sold=<?php echo($value['id']); ?>"> View Sold Tickets</a>
									</li>
									<?php
									if ($user_role == 1 && $value['event_status'] == 0) {
										?>
										<li><a href="<?php echo base_url(); ?>index.php/Welcome/approveEvent/<?php echo $value['id']; ?>"> Approve Event</a>
										</li>
										<li><a href="<?php echo base_url(); ?>index.php/Welcome/rejectEvent/<?php echo $value['id']; ?>"> Reject Event</a>
										</li>
										<?php
									}	if($value['account_id'] == $user_id && $value['event_status'] != 2 || $value['account_id'] == $user_id && $value['event_status'] != 2 && $user_role == 1) {
										?>
										<li><a href="<?php echo base_url('index.php/Welcome/edit_event/'.$value['id']); ?>"> Edit Ticket</a>
										</li>
										<?php
									}
									?>
									<li><a href="<?php echo base_url(); ?>index.php/Welcome/deleteEvent/<?php echo($value['id']); ?>" onclick = "return confirm('Are you sure you want to delete this event?')"> Delete Ticket</a>
									</li>
								</ul>
							</li>
			        	</ul>
				</td>
			</tr>
			<!-- Basic modal -->
			<div id="modal<?php echo($value['id']); ?>" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h5 class="modal-title"><?php echo strtoupper(($value['event_title'])); ?></h5>

						</div>
						<hr>

						<div class="modal-body">
							
							<a href="<?php echo ($value['video']); ?>" target="_blank">
								<span class="label bg-blue">Event video</span>
							</a>

							<a href="<?php echo ($value['sponsor_logo']); ?>" target="_blank">
								<span class="label bg-blue">Sponsor Logo</span>
							</a>

							<a href="<?php echo($value['slider_image']); ?>" target="_blank">
								<span class="label bg-blue">Slider Image</span>
							</a>
							<a href="<?php echo($value['cover_image']); ?>" target="_blank">
								<span class="label bg-blue">Cover Image</span>
							</a>

							<p style="padding-top: 20px"><u><b>Event Description</b></u></p>
							<p><?php echo strtoupper(($value['event_description'])); ?></p>
							
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /basic modal -->
			<?php 
			}
		?>
		</tbody>
	</table>
</div>
<!-- /basic datatable -->