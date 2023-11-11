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
   
		 
      <h5 class="card-header">Add Material Price</h5>
      <!-- Account -->
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
      </div>
      <!-- /Account -->
   </div>
</div>
<script>
</script>

 