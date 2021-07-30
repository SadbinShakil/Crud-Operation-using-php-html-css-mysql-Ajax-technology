<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD Operation using Ajax Technology</title>

<!-- Copied Bootstrap Container Fluid Example Code  !-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<div class="Container">
	<h1 class="text-primary text-uppercase text-center">CRUD program using RAW PHP & AJAX technology </h1>



	<div class="d-flex justify-content-end">
		<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add </button>
    </div>	

    <h2>Records</h2>
    <div id="data_fetch">

    </div>

    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Adding Records</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        	<label>FirstName:</label>
        	<input type="text" name="" id="firstname" placeholder="First Name" class="form-control">
        </div>

         <div class="form-group">
        	<label>LastName:</label>
        	<input type="text" name="" id="lastname" placeholder="Last Name" class="form-control">
        </div>

         <div class="form-group">
        	<label>EmailID:</label>
        	<input type="email" name="" id="emailid" placeholder="Email ID" class="form-control">
        </div>

         <div class="form-group">
        	<label>MobileNumber:</label>
        	<input type="number" name="" id="mobnum" placeholder="Mobile Number" class="form-control">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Updated Modal -->
<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Updating Records</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        	<label>FirstName:</label>
        	<input type="text" name="" id="u_firstname" placeholder="First Name" class="form-control">
        </div>

         <div class="form-group">
        	<label>LastName:</label>
        	<input type="text" name="" id="u_lastname" placeholder="Last Name" class="form-control">
        </div>

         <div class="form-group">
        	<label>EmailID:</label>
        	<input type="email" name="" id="u_emailid" placeholder="Email ID" class="form-control">
        </div>

         <div class="form-group">
        	<label>MobileNumber:</label>
        	<input type="number" name="" id="u_mobnum" placeholder="Mobile Number" class="form-control">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateDetails()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id='hiddenuserid'>
      </div>

    </div>
  </div>
</div>

</div>





<!-- JS code for addRecord function through ajax -->
<script type="text/javascript">

//showing all the record immediately when the page is reloded.
    $(document).ready(function(){
    	readRecords();

    })

    

    function readRecords(){
    	var readrecord = 'readrecord';
    	$.ajax({
    		url:'BackendTask.php',
    		type:'post',
    		data:{readrecord:readrecord},
    		success:function(data,status) {
    			$('#data_fetch').html(data);
    		}

    	});
    }


	function addRecord(){
		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var email = $('#emailid').val();
		var mobile = $('#mobnum').val();

		//ajax code
		$.ajax({
			url:'BackendTask.php',
			type:'post',
			data:{
				firstname:firstname,
				lastname:lastname,
				email:email,
				mobile:mobile
			},
			success:function(data,status){
				readRecords();

			}

		});
	}

//delete function

function DeleteUser(deleteid){
	var conf = confirm("Confirm Before Delete");
	if(conf==true){
		$.ajax({
			url:'BackendTask.php',
			type:'post',
			data:{deleteid:deleteid},
			success:function(data,status){
				readRecords();
			}

		});
	}
}

function EditDetails(id){
	$('#hiddenuserid').val(id);

	$.post("BackendTask.php", {
		id:id
	}, function(data,status){
		var user = JSON.parse(data);
		$('#u_firstname').val(user.firstname);
		$('#u_lastname').val(user.lastname);
		$('#u_mobnum').val(user.mobile);
		$('#u_emailid').val(user.email);
	}

		);
	$('#update_user_modal').modal("show");
}


function updateDetails(){
	var ufirstname= $('#u_firstname').val();
	var ulastname= $('#u_lastname').val();
	var umobile= $('#u_mobnum').val();
	var uemail= $('#u_emailid').val();

	var hidden_user_idd=$('#hiddenuserid').val();

	$.post("BackendTask.php",
		{hidden_user_idd:hidden_user_idd,
		ufirstname:ufirstname,
		ulastname:ulastname,
		uemail:uemail,
		umobile:umobile,
	},
	function(data,status){
		$('#update_user_modal').modal("hide");
		readRecords();
	}


		);
}

</script>

</body>
</html>