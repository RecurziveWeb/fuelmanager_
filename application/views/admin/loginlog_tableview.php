<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">loginlog Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/loginlog/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New loginlog</a>
			   </div>
			   <br><br>
               <table id="loginlog" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idloginlog</th>
<th>Logindate</th>
<th>Users idUsers</th>
<th>Otpcode</th>
<th>Iscorrect</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($loginlog as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idloginlog;?></td>
<td><?=$row->logindate;?></td>
<td><?=$row->Users_idUsers;?></td>
<td><?=$row->otpcode;?></td>
<td><?=$row->iscorrect;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/loginlog/edit/<?=$row->idloginlog; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/loginlog/delete/<?=$row->idloginlog; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#loginlog', {
   scrollX: true,
   scrollY: 350
   });
   
</script>