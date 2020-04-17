<!DOCTYPE html>
<html lang="en">
<?php   
 session_start();  
 require_once('../mysql-connect.php');
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  //If it is not in cart, but cart is not empty
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;
                echo '<script>window.location = "../index.php"</script>';  
           }  
           else //If Item is already in cart 
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location = "../index.php"</script>';  
           }  
      }  
      else  //If Cart is empty
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
           echo '<script>window.location = "../index.php"</script>';
      }  
 }  

 ?>
 </html>
