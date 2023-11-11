<form id='attributeadd'>
    <div><label for="idattribute" class="col-sm-3 col-form-label">Idattribute</label>
        <div class="col-sm-3"><input type="number" class="form-control" id="idattribute"></div>
    </div>
    <div><label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-3"><input type="text" class="form-control" id="name"></div>
    </div>
    <div><label for="value" class="col-sm-3 col-form-label">Value</label>
        <div class="col-sm-3"><input type="text" class="form-control" id="value"></div>
    </div>
    <div><label for="Products_idProducts" class="col-sm-3 col-form-label">Products idProducts</label>
        <div class="col-sm-3"><input type="number" class="form-control" id="Products_idProducts"></div>
    </div><button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
$(document).ready(function () {
  $("#attributeadd").submit(function (event) {
    var formData = {
      idattribute: $("#idattribute").val(),
      name: $("#name").val(),
      value: $("#value").val(),
      Products_idProducts: $("#Products_idProducts").val(),
    };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('attribute/add'); ?>",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
        Swal.fire({
        title: data.title,
        text: data.messages,
        icon: 'success',
        confirmButtonText: 'OK'
        });
    });

    event.preventDefault();
  });
});
</script>
