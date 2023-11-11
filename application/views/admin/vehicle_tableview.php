<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">vehicle Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/vehicle/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New vehicle</a>
			   </div>
			   <br><br>
               <table id="vehicle" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idvehicle</th>
<th>Vehicle number</th>
<th>Vehicle chasis number</th>
<th>Vehicle yom</th>
<th>Vehicle no of passengers</th>
<th>Vehicle weight</th>
<th>Vehicle is available</th>
<th>Vehicle is active</th>
<th>Vehicle type idvehicle type</th>
<th>Location idLocation</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($vehicle as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idvehicle;?></td>
<td><?=$row->vehicle_number;?></td>
<td><?=$row->vehicle_chasis_number;?></td>
<td><?=$row->vehicle_yom;?></td>
<td><?=$row->vehicle_no_of_passengers;?></td>
<td><?=$row->vehicle_weight;?></td>
<td><?=$row->vehicle_is_available;?></td>
<td><?=$row->vehicle_is_active;?></td>
<td><?=$row->vehicle_type_idvehicle_type;?></td>
<td><?=$row->Location_idLocation;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/vehicle/edit/<?=$row->idvehicle; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/vehicle/delete/<?=$row->idvehicle; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#vehicle', {
   scrollX: true,
   scrollY: 350
   });
   
</script>