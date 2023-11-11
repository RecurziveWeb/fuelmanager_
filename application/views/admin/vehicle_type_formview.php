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
		 
		 
      <h5 class="card-header">Add vehicle_type Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/vehicle_type/save">
          
              <input type="hidden" id="idvehicle_type" name="idvehicle_type" class="form-control" placeholder="Idvehicle type" maxlength="11" required>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_capacity" class="form-label"> Vehicle capacity: </label>
									<input type="number" id="vehicle_capacity" name="vehicle_capacity" class="form-control" placeholder="Vehicle capacity" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_type" class="form-label"> Vehicle type: </label>
									<select id="vehicle_type" name="vehicle_type" class="form-select" >
										<option value="0">Bouser</option>
										<option value="1"></option>
									</select>
								</div>
							</div>
							<!-- <div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_type_is_active" class="form-label"> Vehicle type is active: </label>
									<select id="vehicle_type_is_active" name="vehicle_type_is_active" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div> -->
							<!-- <div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isdelete" class="form-label"> Isdelete: <span class="text-danger">*</span> </label>
									<select id="isdelete" name="isdelete" class="form-select" required>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div> -->

            
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
</script>

 