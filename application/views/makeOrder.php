<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=1858867537757998&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<section class="section-page-content">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
					<div class="section-order-details-event-title">
					<div class="section-header">
						<h2 class="event-title"><strong><?php echo $makeOrder[0]["event_title"]?></strong></h2>
						<!--<a href="#">Get your Ticket now</a>-->
					</div>
						
					</div>

				<div class="col-md-4">
				<div class="section-order-details-event-title">
							
                        <img class="event-img" src="<?php echo $makeOrder[0]["cover_image"]?>" width="100%" height="50%">

                    <!-- 	<?php 
						if ($makeOrder[0]["sponsor_logo"]) {
							?>
							<div class="col-md-12">Sponsors &  Partners
							<img src="<?php //echo $makeOrder[0]["sponsor_logo"]?>" width="100%" height="100%">
							</div>
							<?php
						}
						?> -->

						<form method="post" >
								<ul style="text-align: right; padding-top: 30px">
									<li>
										<?php	
										       $eventTitle=urlencode($makeOrder[0]["event_title"]);
										       $twitter_title=urlencode('Hello grab your tickets for the ');								
										       $Ftitle=urlencode($makeOrder[0]["event_title"].' event. ');
										       $url=urlencode(' '.base_url().'index.php/event?me='.$_GET['me']);
										       $image=urlencode($makeOrder[0]["cover_image"]);
										?>

										
										<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
										<i class="fa fa-facebook" aria-hidden="true" style="background:#2c4aa0;width: 20px;height: 20px;line-height: 20px;font-size: 13px;text-align: center;margin: 0 7px 0 0;color:#fff;"></i>
										Facebook</a>				
																						
										<a class="twitter-share-button"
										  href="https://twitter.com/intent/tweet?text=<?php echo $twitter_title; echo $eventTitle; echo $url;?>"
										  data-size="large" target="_blank">
										<i class="fa fa-twitter" aria-hidden="true" style="background:#00b7f1;width: 20px;height: 20px;line-height: 20px;font-size: 13px;text-align: center;margin: 0 7px 0 0;color:#fff;"></i>
										Twitter
										</a>
																							
										<a href="whatsapp://send?text=<?php echo $twitter_title; echo $eventTitle; echo $url;?>">
										<i class="fa fa-whatsapp" aria-hidden="true" style="background:#00E34A;width: 20px;height: 20px;line-height: 20px;font-size: 13px;text-align: center;margin: 0 7px 0 0;color:#fff;"></i>
										WhatsApp
										</a>
									</li>
								</ul>
								</form>
				</div>
				</div>

				<div class="col-md-8">
					<div class="section-order-details-event-info">
						<div class="venue-details">
							<div class="venue-details-info">
							<h3>Venue & Event Information</h3>
								<p>Venue: <?php echo $makeOrder[0]["event_venue"]?></p>
								<p>On <span><?php echo $makeOrder[0]["event_date"];?></span></p>
							</div>
						</div>

						<div class="seat-details">
							<div class="seat-details-info">
							<h3>Event Information</h3>
								<p><?php echo $makeOrder[0]["event_description"]?></p>
							</div>
						</div>
					</div>

					

				</div>
				</div>
				</div>

				<div class="row">
				<div class="col-md-12">
				<form method="post" action="reviewOrder" accept-charset="utf-8">
					<div id="book-table" class="section-order-details-event-info">
							<div class="seat-details">
								<h3 class="event-title">Kindly indicate how many tickets you wish to reserve
								</h3>
								
								<div class="seat-details-info" style="padding:5px 0px !important">
									<table class="table number-tickets table table-striped">
										<thead>
											<tr>
												<th style="padding:0 22px 5px;">Ticket</th>
												<th style="padding:0 22px 5px;">Unit Cost</th>
												<th style="padding:0 22px 5px;">Quantity</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										$count = 0;
										foreach ($ticketType as $ticketTypes) {
											$count++;
											?>
										<tr>
											<td>
												<?php echo($ticketTypes['type_name']);?>
												<input type="hidden" name="" id="<?php echo "ticket_type".$count; ?>" value="<?php echo($ticketTypes['ticket_type']);?>">
											</td>
											<td>
												<?php echo("Ksh. ".$ticketTypes['amount']);?>
												<input type="hidden" name="" id="<?php echo "amount".$count; ?>" value="<?php echo($ticketTypes['amount']);?>">
											</td>
											<td>
												<?php if ($ticketTypes['available_tickets'] < 1): ?> <!--check available tickets-->
														<span class='label bg-danger'>SOLD OUT</span>
												<?php elseif ($ticketTypes['ticket_close_on'] < date("Y-m-d")): ?> <!--check date closing-->
														<span class='label bg-danger'>SOLD OUT</span>
												<?php else: ?>	
												<select name="<?php echo $count; ?>" id="<?php echo "select".$count; ?>" onchange="myPrice()">
												  
												  <?php 
												  	$tickets_leng = 10;
												  	if ($ticketTypes['available_tickets'] < 10) {
												  		$tickets_leng = $ticketTypes['available_tickets'];
												  	}
												  	for ($i=0; $i <= $tickets_leng; $i++) { ?>
												  		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												  		<?php
												  	}
												  ?>
												</select>
												<?php endif ?>	
											</td>
										</tr>
										<?php  
										}
										?>

										</tbody>
									</table>
								</div>

								<div class="seat-details-info-price" style="border: 0px;">
									<table class="table pricing-review">
										<tbody>
											<tr>
												
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td></td>
												<td class="price" id="totalPrice">Total Price KES 0</td>
											</tr>
											<tr><td></td>

												<?php if ($ticketTypes['available_tickets'] < 1 
												|| $ticketTypes['ticket_close_on'] < date("Y-m-d")) : ?>

												<?php else: ?>
													<td class="price" align="right">
													<button type="submit"  class="primary-link btn btn-large btn-block btn-primary">  Buy Ticket </button>
													<!-- onclick="process()" -->
													</td>

												<?php endif; ?>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						</form>
					</div>
					</div>
		</div>
		</section>

		<section class="section-page-header">
			<div class="container">
			<div class="row">
				<div id="secondary" class="col-md-12">
					<div id="disqus_thread"></div>
					<script>
					    /**
					     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
					     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
					     */
					    /*
					    var disqus_config = function () {
					        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
					        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
					    };
					    */
					    (function() {  // DON'T EDIT BELOW THIS LINE
					        var d = document, s = d.createElement('script');

					        s.src = 'https://our-chat-room.disqus.com/embed.js';

					        s.setAttribute('data-timestamp', +new Date());
					        (d.head || d.body).appendChild(s);
					    })();
					</script>
	<!-- <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript> -->
				</div>
			</div>
        </section>


