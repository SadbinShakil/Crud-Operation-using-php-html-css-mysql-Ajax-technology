<?php 
$conn = mysqli_connect('localhost','root','','crud');


//for SQL injection and ssx attack prevention
function input($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    $data = htmlentities($data);
    return $data;
}




extract($_POST);

if(isset($_POST['readrecord'])){
	$data='<table class="table table-bordered table-striped">
	              <tr>
	                  <th>SerialNo.</th>
	                  <th>FirstName</th>
	                  <th>LastName</th>
	                  <th>Email</th>
	                  <th>PhoneNumber</th>
	               </tr>

	';

$query2="select * from info";
$result=mysqli_query($conn,$query2);

if(mysqli_num_rows($result)>0){
	$number=1;
	while ($row=mysqli_fetch_array($result)) {
		$data .='<tr>
		      <td>' .$number.'</td>
		      <td>' .$row['firstname'].'</td>
		      <td>' .$row['lastname'].'</td>
		      <td>' .$row['email'].'</td>
		      <td>' .$row['mobile'].'</td>
		      <td>
		           <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
	           </td>

	           <td>
	           <button onclick="EditDetails('.$row['id'].')" class="btn btn-secondary">Edit</button>
	           </td>
		     </tr>';

		     $number++;
	}
}
$data .= '</table>';
echo $data;
}


if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']) ){

	$firstname=input($_POST['firstname']);
	$lastname=input($_POST['lastname']);
	$mobile=input($_POST['mobile']);
	$email=input($_POST['email']);


	$querey = "insert into info(firstname,lastname,mobile,email)values('$firstname','$lastname','$mobile','$email')";
	mysqli_query($conn,$querey);
}

//delete code
if(isset($_POST['deleteid'])){
	$userid=$_POST['deleteid'];

	$delquery="delete from info where id='$userid' ";
    mysqli_query($conn,$delquery);
}


//edit code
if(isset($_POST['id']) && isset($_POST['id']) !=""){
	$user_id = $_POST['id'];
	$query= "select * from info where id= '$user_id' ";

	if (!$result=mysqli_query($conn,$query)) {
		exit(mysqli_error());
	}
	$response =  array();
	if (mysqli_num_rows($result)>0) {
		while($row=mysqli_fetch_assoc($result)){
			$response=$row;
		}
	}
	else{
		$response['status']=200;
		$response['message']="Data not found.";
	}
	echo json_encode($response);
}
else{
	$response['status']=200;
	$response['message']="invalid request.";
}


if(isset($_POST['hidden_user_idd'])){
	$hidden_user_idd= $_POST['hidden_user_idd'];
	$ufirstname= htmlspecialchars($_POST['ufirstname']);
	$ulastname= htmlspecialchars($_POST['ulastname']);
	$uemail= htmlspecialchars($_POST['uemail']);
	$umobile= htmlspecialchars($_POST['umobile']);

	$query="update info set firstname='$ufirstname', lastname='$ulastname', email='$uemail',mobile='$umobile' where id='$hidden_user_idd' ";

	mysqli_query($conn,$query);
	
}


 ?>