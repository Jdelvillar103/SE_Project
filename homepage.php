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
                    <p class="my-md-4 header-links">
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
                                
                                echo '<a class="px-2"  style="color:black; width:auto; border-style: solid; border-color:black; font-size: 20px; padding: 5px 30px; background-color:white;"href="./Login/logout.php" >Log Out</a>';
                            }
                            else{
                        ?>
                        <a href="#" class="px-2" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign In</a>
                        <div id="id01" class="modal">
                        
                            <form class="modal-content animate" action="./Login/login.php" method="post">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                        title="Close Window">×</span> <br>
                                    <!-- If you want a header:  <h1 class="text-center">Sign In</h1>-->
                                </div>
                        
                                <div class="container text-left">
                                    <label><b style="font-size:20px">Email</b></label>
                                    <input type="text" placeholder="Enter Email" name="email" required>
                                    <br> <br>
                                    <label><b style="font-size:20px">Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="psw" required>
                                    
                                    <div class="text-center">
                                        <button type="submit" id="signin_button"><span style="font-size:18px">Login</span></button>
                                    </div>
                                </div>
                        
                                <div class="container text-left" style="background-color:#f1f1f1">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                        class="cancelbtn">Cancel</button>
                                    <span class="psw"><a href="#">Forgot password?</a></span>
                                </div>
                            </form>
                        </div>
                        
                        
                        <a href="#" class="px-1" onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Create an Account</a>
                        <div id="id02" class="modal">
                        
                            <form class="modal-content animate" action="./Login/signup.php" method="post">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id02').style.display='none'" class="close"
                                        title="Close Window">×</span> <br>
                                    <h1 class="text-center" style="font-size:35px">Sign Up</h1>
                                </div>
                        
                                <div class="container text-left">
                                    <label><b style="font-size:20px">First Name</b></label>
                                    <input type="text" placeholder="Enter First Name" name="FName" required>
                                    <br> <br>
                                    <label><b style="font-size:20px">Last Name</b></label>
                                    <input type="text" placeholder="Enter Last Name" name="LName" required>
                                    <br> <br>
                                    <label><b style="font-size:20px">Email</b></label>
                                    <input type="text" placeholder="Enter Email" name="NewEmail" required>
                                    <br> <br>
                                    <label><b style="font-size:20px">Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="Npass" required>
                                    <br> <br>
                                    <label><b style="font-size:20px">Confirm Password</b></label>
                                    <input type="password" placeholder="Confirm Password" name="2pass" required>
                                    <br><br>
                                    <label><b style="font-size:20px">Address</b></label>
                                    <input type="text" name="Address" id="address" placeholder="Address" required>
                                    <br><br>
                                    <label><b style="font-size:20px">City</b></label>
                                    <input type="text" name="City" id="city" placeholder="City" required>
                                    <br> <br>
    
                                    <label><b style="font-size:20px">State</b></label>
                                    <select name="StateN" id="select-choice">
                                        <option value="0" selected="" disabled="">Select</option>
                                        <option value="Alabama">AL</option>
                                        <option value="Alaska">AK</option>
                                        <option value="Arizona">AZ</option>
                                        <option value="Arkansas">AR</option>
                                        <option value="California">CA</option>
                                        <option value="Colorado">CO</option>
                                        <option value="Connecticut ">CT</option>
                                        <option value="Delaware">DE</option>
                                        <option value="Florida">FL</option>
                                        <option value="Georgia">GA</option>
                                        <option value="Hawaii">HI</option>
                                        <option value="Idaho">ID</option>
                                        <option value="Illinois">IL</option>
                                        <option value="Indiana">IN</option>
                                        <option value="Iowa">IA</option>
                                        <option value="Kansas ">KS</option>
                                        <option value="Kentucky">KY</option>
                                        <option value="Louisiana">LA</option>
                                        <option value="Maine">ME</option>
                                        <option value="Maryland">MD</option>
                                        <option value="Massachusetts">MA</option>
                                        <option value="Michigan">MI</option>
                                        <option value="Minnesota">MN</option>
                                        <option value="Mississippi">MS</option>
                                        <option value="Missouri">MO</option>
                                        <option value="Montana">MT</option>
                                        <option value="Nebraska">NE</option>
                                        <option value="Nevada">NV</option>
                                        <option value="New Hampshire">NH</option>
                                        <option value="New Jersey">NJ</option>
                                        <option value="New Mexico">NM</option>
                                        <option value="New York">NY</option>
                                        <option value="North Carolina">NC</option>
                                        <option value="North Dakota">ND</option>
                                        <option value="Ohio">OH</option>
                                        <option value="Oklahoma">OK</option>
                                        <option value="Oregon">OR</option>
                                        <option value="Pennsylvania">PA</option>
                                        <option value="Rhode Island">RI</option>
                                        <option value="South Carolina">SC</option>
                                        <option value="South Dakota">SD</option>
                                        <option value="Tennessee">TN</option>
                                        <option value="Texas">TX</option>
                                        <option value="Utah">UT</option>
                                        <option value="Vermont">VT</option>
                                        <option value="Virginia">VA</option>
                                        <option value="Washington">WA</option>
                                        <option value="West Virginia">WV</option>
                                        <option value="Wisconsin">WI</option>
                                        <option value="Wyoming">WY</option>
                                    </select><br><br>
                                    <label><b style="font-size:20px">Zipcode</b></label>
                                    <input type="text" name="Zipcode" id="Zipcode" pattern=".{5}" placeholder="Zipcode" required title="7 to 9 characters">
                                </div><br>
                                    
                                    <div class="text-center">
                                        <button type="submit" id="signin_button"><span style="font-size:18px">Create Account</span></button>
                                    </div>
                                
                                <br>
                                <div class="container text-left" style="background-color:#f1f1f1">
                                    <button type="button" onclick="document.getElementById('id02').style.display='none'"
                                        class="cancelbtn">Cancel</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        <!--End of code that runs when not logged in-->
                        <?php
                            }
                        ?>
                    </p>
                </div>
            
        <div class="container-fluid p-0" style=" padding-top:20px;">
            <!--PHP Display --> 
                <?php
                if (isset($_SESSION['Valid']))
                 {
                     echo '<p style="margin-left:825px; color:green">'.$Valid.'</p>';
                     //session_destroy();
                }
                elseif (isset($_SESSION['Unauthorized']))
                {
                    echo '<p style="margin-left:255px;color:red">'.$Unauthorized.'</p>';
                    //session_destroy();
                }
                ?> 
            <nav class="navbar navbar-expand-lg navbar-light bg-white" style ="font-size:22px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/homepage.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <?php //If logged in, display Profile Button
                        if(isset($_SESSION['ID']))
                        {
                    echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="/Profile.php">Profile</a>';
                    echo '</li>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                </ul>
                </div>
             <div class="navbar-nav">
                <li class="nav-item border rounded-circle mx-2 search-icon">
                    <i class="fas fa-search p-2"></i>  
                </li> 
                <li class="nav-item border rounded-circle mx-2 basket-icon">                    
                    <a class="fas fa-shopping-basket p-2 nav-link" href="Order.php"></a> 
                </li>
            </div>
            </nav>   
         </div>
         <!-- issue-->            

        </div> 
        <!-- Issue-->   
    </header>
    <!-- Main Section-->
    <main>
    <br/>
<div class="row row-cols-1 row-cols-md-3">
        <?php  
                $query = "SELECT * FROM products ORDER BY ID_Product ASC";  
                $result = mysqli_query($dbc, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>

        <div class="col mb-4 " style="padding-bottom:37px;" align="center">
            <form method="post" action="Test_Cart/Cart.php?action=add&id=<?php echo $row["ID_Product"]; ?>">
                <div class="card" style="border:5px solid purple; background-color:white; border-radius:5px; padding-top:20px; width:25rem; height:45rem;" 
                    align="center">
                    <img src="<?php echo './assests/'.$row["ImageName"].'.jpg'; ?>" class="img-responsive" style="max-height:340px;"/><br/>
                    <div class="card-body" style="background-color:lightgray;">

                        <h4 class="text-info" style="font-size:25px;"><?php echo $row["PrName"]; ?></h4>
                        <h4 class="text"><?php echo $row["PrDesc"]; ?></h4>
                        <h4 class="text-danger">$ <?php echo $row["Price"]; ?></h4>
                        <input type="text" name="quantity" class="form-control" value="1" />
                        <input type="hidden" name="hidden_name" value="<?php echo $row["PrName"]; ?>" />
                        <input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success"
                        value="Add to Cart" />
                    </div>
                </div>
            </form>
        </div>
        <?php  
                     }  
                }  
                ?>
        
       </div>
    </div>
    <br />

       
    </main>
    <!-- Main Section-->
    <footer></footer>

    <!--For the Pop Up Window-->
    <script>
        var modal1 = document.getElementById('id01');
        window.onclick = function (event) {
            if (event.target == modal1) {
                modal1.style.display = "none";
            }
        }
    </script>
    <script>
        var modal2 = document.getElementById('id02');
        window.onclick = function (event) {
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }
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

    <!-- Deleted Scripts

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    -->
</body>

</html>