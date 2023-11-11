<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">employee Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/employee/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New employee</a>
			   </div>
			   <br><br>
               <table id="employee" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idemployee</th>
<th>Epf</th>
<th>Isactive</th>
<th>Isavailable</th>
<th>Employeetype idemployeetype</th>
<th>Userid</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($employee as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idemployee;?></td>
<td><?=$row->epf;?></td>
<td><?=$row->isactive;?></td>
<td><?=$row->isavailable;?></td>
<td><?=$row->employeetype_idemployeetype;?></td>
<td><?=$row->userid;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/employee/edit/<?=$row->idemployee; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/employee/delete/<?=$row->idemployee; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#employee', {
   scrollX: true,
   scrollY: 350
   });
   
</script>