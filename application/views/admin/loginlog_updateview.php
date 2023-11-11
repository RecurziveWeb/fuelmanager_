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
		 
		 
      <h5 class="card-header">Add loginlog Details</h5>
      
      <hr class="my-0">
      <div class="card-body">
         <form method="POST" action="<?php echo base_url();?>index.php/loginlog/update/<?php echo $primaryid; ?>">
            <div class="row">
            <input type="hidden" id="idloginlog" name="idloginlog" class="form-control" placeholder="Idloginlog" maxlength="11" required>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="logindate" class="form-label"> Logindate: </label>
									<input type="date" id="logindate" name="logindate" class="form-control" dateISO="true"  value="<?php echo $loginlog->logindate; ?>">
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="Users_idUsers" class="form-label"> Users idUsers: <span class="text-danger">*</span> </label>
							<select id="Users_idUsers" name="Users_idUsers" class="form-select" required>
								<?php foreach($users as $data){ ?>
									if(strcmp($loginlog->Users_idUsers,$data->keyid)==0){
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
									<label for="otpcode" class="form-label"> Otpcode: </label>
									<input type="text" id="otpcode" name="otpcode" class="form-control" value="<?php echo $loginlog->otpcode; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="iscorrect" class="form-label"> Iscorrect: </label>
									<select id="iscorrect" name="iscorrect" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
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

 