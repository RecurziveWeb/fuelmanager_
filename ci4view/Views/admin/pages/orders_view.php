
<!-- Main content -->
<div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 mt-2">
              <h3 class="card-title">orders</h3>
            </div>
            <div class="col-2">
              <button type="button" class="btn float-right btn-success" onclick="save()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i>   <?= lang('App.new') ?></button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="data_table" class="table table-bordered table-striped">
            <thead>
              <tr>
              <th>Idorders</th>
<th>Orderdate</th>
<th>Amount</th>
<th>Discount</th>
<th>Tax</th>
<th>Isapproved</th>
<th>Fillingstation idfillingstation</th>
<th>Approvedby</th>
<th>Vehicle idvehicle</th>
<th>Employee idemployee</th>

			  <th></th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="text-center bg-info p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <div class="row">
<input type="hidden" id="idorders" name="idorders" class="form-control" placeholder="Idorders" maxlength="11" required>
						</div>
						<div class="row">
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="orderdate" class="col-form-label"> Orderdate: </label>
									<input type="date" id="orderdate" name="orderdate" class="form-control" dateISO="true" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="amount" class="col-form-label"> Amount: </label>
									<input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" minlength="0"  >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="discount" class="col-form-label"> Discount: </label>
									<input type="number" id="discount" name="discount" class="form-control" placeholder="Discount" minlength="0"  >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="tax" class="col-form-label"> Tax: </label>
									<input type="number" id="tax" name="tax" class="form-control" placeholder="Tax" minlength="0"  >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isapproved" class="col-form-label"> Isapproved: </label>
									<select id="isapproved" name="isapproved" class="form-select" >
										<option value="select1">select1</option>
										<option value="select2">select2</option>
										<option value="select3">select3</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="fillingstation_idfillingstation" class="col-form-label"> Fillingstation idfillingstation: <span class="text-danger">*</span> </label>
							<select id="fillingstation_idfillingstation" name="fillingstation_idfillingstation" class="form-select" required>
								<?php foreach($selectdata_fillingstation as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="approvedby" class="col-form-label"> Approvedby: </label>
									<textarea cols="40" rows="5" id="approvedby" name="approvedby" class="form-control" placeholder="Approvedby" minlength="0"  maxlength="45" ></textarea>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="vehicle_idvehicle" class="col-form-label"> Vehicle idvehicle: <span class="text-danger">*</span> </label>
							<select id="vehicle_idvehicle" name="vehicle_idvehicle" class="form-select" required>
								<?php foreach($selectdata_vehicle as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="employee_idemployee" class="col-form-label"> Employee idemployee: <span class="text-danger">*</span> </label>
							<select id="employee_idemployee" name="employee_idemployee" class="form-select" required>
								<?php foreach($selectdata_employee as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
						</div>

          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="form-btn"><?= lang("App.save") ?></button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /ADD modal content -->


<script>
  // dataTables
  $(function() {
    var table = $('#data_table').removeAttr('width').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollY": '45vh',
      "scrollX": true,
      "scrollCollapse": false,
      "responsive": false,
      "ajax": {
        "url": '<?php echo base_url($controller . "/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true"
      }
    });
  });

  var urlController = '';
  var submitText = '';

  function getUrl() {
    return urlController;
  }

  function getSubmitText() {
    return submitText;
  }

  function save(idorders) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof idorders === 'undefined' || idorders < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-info').addClass('bg-success');
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          idorders: idorders
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          			$("#data-form #idorders").val(response.idorders);
			$("#data-form #orderdate").val(response.orderdate);
			$("#data-form #amount").val(response.amount);
			$("#data-form #discount").val(response.discount);
			$("#data-form #tax").val(response.tax);
			$("#data-form #isapproved").val(response.isapproved);
			$("#data-form #fillingstation_idfillingstation").val(response.fillingstation_idfillingstation);
			$("#data-form #approvedby").val(response.approvedby);
			$("#data-form #vehicle_idvehicle").val(response.vehicle_idvehicle);
			$("#data-form #employee_idemployee").val(response.employee_idemployee);

        }
      });
    }
    $.validator.setDefaults({
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      },
      errorElement: 'div ',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if ($(element).is('.select')) {
          element.next().after(error);
        } else if (element.hasClass('select2')) {
          //error.insertAfter(element);
          error.insertAfter(element.next());
        } else if (element.hasClass('selectpicker')) {
          error.insertAfter(element.next());
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        var form = $('#data-form');
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
          url: getUrl(),
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {
            $('#form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                $('#data-modal').modal('hide');
              })
            } else {
              if (response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var ele = $("#" + index);
                  ele.closest('.form-control')
                    .removeClass('is-invalid')
                    .removeClass('is-valid')
                    .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
                  ele.after('<div class="invalid-feedback">' + response.messages[index] + '</div>');
                });
              } else {
                Swal.fire({
                  toast: false,
                  position: 'bottom-end',
                  icon: 'error',
                  title: response.messages,
                  showConfirmButton: false,
                  timer: 3000
                })

              }
            }
            $('#form-btn').html(getSubmitText());
          }
        });
        return false;
      }
    });

    $('#data-form').validate({

      //insert data-form to database

    });
  }



  function remove(idorders) {
    Swal.fire({
      title: "<?= lang("App.remove-title") ?>",
      text: "<?= lang("App.remove-text") ?>",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '<?= lang("App.confirm") ?>',
      cancelButtonText: '<?= lang("App.cancel") ?>'
    }).then((result) => {

      if (result.value) {
        $.ajax({
          url: '<?php echo base_url($controller . "/remove") ?>',
          type: 'post',
          data: {
            idorders : idorders
          },
          dataType: 'json',
          success: function(response) {

            if (response.success === true) {
              Swal.fire({
                toast:true,
                position: 'top-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
              })
            } else {
              Swal.fire({
                toast:false,
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 3000
              })
            }
          }
        });
      }
    })
  }
</script>


