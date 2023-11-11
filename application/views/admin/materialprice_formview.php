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
		 
		 
      <h5 class="card-header">Add materialprice Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/materialprice/save">
          
              <input type="hidden" id="idmaterialprice" name="idmaterialprice" class="form-control" placeholder="Idmaterialprice" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="materialtype" class="form-label"> Materialtype: </label>
									<!-- <input type="text" id="materialtype" name="materialtype" class="form-control" placeholder="Materialtype" minlength="0"  maxlength="45" > -->
									<select id="materialtype" name="materialtype" class="form-select" >
										<option value="petrol">Petrol</option>
										<option value="deisel">Deisel</option>
										<option value="superpetrol">Super Petrol</option>
										<option value="superdeisel">Super Deisel</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="materialprice" class="form-label"> Materialprice: </label>
									<input type="number" id="materialprice" name="materialprice" class="form-control" placeholder="Materialprice" minlength="0"  maxlength="11" >									
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

 