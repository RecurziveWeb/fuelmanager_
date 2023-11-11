<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">vehicle_calibration_certificate Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/vehicle_calibration_certificate/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New vehicle_calibration_certificate</a>
			   </div>
			   <br><br>
               <table id="vehicle_calibration_certificate" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idvehicle calibration certificate</th>
<th>Vehicle calibration certificate name</th>
<th>Vehicle calibration certificate issue date</th>
<th>Vehicle calibration certificate expiry date</th>
<th>Vehicle calibration certificate is active</th>
<th>Vehicle idvehicle</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($vehicle_calibration_certificate as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idvehicle_calibration_certificate;?></td>
<td><?=$row->vehicle_calibration_certificate_name;?></td>
<td><?=$row->vehicle_calibration_certificate_issue_date;?></td>
<td><?=$row->vehicle_calibration_certificate_expiry_date;?></td>
<td><?=$row->vehicle_calibration_certificate_is_active;?></td>
<td><?=$row->vehicle_idvehicle;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/vehicle_calibration_certificate/edit/<?=$row->idvehicle_calibration_certificate; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/vehicle_calibration_certificate/delete/<?=$row->idvehicle_calibration_certificate; ?>" class="btn btn-sm btn-danger">Delete</a>
							</td>
						
						</tr>
						<?php } ?>
                     				                      
                    
                  </tbody>
               </table>
			   <?php
					 if($this->session->flashdata('message')) {?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Successfully Added </strong> 
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php }					  
					 ?>
					<?php
					 if($this->session->flashdata('error')){?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Failed!</strong> 
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php }					  
					 ?>
               
            </div>
         </div>
      </div>
   </div>
   <!-- Examples -->
</div>
<script>   
   new DataTable('#vehicle_calibration_certificate', {
   scrollX: true,
   scrollY: 350
   });
   
</script>