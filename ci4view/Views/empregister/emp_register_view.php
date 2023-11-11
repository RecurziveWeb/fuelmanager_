 <div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">Registered user Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>VehicleCalibration/add" class="btn btn-info"><i class="fa fa-pencil"></i> Add New Employee Details</a>
			   </div>
			   <br><br>
               <table id="vehicle_calibrate" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Vehicle Number</th>
                        <th>Calibration Certificate Name</th>
						<th>Issued Date</th>
						<th>Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
						/* <?php $i=1; foreach($vehicletype as $row) {?>  */
						<tr>
							<td><?=$i++?></td>
							<td><?=$row['vehicle_capacity']?></td>
							<td><?=$row['vehicle_type_name']?></td>
							<td><?=$row['vehicle_type_name']?></td>
							<td><?=$row['vehicle_type_name']?></td>
							<td>
								<?php
								if ($row['vehicle_type_is_active'] == 1) 
								{
									echo ' <span class="badge rounded-pill bg-success">Active</span>';
								} 
								else 
								{
									echo '<span class="badge rounded-pill bg-danger">Inactive</span>';
								}
								?>
							</td>
							<td>
								<a href="<?php echo base_url();?>VehicleType/editType/<?=$row['vehicle_type_id']?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>VehicleType/editType/<?=$row['vehicle_type_id']?>" class="btn btn-sm btn-danger">Delete</a>
							
							</td>
						
						</tr>
						<?php } ?>
                     				                      
                    
                  </tbody>
               </table>
			   <?php
					 if($this->session->flashdata('success')) {?>
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
   /*$(document).ready( function () {
       $('example').DataTable();
   
   } );*/
   
   new DataTable('#vehicle_calibrate', {
   scrollX: true,
   scrollY: 350
   });
   
</script>