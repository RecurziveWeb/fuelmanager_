 <div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">Vehicle Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>vehicle/addVehicle" class="btn btn-info"><i class="fa fa-pencil"></i> Add New Vehicle</a>
			   </div>
			   <br><br>
               <table id="vehicle" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Vehicle Number</th>
                        <th>Capacity</th>
                        <th>Created Date</th>
						<th>Status</th>
						<th>Availability</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($vehicle as $row) {?>
						<tr>
							<td><?=$i++?></td>
							<td><?=$row['vehicle_number']?></td>
							<td><?=$row['vehicle_capacity']?></td>
							<td><?=$row['created_date']?></td>
							<td><?=$row['status']?></td>
							<td><?=$row['vehicle_is_available']?></td>
							<td>
								<a href="<?php echo base_url();?>vehicle/edit/<?=$row['vehicle_id']?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>vehicle/edit/<?=$row['vehicle_id']?>" class="btn btn-sm btn-danger">Delete</a>
							
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
   
   new DataTable('#vehicle', {
   scrollX: true,
   scrollY: 350
   });
   
</script>