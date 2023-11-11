
<!-- Main content -->
<div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 mt-2">
              <h3 class="card-title">employee</h3>
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
              <th>Idemployee</th>
<th>Fristname</th>
<th>Lastname</th>
<th>Epf</th>
<th>Dateofbirth</th>
<th>Isactive</th>
<th>Isavailable</th>
<th>Employeetype idemployeetype</th>

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
<input type="hidden" id="idemployee" name="idemployee" class="form-control" placeholder="Idemployee" maxlength="11" required>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="fristname" class="col-form-label"> Fristname: </label>
									<input type="text" id="fristname" name="fristname" class="form-control" placeholder="Fristname" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="lastname" class="col-form-label"> Lastname: </label>
									<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Lastname" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="epf" class="col-form-label"> Epf: </label>
									<input type="text" id="epf" name="epf" class="form-control" placeholder="Epf" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="dateofbirth" class="col-form-label"> Dateofbirth: </label>
									<input type="date" id="dateofbirth" name="dateofbirth" class="form-control" dateISO="true" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isactive" class="col-form-label"> Isactive: </label>
									<select id="isactive" name="isactive" class="form-select" >
										<option value="select1">select1</option>
										<option value="select2">select2</option>
										<option value="select3">select3</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="isavailable" class="col-form-label"> Isavailable: </label>
									<select id="isavailable" name="isavailable" class="form-select" >
										<option value="select1">select1</option>
										<option value="select2">select2</option>
										<option value="select3">select3</option>
									</select>
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="employeetype_idemployeetype" class="col-form-label"> Employeetype idemployeetype: <span class="text-danger">*</span> </label>
							<select id="employeetype_idemployeetype" name="employeetype_idemployeetype" class="form-select" required>
								<?php foreach($selectdata_employeetype as $data){ ?>
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

  function save(idemployee) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof idemployee === 'undefined' || idemployee < 1) { //add
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
          idemployee: idemployee
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          			$("#data-form #idemployee").val(response.idemployee);
			$("#data-form #fristname").val(response.fristname);
			$("#data-form #lastname").val(response.lastname);
			$("#data-form #epf").val(response.epf);
			$("#data-form #dateofbirth").val(response.dateofbirth);
			$("#data-form #isactive").val(response.isactive);
			$("#data-form #isavailable").val(response.isavailable);
			$("#data-form #employeetype_idemployeetype").val(response.employeetype_idemployeetype);

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



  function remove(idemployee) {
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
            idemployee : idemployee
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