<script>
var count = <?php echo $count?>;
function myPrice() {
	var tickets = []
	for (var i = 1; i <= count; i++) {
		tickets[i] = Number(document.getElementById("select"+i).value * document.getElementById("amount"+i).value);
	}

	var sum = tickets.reduce(function(a, b) { return a + b; }, 0);
	document.getElementById("totalPrice").innerHTML = "Total Price    KES. " + sum;
	
	// var ticket1 = document.getElementById("ticket1").value;
	// var ticket2 = document.getElementById("ticket2").value;
	// var ticket3 = document.getElementById("ticket3").value;
	// var ticket4 = document.getElementById("ticket4").value;
	// var ticket5 = document.getElementById("ticket5").value;
    
	// // get price
	// var ticket1 = Number(ticket1*1000);
	// var ticket2 = Number(ticket2*1000);
	// var ticket3 = Number(ticket3*1000);
	// var ticket4 = Number(ticket4*1000);
	// var ticket5 = Number(ticket5*3500);
	// var price_ticket = Number(ticket1+ticket2+ticket3+ticket4+ticket5);
    
 //    document.getElementById("totalPrice").innerHTML = "KES " + price_ticket;
}


// function process()
// {

// 	var data = []
// 	for (var i = 1; i <= count; i++) {
// 		data[i] = document.getElementById("select"+i).value +" "+ document.getElementById("amount"+i).value;
// 	}

// 	var sum = data.reduce(function(a, b) { return a + b; }, 0);

// 	if(sum){
// 		alert(data);
// 	}else{
// 		alert("error proccessing");
// 	}

// }
</script>