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
		 
		 
      <h5 class="card-header">Add orderitems Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/orderitems/save">
          
              <input type="hidden" id="idorderitems" name="idorderitems" class="form-control" placeholder="Idorderitems" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="itemname" class="form-label"> Itemname: </label>
									<input type="text" id="itemname" name="itemname" class="form-control" placeholder="Itemname" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="qty" class="form-label"> Qty: </label>
									<input type="number" id="qty" name="qty" class="form-control" placeholder="Qty" minlength="0"  >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="itemamount" class="form-label"> Itemamount: </label>
									<input type="number" id="itemamount" name="itemamount" class="form-control" placeholder="Itemamount" minlength="0"  >
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="orders_idorders" class="form-label"> Orders idorders: <span class="text-danger">*</span> </label>
							<select id="orders_idorders" name="orders_idorders" class="form-select" required>
								<?php foreach($selectdata_orders as $data){ ?>
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

 