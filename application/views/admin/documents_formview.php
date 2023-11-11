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
		 
		 
      <h5 class="card-header">Add documents Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/documents/save">
          
              <input type="hidden" id="iddocuments" name="iddocuments" class="form-control" placeholder="Iddocuments" maxlength="11" required>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="type" class="form-label"> Type: </label>
									<select id="type" name="type" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="filename" class="form-label"> Filename: </label>
									<input type="text" id="filename" name="filename" class="form-control" placeholder="Filename" minlength="0"  maxlength="450" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="uploaddate" class="form-label"> Uploaddate: </label>
									<input type="date" id="uploaddate" name="uploaddate" class="form-control" dateISO="true" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isapproved" class="form-label"> Isapproved: </label>
									<select id="isapproved" name="isapproved" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="fillingstation_idfillingstation" class="form-label"> Fillingstation idfillingstation: <span class="text-danger">*</span> </label>
							<select id="fillingstation_idfillingstation" name="fillingstation_idfillingstation" class="form-select" required>
								<?php foreach($selectdata_fillingstation as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="approvedby" class="form-label"> Approvedby: </label>
									<input type="text" id="approvedby" name="approvedby" class="form-control" placeholder="Approvedby" minlength="0"  maxlength="45" >
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

 