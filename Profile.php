<?php
  session_start();
  require_once('./mysql-connect.php');

  if(isset($_SESSION['Valid']))
  {
    $Valid = $_SESSION['Valid'];
  }

  if(isset($_SESSION['Unauthorized']))
  {
    $Unauthorized = $_SESSION['Unauthorized'];
  }

  /*if(isset($_SESSION['ID']))
  {
    session_destroy();
  }*/
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce Store</title>


    <!--Bootstrap CDN-->
    <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
        crossorigin="anonymous" 
    />

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/b7a61c9463.js" crossorigin="anonymous"></script>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="./css/style.css" />

    <!-- Slick Library-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    
</head>

<body>

    <!--
        button.bt.btn - exemple shortcut to add a class
        Another example: div.container  -- TAB
    -->

    <!-- To host a live developmental server:

    Open VSCode and type ctrl+P , type ext install ritwickdey  -->
    

    <!-- header-->
    <header>
        <div class="container"> 
            <div class="row">
                <div class="col-md-3 col-sm-12 col-12">
                   
                </div>
                <div class="col-md-6 col-12 text-center">
                    <h2 class="my-md-3 site-title text-white" style="font-family:roboto; font-size:60px">Pete's Online Store</h2>
                </div>
                <div class="col-md-3 col-12 text-right">
                    <p class="md-3 header-links">

                        <!-- Beginning of code that only runs when NOT logged in-->
                        <?php
                            if(isset($_SESSION['ID']))//If logged in, display login button
                            {
                                $ID = $_SESSION['ID'];
                                $query = "SELECT P.FName FROM profile AS P WHERE P.ID_Profile = '$ID';";
                                $response = @mysqli_query($dbc,$query);
                                while ($row = mysqli_fetch_array($response))
                                {
                                    $FName = $row['FName'];
                                }
                                echo '<p class="px-2" style="margin-center:825px; font-size: 20px; padding-bottom: 3px; color:white">'.'Welcome '.$FName.'!'.'</p>';
                                
                                echo '<a class="px-2"  style="color:black; width:auto; border-style: solid; border-color:black; font-size:20px;padding: 5px 30px; background-color:white;"href="./Login/logout.php" >Log Out</a>';
                            }
                            else{
                                header("location:index.php");
                                die;
                            }
                        ?>
                        
                    </p>
                </div>
            </div>
        <div class="container-fluid p-0" style="padding-top:20px;">
            <nav class="navbar navbar-expand-lg navbar-light bg-white" style ="font-size:22px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Profile.php">Profile<span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/AboutUs.php">About Us</a>
                    </li>
                </ul>
            </div>
             <div class="navbar-nav">
                
                <li class="nav-item border rounded-circle mx-2 basket-icon">
                    <a class="fas fa-shopping-basket p-2 nav-link" href="Order.php"></a>  
                </li>   
            </div>            
        </nav>
    </div>    
    </header>
    <!-- Main Section-->
    <main>
    
    <div class ="container">
                <div class = row>
                    <div class = "col-lg-2 col-md-2 col-xs-2" >
                        <div class = "col1">
<?php
    $sql = "SELECT * FROM `profile` WHERE `ID_Profile` = '$ID'";
    $results = mysqli_query($dbc,$sql);
    $resultCheck = mysqli_num_rows($results);
    if($resultCheck>0){
        while($row = mysqli_fetch_assoc($results)){
            $FName = $row['FName'];
            $LName = $row['LName'];
            $Address = $row['Address'];
            $City = $row['City'];
            $ID_State = $row['State'];
            $Zipcode = $row['Zipcode'];
            $Email = $row['Email'];
            $Profile = $row['ID_Profile'];

        }
        mysqli_close($dbc);
    }
    else
    {
      mysqli_close($dbc);
    }
