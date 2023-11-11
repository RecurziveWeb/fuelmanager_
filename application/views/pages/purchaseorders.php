<!-- Content -->
<script>
	function calculate()
	{
		let grandtotal = [];
		<?php foreach($materialprices as $mat){ ?>
		let <?php echo $mat->materialtype; ?>price = document.getElementById("Price_<?php echo $mat->materialtype; ?>");
		let <?php echo $mat->materialtype; ?>qty = document.getElementById("Qty_<?php echo $mat->materialtype; ?>");
		let <?php echo $mat->materialtype; ?>total = document.getElementById("Total_<?php echo $mat->materialtype; ?>");
		 
		<?php echo $mat->materialtype; ?>total.value = <?php echo $mat->materialtype; ?>price.value * <?php echo $mat->materialtype; ?>qty.value;		
		grandtotal.push(<?php echo $mat->materialtype; ?>price.value * <?php echo $mat->materialtype; ?>qty.value);		
		<?php } ?>
		let totalval = 0;
		for(let i=0;  i<grandtotal.length; i++){
			totalval = totalval + grandtotal[i];
		}

		document.getElementById("grandtotal").value = totalval;

		return false;
	}
</script>
			        
<div class="container-xxl flex-grow-1 container-p-y">
            
            

			<div class="row invoice-add">
			<form action="<?php echo base_url('fuelorders/placeorder/save'); ?>" method="post">
			  <!-- Invoice Add-->
			  <div class="col-lg-9 col-12 mb-lg-0 mb-4">
				<div class="card invoice-preview-card">
				  <div class="card-body">
					<div class="row p-sm-3 p-0">
					  <div class="col-md-6 mb-md-0 mb-4">
						<div class="d-flex svg-illustration mb-4 gap-2">
						  <span class="app-brand-logo demo"></span>
						</div>
						<p class="mb-1"><?php echo $fillingstation[0]->fillingstation_name; ?></p>
						<p class="mb-1"><?php echo $fillingstation[0]->fillingstation_address; ?></p>
					  </div>
					  <div class="col-md-6">
						<dl class="row mb-2">
						  <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
							<span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>
						  </dt>
						  <dd class="col-sm-6 d-flex justify-content-md-end">
							<div class="w-px-150">
							  <input type="text" class="form-control" disabled placeholder="3905" value="3666" id="invoiceId" />
							</div>
						  </dd>
						  <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
							<span class="fw-normal">Date:</span>
						  </dt>
						  <dd class="col-sm-6 d-flex justify-content-md-end">
							<div class="w-px-150">
							  <input type="text" class="form-control date-picker" name="orderdate" value="<?php echo date("Y-m-d H:i:s");?>" readonly/>
							</div>
						  </dd>
						</dl>
					  </div>
					</div>
			
					<hr class="my-4 mx-n4" />
			
					<div class="row p-sm-3 p-0">
					  <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
						<h6 class="pb-2">Invoice To:</h6>
						<p class="mb-1">SL Fuel Inc</p>
						<p class="mb-1">Temple Road</p>
						<p class="mb-1">011 690000</p>
						<p class="mb-0">mr@mm.lk</p>
					  </div>
					  <div class="col-md-6 col-sm-7">
						<h6 class="pb-2">Bill To:</h6>
						<table>
						  <tbody>
							<tr>
							  <td class="pe-3">Total Due:</td>
							  <td>Rs 12,110.55</td>
							</tr>
							<tr>
							  <td class="pe-3">Bank name:</td>
							  <td>People Bank</td>
							</tr>
							<tr>
							  <td class="pe-3">Country:</td>
							  <td>Sri Lanka</td>
							</tr>
							<tr>
							  <td class="pe-3">IBAN:</td>
							  <td>ETD95476213874685</td>
							</tr>
							<tr>
							  <td class="pe-3">SWIFT code:</td>
							  <td>BR91905</td>
							</tr>
						  </tbody>
						</table>
					  </div>
					</div>
			
					<hr class="mx-n4" />
			
					<div class="source-item py-sm-3">
					  <div class="mb-3" data-repeater-list="group-a">
					  <?php foreach($materialprices as $mat){ ?>
					 	 <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
						  <div class="d-flex border rounded position-relative pe-0">
							
						 	 <div class="row w-100 m-0 p-3">
								<div class="col-md-3 col-12 mb-md-0 mb-3">
								<p class="mb-2 repeater-title">Item</p>
								<input name="<?php echo "Itm_".$mat->materialtype; ?>"  id="<?php echo "Itm_".$mat->materialtype; ?>" type="text" class="form-control invoice-item-price mb-2" value="<?php echo $mat->materialtype; ?>" readonly/>
								
							  </div>
							  <div class="col-md-3 col-12 mb-md-0 mb-3">
								<p class="mb-2 repeater-title">Cost</p>
								<input name="<?php echo "Price_".$mat->materialtype; ?>" id="<?php echo "Price_".$mat->materialtype; ?>" type="number" class="form-control invoice-item-price mb-2" value="<?php echo $mat->materialprice; ?>" readonly />
								
							  </div>
							  <div class="col-md-3 col-12 mb-md-0 mb-3">
								<p class="mb-2 repeater-title">Qty</p>
								<input onchange="calculate();" name="<?php echo "Qty_".$mat->materialtype; ?>" id="<?php echo "Qty_".$mat->materialtype; ?>" type="number" class="form-control invoice-item-qty" placeholder="1" min="1" max="50" />
							  </div>
							  <div class="col-md-3 col-12 pe-0">
								<p class="mb-2 repeater-title">Price (Rs)</p>
								<input type="number" name="<?php echo "Total_".$mat->materialtype; ?>" id="<?php echo "Total_".$mat->materialtype; ?>" class="form-control" value="0" readonly>
							  </div>
							</div>
						</div>
					  </div>
					  <?php } ?>
					  
					
			
					<hr class="my-4 mx-n4" />
			
					<div class="row py-sm-3">
					  <div class="col-md-7 mb-md-0 mb-3">
						
					  </div>
					  <div class="col-md-5 d-flex">
						<div class="invoice-calculations">
						  <div class="d-flex justify-content-between">
							<span class="w-px-100">Total:</span>
							<input type="number" name="amount" id="grandtotal" class="form-control" value="0" readonly>
						  </div>
						</div>
					  </div>
					</div>
			
					<hr class="my-4" />

					<div class="row py-sm-3">
					  <div class="col-md-7 mb-md-0 mb-3">
						<input type="hidden" name="fillingstation_idfillingstation" value="<?php echo $fillingstation[0]->idfillingstation; ?>">
						<input type="hidden" name="tax" value="">
						<input type="hidden" name="discount" value="">
					  </div>
					  <div class="col-md-5 d-flex">
						<button class="btn btn-success" type="submit">Order</button>
					  </div>
					</div>
						
					  </div>	
					
				  </div>
				</div>
					  </div>						


			</form>  
			  <!-- /Invoice Add-->
<script>
$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
			event.preventDefault();
      		return false;
        }
    });
});
</script>