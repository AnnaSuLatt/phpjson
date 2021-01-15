<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container" id="addStudentdiv">
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h1 class="display-4"> Add New Student </h1>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col align-self-center">
				<form action="addstudent.php" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="profile" class="col-sm-2 col-form-label"> Profile </label>
					    <div class="col-sm-10">
					    	<input type="file"  id="profile" name="profile">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Name </label>
					    <div class="col-sm-10">
					    	<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Email </label>
					    <div class="col-sm-10">
					    	<input type="email" class="form-control" id="name" placeholder="Enter Email" name="email">
					    </div>
					</div>

					<fieldset class="form-group">
					    <div class="row">
					    	<legend class="col-form-label col-sm-2 pt-0"> Gender </legend>
					      
					      	<div class="col-sm-10">
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
					          		<label class="form-check-label" for="male">
					            		Male
					          		</label>
					        	</div>
					        
					        	<div class="form-check">
					          		<input class="form-check-input" type="radio" name="gender" id="female" value="Female">
					          		<label class="form-check-label" for="female">
					            		Female
					          		</label>
					        	</div>
					        
					      </div>
					    </div>
					</fieldset>

					<div class="form-group row">
						<label for="address" class="col-sm-2 col-form-label"> Address </label>
					    <div class="col-sm-10">
					    	<textarea class="form-control" rows="5" name="address"></textarea>
					    </div>
					</div>

					<div class="form-group row">
					    <div class="col-sm-10">
					   		<button type="submit" class="btn btn-primary">
					   			SAVE
					   		</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th> # </th>
				<th> Name </th>
				<th> Gender </th>
				<th> Email </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>


<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

<script>

	$(document).ready(function(){
		getData();
		function getData(){
			$.get('student.json',function(response){
				console.log(typeof(response));
				if (response) {
					var stu_arr=JSON.parse(response);
					var html='';
					var j=1;
					$.each(stu_arr,function(i,v){
						html+=`<tr>
						<td>${j++}</td>
						<td>${v.name}</td>
						<td>${v.gender}</td>
						<td>${v.email}</td>
						<td>
							<button class="btn btn-success detail" data-name="${v.name}" data-gender="${v.gender}" data-email="${v.email}" data-address="${v.address}" data-profile="${v.profile}">Detail</button>
							<button class="btn btn-warning">Edit</button>
							<button class="btn btn-danger delete" data-id=${i}>Delete</button>
						<td>


						</tr>`
					})
					$('tbody').html(html);
				}
			})
		}


		$('tbody').on('click','.detail',function(){
			var name=$(this).data('name');
			var email=$(this).data('email');
			var gender=$(this).data('gender');
			var address=$(this).data('address');
			var profile=$(this).data('profile');

			$('.stu_img').attr('src',profile);
			$('#stu_name').text(name);
			$('#stu_email').text(email);
			$('#stu_gender').text(gender);
			$('#stu_address').text(address);
			$("#detailModal").modal('show');
		})

		$('tbody').on('click','.delete',function(){
			var id=$(this).data('id');
			var ans=confirm("Are You Sure Delete?");
			if (ans) {
				$.post('deletestudent.php',{stu_id:id},function(response){
					console.log(response);
					getData();
				})
			}

			
		})



	})
	
</script>


<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
        	<div class="row">
        		<div class="col-md-5">
        			<img src="" class="img-fluid stu_img">
        		</div>
        		<div class="col-md-7">
        			<p id="stu_name"></p>
        			<p id="stu_email"></p>
        			<p id="stu_gender"></p>
        			<p id="stu_address"></p>

        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>