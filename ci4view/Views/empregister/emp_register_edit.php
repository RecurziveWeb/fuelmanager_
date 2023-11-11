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
		 
		 
      <h5 class="card-header">Update Employee Register Details</h5>
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
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">First Name</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="" placeholder="john"autofocus="">
            </div>
            <div class="mb-3 col-md-6">
              <label for="lastName" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="lastName" id="lastName" value="" placeholder="jdoe">
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="" placeholder="john.doe@example.com">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Phone Number</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text">SL (+94)</span>
                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111">
              </div>
            </div>
			<div class="mb-3 col-md-6">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address">
            </div>
			<div class="mb-3 col-md-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
            <div class="form-password-toggle">
              <label class="form-label" for="formValidationPass">Password</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" id="formValidationPass" name="formValidationPass" placeholder="············" aria-describedby="multicol-password2">
                <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
          </div>
            
			<div class="mb-3 col-md-6 fv-plugins-icon-container fv-plugins-bootstrap5-row-invalid">
            <div class="form-password-toggle">
              <label class="form-label" for="formValidationConfirmPass">Confirm Password</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control is-invalid" type="password" id="formValidationConfirmPass" name="formValidationConfirmPass" placeholder="············" aria-describedby="multicol-confirm-password2">
                <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"><div data-field="formValidationConfirmPass" data-validator="identical">The password and its confirm are not the same</div><div data-field="formValidationConfirmPass" data-validator="notEmpty">Please confirm password</div></div>
            </div>
          </div>
            <div class="mb-3 col-md-6">
              <label for="state" class="form-label">District</label>
              <input class="form-control" type="text" id="state" name="state" placeholder="Gampaha">
            </div>
			 <div class="mb-3 col-md-6">
              <label for="tank" class="form-label">Gender</label>
              <select id="tank" class="select2 form-select">
                <option value="">Male</option>
                <option value="usd">Female</option>
              </select>
            </div>
                        
            <div class="mb-3 col-md-6">
                 <label for="html5-date-input" class="col-md-2 col-form-label">Date of birth</label>
            <div class="col-md-12">
                <input class="form-control" type="date" value="2023-09-12" id="html5-date-input">
           </div>
           </div>
      
      <!-- /Account -->
   </div>
</div>
</div>
</div>
<script>
</script>

 