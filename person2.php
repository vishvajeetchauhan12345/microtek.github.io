<?php
$name=$_POST['name'];
$email=$_POST['email'];
$mn=$_POST['mn'];
$txta=$_POST['txta'];
if (!empty($name) || !empty($email)|| !empty($mn)|| !empty($txta)) {

$host='localhost';
$user='root';
$pass='';
$db='mydb1';
$conn= new mysqli($host,$user,$pass,$db);
if (mysqli_connect_error()) 
{
	die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
}
else{
	$SELECT="SELECT email  From mytable1 Where email=? Limit 1";
	$INSERT="INSERT Into mytable1(name,email,mn,txta)value(?,?,?,?)";
	//prepare statement
	$stmt=$conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;
	if ($rnum==0) {
		$stmt->close();
		$stmt=$conn->prepare($INSERT);
	    $stmt->bind_param("ssis",$name,$email,$mn,$txta);
	    $stmt->execute();
	    echo "new record inserted successfully";
	}
	else
	{
		echo "someone already registered";
	}
	$stmt->close();
	$conn->close();;
}
}
else
	{
		echo "All feild are required";
		die();
	}
?>