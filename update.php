<?php
    session_start();

    require_once('./mysql-connect.php');
    ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
    </head>
    <body>

    <?php
 

    if(isset($_POST['submit'])){
		$first = $_POST['FName'];
		$last = $_POST['LName'];
		$address = $_POST['Address'];
		$city = $_POST['City'];
		$state = $_POST['StateN'];
		$zipcode = $_POST['Zipcode'];
		$Email = $_POST['Email'];
		$Profile = $_POST['profile'];

		$sqlquery = "SELECT * FROM `profile` WHERE ID_Profile <> '$Profile' AND `Email` = '$Email';";
		$retrival = mysqli_query( $dbc, $sqlquery );
		$num_rows = mysqli_num_rows($retrival);

		$valuelength = max(strlen($first) , strlen($last) , strlen($address) , strlen($state));


		if(empty($first) || empty($last) || empty($address)|| empty($city) || empty($state) || empty($zipcode)){
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=empty");
			exit();
		}
		elseif (!preg_match("/^[a-zA-Z ]*$/",$first) || !preg_match("/^[a-zA-Z ]*$/",$last) || !preg_match("/^[a-zA-Z ]*$/",$city) ) {
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=variable");
			exit();

		}
		elseif($valuelength > 20){
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=inputlarge");
			exit();
		}
		elseif(!preg_match("/^[0-9]{5}$/",$zipcode)){
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=ziplarge");
			exit();
		}

		elseif(!preg_match("/[0-9]/",$zipcode)){
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=number");
			exit();
		}
		
		elseif($num_rows > 0 ){
      mysqli_close($dbc);
			header("Location: ./profile.php?profile=duplicate");
			exit();
		}
		else{

			$sql = "UPDATE profile SET Email = '$Email',FName = '$first',LName = '$last',Address = '$address',City = '$city',State = '$state',Zipcode = '$zipcode' WHERE ID_Profile = '$ID';";
      mysqli_query( $dbc, $sql );
      mysqli_close($dbc);
      header("Location: ./profile.php?profile=success");
      exit();
		}

	}

    ?>
    </body>
</html>
