
<!-- Main content -->
<div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 mt-2">
              <h3 class="card-title">fillingstation</h3>
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
              <th>Idfillingstation</th>
<th>Fillingstation name</th>
<th>Fillingstation address</th>
<th>Numberoffueldespencers</th>
<th>Capacityofpetroltank</th>
<th>Capacityofdieseltank</th>
<th>Capacityofsuperpetrol</th>
<th>Capacityofsuperdiesel</th>
<th>District</th>
<th>Users idUsers</th>
<th>Isapproved</th>
<th>Approvedby</th>

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
<input type="hidden" id="idfillingstation" name="idfillingstation" class="form-control" placeholder="Idfillingstation" maxlength="11" required>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="fillingstation_name" class="col-form-label"> Fillingstation name: </label>
									<input type="text" id="fillingstation_name" name="fillingstation_name" class="form-control" placeholder="Fillingstation name" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="fillingstation_address" class="col-form-label"> Fillingstation address: </label>
									<textarea cols="40" rows="5" id="fillingstation_address" name="fillingstation_address" class="form-control" placeholder="Fillingstation address" minlength="0"  maxlength="450" ></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="numberoffueldespencers" class="col-form-label"> Numberoffueldespencers: </label>
									<input type="number" id="numberoffueldespencers" name="numberoffueldespencers" class="form-control" placeholder="Numberoffueldespencers" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofpetroltank" class="col-form-label"> Capacityofpetroltank: </label>
									<input type="number" id="capacityofpetroltank" name="capacityofpetroltank" class="form-control" placeholder="Capacityofpetroltank" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofdieseltank" class="col-form-label"> Capacityofdieseltank: </label>
									<input type="number" id="capacityofdieseltank" name="capacityofdieseltank" class="form-control" placeholder="Capacityofdieseltank" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofsuperpetrol" class="col-form-label"> Capacityofsuperpetrol: </label>
									<input type="number" id="capacityofsuperpetrol" name="capacityofsuperpetrol" class="form-control" placeholder="Capacityofsuperpetrol" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="capacityofsuperdiesel" class="col-form-label"> Capacityofsuperdiesel: </label>
									<input type="number" id="capacityofsuperdiesel" name="capacityofsuperdiesel" class="form-control" placeholder="Capacityofsuperdiesel" minlength="0"  maxlength="11" >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="district" class="col-form-label"> District: </label>
									<input type="text" id="district" name="district" class="form-control" placeholder="District" minlength="0"  maxlength="45" >
								</div>
							</div>
<div class="col-md-12">
						<div class="form-group mb-3">
							<label for="Users_idUsers" class="col-form-label"> Users idUsers: <span class="text-danger">*</span> </label>
							<select id="Users_idUsers" name="Users_idUsers" class="form-select" required>
								<?php foreach($selectdata_users as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
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
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="approvedby" class="col-form-label"> Approvedby: </label>
									<input type="text" id="approvedby" name="approvedby" class="form-control" placeholder="Approvedby" minlength="0"  maxlength="45" >
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

  function save(idfillingstation) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof idfillingstation === 'undefined' || idfillingstation < 1) { //add
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
          idfillingstation: idfillingstation
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-info');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          			$("#data-form #idfillingstation").val(response.idfillingstation);
			$("#data-form #fillingstation_name").val(response.fillingstation_name);
			$("#data-form #fillingstation_address").val(response.fillingstation_address);
			$("#data-form #numberoffueldespencers").val(response.numberoffueldespencers);
			$("#data-form #capacityofpetroltank").val(response.capacityofpetroltank);
			$("#data-form #capacityofdieseltank").val(response.capacityofdieseltank);
			$("#data-form #capacityofsuperpetrol").val(response.capacityofsuperpetrol);
			$("#data-form #capacityofsuperdiesel").val(response.capacityofsuperdiesel);
			$("#data-form #district").val(response.district);
			$("#data-form #Users_idUsers").val(response.Users_idUsers);
			$("#data-form #isapproved").val(response.isapproved);
			$("#data-form #approvedby").val(response.approvedby);

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



  function remove(idfillingstation) {
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
            idfillingstation : idfillingstation
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


