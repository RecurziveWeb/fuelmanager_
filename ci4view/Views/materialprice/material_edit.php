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
		 
		 
      <h5 class="card-header">Update Material Price</h5>
      <!-- Account -->
	  <div class="row justify-content-end">
		<div class="col-sm-2"> 
			<div class="form-check">
				<?php 
				if($vehicle_type_is_active == 'Active'){
					echo '<input class="form-check-input" type="checkbox" name="vehicle_type_is_active[]" value="Active" id="vehicle_type_is_active" checked>';
				}
				else{
					echo '<input class="form-check-input" type="checkbox" name="vehicle_type_is_active[]" value="Inactive" id="vehicle_type_is_active">';
				}
				
				?>
			  <label class="form-check-label" for="flexCheckDefault">
				Active/Inactive
			  </label>
			</div>
			
		</div>
	  </div>
	    
     <hr class="my-0">
      <div class="card-body">
         <form id="formAccountSettings" method="POST" action="<?php echo base_url();?>VehicleType/insertType">
            <div class="row">
               <div class="mb-3 col-md-6">
                  <label for="materialtype" class="form-label">Material Type</label>
                  <input class="form-control" type="text" id="materialtype" name="materialtype" value=""  placeholder="materialtype" autofocus="">
               </div>
                         
               <div class="mb-3 col-md-6">
                  <label for="materialprice" class="form-label">Material Price</label>
                  <input class="form-control" type="text" id="materialprice" name="materialprice" value="" placeholder=" " autofocus="">
               </div>
                             
            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
               <a href="<?php echo site_url('MaterialPrice'); ?>" class="btn btn-secondary">Back</a>
            </div>
         </form>
      </div
      <!-- /Account -->
   </div>
</div>
<script>
</script>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>








