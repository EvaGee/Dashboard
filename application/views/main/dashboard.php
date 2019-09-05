<!-- Main content -->
<div class="content-wrapper">
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Manage Event</h6>			
		</div> 
		<table id="" class="table datatable-basic">
            <tr>
            	<br>
                <td class="admin-report">
                  <a href="<?php echo base_url(); ?>index.php/my-event">
                  	<div><img src="/assets/images/search.png" style="width: 100px;"></div>
                  	<div><button>VIEW EVENTS</button></div>
                  </a>
                </td>
                <?php
                  if ($this->session->userdata('role') == 1) {      
                  ?>
                  <td class="admin-report">
                  <a href="<?php echo base_url(); ?>index.php/pending-event">
                    <div><img src="/assets/images/pending-512.png" style="width: 100px;"></div>
                  	<div><button>PENDING EVENTS</button></div>
                  </a>
                  </td>
                  <td class="admin-report">
                  <a href="<?php echo base_url(); ?>index.php/Welcome/approved_events">
                    <div><img src="/assets/images/approved.png" style="width: 100px;"></div>
                  	<div><button>APPROVED EVENTS</button></div>
                  	</a>
                  </td>
                  <td class="admin-report">
                  <a href="<?php echo base_url(); ?>index.php/Welcome/rejected_events">
                    <div><img src="/assets/images/slash-512.png" style="width: 100px;"></div>
                  	<div><button>REJECTED EVENTS</button></div>
                  </a>
                  </td>
                  <td class="admin-report">
                  <a href="<?php echo base_url(); ?>index.php/Welcome/rejected_events">
                    <div><img src="/assets/images/past.png" style="width: 100px;"></div>
                  	<div><button>PAST EVENTS</button></div>
                  </a>
                  </td>
                <?php } ?>
                </tr>
        </table>

	</div>

</div>
