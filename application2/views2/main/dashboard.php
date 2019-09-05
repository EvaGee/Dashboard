<!-- Main content -->
<div class="content-wrapper">
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Manage Event</h6>			
		</div> 
        <table id="approval" class="table datatable-basic">
            <tr>
                <td>
                  <a href="<?php echo base_url()?>index.php/my-event"><button><span>VIEW EVENTS</span></button></a>
                </td>
                <td>
                  <?php
                  if ($this->session->userdata('role') == 1) {			
                  ?>
                  <a href="<?echo base_url(); ?>index.php/pending-event"><button><span>PENDING EVENTS</span></button></a>
                </td>
            </tr>
        </table>

	<?php } ?>

	</div>

</div>

