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

        <h5 class="card-header">Filling Station Request Document</h5>

        <hr class="my-0">
        <div class="card-body">
        <form method="POST" action="<?php echo base_url(); ?>index.php/fillingstation/approve/<?php echo $fillingstation[0]->idfillingstation; ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="fillingstation_name" class="form-label"> Fillingstation name: <?php echo $fillingstation[0]->fillingstation_name; ?></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="fillingstation_address" class="form-label"> Fillingstation address: <?php echo $fillingstation[0]->fillingstation_address; ?></label>
            </div> 
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="numberoffueldespencers" class="form-label"> Number of fuel dispensers: <?php echo $fillingstation[0]->numberoffueldespencers; ?></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="capacityofpetroltank" class="form-label"> Capacity of petrol tank: <?php echo $fillingstation[0]->capacityofpetroltank; ?></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="capacityofdieseltank" class="form-label"> Capacity of Deisel tank: <?php echo $fillingstation[0]->capacityofdieseltank; ?></label>
            </div>
        </div>    

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="capacityofsuperpetrol" class="form-label"> Capacity of super petrol tank: <?php echo $fillingstation[0]->capacityofsuperpetrol; ?></label>
            </div>
        </div>    

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="capacityofsuperdiesel" class="form-label"> Capacity of super diesel tank: <?php echo $fillingstation[0]->capacityofsuperdiesel; ?></label>
            </div>
        </div> 
        
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="district" class="form-label"> District: <?php echo $fillingstation[0]->district; ?></label>
            </div>
        </div> 

        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="isapproved" class="form-label"> Is approved: </label>
                <select id="isapproved" name="isapproved" class="form-select">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-3">
                <!-- <label for="approvedby" class="form-label"> Approved by: </label> -->
                <input type="hidden" id="approvedby" name="approvedby" class="form-label" value="<?php echo $this->session->username; ?>">
            </div>
        </div>
        
    </div>
    <div class="mt-2">
        <button type="submit" class="btn btn-primary me-2">Update</button>
    </div>
</form>

        </div>
    </div>
</div>
<script>
</script>