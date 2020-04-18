<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
    </head>
    <body>
    <?php
    session_start();

    require_once('../mysql-connect.php');

    $email = $_POST['NewEmail'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $StateN = $_POST['StateN'];
    $Zipcode = $_POST['Zipcode'];
    $Password = $_POST['Npass'];
    $CPassword = $_POST['2pass'];

		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
      $query = "SELECT P.Email FROM profile AS P WHERE P.Email = '$email';";
      $response = mysqli_query($dbc,$query);

      while ($row = mysqli_fetch_array($response))
      {
        $RetrivedEmail = $row['Email'];
        echo $row['Email'];
      }
      if ($RetrivedEmail == $email)
      {
        mysqli_close($dbc);
        $Valid = "Email Already Exists: Try Logging in";
        $_SESSION['Valid'] = $Valid;
        $url = "../index.php";
        header("Location: ".$url);
        exit();
      }
      if (ctype_alpha(str_replace(' ', '', $FName)))
      {
        if (ctype_alpha(str_replace(' ', '', $LName)))
        {
          $Address = filter_var($Address,FILTER_SANITIZE_SPECIAL_CHARS);
          if(ctype_alpha(str_replace(' ', '', $City)))
          {
            if(filter_var($Zipcode,FILTER_VALIDATE_INT) && strlen($Zipcode) == 5)
            {
              if ($Password == $CPassword)
              {
                $query = "SELECT S.ID_State FROM states AS S WHERE S.StateName = '$StateN'";
                $response = $dbc->query($query);
                while ($row = mysqli_fetch_array($response))
                {
                  $ID_State = $row['ID_State'];
                }

                $query = "INSERT INTO profile(Email,FName,LName,Address,City,State,Zipcode) VALUES ('$email','$FName','$LName','$Address','$City','$ID_State','$Zipcode')";
                $result = $dbc->query($query);
                $_SESSION['Role'] = 2;
                $query = "SELECT P.ID_Profile FROM profile AS P WHERE '$email' = P.Email";
                $response = $dbc->query($query);
                while($row = mysqli_fetch_array($response))
                {
                  $ID_Profile = $row['ID_Profile'];
                }

                $query = "INSERT INTO credentials VALUES('$ID_Profile','$Password')";
                $dbc->query($query);

                mysqli_close($dbc);

                $Valid = "Account Created: Log In";
                $_SESSION['Valid'] = $Valid;
                $url = "../index.php";
                header("Location: ".$url);
                exit();
              }
              else
              {
                mysqli_close($dbc);
                $Valid = "INVALID: Passwords Don't Match";
                $_SESSION['Valid'] = $Valid;
                $url = "../index.php";
                header("Location: ".$url);
                exit();
              }
            }
            else
            {
              mysqli_close($dbc);
              $Valid = "INVALID: Zip Code MUST be 5 Integers";
              $_SESSION['Valid'] = $Valid;
              $url = "../index.php";
              header("Location: ".$url);
              exit();
        		}
          }
          else
          {
            mysqli_close($dbc);
            $Valid = "INVALID: City must only contain characters";
            $_SESSION['Valid'] = $Valid;
            $url = "../index.php";
            header("Location: ".$url);
            exit();
      		}
        }
        else
        {
          mysqli_close($dbc);
          $Valid = "INVALID: Last Name must be only char";
          $_SESSION['Valid'] = $Valid;
          $url = "../index.php";
          header("Location: ".$url);
          exit();
    		}
      }
      else
      {
        mysqli_close($dbc);
        $Valid = "INVALID: First Name must be only char";
        $_SESSION['Valid'] = $Valid;
        $url = "../index.php";
        header("Location: ".$url);
        exit();
  		}
		}
		else
    {
      $Valid = "INVALID EMAIL: example@gmail.com";
      $_SESSION['Valid'] = $Valid;
      $url = "../index.php";
      header("Location: ".$url);
      exit();
		}

    ?>
    </body>
</html>
