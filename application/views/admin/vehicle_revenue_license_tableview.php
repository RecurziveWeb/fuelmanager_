<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">vehicle_revenue_license Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/vehicle_revenue_license/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New vehicle_revenue_license</a>
			   </div>
			   <br><br>
               <table id="vehicle_revenue_license" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idvehicle revenue license</th>
<th>Vehicle revenue license name</th>
<th>Vehicle revenue license issue date</th>
<th>Vehicle revenue license expiry date</th>
<th>Vehicle revenue license is active</th>
<th>Vehicle idvehicle</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($vehicle_revenue_license as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idvehicle_revenue_license;?></td>
<td><?=$row->vehicle_revenue_license_name;?></td>
<td><?=$row->vehicle_revenue_license_issue_date;?></td>
<td><?=$row->vehicle_revenue_license_expiry_date;?></td>
<td><?=$row->vehicle_revenue_license_is_active;?></td>
<td><?=$row->vehicle_idvehicle;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/vehicle_revenue_license/edit/<?=$row->idvehicle_revenue_license; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/vehicle_revenue_license/delete/<?=$row->idvehicle_revenue_license; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#vehicle_revenue_license', {
   scrollX: true,
   scrollY: 350
   });
   
</script>