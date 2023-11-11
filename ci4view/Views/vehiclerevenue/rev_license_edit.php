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
		 
		 
      <h5 class="card-header">Update Revenue License Details</h5>
      <!-- Account -->
	  <div class="row justify-content-end">
		<div class="col-sm-2"> 
			<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
				  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="1" >
				  <label class="btn btn-outline-success" for="btnradio1">Active</label>

				  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="0" >
				  <label class="btn btn-outline-danger" for="btnradio2">Inactive</label>
  
			</div>
			<br><br>
		</div>
	  </div>
	    
      <hr class="my-0">
	  <div class="card-body">
         <form id="formAccountSettings" method="POST" action="<?php echo base_url();?>VehicleRevenue/addType">
            <div class="row">
               <div class="mb-3 col-md-6">
                  <label for="revenue_license_name" class="form-label">Revenue License Name</label>
                  <input class="form-control" type="text" id="revenue_license_name" name="revenue_license_name" value=""  placeholder="License Name" autofocus="">
               </div>
			   <div class="mb-3 col-md-6">
                  <label for="vehicle_number" class="form-label">Vehicle Number</label>
                  <input class="form-control" type="text" id="vehicle_number" name="vehicle_number" value="Vehicle Number"  placeholder="" autofocus="">
               </div>
                         
               <div class="mb-3 col-md-6">
                  <label for="revenue_license_issue_date" class="form-label">Revenue License Issue Date</label>
                  <div class="col-md-10">
                     <input class="form-control" type="date" name="revenue_license_issue_date" value="2023-10-18" id="revenue_license_issue_date">
                  </div>
               </div>
			    <div class="mb-3 col-md-6">
                  <label for="revenue_license_exp_date" class="form-label">Revenue License Expiry Date</label>
                  <div class="col-md-10">
                     <input class="form-control" type="date" name="revenue_license_exp_date" value="2023-10-18" id="revenue_license_exp_date">
                  </div>
               </div>
                             
            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
               <a href="<?php echo site_url('VehicleRevenue'); ?>" class="btn btn-secondary">Back</a>
            </div>
         </form>
      </div>
      
      <!-- /Account -->
   </div>
</div>
<script>
</script>

 