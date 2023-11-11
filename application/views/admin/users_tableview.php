<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">users Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/users/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New users</a>
			   </div>
			   <br><br>
               <table id="users" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>IdUsers</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
<th>Password</th>
<th>Isadmin</th>
<th>Isdealer</th>
<th>Isdriver</th>
<th>Phonenumber</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($users as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idUsers;?></td>
<td><?=$row->firstname;?></td>
<td><?=$row->lastname;?></td>
<td><?=$row->email;?></td>
<td><?=$row->password;?></td>
<td><?=$row->isadmin;?></td>
<td><?=$row->isdealer;?></td>
<td><?=$row->isdriver;?></td>
<td><?=$row->phonenumber;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/users/edit/<?=$row->idUsers; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/users/delete/<?=$row->idUsers; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#users', {
   scrollX: true,
   scrollY: 350
   });
   
</script>