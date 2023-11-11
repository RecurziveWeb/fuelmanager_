<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Examples -->
   <div class="row mb-5">
      <div class="col-md-12 mb-3">
         <div class="card h-100">
            <div class="card-body">
               <h5 class="card-title">Membership Details</h5>
			   
			   <button class="btn btn-info"><i class="fa fa-pencil"></i> Add New Member</button>
			   <br><br>
               <table id="example" class="display nowrap" style="width:100%" >
                  <thead class="thead-dark">
                     <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>2</td>
                        <td>ewew</td>
                        <td>ewewewewew</td>
                        <td>keerthi.sanjaya@gmail.com</td>
                        <td>Female</td>
                        <td>india</td>
                        <td>
                           <a href="http://localhost/test/members/view/2" class="btn btn-primary" style="height: 30px; width: 10px; "><i class="fa fa-eye"></i></a>
                           <a href="http://localhost/test/members/edit/2" class="btn btn-warning" style="height: 30px; width: 10px;"><i class="fa fa-edit"></i></a>
                           <a href="http://localhost/test/members/delete/2" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" style="height: 30px; width: 10px;"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>3</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>keerthi.sanjaya@gmail.com</td>
                        <td>Male</td>
                        <td>Sri Lanka</td>
                        <td>
                           <a href="http://localhost/test/members/view/2" class="btn btn-primary" style="height: 30px; width: 10px; "><i class="fa fa-eye"></i></a>
                           <a href="http://localhost/test/members/edit/2" class="btn btn-warning" style="height: 30px; width: 10px;"><i class="fa fa-edit"></i></a>
                           <a href="http://localhost/test/members/delete/2" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" style="height: 30px; width: 10px;"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>4</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>keerthi.sanjaya@gmail.com</td>
                        <td>Male</td>
                        <td>new</td>
                        <td>
                           <a href="http://localhost/test/members/view/2" class="btn btn-primary" style="height: 30px; width: 10px; "><i class="fa fa-eye"></i></a>
                           <a href="http://localhost/test/members/edit/2" class="btn btn-warning" style="height: 30px; width: 10px;"><i class="fa fa-edit"></i></a>
                           <a href="http://localhost/test/members/delete/2" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" style="height: 30px; width: 10px;"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>5</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>keerthi.sanjaya@gmail.com</td>
                        <td>Male</td>
                        <td>Sri Lanka</td>
                        <td>
                           <a href="http://localhost/test/members/view/2" class="btn btn-primary" style="height: 30px; width: 10px; "><i class="fa fa-eye"></i></a>
                           <a href="http://localhost/test/members/edit/2" class="btn btn-warning" style="height: 30px; width: 10px;"><i class="fa fa-edit"></i></a>
                           <a href="http://localhost/test/members/delete/2" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" style="height: 30px; width: 10px;"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                     <tr>
                        <td>6</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>Keerthi Sanjaya Hettiarac</td>
                        <td>keerthi.sanjaya@gmail.com</td>
                        <td>Male</td>
                        <td>Sri Lanka</td>
                        <td>
                           <a href="http://localhost/test/members/view/2" class="btn btn-primary" style="height: 30px; width: 10px; "><i class="fa fa-eye"></i></a>
                           <a href="http://localhost/test/members/edit/2" class="btn btn-warning" style="height: 30px; width: 10px;"><i class="fa fa-edit"></i></a>
                           <a href="http://localhost/test/members/delete/2" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" style="height: 30px; width: 10px;"><i class="fa fa-trash"></i></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
               
            </div>
         </div>
      </div>
   </div>
   <!-- Examples -->
</div>
<script>
   /*$(document).ready( function () {
       $('example').DataTable();
   
   } );*/
   
   new DataTable('#example', {
   scrollX: true,
   scrollY: 350
   });
   
</script>