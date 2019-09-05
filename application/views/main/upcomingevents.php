<section class="section-upcoming-events">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs12">
				<div class="all_team">
					<div class="spacer-35"></div>
					<div style="font-weight: bold; color:#293a63"><?php echo $links; ?></div>
					<div class="section-header">
						<h2>
							<?php
							if (empty($events)):
								echo 'NO UPCOMING EVENTS'; 
							else:
								echo 'UPCOMING EVENTS';
							endif;							
							?>
						</h2>
					</div>

					<?php
						foreach ($events as $value) {
							?>
					  			<div class="sngl_team col-sm-4" style="padding:10px;">
									<a href="<?php echo base_url(); ?>index.php/event?me=<?php echo $value['event_id']; ?>">
									<div class="card" style="padding-bottom:50px; height:300px;">
									  <img src="<?php echo $value['cover_image']; ?>" alt="<?php echo $value['event_title']; ?>" style="width:100%; height:100%;">
									  <div class="card-container" style="text-align: left;">
									  	 <div style="font-size: 11px;"><b>Event:</b> <font style="color:#514848;"><?php echo $value['event_title']; ?></font></div> 
									  	 <div style="font-size: 11px;"><b>Location:</b> <font style="color:#514848;"><?php echo $value['event_venue']; ?></font></div>
									  	<button style="background-color: #4CAF50;border: none;color: white;padding: 5px 32px;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;bottom: 4px;" class="button">Read more</button>
									  </div>
									</div>
									</a>
								</div>


							<?php
						}
					?>
				</div>

			</div>
		</div>
</div>
<div class="spacer-35"></div>
<div style="font-weight: bold; color:#293a63; text-indent: 11%"><?php echo $links; ?></div>
</section>