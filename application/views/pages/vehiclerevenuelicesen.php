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
		 
		 
      <h5 class="card-header">Add vehicle_revenue_license Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/vehicle/certificate/revenuelicesen/save">
          
              <input type="hidden" id="idvehicle_revenue_license" name="idvehicle_revenue_license" class="form-control" placeholder="Idvehicle revenue license" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_revenue_license_name" class="form-label"> Vehicle revenue license name: </label>
									<input type="text" id="vehicle_revenue_license_name" name="vehicle_revenue_license_name" class="form-control" placeholder="Vehicle revenue license name" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_revenue_license_issue_date" class="form-label"> Vehicle revenue license issue date: </label>
									<input type="date" id="vehicle_revenue_license_issue_date" name="vehicle_revenue_license_issue_date" class="form-control" dateISO="true" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="vehicle_revenue_license_expiry_date" class="form-label"> Vehicle revenue license expiry date: </label>
									<input type="date" id="vehicle_revenue_license_expiry_date" name="vehicle_revenue_license_expiry_date" class="form-control" dateISO="true" >
								</div>
							</div>
							
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="vehicle_idvehicle" class="form-label"> Vehicle : <span class="text-danger">*</span> </label>
							<select id="vehicle_idvehicle" name="vehicle_idvehicle" class="form-select" required>
								<?php foreach($vehicle as $data){ ?>
									<option value="<?php echo $data->idvehicle; ?>"><?php echo $data->vehicle_number; ?></option>
								<?php } ?>
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

 