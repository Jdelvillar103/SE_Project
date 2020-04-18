<?php
    session_start();

    require_once('./mysql-connect.php');

    if(isset($_POST['FName'])){
        $ID = $_SESSION['ID'];
        $Pa_First = $_POST['FName'];
        $Pa_MInit = $_POST['MInit'];
        $Pa_Last = $_POST['LName'];
        $CardType = $_POST['CType'];
        $CardNum = $_POST['CardNumber'];
        $ExpMonth = $_POST['ExpMonth'];
        $ExpYear = $_POST['ExpYear'];
        $CVV = $_POST['CVV'];


        if (!(ctype_alpha(str_replace(' ', '', $Pa_First))))
        {
            mysqli_close($dbc);
            $Valid = "INVALID: First Name must only contain letters";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
        }
        elseif (!ctype_alpha($Pa_MInit)&&$Pa_MInit!=null)
        {
            mysqli_close($dbc);
            $Valid = "INVALID: Middle Initial must only contain Letter";
            $_SESSION['Valid'] = $Valid;
            $url = "../Order.php";
            header("Location: ".$url);
            exit();
        }
        elseif (!ctype_alpha(str_replace(' ', '', $Pa_Last)))
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
		
		else{
            echo "What up dog you just entered the else statement\n";
            //Payment
            if($_SESSION['Role'] == 2){//User has is registered w/o payment info
                //Add new payment information to DB
                $query = "INSERT INTO payment(ID_Payment,Pa_FName,Pa_LName,CardType,CardNum,ExpMonth,ExpYear,CVV) VALUES('$ID','$Pa_First','$Pa_Last','$CardType','$CardNum','$ExpMonth','$ExpYear','$CVV')";
                $dbc->query($query);  
                $_SESSION['Role'] = 1;
                mysqli_close($dbc);
                echo "Role is equal 2\n";
            }
            elseif($_SESSION['Role']==1)//If payment information has been saved
            {//Update payment information
                $sql = "UPDATE payment SET Pa_FName = '$Pa_First', Pa_LName = '$Pa_Last', CardType = '$CardType', CardNum = '$CardNum', ExpMonth = '$ExpMonth', ExpYear = '$ExpYear', CVV = '$CVV' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
                mysqli_close($dbc);
                echo "Role is equal 1";
                
            }

            if($Pa_MInit!=null)
            {
                $sql = "UPDATE payment SET Pa_MInit = '$Pa_MInit' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
            }

            //Add products to cart
            if(!empty($_SESSION["shopping_cart"]))  
            {  
                $total = $_SESSION['CartTotal'];
                $query = "INSERT INTO cart(ID_Cust,CStatus,Total) VALUES('$ID','2','$total')";
                $dbc->query($query);
                
                $query = "SELECT ID_Cart FROM `cart` WHERE ID_Cust = '$ID' ORDER BY DateCreated DESC LIMIT 1;";
                $retrival = mysqli_query( $dbc, $query );
                
                while ($row = mysqli_fetch_array($retrival))
                {
                    $CartID = $row['ID_Cart'];
                    foreach($_SESSION["shopping_cart"] as $keys => $values)  
                    {
                        $item_array = $_SESSION["shopping_cart"][$keys];

                        $PrID = $item_array['item_id'];
                        $Quantity = $item_array['item_quantity'];
                        $Price = $Quantity*$item_array['item_price'];
                        
                    $query = "INSERT INTO cartItems(CartID,ProductID,Quantity, Price) VALUES('$CartID','$PrID','$Quantity','$Price')";
                    $dbc->query($query);
                    }
                }
                
            }
            unset($_SESSION["shopping_cart"]);
            header("Location: ./index.php?checkout=successful");
			exit();

        }
		
		//$retrival = mysqli_query( $dbc, $sqlquery );
        //$num_rows = mysqli_num_rows($retrival);
        
        //Create Reciept
        /*
            $myfile = fopen("Reciept.txt", "w") or die("Unable to open file!");
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                $txt= $PrID + "\t" + $Quantity + "\t" + $Price + "\t" $total + "\n";
            }
            fwrite($myfile, $txt);
            $Address = $SESSION["ID"]
            $txt = "Delivered To: " + $FName + " " + $LName + " Address: ";
            fwrite($myfile, $txt);
            fclose($myfile);
        */
		

	}

    ?>