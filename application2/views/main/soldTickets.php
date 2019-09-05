<!-- Basic datatable -->
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">Sold Tickets</h5>
	</div>

	<div class="panel-body"></div>



	<table class="table datatable-basic">
		<thead>
			<tr>
				<th>Client Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Order id</th>
				<th>Ticket Type</th>
				<th>Ticket Amount</th>
				<th>No. of Tickets</th>
                <th>Status</th>
			</tr>
		</thead>
		<tbody>

		<?php 
			foreach ($tickets as $key => $value) {?>
			<tr>
				<td><?php echo($value['clientName']); ?></td>
				<td><?php echo($value['phone']); ?></td>
				<td><?php echo($value['email']); ?></td>
				<td><?php echo($value['order_id']); ?></td>
				<td><?php echo($value['ticket_type']); ?></td>
				<td><?php echo($value['ticket_amount']); ?></td>
				<td><?php echo($value['number_of_tickets']); ?></td>
              <td>
					<?php 
					if ($value['transaction_status'] == "PENDING") {
						?><span class='label bg-danger'><?php echo($value['transaction_status']);?></span><?php
					}
					if ($value['transaction_status'] == "SUCCESS") {
					?><span class='label bg-success'><?php echo($value['transaction_status']);?></span><?php
					}
					if ($value['transaction_status'] == "OVERPAID") {
					?><span class='label bg-success'><?php echo($value['transaction_status']);?></span><?php
					}
					
					?>
				</td>
			</tr>
			<?php 
			}
		?>
		</tbody>
	</table>
</div>
<!-- /basic datatable -->