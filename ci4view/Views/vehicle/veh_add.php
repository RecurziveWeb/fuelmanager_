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
		 
		 
      <h5 class="card-header">Add Vehicle Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
         <form id="formAccountSettings" method="POST" action="<?php echo base_url();?>vehicle/addVehicle">
            <div class="row">
               <div class="mb-3 col-md-6">
                  <label for="vehicle_number" class="form-label">Vehicle Number</label>
                  <input class="form-control" type="text" id="vehicle_number" name="vehicle_number" value="Number" autofocus="">
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_capacity" class="form-label">Capacity</label>
                  <select id="vehicle_capacity" name="vehicle_capacity" class="select2 form-select">
                     <option selected="">Select Capacity</option>
                     <option value="6600">6600</option>
                     
                  </select>
               </div>
              
               <div class="mb-3 col-md-6">
                  <label for="location" class="form-label">Location</label>
                  <select id="location" name="location"class="select2 form-select">
                     <option selected="">Location</option>
                     <option value="Kolonnawa">Kolonnawa</option>
                     
                  </select>
               </div>
			   <div class="mb-3 col-md-6">
                  <label for="vehicle_weight" class="form-label">Weight</label>
                  <input class="form-control" type="text" id="vehicle_weight" name="vehicle_weight" value="" autofocus="">
               </div>
              
               <div class="mb-3 col-md-6">
                  <label for="vehicle_chasis_no" class="form-label">Chasis Number</label>
                  <input class="form-control" type="text" id="vehicle_chasis_no" name="vehicle_chasis_no" value="Chasis Number" autofocus="">
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_engine_no" class="form-label">Engine Number</label>
                  <input class="form-control" type="text" id="vehicle_engine_no" name="vehicle_engine_no" value="Engine Number" autofocus="">
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_manufacture_date" class="form-label">Year Of Manufacture</label>
                  <div class="col-md-10">
                     <input class="form-control" type="date" name="vehicle_manufacture_date" value="2021-06-18" id="vehicle_manufacture_date">
                  </div>
               </div>
               <div class="mb-3 col-md-6">
                  <label for="no_of_passengers" class="form-label">Number Of Passenger</label>
                  <select id="no_of_passengers" name="no_of_passengers"class="select2 form-select">
                     <option selected="">Select</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                  </select>
               </div>
            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
               <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
         </form>
      </div>
      <!-- /Account -->
   </div>
</div>
<script>
</script>

 