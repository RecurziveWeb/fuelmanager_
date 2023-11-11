<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">vehicle_type Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/vehicle_type/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New vehicle_type</a>
			   </div>
			   <br><br>
               <table id="vehicle_type" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idvehicle type</th>
<th>Vehicle capacity</th>
<th>Vehicle type</th>
<th>Vehicle type is active</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($vehicle_type as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idvehicle_type;?></td>
<td><?=$row->vehicle_capacity;?></td>
<td><?=$row->vehicle_type;?></td>
<td><?=$row->vehicle_type_is_active;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/vehicle_type/edit/<?=$row->idvehicle_type; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/vehicle_type/delete/<?=$row->idvehicle_type; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#vehicle_type', {
   scrollX: true,
   scrollY: 350
   });
   
</script>