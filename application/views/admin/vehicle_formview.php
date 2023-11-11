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
		 
		 
      <h5 class="card-header">Add vehicle Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/vehicle/save">
          
              <input type="hidden" id="idvehicle" name="idvehicle" class="form-control" placeholder="Idvehicle" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_number" class="form-label"> Vehicle number: </label>
									<input type="text" id="vehicle_number" name="vehicle_number" class="form-control" placeholder="Vehicle number" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_chasis_number" class="form-label"> Vehicle chasis number: </label>
									<input type="text" id="vehicle_chasis_number" name="vehicle_chasis_number" class="form-control" placeholder="Vehicle chasis number" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_yom" class="form-label"> Vehicle yom: </label>
									<input type="date" id="vehicle_yom" name="vehicle_yom" class="form-control" dateISO="true" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_no_of_passengers" class="form-label"> Vehicle no of passengers: </label>
									<input type="number" id="vehicle_no_of_passengers" name="vehicle_no_of_passengers" class="form-control" placeholder="Vehicle no of passengers" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_weight" class="form-label"> Vehicle weight: </label>
									<input type="number" id="vehicle_weight" name="vehicle_weight" class="form-control" placeholder="Vehicle weight" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_is_available" class="form-label"> Vehicle is available: </label>
									<select id="vehicle_is_available" name="vehicle_is_available" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_is_active" class="form-label"> Vehicle is active: </label>
									<select id="vehicle_is_active" name="vehicle_is_active" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="vehicle_type_idvehicle_type" class="form-label"> Vehicle type idvehicle type: <span class="text-danger">*</span> </label>
							<select id="vehicle_type_idvehicle_type" name="vehicle_type_idvehicle_type" class="form-select" required>
								<?php foreach($selectdata_vehicle_type as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="Location_idLocation" class="form-label"> Location idLocation: <span class="text-danger">*</span> </label>
							<select id="Location_idLocation" name="Location_idLocation" class="form-select" required>
								<?php foreach($selectdata_location as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
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

 