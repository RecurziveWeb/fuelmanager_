<div class="container-xxl flex-grow-1 container-p-y">
   <div class="card mb-4">
   
   
   <!-- error message start-->
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
		<!-- error message end--> 
		 
		 
      <h5 class="card-header">Add users Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/users/save">
          
              <input type="hidden" id="idUsers" name="idUsers" class="form-control" placeholder="IdUsers" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="firstname" class="form-label"> Firstname: </label>
									<input type="text" id="firstname" name="firstname" class="form-control" placeholder="Firstname" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="lastname" class="form-label"> Lastname: </label>
									<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Lastname" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="email" class="form-label"> Email: </label>
									<input type="email" id="email" name="email" class="form-control" placeholder="Email" minlength="0"  maxlength="256" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="password" class="form-label"> Password: </label>
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" minlength="0"  maxlength="300" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isadmin" class="form-label"> Isadmin: </label>
									<select id="isadmin" name="isadmin" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isdealer" class="form-label"> Isdealer: </label>
									<select id="isdealer" name="isdealer" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isdriver" class="form-label"> Isdriver: </label>
									<select id="isdriver" name="isdriver" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="phonenumber" class="form-label"> Phonenumber: </label>
									<input type="text" id="phonenumber" name="phonenumber" class="form-control" placeholder="Phonenumber" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isdelete" class="form-label"> Isdelete: <span class="text-danger">*</span> </label>
									<select id="isdelete" name="isdelete" class="form-select" required>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>

            
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
</script>

 