<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-title h6">
							<span>Main navigation</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="<?php echo base_url(); ?>index.php/Welcome/dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li><a href="<?php echo base_url(); ?>index.php"><i class="icon-list-unordered"></i> <span>Create Event </span></a></li>
								<li><a href="<?php echo base_url(); ?>index.php/my-event"><i class="icon-width"></i> <span>My Events</span></a></li>
								<li><a href="<?php echo base_url(); ?>index.php/my-event"><i class="icon-width"></i> <span>Sold Tickets</span></a></li>
								<li><a data-toggle="modal" data-target="#modalscan"><i class="icon-width"></i> <span>Scan Tickets</span></a></li>
								<li>
									<a href="#"><i class="icon-stack2"></i> <span>Payment</span></a>
									<ul>
										<li><a href="<?php echo base_url(); ?>index.php/payment-option">Request Pay</a></li>
									</ul>
								</li>
								<!-- /main -->
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->
          
          <!-- scan Basic modal -->
<div id="modalscan" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Scan Ticket</h5>

			</div>
			<hr>
			<form action="<?php echo base_url(); ?>index.php/scan" method="post">
				<div class="modal-body">

					<div class="form-group">
						<label>Ticket Serial: </label>
						<input type="text" name="serial" class="form-control" required placeholder="Serial No">
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" >Scan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /basic modal -->