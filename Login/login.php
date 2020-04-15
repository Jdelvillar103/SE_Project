<?php
session_start();

require_once('../mysql-connect.php');

if(isset($_POST['email']))
{
  if(isset($_POST['Password']))
  {
    $email = $_POST["email"];
    $password = $_POST["Password"];

    $query = "SELECT P.ID_Profile, P.Email, C.Password FROM profile AS P,credentials AS C WHERE P.Email = '$email' && C.Password = '$password';";
    $response = @mysqli_query($dbc,$query);
    if($response)
    {
      while ($row = mysqli_fetch_array($response))
      {
        $ID = $row['ID_Profile'];
        $tempEmail = $row['Email'];
        $tempPass = $row['Password'];
      }
      if($email == $tempEmail && $password == $tempPass)
      {
        $_SESSION['ID'] = $ID;
        mysqli_close($dbc);
        $url = "../FuelQuoteInformation/FuelQuotePage.php";
        header("Location: ".$url);
        exit();
      }
      else
      {
        $Unauthorized = "Email or Password Wrong: Case Sensitive!";
        $_SESSION['Unauthorized'] = $Unauthorized;
        mysqli_close($dbc);
        $url = "loginPage.php";
        header("Location: ".$url);
        exit();
      }
    }
    else
    {
      mysqli_close($dbc);
      $url = "loginPage.php";
      header("Location: ".$url);
      exit();
    }
  }
}
 ?>
