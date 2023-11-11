 <div class="container-xxl flex-grow-1 container-p-y">
   <div class="card mb-4">
   
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
		 
		 
      <h5 class="card-header">Update Vehicle Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
         <form id="formAccountSettings" method="POST" action="<?php echo base_url(); ?>vehicle/edit/<?php echo $vehicle_id; ?>">
            <div class="row">
               <div class="mb-3 col-md-6">
                  <label for="vehicle_number" class="form-label">Vehicle Number</label>
                  <input class="form-control" type="text" id="vehicle_number" name="vehicle_number" value="<?=$vehicles->vehicle_number?>" autofocus="">
               </div>
              <div class="mb-3 col-md-6">
   <label for="vehicle_capacity" class="form-label">Capacity</label>
   <select id="vehicle_capacity" name="vehicle_capacity" class="select2 form-select">
		 <option selected="">Select Capacity</option>
      <option value="6600" <?php if ($vehicles->vehicle_capacity == 6600) echo "selected"; ?>>6600</option>
      <option value="13200" <?php if ($vehicles->vehicle_capacity == 13200) echo "selected"; ?>>13200</option>
      <option value="19800" <?php if ($vehicles->vehicle_capacity == 19800) echo "selected"; ?>>19800</option>
      <option value="26400" <?php if ($vehicles->vehicle_capacity == 26400) echo "selected"; ?>>26400</option>
      <option value="33000" <?php if ($vehicles->vehicle_capacity == 33000) echo "selected"; ?>>33000</option>
   </select>
</div>

               <div class="mb-3 col-md-6">
                  <label for="calibration_certificate" class="form-label">Calibration Certificate</label>
                  <select id="calibration_certificate" name="calibration_certificate"  class="select2 form-select">
                     <option selected="">Select</option>
                     <option value="Pass">Pass</option>
                     <option value="Fail">Fail</option>
                  </select>
               </div>
               <div class="mb-3 col-md-6">
                  <label for="location" class="form-label">Location</label>
                  <select id="location" name="location"class="select2 form-select" >
                     <option selected="">Location</option>
                     <option value="<?=$vehicles->location?>">Kolonnawa</option>
                     <option value="<?=$vehicles->location?>">Muthurajawela</option>
                  </select>
               </div>
               <div class="mb-3 col-md-6">
                  <label for="license_expire" class="form-label">Revenue License Expiration</label>
                  <div class="col-md-10">
                     <input class="form-control" type="date" name="license_expire" value="<?=$vehicles->license_expire?>" id="license_expire">
                  </div>
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_chasis_no" class="form-label">Chasis Number</label>
                  <input class="form-control" type="text" id="vehicle_chasis_no" name="vehicle_chasis_no" value="<?=$vehicles->vehicle_chasis_no?>" autofocus="">
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_engine_no" class="form-label">Engine Number</label>
                  <input class="form-control" type="text" id="vehicle_engine_no" name="vehicle_engine_no" value="<?=$vehicles->vehicle_engine_no?>" autofocus="">
               </div>
               <div class="mb-3 col-md-6">
                  <label for="vehicle_manufacture_date" class="form-label">Year Of Manufacture</label>
                  <div class="col-md-10">
                     <input class="form-control" type="date" name="vehicle_manufacture_date" value="<?=$vehicles->vehicle_manufacture_date?>" id="vehicle_manufacture_date">
                  </div>
               </div>
               <div class="mb-3 col-md-6">
                  <label for="no_of_passengers" class="form-label">Number Of Passenger</label>
                  <select id="no_of_passengers" name="no_of_passengers"class="select2 form-select" ">
                     <option selected="">Select</option>
                     <option value="<?=$vehicles->no_of_passengers?>">2</option>
                     <option value="<?=$vehicles->no_of_passengers?>">3</option>
                  </select>
               </div>
            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Update</button>
               <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
         </form>
      </div>
      <!-- /Account -->
   </div>
</div>


 