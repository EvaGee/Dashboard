<!-- Basic datatable -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Pending Events</h5>
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
	<?php } 

	if ($this->session->userdata('role') == 1) {
	?>

	<div class="panel-body"></div>

	<table class="table datatable-basic">
		<thead>
			<tr>
				<th>Title</th>
				<th>View</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

		<?php 
			foreach ($pending as $key => $value) {?>
			<tr>
				<td><a href="<?php echo base_url()?>index.php/Welcome/singleEvent/<?php echo($value['id']); ?>"><?php echo($value['event_title']); ?></a></td>
				<td><?php echo($value['event_venue']); ?></td>
				<td class="text-center">
						<ul class="icons-list">
			        		<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<?php
									if ($this->session->userdata('role') == 1 && $value['event_status'] != 1) {
										?>
										<li><a href="<?php echo base_url(); ?>index.php/Welcome/approveEvent/<?php echo $value['id']; ?>"> Approve</a>
										</li>
										<?php
									}
									?>
									<li><a href="<?php echo base_url(); ?>index.php/Welcome/deleteEvent/<?php echo($value['id']); ?>" onclick = "return confirm('Are you sure you want to delete this event?')"> Delete</a>
									</li>
								</ul>
							</li>
			        	</ul>
				</td>
			</tr>
			<?php 
			}
		?>
		</tbody>
	</table>
<?php } ?>
</div>
<!-- /basic datatable -->