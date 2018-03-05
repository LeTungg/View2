<!DOCTYPE html>
<html>
<head>
	<style>
	    body, html{
			margin: 0;
			font-size:18px;
		}
		ul {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #333;
		}

		li {
    		float: left;
		}

		li a {
		    display: block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		    width: 100%
		}

		li a:hover {
		    background-color: #111;
		}
		form {
    		border: 3px solid #f1f1f1;
		}
		input[type=text], input[type=password] {
		    width: 100%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    box-sizing: border-box;
		}

		button {
		    background-color: #4CAF50;
		    color: white;
		    padding: 14px 20px;
		    margin: 8px 0;
		    border: none;
		    cursor: pointer;
		    width: 100%;
		}

		button:hover {
		    opacity: 0.8;
		}

		.cancelbtn {
		    width: auto;
		    padding: 10px 18px;
		    background-color: #f44336;
		}
		.container {
			margin: auto;   			
		    padding: 20px;
		    width: 50%;
		}

		span.psw {
		    float: right;
		    padding-top: 16px;
		}
		body > form > div > a {
		    background-color: #4CAF50;
		    color: white;
		    padding: 14px 20px;
		    display: inline-block;
		    text-decoration: none;

		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
		    span.psw {
		       display: block;
		       float: none;
		    }
		    .cancelbtn {
		       width: 100%;
		    }
		}
	</style>

</head>
<?php
$connect = mysql_connect("localhost","root","") or die("could not connect to server");
mysql_select_db("test") or die (mysql_error($connect));
$id = $_GET['id'];
$result = mysql_query("SELECT * FROM user WHERE admin_id=$id");
?>
<body>
	<div>
		<ul>
		  <li><a class="active" href="mainpage.php">Home</a></li>
		  <li><a href="CreateStu.php">Create New Student</a></li>
		  <li><a href="studentlist.php">Student List</a></li>
		  <li><a href="account.php">Account Manager</a></li>
		</ul>
	</div>
	<h2 align="center">Infomation of Student</h2>
<form action="/action_page.php">
  <div class="container">
  	<?php
  	while($row = mysql_fetch_assoc($result)){	
  	?>
	  	<label><b>ID</b></label>
	    <input  type="text" name="textid" value="<?php echo $row["admin_id"] ?>"  required>
	    <label><b>Name</b></label>
	    <input type="text" name="textname" value="<?php echo $row["fullname"] ?>" required>
	    <label><b>DOB</b></label>
	    <input type="text" name="textdob" value="<?php echo date('m/d/Y', $row["dob"]) ?>" required>
	    <label><b>Address</b></label>
	    <input type="text" name="textaddress" value="<?php echo $row["address"] ?>" required>
	<?php
	}
	?>
	<?php 
	if(isset($_POST['fullname']) and isset($_POST['dob']) and isset($_POST['address'])){
	$fullname = $_POST['fullname'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$query ="Update user set fullname=$fullname, dob=$dob, address=$address WHERE id = $id";
	mysql_query($query);
	if (mysql_affected_rows()>0) 
		echo "Update Success!";
	else
		echo "fail";
	 ?>
	 <?php
	 } 
	 ?>
    <input type="submit" name="submit" value="Change" > 
  </div>
</form>
</div>
</body>
</html>