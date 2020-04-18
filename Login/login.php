<?php
session_start();

require_once('../mysql-connect.php');

if(isset($_POST['email']))
{
  if(isset($_POST['psw']))
  {
    $email = $_POST["email"];
    $password = $_POST["psw"];

    $query = "SELECT P.ID_Profile, P.Email, P.Role, C.Password FROM profile AS P,credentials AS C WHERE P.Email = '$email' && C.Password = '$password';";
    $response = @mysqli_query($dbc,$query);
    if($response)
    {
      while ($row = mysqli_fetch_array($response))
      {
        $ID = $row['ID_Profile'];
        $tempEmail = $row['Email'];
        $tempPass = $row['Password'];
        $Role = $row['Role'];
        $_SESSION['Role'] = $Role;
      }
      if($email = $tempEmail && $password = $tempPass)
      {
        $_SESSION['ID'] = $ID;
        mysqli_close($dbc);
        $url = "../index.php";
        header("Location: ".$url);
        exit();
      }
      else
      {
        $Unauthorized = "Email or Password Wrong: Case Sensitive!";
        $_SESSION['Unauthorized'] = $Unauthorized;
        mysqli_close($dbc);
        $url = "../index.php";
        header("Location: ".$url);
        exit();
      }
    }
    else
    {
      mysqli_close($dbc);
      $url = "../index.php";
      header("Location: ".$url);
      exit();
    }
  }
}
 ?>
