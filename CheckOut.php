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
                $sql = "UPDATE profile SET Role = '1' WHERE ID_Profile = '$ID';";
                mysqli_query( $dbc, $sql );
                //mysqli_close($dbc);
                echo "Role is equal 2\n";
            }
            elseif($_SESSION['Role']==1)//If payment information has been saved
            {//Update payment information
                $sql = "UPDATE payment SET Pa_FName = '$Pa_First', Pa_LName = '$Pa_Last', CardType = '$CardType', CardNum = '$CardNum', ExpMonth = '$ExpMonth', ExpYear = '$ExpYear', CVV = '$CVV' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
                echo "Role is equal 1";
                //mysqli_close($dbc);
                
            }

            if($Pa_MInit!=null)
            {
                $sql = "UPDATE payment SET Pa_MInit = '$Pa_MInit' WHERE ID_Payment = '$ID';";
                mysqli_query( $dbc, $sql );
                //mysqli_close($dbc);
            }

            //Add products to cart
            if(isset($_SESSION["shopping_cart"]))  
            {  
                $total = $_SESSION['CartTotal'];
                $query = "INSERT INTO cart(ID_Cust,CStatus,Total) VALUES('$ID','2','$total')";
                $retrival = mysqli_query( $dbc, $query );
                
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
                    $retrival = mysqli_query( $dbc, $query );
                    }
                }
                //mysqli_close($dbc);
            }
            //unset($_SESSION["shopping_cart"]);
            unset($_SESSION["Verified"]);

            $query = "SELECT ID_Cart FROM `cart` WHERE ID_Cust = '$ID' ORDER BY DateCreated DESC LIMIT 1;";
                $retrival = mysqli_query( $dbc, $query );
                
                $row = mysqli_fetch_array($retrival);
                $CartID = $row['ID_Cart'];

            $sql = "SELECT pr.FName, pr.LName, pr.Address, pr.City, s.StateAbbreviation, pr.Email, pr.Zipcode, pa.Pa_FName, pa.Pa_MInit, pa.Pa_LName, ct.CTypeN, pa.CardNum, pa.ExpMonth, pa.ExpYear, c.ID_Cart, c.DateCreated, c.Total 
                        FROM profile as pr, cart as c, payment as pa, states as s, card_type as ct
                         where pr.ID_Profile = pa.ID_Payment and pr.ID_Profile = c.ID_Cust and s.ID_State = pr.State and ct.ID_CType = pa.CardType 
                         and c.ID_Cart = $CartID and pr.ID_Profile = $ID";

            $stmt = mysqli_query( $dbc, $sql );
            while ($row = mysqli_fetch_array($stmt))
                {
                    //Create File
                    
                    //Set Variables from the query [if necessary]
                    $PR_FName = $row['FName'];

                    //Open File
                    $myfile = fopen( $CartID.".txt", "w") or die("Unable to open file!");
                    
                    //Enters Customer and carts information
                    $txt= "Order For: ".$row['FName']." ".$row['LName']."\n\nEmail: ".$row['Email']. "\n\n";
                    fwrite($myfile, $txt);
                    $txt= "Order ID: ".$row['ID_Cart']. "\n\n";
                    fwrite($myfile, $txt);

                    $txt= "Billing Info: ".$row['Pa_FName']." ".$row['Pa_LName']." \n".$row['CTypeN']."\nXXXX-XXXX-".substr($row['CardNum'],8)."\n\n";//xxxx-xxxx-L4Ds
                    fwrite($myfile, $txt);

                    $txt= "Delivery Information: \n\tAddress: ".$row['Address'].", ".$row['City'].", ".$row['StateAbbreviation']." ".$row['Zipcode']."\n\nORDER DETAILS:\n";
                    fwrite($myfile, $txt);

                    //Insert Product Information;
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {
                        //Create A temporary Array to store shopping cart
                        $item_array = $_SESSION["shopping_cart"][$keys];

                        //Set variables for every attribte stored in the temp array
                        $PrID = $item_array['item_id'];
                        $PrName = $item_array['item_name'];
                        $Quantity = $item_array['item_quantity'];
                        $Price = $Quantity*$item_array['item_price'];
                        $txt= $PrID."\t".$PrName."\tQuantity: ".$Quantity."\tPrice: $".$Price."\n";
                        fwrite($myfile, $txt);
                        
                        
                    }
                    
                    //fwrite($myfile, $txt);
                   // $Address = $SESSION["ID"];
                    //$txt = "Delivered To: " + $FName + " " + $LName + " Address: ";
                   // fwrite($myfile, $txt);
                    fclose($myfile);
                    echo "Closed FIle";
                }

            //return $stmt->fetchAll();
            unset($_SESSION['shopping_cart']);
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
                $txt= $PrID + "\t" + $Quantity + "\t" + $Price + "\t" + $total + "\n";
            }
            fwrite($myfile, $txt);
            $Address = $SESSION["ID"];
            $txt = "Delivered To: " + $FName + " " + $LName + " Address: ";
            fwrite($myfile, $txt);
            fclose($myfile);
        
            */

	}

?>