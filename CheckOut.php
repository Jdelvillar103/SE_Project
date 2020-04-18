<?php
    session_start();

    require_once('./mysql-connect.php');

    if(isset($_POST['Check Out'])){
        $ID = $_SESSION['ID'];
        $Pa_First = $_POST['FName'];
        $Pa_MInit = $_POST['MInit'];
        $Pa_Last = $_POST['LName'];
        $CardType = $_POST['CType'];
        $CardNum = $_POST['CardNumber']
        $ExpMonth = $_POST['ExpMonth']
        $ExpYear = $_POST['ExpYear'];
        $CVV = $_POST['CVV'];

        if (!ctype_alpha(str_replace(' ', '', $FName)))
        {
            mysqli_close($dbc);
            $Valid = "INVALID: First Name must only contain letters";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
        }
        elseif (!preg_match("/^[a-z][A-Z]{1}$/"$MInit)&&$MInit!=null)
        {
            mysqli_close($dbc);
            $Valid = "INVALID: Middle Initial must only contain Letter";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
        }
        elseif (!ctype_alpha(str_replace(' ', '', $LName)))
        {
            mysqli_close($dbc);
            $Valid = "INVALID: CVV must only contain Numbers";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
        }
        elseif(!preg_match("/^[0-9]{3}$/",$CVV)){
            mysqli_close($dbc);
            $Valid = "INVALID: CVV must only contain Numbers";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
		}
		elseif(!preg_match("/[0-9]/",$zipcode)){
            mysqli_close($dbc);
            $Valid = "INVALID: Last Name must only contain letters";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
		}
		else{
            //Payment
            if($_SESSION['Role'] == 2){//User has is registered w/o payment info
                //Add new payment information to DB
                $query = "INSERT INTO payment(ID_Payment,Pa_FName,Pa_LName,CardType,CardNum,ExpMonth,ExpYear) VALUES('$ID','$Pa_FName','$Pa_LName','$CardType','$CardNum','$ExpMonth','$ExpYear')";
                $dbc->query($query);  
                $_SESSION['Role'] = 1;
                mysqli_close($dbc);
            }
            elseif($_SESSION['Role']==1)//If payment information has been saved
            {//Update payment information
                $sql = "UPDATE payment SET Pa_FName = '$Pa_FName', Pa_LName = '$Pa_LName', CardType = '$CardType', CardNum = '$CardNum', ExpMonth = '$ExpMonth', ExpYear = '$ExpYear' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
                mysqli_close($dbc);
            }

            if($MInit!=null)
            {
                $sql = "UPDATE payment SET Pa_MInit = '$MInit' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
            }

            //Add products to cart
            

        }
		

		$sqlquery = "SELECT * FROM `profile` WHERE ID_Profile <> '$Profile' AND `Email` = '$Email';";
		$retrival = mysqli_query( $dbc, $sqlquery );
		$num_rows = mysqli_num_rows($retrival);

		$valuelength = max(strlen($first) , strlen($last) , strlen($address) , strlen($state));

        //Create Reciept
        /*
            <?php
                $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                $txt = "John Doe\n";
                fwrite($myfile, $txt);
                $txt = "Jane Doe\n";
                fwrite($myfile, $txt);
                fclose($myfile);
            ?>
        */
		

	}

    ?>