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
		 
		 
      <h5 class="card-header">Add paymentmethod Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/paymentmethod/update/<?php echo $primaryid; ?>">
            <div class="row">
            <input type="hidden" id="idpaymentmethod" name="idpaymentmethod" class="form-control" placeholder="Idpaymentmethod" maxlength="11" required>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="method_name" class="form-label"> Method name: </label>
									<input type="text" id="method_name" name="method_name" class="form-control" value="<?php echo $paymentmethod->method_name; ?>">
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

            </div>
            <div class="mt-2">
               <button type="submit" class="btn btn-primary me-2">Save</button>
               <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
</script>

 