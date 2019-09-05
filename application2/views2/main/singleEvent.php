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

							<b><i>Created By:</i></b> <a style="background-color: white; color: black" href="<?php echo $single_event->user_name; ?>" target="_blank">
								<span class="label bg-blue"><?php echo $single_event->user_name; ?></span>
							</a>&nbsp &nbsp &nbsp &nbsp

							<b>On:</b> <a href="<?php echo $single_event->sponsor_logo; ?>" target="_blank">
								<span class="label bg-blue"><?php echo $single_event->created_at; ?></span>
							</a>
							<p style="padding-top: 20px">
								<a href="<?php echo base_url(); ?>index.php/Welcome/approveEvent/<?php echo $single_event->event_id; ?>"><button style="color: black; font-weight: bold">Aprove</button></a>
								<a href="<?php echo base_url(); ?>index.php/Welcome/deleteEvent/<?php echo $single_event->event_id; ?>"><button style="color: black; font-weight: bold">Delete</button></a>
							</p>

							
						</div>
					</div>
				</div>
			</div>
		
</div>
<!-- /basic datatable -->