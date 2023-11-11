<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">payments Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/payments/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New payments</a>
			   </div>
			   <br><br>
               <table id="payments" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idpayments</th>
<th>Paymentdate</th>
<th>Isreceived</th>
<th>Paymentmethod idpaymentmethod</th>
<th>Amount</th>
<th>Orders idorders</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($payments as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idpayments;?></td>
<td><?=$row->paymentdate;?></td>
<td><?=$row->isreceived;?></td>
<td><?=$row->paymentmethod_idpaymentmethod;?></td>
<td><?=$row->amount;?></td>
<td><?=$row->orders_idorders;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/payments/edit/<?=$row->idpayments; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/payments/delete/<?=$row->idpayments; ?>" class="btn btn-sm btn-danger">Delete</a>
							</td>
						
						</tr>
						<?php } ?>
                     				                      
                    
                  </tbody>
               </table>
			   <?php
					 if($this->session->flashdata('message')) {?>
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
               
            </div>
         </div>
      </div>
   </div>
   <!-- Examples -->
</div>
<script>   
   new DataTable('#payments', {
   scrollX: true,
   scrollY: 350
   });
   
</script>