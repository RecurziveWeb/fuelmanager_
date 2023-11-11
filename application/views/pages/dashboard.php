<div class="container-xxl flex-grow-1 container-p-y">
<div class="row mb-5">
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Register Fuel station</h5>
            <p class="card-text">Welcome to the Fuel Station Registration portal!</p>
            <a href="<?php echo base_url('fillingstation/insert'); ?>" class="btn btn-primary">Enter</a>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Approve Fuel station</h5>
            <p class="card-text">Welcome to the Fuel Station Approval portal!</p>
            <a href="<?php echo base_url('fuelstations/list/unapproved'); ?>" class="btn btn-primary">Enter</a>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
        <h5 class="card-title">Mark Daily Dip</h5>
            <p class="card-text">Mark Daily Dip Values Petrol Deisel Super Petrol Deisel</p>
            <a href="<?php echo base_url('dailydip/markdip/'.$this->session->user_id); ?>" class="btn btn-primary">Enter</a>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
        <h5 class="card-title">Place A Order</h5>
            <p class="card-text">Place a order for your filling station</p>
            <form action="<?php echo base_url('fuelorders/placeorder/'); ?>" method="get">
            <div class="form-group mb-3">
                <label for="fillingstation_idfillingstation" class="form-label">Filling station: <span class="text-danger">*</span></label>
                <select id="fillingstation_idfillingstation" name="fillingstation_idfillingstation"
                    class="form-select" required>
                    <?php foreach($fillingstations as $data){ ?>
                        <option value="<?php echo $data->idfillingstation; ?>"><?php echo $data->fillingstation_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2">Order</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
        <h5 class="card-title">Register a Vehicle</h5>
            <p class="card-text">Register a Vehicle in System</p>
            <a href="<?php echo base_url('vehicle/register'); ?>" class="btn btn-primary">Enter</a>
        </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
        <h5 class="card-title">Submit Vehicle Certifications</h5>
            <p class="card-text">submit vehicle certification</p>
            <a href="<?php echo base_url('vehicle/certificate/calibration'); ?>" class="btn btn-primary">calibration</a>
            <br>
            <a href="<?php echo base_url('vehicle/certificate/revenuelicesen'); ?>" class="btn btn-primary">revenue licesen</a>
        </div>
        </div>
    </div>
</div>
</div>