<div class="container">
<div class="row">
    <div class="col-md-8">
    <form id="data-form" class="pl-3 pr-3">
          <div class="row">
<input type="hidden" id="idProducts" name="idProducts" class="form-control" placeholder="IdProducts" maxlength="11" required>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="product_name" class="col-form-label"> Product name: </label>
									<input type="text" id="product_name" name="product_name" class="form-control" placeholder="Product name" minlength="0"  maxlength="100" >
								</div>
							</div>
                            <div class="col-md-6">
								<div class="form-group mb-3">
									<label for="condition" class="col-form-label"> Condition: </label>
									<select id="condition" name="condition" class="form-select" >
										<option value="brandnew">Brand New</option>
										<option value="used">Used</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="shortdescription" class="col-form-label"> Shortdescription: </label>
									<textarea cols="40" rows="5" id="shortdescription" name="shortdescription" class="form-control" placeholder="Shortdescription" minlength="0"  maxlength="450" ></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="longdescription" class="col-form-label"> Longdescription: </label>
									<textarea cols="40" rows="5" id="longdescription" name="longdescription" class="form-control" placeholder="Longdescription" minlength="0"  maxlength="1500" ></textarea>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="brand" class="col-form-label"> Brand: </label>
									<input type="text" id="brand" name="brand" class="form-control" placeholder="Brand" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="model" class="col-form-label"> Model: </label>
									<input type="text" id="model" name="model" class="form-control" placeholder="Model" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="barcode" class="col-form-label"> Barcode: </label>
									<input type="text" id="barcode" name="barcode" class="form-control" placeholder="Barcode" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="weight" class="col-form-label"> Weight: </label>
									<input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" minlength="0"  >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="length" class="col-form-label"> Length: </label>
									<input type="text" id="length" name="length" class="form-control" placeholder="Length" minlength="0"  >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="width" class="col-form-label"> Width: </label>
									<input type="text" id="width" name="width" class="form-control" placeholder="Width" minlength="0"  >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="height" class="col-form-label"> Height: </label>
									<input type="text" id="height" name="height" class="form-control" placeholder="Height" minlength="0"  >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="is_featured" class="col-form-label"> Is featured: </label>
									<select id="is_featured" name="is_featured" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="is_active" class="col-form-label"> Is active: </label>
									<select id="is_active" name="is_active" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>

<div class="col-md-6">
						<div class="form-group mb-3">
							<label for="categories_idcategories" class="col-form-label"> Categories: <span class="text-danger">*</span> </label>
							<select id="categories_idcategories" name="categories_idcategories" class="form-select" required>
								<?php foreach($selectdata_categories as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
<div class="col-md-6">
						<div class="form-group mb-3">
							<label for="Vendors_idVendors" class="col-form-label"> Vendor Name: <span class="text-danger">*</span> </label>
							<select id="Vendors_idVendors" name="Vendors_idVendors" class="form-select" required>
								<?php foreach($selectdata_vendors as $data){ ?>
									<option value="<?php echo $data->keyid; ?>"><?php echo $data->keyvalue; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="productcode" class="col-form-label"> Productcode: </label>
									<input type="text" id="productcode" name="productcode" class="form-control" placeholder="Productcode" minlength="0"  maxlength="45" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="is_digital_product" class="col-form-label"> Is digital product: </label>
									<select id="is_digital_product" name="is_digital_product" class="form-select" >
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="ticktok" class="col-form-label"> Ticktok: </label>
									<input type="text" id="ticktok" name="ticktok" class="form-control" placeholder="Ticktok" minlength="0"  maxlength="450" >
								</div>
							</div>
                            <div class="col-md-6">
								<div class="form-group mb-3">
									<label for="youtubeurl" class="col-form-label"> Youtubeurl: </label>
									<input type="text" id="youtubeurl" name="youtubeurl" class="form-control" placeholder="Youtubeurl" minlength="0"  maxlength="450" >
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

    <div class="col-md-4">
        
    </div>
</div>
</div>