<!-- Main content -->
<div class="content-wrapper">

    <!-- Wizard with validation -->
    <div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Create Event</h6>
			<div style="text-align: center; width: 90%">
		        <?php if($this->session->flashdata('success')):?>
		          <div class="alert alert-info alert-styled-left">
		            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>          
		            <?php echo $this->session->flashdata('success'); ?>
		          </div>
		         <?php
		        endif;?>

		        <?php if($this->session->flashdata('false')):?>
		          <div class="alert alert-danger alert-styled-left">
		            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>          
		            <?php echo $this->session->flashdata('false'); ?>
		          </div>
		         <?php
		        endif;?>
        	</div>
		</div>

    	<form class="stepy-validation" id="myform" action="<?php if(!empty($event_data)){ echo base_url(); ?>index.php/Welcome/updateEvent/<?php echo $event_data->event_id; ?> <?php } else { echo base_url(); ?>index.php/create-event <?php } ?>" method="post" enctype="multipart/form-data">
			<fieldset title="1">
				<legend class="text-semibold">Step 1</legend>

				<?php
				//foreach ($event_data as $key => $event_value) {
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Event Title: <span class="text-danger">*</span></label>
							<input type="text" name="title" class="form-control required" placeholder="event title" value="<?php if(!empty($event_data)){ echo $event_data->event_title; } ?>" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Event Venue: <span class="text-danger">*</span></label>
							<input type="text" name="venue" class="form-control required" placeholder="event venue" value="<?php if(!empty($event_data)){ echo $event_data->event_venue; } ?>">
						</div>
					</div>
				</div>
			<?php //} ?>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Event Location: <span class="text-danger">*</span></label>
							<input type="text" name="location" class="form-control required" placeholder="event location" value="<?php if(!empty($event_data)){ echo $event_data->event_coodinates; } ?>" >
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Event Category: <span class="text-danger">*</span></label>
							<select name="category" class="form-control" required>
								<?php
								if (!empty($event_data)) { 
									echo '<option value="'.$event_data->event_category_id.'">'.$event_data->category_name.'</option>';
								} else {
									echo '<option value="">Select Category</option>';
								}
								?>
								<?php 
								foreach ($category as $key => $value) { ?>
								<option value="<?php 
								echo($value['id']);?>"> <?php echo($value['category_name']); ?> 
							</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Event Date: <span class="text-danger">*</span></label>
							<input type="date" name="date" class="form-control required" placeholder="event date" value="<?php if(!empty($event_data)){ echo $event_data->event_date; } ?>" >
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset title="2">
				<legend class="text-semibold">Step 2</legend>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Event Video: <span class="text-danger"> (or past events video)</span></label>
                            <input type="text" name="video_link" placeholder="enter youtube link" class="form-control" value="<?php if(!empty($event_data)){ echo $event_data->video; } ?>">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label class="display-block">Event Sponsor Logo:</label>
                            <input type="file" name="file_sponsor" class="file-styled" id="file_sponsor" onchange="sponsor_logo(this.value);" value="<?php if(!empty($event_data)){ echo $event_data->sponsor_logo; } ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label class="display-block">Slideshow Image: <span class="text-danger">*</span></label></label>
                            <input name="slider_images" id="file_slider" type="file" class="file-styled <?php if(empty($event_data)){ ?> required <?php } ?>" onchange="slider_image(this.value);" value="<?php if(!empty($event_data)){ echo $event_data->slider_image; } ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb <br>
                            	<?php if(!empty($event_data)){ echo $event_data->slider_image; } ?>
                            </span>
                        </div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="display-block">Event Banner Image: <span class="text-danger">*</span></label></label>
                            <input name="banner_images" id="file_banner" type="file" class="file-styled <?php if(empty($event_data)){ ?> required <?php } ?>" onchange="banner_image(this.value);" value="<?php if(!empty($event_data)){ echo $event_data->cover_image; } ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                        </div>
					</div>
				</div>
			</fieldset>

			<fieldset title="3">
				<legend class="text-semibold">Step 3</legend>
				<div class="row">
					<div class="col-lg-4">
						<ul class="list-inline text-center">
							<?php
							if (empty($ticket_data)) {
							?>
							<li>
								<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-toggle="modal" data-target="#modalcreateticket"><i class="icon-plus3">
									Create Ticket Type
								</i>
								</a>
							</li>
								<?php
							} else {
								foreach ($ticket_data as $key => $val) {
									
									?>
									<br>
									<li>
								<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-toggle="modal" data-target="#<?php echo $val['id']; ?>"><i>
									<?php echo $val['ticket_type']; echo $val['amount'];  ?>
								</i>
								<input type="hidden" name="ticket_type_id" value="<?php echo $val['id']; ?>">
								</a>
							</li>
							
								<?php
								}	
								}							
								?>
						
						</ul>
					</div>

					<div class="col-lg-8">
						<span class="text-danger"><p id="show_number">
						0 Tickets generated</p></span>
						<ul id="myList"></ul>
						<input type="text" id="num_ticket_generated" name="num_ticket_generated" value="" hidden <?php if(empty($ticket_data)){ ?>required <?php } ?> >
						<p id="ticket_autogen"></p>
					</div>
				</div>

			</fieldset>

			<fieldset title="4">
				<legend class="text-semibold">Step 4</legend>

				<div class="row">
				  <div class="col-lg-12">
				  <script type="text/javascript" src="<?php echo base_url(); ?>assets/nicEdit.js"></script> 
				  <script type="text/javascript">
					//<![CDATA[
					bkLib.onDomLoaded(function() {
					    nicEditors.editors.push(
					        new nicEditor().panelInstance(
					            document.getElementById('event_description')
					        )
					    );
					});
					//]]>
					</script>
				   		<div class="form-group"><label>Describe Your Event: <span class="text-danger">*</span></label>
							<textarea name="event_description" width = "100%" id="event_description" rows="10" style="100%" class="form-control"> <?php if(!empty($event_data)){ echo $event_data->event_description; } ?></textarea>
						</div>
				  </div>
				</div>
								
			</fieldset>

			<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
		</form>
    </div>
    <!-- /wizard with validation -->

    <!-- fellowship Basic modal -->
    <?php
    if (!empty($ticket_data)) {
    	foreach ($ticket_data as $key => $valtic) {
    		?>
    		<div id="<?php echo $valtic['id']; ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Create Ticket Type</h5>

				</div>
				<hr>
				<div class="modal-body">
					
						<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket Type: <span class="text-danger">*</span></label>
							<input type="text" id="ticket_type" name="ticket_type" class="form-control" required placeholder="Ticket type name e.g VIP" value="<?php if(!empty($ticket_data)){ echo $valtic['ticket_type']; } ?>">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket amount: <span class="text-danger">*</span></label>
							<input type="number" id="amount_ticket" name="amount_ticket" class="form-control" required placeholder="Ticket amount e.g 1000" value="<?php if(!empty($ticket_data)){ echo $valtic['amount']; } ?>">
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Number of Tickets: <span class="text-danger">*</span></label>
							<input type="number" id="number_ticket" name="number_ticket" class="form-control" required placeholder="Number of Tickets e.g 1000" value="<?php if(!empty($ticket_data)){ echo $valtic['total_tickets']; } ?>">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Close Ticket on Date: <span class="text-danger">*</span></label>
							<input type="date" id="date_ticket" name="date_ticket" class="form-control" required placeholder="Close Ticket on Date" value="<?php if(!empty($ticket_data)){ echo $valtic['ticket_close_on']; } ?>">
                        </div>
					</div>
				</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
				</div>
		</div>
	</div>
    		<?php
    	}
    }
    ?>
	<div id="modalcreateticket" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Create Ticket Type</h5>

				</div>
				<hr>
				<div class="modal-body">
					
						<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket Type: <span class="text-danger">*</span></label>
							<input type="text" id="ticket_type" name="ticket_type" class="form-control" required placeholder="Ticket type name e.g VIP">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Ticket amount: <span class="text-danger">*</span></label>
							<input type="number" id="amount_ticket" name="amount_ticket" class="form-control" required placeholder="Ticket amount e.g 1000">
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label>Number of Tickets: <span class="text-danger">*</span></label>
							<input type="number" id="number_ticket" name="number_ticket" class="form-control" required placeholder="Number of Tickets e.g 1000">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label>Close Ticket on Date: <span class="text-danger">*</span></label>
							<input type="date" id="date_ticket" name="date_ticket" class="form-control" required placeholder="Close Ticket on Date">
                        </div>
					</div>
				</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="myFunction()">Save</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /basic modal -->
</div>
<!-- /main content -->

<script>
function myFunction() {
	var generated 		= document.getElementById("num_ticket_generated").value;
	var ticket_type 	= document.getElementById("ticket_type").value;
	var amount_ticket 	= document.getElementById("amount_ticket").value;
	var number_ticket 	= document.getElementById("number_ticket").value;
	var date_ticket 	= document.getElementById("date_ticket").value;

	if(ticket_type.length <= 0 || amount_ticket.length <= 0 || number_ticket.length <= 0 ||date_ticket.length <= 0)
	{
		alert('ensure all fields are filled');
		return false;
	}

	//array to hold the ticket
	var ticket = [ticket_type, amount_ticket, number_ticket, date_ticket];

	//auto generate field
 	var x = document.createElement("INPUT");
  	x.setAttribute("type", "text");
  	x.setAttribute("name", Number(generated)+Number(1));
  	x.setAttribute("hidden", "true");
  	x.setAttribute("value", ticket);

	//show the list
	var list = document.createElement("LI");
	var textnode = document.createTextNode("TICKET TYPE:    "+ticket_type +"    AMOUNT:    "+ amount_ticket +"    No. OF TICKETS:    "+ number_ticket +"    DATE:    "+ date_ticket);
	list.appendChild(textnode);
	document.getElementById("myList").appendChild(list);

  	//clear popup form 
  	document.getElementById("ticket_type").value = "";
	document.getElementById("amount_ticket").value = "";
	document.getElementById("number_ticket").value = "";
	document.getElementById("date_ticket").value = "";

  	document.getElementById("num_ticket_generated").value = Number(generated)+Number(1);
  	document.getElementById("show_number").innerHTML = Number(generated)+Number(1) +' Tickets generated';
  	document.getElementById("ticket_autogen").appendChild(x);
}

function sponsor_logo(fileName)
{
	var fileid = 'file_sponsor';
	var image = validateFileType(fileName, fileid);
}

function slider_image(fileName)
{
	var fileid = 'file_slider';
	var image = validateFileType(fileName, fileid);
}

function banner_image(fileName)
{
	var fileid = 'file_banner';
	var image = validateFileType(fileName, fileid);
}

//validate images
function validateFileType(fileName, fileid)
{
    var allowed_extensions = new Array("jpg","png","jpeg");
    var file_extension = fileName.split('.').pop().toLowerCase(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

    for(var i = 0; i <= allowed_extensions.length; i++)
    {
        if(allowed_extensions[i]==file_extension)
        {
        	//console.log("gets here allowed extension ", file_extension);
        	//document.getElementById(fileid).onchange(validateFileSize);
    		return;
        }
    }

    alert("invalid image format");
    document.getElementById(fileid).value = ""; 
    return;
}

</script>




