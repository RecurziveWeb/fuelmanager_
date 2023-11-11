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

        <h5 class="card-header">Add employee Details</h5>

        <hr class="my-0">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url();?>index.php/employee/register/save">

                <input type="hidden" id="idemployee" name="idemployee" class="form-control" placeholder="Idemployee"
                    maxlength="11" required>
               

                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="employeetype_idemployeetype" class="form-label"> Employee Type : <span
                                class="text-danger">*</span> </label>
                        <select id="employeetype_idemployeetype" name="employeetype_idemployeetype" class="form-select"
                            required>
                            <?php foreach($employeetype as $data){ ?>
                            <option value="<?php echo $data->idemployeetype; ?>"><?php echo $data->employeetype; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
</script>