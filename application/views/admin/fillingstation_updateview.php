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
		 
		 
      <h5 class="card-header">Add fillingstation Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/fillingstation/update/<?php echo $primaryid; ?>">
            <div class="row">
            <input type="hidden" id="idfillingstation" name="idfillingstation" class="form-control" placeholder="Idfillingstation" maxlength="11" required>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="fillingstation_name" class="form-label"> Fillingstation name: </label>
									<input type="text" id="fillingstation_name" name="fillingstation_name" class="form-control" value="<?php echo $fillingstation->fillingstation_name; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="fillingstation_address" class="form-label"> Fillingstation address: </label>
									<textarea cols="40" rows="5" id="fillingstation_address" name="fillingstation_address" class="form-control"><?php echo $fillingstation->fillingstation_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="numberoffueldespencers" class="form-label"> Numberoffueldespencers: </label>
									<input type="number" id="numberoffueldespencers" name="numberoffueldespencers" class="form-control" value="<?php echo $fillingstation->numberoffueldespencers; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofpetroltank" class="form-label"> Capacityofpetroltank: </label>
									<input type="number" id="capacityofpetroltank" name="capacityofpetroltank" class="form-control" value="<?php echo $fillingstation->capacityofpetroltank; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofdieseltank" class="form-label"> Capacityofdieseltank: </label>
									<input type="number" id="capacityofdieseltank" name="capacityofdieseltank" class="form-control" value="<?php echo $fillingstation->capacityofdieseltank; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofsuperpetrol" class="form-label"> Capacityofsuperpetrol: </label>
									<input type="number" id="capacityofsuperpetrol" name="capacityofsuperpetrol" class="form-control" value="<?php echo $fillingstation->capacityofsuperpetrol; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofsuperdiesel" class="form-label"> Capacityofsuperdiesel: </label>
									<input type="number" id="capacityofsuperdiesel" name="capacityofsuperdiesel" class="form-control" value="<?php echo $fillingstation->capacityofsuperdiesel; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="district" class="form-label"> District: </label>
									<input type="text" id="district" name="district" class="form-control" value="<?php echo $fillingstation->district; ?>">
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="Users_idUsers" class="form-label"> Users idUsers: <span class="text-danger">*</span> </label>
							<select id="Users_idUsers" name="Users_idUsers" class="form-select" required>
								<?php foreach($users as $data){ ?>
									if(strcmp($fillingstation->Users_idUsers,$data->keyid)==0){
										<option value="<?php echo $data->keyid; ?>" selected><?php echo $data->keyvalue; ?></option>
									}else{
										<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>	
									}
									
								<?php } ?>
							</select>
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
									<label for="approvedby" class="form-label"> Approvedby: </label>
									<input type="text" id="approvedby" name="approvedby" class="form-control" value="<?php echo $fillingstation->approvedby; ?>">
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

 