?>
                            
    
                        </div>
                    </div>
                    <div class = "col-lg-8 col-md-8 col-xs-8">
                        <div class = "col2">
    
    
    
    
    
                            <div class="container">
                                <div class="login">
                                    <h1 style="font-size:50px" class="text-left">Update Your Profile</h1>
                                    <br>
                <!-- PHP Display-->
                <?php
                $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


                if (strpos($fullurl,"profile=empty") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'All fields are were not filled'.'</b>'.'</p>';
                
                }
                if((strpos($fullurl,"profile=inputlarge") == true)){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Invaild input size, try a smaller size or contact the administrator'.'</b>'.'</p>';

                }

                if((strpos($fullurl,"profile=variable") == true)){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Please use only letters'.'</b>'.'</p>';


                }

                if (strpos($fullurl,"profile=number") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Please use a number'.'</b>'.'</p>';


                }

                if (strpos($fullurl,"profile=email") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Please use a valid email address'.'</b>'.'</p>';


                }

                if (strpos($fullurl,"profile=ziplarge") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Please use a smaller zip code'.'</b>'.'</p>';


                }

                if (strpos($fullurl,"profile=duplicate") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:red">'.'<b>'.'Duplicate email address'.'</b>'.'</p>';


                }

                if (strpos($fullurl,"profile=success") == true){
                    echo '<p class="px-2 text-right" style="margin-center:825px; font-size: 20px; padding-bottom: 5px; color:green">'.'<b>'.'Update Successful'.'</b>'.'</p>';

                }

            ?>
                                    <form  action="../update.php" method="post">
                                        <div>
                                            <label for="first-name" style="font-size:20px">First Name:</label>
                                            <input type="text" name="FName" id="first-name" value="<?php echo $FName; ?>" contenteditable="true"> <br><br>
                                            <label for="last-name" style="font-size:20px">Last Name:</label>
                                            <input type="text" name="LName" id="last-name" value="<?php echo $LName; ?>" contenteditable="true"><br><br>
                                        </div>
                                        <div>
                                            <label for="address1" style="font-size:20px">Address 1:</label>
                                            <input type="text" name="Address" id="address" value="<?php echo $Address; ?>" contenteditable="true"> <br><br>
                                            <label for="city" style="font-size:20px">City:</label>
                                            <input type="text" name="City" id="city" value="<?php echo $City; ?>" contenteditable="true"> <br> <br>
    
                                            <label style="font-size:20px">State: </label>
                                            <select name="StateN" id="select-choice">
                                                <option <?php if ($ID_State == 1) echo 'selected="selected"'; ?> value=1>Alabama</option>
                                                <option <?php if ($ID_State == 2) echo 'selected="selected"'; ?> value=2>Alaska</option>
                                                <option <?php if ($ID_State == 3) echo 'selected="selected"'; ?> value=3>Arizona</option>
                                                <option <?php if ($ID_State == 4) echo 'selected="selected"'; ?> value=4>Arkansas</option>
                                                <option <?php if ($ID_State == 5) echo 'selected="selected"'; ?> value=5>California</option>
                                                <option <?php if ($ID_State == 6) echo 'selected="selected"'; ?> value=6>Colorado</option>
                                                <option <?php if ($ID_State == 7) echo 'selected="selected"'; ?> value=7>Connecticut</option>
                                                <option <?php if ($ID_State == 8) echo 'selected="selected"'; ?> value=8>Delaware</option>
                                                <option <?php if ($ID_State == 9) echo 'selected="selected"'; ?> value=9>Florida</option>
                                                <option <?php if ($ID_State == 10) echo 'selected="selected"'; ?> value=10>Georgia</option>
                                                <option <?php if ($ID_State == 11) echo 'selected="selected"'; ?> value=11>Hawaii</option>
                                                <option <?php if ($ID_State == 12) echo 'selected="selected"'; ?> value=12>Idaho</option>
                                                <option <?php if ($ID_State == 13) echo 'selected="selected"'; ?> value=13>Illinois</option>
                                                <option <?php if ($ID_State == 14) echo 'selected="selected"'; ?> value=14>Indiana</option>
                                                <option <?php if ($ID_State == 15) echo 'selected="selected"'; ?> value=15>Iowa</option>
                                                <option <?php if ($ID_State == 16) echo 'selected="selected"'; ?> value=16>Kansas</option>
                                                <option <?php if ($ID_State == 17) echo 'selected="selected"'; ?> value=17>Kentucky</option>
                                                <option <?php if ($ID_State == 18) echo 'selected="selected"'; ?> value=18>Louisiana</option>
                                                <option <?php if ($ID_State == 19) echo 'selected="selected"'; ?> value=19>Maine</option>
                                                <option <?php if ($ID_State == 20) echo 'selected="selected"'; ?> value=20>Maryland</option>
                                                <option <?php if ($ID_State == 21) echo 'selected="selected"'; ?> value=21>Massachusetts</option>
                                                <option <?php if ($ID_State == 22) echo 'selected="selected"'; ?> value=22>Michigan</option>
                                                <option <?php if ($ID_State == 23) echo 'selected="selected"'; ?> value=23>Minnesota</option>
                                                <option <?php if ($ID_State == 24) echo 'selected="selected"'; ?> value=24>Mississippi</option>
                                                <option <?php if ($ID_State == 25) echo 'selected="selected"'; ?> value=25>Missouri</option>
                                                <option <?php if ($ID_State == 26) echo 'selected="selected"'; ?> value=26>Montana</option>
                                                <option <?php if ($ID_State == 27) echo 'selected="selected"'; ?> value=27>Nebraska</option>
                                                <option <?php if ($ID_State == 28) echo 'selected="selected"'; ?> value=28>Nevada</option>
                                                <option <?php if ($ID_State == 29) echo 'selected="selected"'; ?> value=29>New Hampshire</option>
                                                <option <?php if ($ID_State == 30) echo 'selected="selected"'; ?> value=30>New Jersey</option>
                                                <option <?php if ($ID_State == 31) echo 'selected="selected"'; ?> value=31>New Mexico</option>
                                                <option <?php if ($ID_State == 32) echo 'selected="selected"'; ?> value=32>New York</option>
                                                <option <?php if ($ID_State == 33) echo 'selected="selected"'; ?> value=33>North Carolina</option>
                                                <option <?php if ($ID_State == 34) echo 'selected="selected"'; ?> value=34>North Dakota</option>
                                                <option <?php if ($ID_State == 35) echo 'selected="selected"'; ?> value=35>Ohio</option>
                                                <option <?php if ($ID_State == 36) echo 'selected="selected"'; ?> value=36>Oklahoma</option>
                                                <option <?php if ($ID_State == 37) echo 'selected="selected"'; ?> value=37>Oregon</option>
                                                <option <?php if ($ID_State == 38) echo 'selected="selected"'; ?> value=38>Pennsylvania</option>
                                                <option <?php if ($ID_State == 39) echo 'selected="selected"'; ?> value=39>Rhode Island</option>
                                                <option <?php if ($ID_State == 40) echo 'selected="selected"'; ?> value=40>South Carolina</option>
                                                <option <?php if ($ID_State == 41) echo 'selected="selected"'; ?> value=41>South Dakota</option>
                                                <option <?php if ($ID_State == 42) echo 'selected="selected"'; ?> value=42>Tennessee</option>
                                                <option <?php if ($ID_State == 43) echo 'selected="selected"'; ?> value=43>Texas</option>
                                                <option <?php if ($ID_State == 44) echo 'selected="selected"'; ?> value=44>Utah</option>
                                                <option <?php if ($ID_State == 45) echo 'selected="selected"'; ?> value=45>Vermont</option>
                                                <option <?php if ($ID_State == 46) echo 'selected="selected"'; ?> value=46>Virginia</option>
                                                <option <?php if ($ID_State == 47) echo 'selected="selected"'; ?> value=47>Washington</option>
                                                <option <?php if ($ID_State == 48) echo 'selected="selected"'; ?> value=48>West Virginia</option>
                                                <option <?php if ($ID_State == 49) echo 'selected="selected"'; ?> value=49>Wisconsin</option>
                                                <option <?php if ($ID_State == 50) echo 'selected="selected"'; ?> value=50>Wyoming</option>
                                            </select>
    
                                        </div><br>
    
                                        <div>
                                            <label for="Zipcode" style="font-size:20px">Zipcode:</label>
                                            <input type="text" name="Zipcode" id="Zipcode" pattern=".{5}" value="<?php echo $Zipcode; ?>" contenteditable="true" title="7 to 9 characters">
                                        </div>
    
                                        <br>
                                        <div>
                                            <input type="hidden" name="profile" value="<?php echo $Profile; ?>">
                                            <input type="hidden" name="email" value="<?php echo $Email; ?>">
                                            <button type="submit" id="signin_button" name="submit"><span style="font-size:18px">Save Changes</span></button>
                                            <button type = "reset" class= "cancelbtn" name="reset">Reset</button>
                                        </div>
                                    </form>
            
                                </div>
                            </div>
        </main>
    
    </script>
    <!-- do not touch-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <!-- end of do not touch-->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./js/main.js"></script>

                        </body>
                        </html>
