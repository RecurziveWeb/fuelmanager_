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
		 
		 
      <h5 class="card-header">Add employee Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/employee/save">
          
              <input type="hidden" id="idemployee" name="idemployee" class="form-control" placeholder="Idemployee" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="epf" class="form-label"> Epf: </label>
									<input type="text" id="epf" name="epf" class="form-control" placeholder="Epf" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isactive" class="form-label"> Isactive: </label>
									<select id="isactive" name="isactive" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isavailable" class="form-label"> Isavailable: </label>
									<select id="isavailable" name="isavailable" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="employeetype_idemployeetype" class="form-label"> Employeetype idemployeetype: <span class="text-danger">*</span> </label>
							<select id="employeetype_idemployeetype" name="employeetype_idemployeetype" class="form-select" required>
								<?php foreach($selectdata_employeetype as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="userid" class="form-label"> Userid: <span class="text-danger">*</span> </label>
									<input type="number" id="userid" name="userid" class="form-control" placeholder="Userid" minlength="0"  maxlength="11" required>
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

 