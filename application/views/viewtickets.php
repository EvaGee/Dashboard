<style>
   #map {
    height: 200px;
    width: 100%;
   }
</style>

<section class="section-page-header">
	<div class="container">
		<h1 class="entry-title">Down load Ticket</h1>
	</div>
</section>
	
<section class="section-page-content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="section-order-review-pricing">
					<div class="pricing-coupon">
						<div class="coupon">
							<div class="row">
								<div class="col-sm-12 col-lg-12">
									<h3>Please confirm your ticket and download</h3>
								</div>
							</div>
						</div>
						
						<div class="pricing">
							<table class="table pricing-review">

								<thead>
							      <tr>
							        <th style="text-align: center;">Ticket Name</th>
							        <th style="text-align: center;">No. of Tickets</th>
							        <th style="text-align: center;">Unit Cost</th>
							        <th style="text-align: center;">Sub Total</th>
							        <th style="text-align: center;">Action</th>
							      </tr>
							    </thead>
								<tbody>
								    <?php 
							        foreach ($event_info as $key => $value) {
							           
							            ?>
							            <?php if($value['number_of_tickets'] >= 1){ ?>
							            <tr>
							                <td style="text-align: center;"><?php echo $value['ticket_type']; ?></td>
							                <td style="text-align: center;"><?php echo $value['number_of_tickets']; ?></td>
							                <td style="text-align: center;"><?php echo $value['ticket_amount']; ?></td>
							                <td style="text-align: center;"><?php echo ($value['ticket_amount'] * $value['number_of_tickets']); ?></td>
							            	<th style="text-align: center;">
							            		<a href="Ticket_prints?serial=<?php echo $value['serial_number'];?>">download</a> 
							            	</th>
							            </tr>
							            <?php
							            }
							        }
							        ?>

								</tbody>

							</table>
						</div>
					</div>
				</div>
				</div>
						
	</div>
	</div>	
</section>