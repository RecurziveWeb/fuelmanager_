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
			<strong>Failed! : <?php echo $this->session->flashdata('error'); ?></strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php }					  
         ?>
		<!-- error message end-->

		<?php
	$sriLankaDistricts = [
		'Ampara',
		'Anuradhapura',
		'Badulla',
		'Batticaloa',
		'Colombo',
		'Galle',
		'Gampaha',
		'Hambantota',
		'Jaffna',
		'Kalutara',
		'Kandy',
		'Kegalle',
		'Kilinochchi',
		'Kurunegala',
		'Mannar',
		'Matale',
		'Matara',
		'Moneragala',
		'Mullaitivu',
		'Nuwara Eliya',
		'Polonnaruwa',
		'Puttalam',
		'Ratnapura',
		'Trincomalee',
		'Vavuniya'
	];
	
?>

		<h5 class="card-header">Add fillingstation Details</h5>

		<hr class="my-0">
		<div class="card-body">
		<form method="POST" action="<?php echo base_url();?>index.php/fillingstation/save">

<div class="row">
	<div class="col-md-6">
		<input type="hidden" id="idfillingstation" name="idfillingstation" class="form-control"
			placeholder="Idfillingstation" maxlength="11" required>

		<div class="form-group mb-3">
			<label for="fillingstation_name" class="form-label"> Filling station name: </label>
			<input type="text" id="fillingstation_name" name="fillingstation_name" class="form-control"
				placeholder="Fillingstation name" minlength="0" maxlength="45">
		</div>

		<div class="form-group mb-3">
			<label for="fillingstation_address" class="form-label"> Filling station address: </label>
			<textarea cols="40" rows="5" id="fillingstation_address" name="fillingstation_address"
				class="form-control" placeholder="Fillingstation address" minlength="0"
				maxlength="450"></textarea>
		</div>

		<div class="form-group mb-3">
			<label for="numberoffueldespencers" class="form-label"> Number of fuel despencers: </label>
			<input type="number" id="numberoffueldespencers" name="numberoffueldespencers"
				class="form-control" placeholder="Numberoffueldespencers" minlength="0" maxlength="11">
		</div>

		<div class="form-group mb-3">
			<label for="capacityofpetroltank" class="form-label"> Capacity of petrol tank: </label>
			<input type="number" id="capacityofpetroltank" name="capacityofpetroltank" class="form-control"
				placeholder="Capacityofpetroltank" minlength="0" maxlength="11">
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group mb-3">
			<label for="capacityofdieseltank" class="form-label"> Capacity of diesel tank: </label>
			<input type="number" id="capacityofdieseltank" name="capacityofdieseltank" class="form-control"
				placeholder="Capacityofdieseltank" minlength="0" maxlength="11">
		</div>

		<div class="form-group mb-3">
			<label for="capacityofsuperpetrol" class="form-label"> Capacity of super petrol tank: </label>
			<input type"number" id="capacityofsuperpetrol" name="capacityofsuperpetrol"
				class="form-control" placeholder="Capacityofsuperpetrol" minlength="0" maxlength="11">
		</div>

		<div class="form-group mb-3">
			<label for="capacityofsuperdiesel" class="form-label"> Capacity of super diesel tank: </label>
			<input type="number" id="capacityofsuperdiesel" name="capacityofsuperdiesel"
				class="form-control" placeholder="Capacityofsuperdiesel" minlength="0" maxlength="11">
		</div>

		<div class="form-group mb-3">
			<label for="district" class="form-label"> District: </label>
			<select id="district" name="district" class="form-select">
				<?php foreach($sriLankaDistricts as $dname) { ?>
					<option value="<?php echo $dname; ?>"><?php echo $dname; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>

<!-- Hidden fields and the submit button -->
<input type="hidden" id="Users_idUsers" name="Users_idUsers" class="form-select"
	value="<?php if($this->session->has_userdata('user_id')){echo $this->session->user_id; } ?>" required>
<input type="hidden" value="0" id="isapproved" name="isapproved" class="form-select">
<input type="hidden" id="approvedby" name="approvedby" class="form-control"
	placeholder="Approvedby" minlength="0" maxlength="45" value="not_approved">
<input type="hidden" value="0" id="isdelete" name="isdelete" class="form-select" required>

<div class="mt-2">
	<button type="submit" class="btn btn-primary me-2">Save</button>
</div>
</form>

		</div>
	</div>
</div>
<script>
</script>