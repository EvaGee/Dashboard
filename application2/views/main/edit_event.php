<!-- Main content -->
<div class="content-wrapper">

    <!-- Wizard with validation -->
    <div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Edit Event</h6>
		</div>

    	<form class="stepy-validation" id="myform" action="<?php echo base_url(); ?>index.php/Welcome/update_event/<?php echo $events->event_id; ?>" method="post" enctype="multipart/form-data">
			<fieldset title="1">
				<legend class="text-semibold">Step 1</legend>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Event Title: <span class="text-danger">*</span></label>
							<input type="text" name="title" class="form-control required" placeholder="event title" value="<?php echo $events->event_title; ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Event Venue: <span class="text-danger">*</span></label>
							<input type="text" name="venue" class="form-control required" placeholder="event venue" value="<?php echo $events->event_venue; ?>">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label>Event Location: <span class="text-danger">*</span></label>
							<input type="text" name="location" class="form-control required" placeholder="event location" value="<?php echo $events->event_coodinates; ?>">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Event Category: <span class="text-danger">*</span></label>
							<select name="category" class="form-control" required>
								<option value="<?php echo $events->event_category_id; ?>"><?php if ($events) {
									echo $events->category_name;
								} ?></option>
								<?php 
								foreach ($category as $key => $value) { ?>
								<option value="<?php echo($value['id']);?>"> <?php echo($value['category_name']); ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Event Date: <span class="text-danger">*</span></label>
							<input type="date" name="date" class="form-control required" placeholder="event date" value="<?php echo $events->event_date; ?>">
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
                            <input type="text" name="video_link" placeholder="enter youtube link" class="form-control" value="<?php echo $events->video; ?>">
                        </div>
					</div>

					<div class="col-md-6">
                        <div class="form-group">
							<label class="display-block">Event Sponsor Logo:</label>
                            <input type="file" name="file_sponsor" class="file-styled" id="file_sponsor" onchange="sponsor_logo(this.value);">

                            <!--File Alternative-->
                            <input name="file_sponsor_update" type="hidden" value="<?php echo $events->sponsor_logo; ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
							<label class="display-block">Slideshow Image: <span class="text-danger">*</span></label></label>
                            <input name="slider_images" id="file_slider" type="file" class="file-styled" onchange="slider_image(this.value);" >
                            <!--File Alternative-->
                            <input name="slider_images_update" type="hidden" value="<?php echo $events->slider_image; ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                        </div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="display-block">Event Banner Image: <span class="text-danger">*</span></label></label>
                            <input name="banner_images" id="file_banner" type="file" class="file-styled" onchange="banner_image(this.value);">

                            <!--File Alternative-->
                            <input name="banner_images_update" type="hidden" value="<?php echo $events->cover_image; ?>">
                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                        </div>
					</div>
				</div>
			</fieldset>

			<fieldset title="3">
				<legend class="text-semibold">Step 3</legend>

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
							<textarea name="event_description"  id="event_description" rows="10" style="100%" class="form-control"><?php echo $events->event_description; ?></textarea>
						</div>
				  </div>
				</div>
								
			</fieldset>

			<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
		</form>
    </div>
    <!-- /wizard with validation -->

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

    alert("invalid image formart");
    document.getElementById(fileid).value = ""; 
    return;
}

</script>




