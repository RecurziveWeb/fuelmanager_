<div class="container-xxl flex-grow-1 container-p-y">
<div class="row mb-5">
    <?php foreach($fillingstations as $station){ ?>
    <div class="col-md-6 col-lg-4">
        <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title"><?php echo $station->fillingstation_name; ?></h5>
            <p class="card-text"><?php echo $station->fillingstation_address; ?></p>
            <p class="card-text"><?php echo $station->district; ?></p>
            <a href="<?php echo base_url('fillingstation/view/doc/'.$station->idfillingstation); ?>" class="btn btn-primary">View Doc</a>
        </div>
        </div>
    </div>
    <?php } ?>
   
</div>
</div>