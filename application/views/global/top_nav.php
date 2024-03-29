<body class="navbar-bottom navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="assets/images/logo_light.png" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		
		<p class="navbar-text"><span class="label bg-success-400">Online</span></p>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown language-switch">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="assets/images/flags/gb.png" class="position-left" alt="">
					English
					<span class="caret"></span>
				</a>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-bubbles4"></i>
					<span class="visible-xs-inline-block position-right">Messages</span>
					<span class="badge bg-warning-400">0</span>
				</a>
				
				<div class="dropdown-menu dropdown-content width-350">
					<div class="dropdown-content-heading">
						Messages
						<ul class="icons-list">
							<li><a href="#"><i class="icon-compose"></i></a></li>
						</ul>
					</div>

					<!-- <ul class="media-list dropdown-content-body">
						<li class="media">
							<div class="media-left">
								<img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt="">
								<span class="badge bg-danger-400 media-badge">5</span>
							</div>

							<div class="media-body">
								<a href="#" class="media-heading">
									<span class="text-semibold">James Alexander</span>
									<span class="media-annotation pull-right">04:58</span>
								</a>

								<span class="text-muted">who knows, maybe that would be the best thing for me...</span>
							</div>
						</li>
					</ul> -->

					<div class="dropdown-content-footer">
						<a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a>
					</div>
				</div>
			</li>

			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="assets/images/placeholder.jpg" alt="">
					<span><?php echo $this->session->userdata('name');?></span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="<?php echo base_url(); ?>index.php/profile-balance" data-toggle="modal" data-target="#modalbalance">
					<i class="icon-coins"></i> My balance</a></li>
					<li><a href="<?php echo base_url(); ?>index.php/logout"><i class="icon-switch2"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /main navbar -->

<!-- balance Basic modal -->
<div id="modalbalance" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" style="padding: 20px">
			
		</div>
	</div>
</div>
<!-- /basic modal -->
