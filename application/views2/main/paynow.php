<!-- Main content -->
<div class="content-wrapper">
    <div class="panel panel-white" style="padding: 10px">
		<div class="panel-heading">
			<h6 class="panel-title">Choose Option</h6>
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

		<div class="row" style="padding: 10px">
			
			<div class="col-lg-12">
				<ul class="list-inline">
					<li>
						<a data-toggle="modal" data-target="#modalb2c" class="btn border-green-700 text-green-700 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
						<i class="ipay_elipa" style="text-align: center;"></i>
						</a>
					</li>
					<li class="text-left">
						<div class="text-semibold">B2C</div>
						<div class="text-muted">eLipa/Mpesa/AirtelMoney</div>
					</li>
				</ul>
			</div>

			<div class="col-lg-12">
				<ul class="list-inline">
					<li>
						<a data-toggle="modal" data-target="#modalb2b" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
						<i class="ipay_mpesa" style="text-align: center;"></i>
						</a>
					</li>
					<li class="text-left">
						<div class="text-semibold">B2B</div>
						<div class="text-muted">Paybill/TillNumber/iPayAccount</div>
					</li>
				</ul>
			</div>

			<div class="col-lg-12">
				<ul class="list-inline">
					<li>
						<a data-toggle="modal" data-target="#modalpesalink" class="btn border-slate-700 text-slate-700 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="ipay_pesalink" style="text-align: center;"></i></a>
					</li>
					<li class="text-left">
						<div class="text-semibold">PesaLink</div>
						<div class="text-muted">Direct to bank account</div>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>

<!-- b2c Basic modal -->
<div id="modalb2c" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Send Money to Wallet</h5>

			</div>
			<hr>
			<form action="<?php echo base_url(); ?>index.php/Welcome/paynowb2c" method="post">
				<div class="modal-body">

					<div class="form-group">
						<label>Select Wallet: </label>
						<select name="wallet_category" onchange="categoryCheck(this.value);" class="form-control" required>
							<option value="">Select Wallet</option>
							<option value="elipa">eLipa</option>
							<option value="mpesa">Mpesa</option>
							<option value="airtelmoney">Airtel-Money</option>
						</select>
					</div>

					<div class="form-group">
						<label id="cat_phone"> </label>
						<input type="text" pattern="[07][0-9]{9}" name="phone" id="phone" class="form-control" required placeholder="phone number e.g. 07xxxxxxxx">
					</div>

					<div class="form-group">
						<label>Amount to send: </label>
						<input type="number" name="amount" class="form-control" required placeholder="amount to send">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" >Send</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->


<!-- pesalink Basic modal -->
<div id="modalpesalink" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Send Money to Bank</h5>

			</div>
			<hr>
			<form action="<?php echo base_url(); ?>index.php/dd" method="post">
				
			<div class="modal-body">

				coming soon

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Send</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->

<!-- b2b Basic modal -->
<div id="modalb2b" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Send Money</h5>

			</div>
			<hr>
			<form action="<?php echo base_url(); ?>index.php/Welcome/paynowb2b" method="post">
				
			<div class="modal-body">
				<div class="form-group">
					<label>Category: <span class="text-danger">*</span></label>
					<select name="b2bcategory" class="form-control" onchange="b2bcategoryCheck(this.value);" required>
						<option value="">Select Category</option>
						<option value="ipay">iPay Merchant</option>
						<option value="mpesapaybill">Paybill Number</option>
						<option value="mpesatill">Till Number</option>
					</select>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Receving Account: <span class="text-danger">*</span></label>
							<input type="text" name="b2baccount" class="form-control" placeholder="paybill/till/vendor-id" required>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label>Paybill Account no: <span class="text-danger"> (only for paybill no.)</span></label>
							<input type="text" name="b2bnarration" id="b2bnarration" class="form-control" placeholder="paybill/till/vendor-id" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Amount to send: <span class="text-danger">*</span></label>
					<input type="number" name="b2bamount" class="form-control" placeholder="amount to send" required>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" >Send</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->

<script>
	function categoryCheck(cat)
	{
		document.getElementById("cat_phone").innerHTML = cat+' phone number ';
	}

	function b2bcategoryCheck(cat)
	{
		if(cat != 'mpesapaybill')
		{
			document.getElementById("b2bnarration").disabled = true;
			document.getElementById("b2bnarration").value = "NA";
		}else{
			document.getElementById("b2bnarration").value = "";
			document.getElementById("b2bnarration").disabled = false;
		}
	}
</script>