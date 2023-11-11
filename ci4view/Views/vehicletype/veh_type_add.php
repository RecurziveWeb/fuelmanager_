 <div class="container-xxl flex-grow-1 container-p-y">
   <div class="card mb-4">
   
		<?php
		
			 if($this->session->flashdata('success')){
				 echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
						 <strong>Successfully Added </strong> 
						 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					  </div>';
			 }
			 if($this->session->flashdata('error')){
				 echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
						 <strong>Failed!</strong> 
						 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					  </div>';
			 }
		?>
   
		 
      <h5 class="card-header">Add Vehicle Type</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
         <form id="formAccountSettings" method="POST" action="<?php echo base_url();?>VehicleType/insertType">
            <div class="row">
               <div class="mb-3 col-md-6">
                  <label for="vehicle_capacity" class="form-label">Vehicle Capacity</label>
                  <input class="form-control" type="text" id="vehicle_capacity" name="vehicle_capacity" value=""  placeholder="Vehicle capacity ex: 6600" autofocus="">
               </div>
                         
               <div class="mb-3 col-md-6">
                  <label for="vehicle_type_name" class="form-label">Vehicle Type Name</label>
                  <input class="form-control" type="text" id="vehicle_type_name" name="vehicle_type_name" value="" placeholder="Vehicle Type name ex: 6600" autofocus="">
               </div>
                             
            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
               <a href="<?php echo site_url('VehicleType'); ?>" class="btn btn-secondary">Back</a>
            </div>
         </form>
      </div>
      <!-- /Account -->
   </div>
</div>
<script>
</script>

 