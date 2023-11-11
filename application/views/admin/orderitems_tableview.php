<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
					
               <h5 class="card-title">orderitems Details</h5>
			   <div class="float-right">
			   		   <a href="<?php echo base_url();?>index.php/orderitems/insert" class="btn btn-info"><i class="fa fa-pencil"></i> Add New orderitems</a>
			   </div>
			   <br><br>
               <table id="orderitems" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>Idorderitems</th>
<th>Itemname</th>
<th>Qty</th>
<th>Itemamount</th>
<th>Orders idorders</th>
<th>Isdelete</th>

                     </tr>
                  </thead>
                  <tbody>
						<?php $i=1; foreach($orderitems as $row) {?>
						<tr>
							<td><?=$i++?></td>
                            <td><?=$row->idorderitems;?></td>
<td><?=$row->itemname;?></td>
<td><?=$row->qty;?></td>
<td><?=$row->itemamount;?></td>
<td><?=$row->orders_idorders;?></td>
<td><?=$row->isdelete;?></td>

							<td>
								<a href="<?php echo base_url();?>index.php/orderitems/edit/<?=$row->idorderitems; ?>" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?php echo base_url();?>index.php/orderitems/delete/<?=$row->idorderitems; ?>" class="btn btn-sm btn-danger">Delete</a>
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
   new DataTable('#orderitems', {
   scrollX: true,
   scrollY: 350
   });
   
</script>