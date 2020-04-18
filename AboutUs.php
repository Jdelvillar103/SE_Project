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
                                
                                echo '<a class="px-2"  style="color:black; width:auto; border-style: solid; border-color:black; font-size: 20px; padding: 5px 30px; background-color:white;"href="./Login/logout.php" >Log Out</a>';
                            }
                            else{
                        ?>
                        <a href="#" class="px-2" onclick="document.getElementById('id01').style.display='block'" style=" font-size:25px;">Sign In</a>
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
                                        <button type="submit" id="signin_button"><span style="font-size:24px">Login</span></button>
                                    </div>
                                </div>
                        
                                <div class="container text-left" style="background-color:#f1f1f1">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                        class="cancelbtn">Cancel</button>
                                    <span class="psw"><a href="#">Forgot password?</a></span>
                                </div>
                            </form>
                        </div>
                        
                        
                        <a href="#" class="px-2" onclick="document.getElementById('id02').style.display='block'" style="width:auto; font-size:25px; color:lightblue;">Create an Account</a>
                        <div id="id02" class="modal">
                        
                            <form class="modal-content animate" action="./Login/signup.php" method="post">
                                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id02').style.display='none'" class="close"
                                        title="Close Window">×</span> <br>
                                    <h1 class="text-center" style="font-size:45px">Sign Up</h1>
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
                                    <br>
                                    <div class="text-center">
                                        <button type="submit" id="signin_button"><span style="font-size:24px">Create Account</span></button>
                                    </div>
                                </div>
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
            
        <div class="container-fluid p-0" style="padding-top:20px;">
            <!--PHP Display --> 
                <?php
                if (isset($_SESSION['ID']))
                 {
                     unset($_SESSION['Valid']);
                }
                elseif (isset($_SESSION['Valid']))
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
                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Home</a>
                    </li>
                    <?php //If logged in, display Profile Button
                        if(isset($_SESSION['ID']))
                        {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="/Profile.php">Profile</a>';
                            echo '</li>';
                        }
                    ?>
                    
                    <li class="nav-item active">
                        <a class="nav-link" href="/AboutUs.php">About Us<span class="sr-only">(current)</span></a>
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
                     

        </div> 
          
    </header>
    <!-- Main Section-->
    <main>
    </body>

    </html>
    <div class ="container">
                <div class = row>
                    <div class = "col-lg-2 col-md-2 col-xs-2" >
                        <div class = "col1">
    
                            
    
                        </div>
                    </div>
                    <div class = "col-lg-8 col-md-8 col-xs-8">
                        <div class = "col2">
    
<div class="about-section">
    <h1 style = "text-align:center" ;>About Us</h1>
    

  </div>
  
  <h2 style="text-align:center">Our Team</h2>
  <div class="row">
    <div class = "col-lg-4 col-md-4 col-sm-12">
      <div class="card align-items-center">
        <img src="assests/Pete.jpg" alt="Jose" style="width:50%;">
        <div class="container">
            <div class="card-block text-center">
                <h2>Jose Del Villar</h2>
                <p class="title">Software Developer</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                <p>University of Houston</p>
                <button onclick="location.href='mailto:josdp23@gmail.com';">Contact</button>
            </div>
        </div>
      </div>
    </div>
  
    <div class = "col-lg-4 col-md-4 col-sm-12">
      <div class="card align-items-center">
        <img src="assests/Pete.jpg" alt="Ray" style="width:50%">
        <div class="container">
            <div class="card-block text-center">
                <h2>Ray Watson &nbsp;</h2>

                <p class="title">Software Developer</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <a href="#"><i class="fa fa-twitter"></i></a>
				    <a href="#"><i class="fa fa-linkedin"></i></a>
				    <a href="#"><i class="fa fa-facebook"></i></a>
                <p>University of Houston</p>
          <button onclick="location.href='mailto:rayvanwatsonjr@gmail.com';">Contact</button>
        </div>
      </div>
    </div>
  </div>
    <div class = "col-lg-4 col-md-4 col-sm-12">
      <div class="card align-items-center">
        <img src="assests/Pete.jpg" alt="Ryan" style="width:50%">
        <div class="container">
            <div class="card-block text-center">
          <h2>Ryan Mastriano</h2>
          <p class="title">Software Developer</p>
          <p>Some text that describes me lorem ipsum ipsum lorem.</p>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-facebook"></i></a>
          <p>University of Houston</p>
         <button onclick="location.href='mailto:rmastriano@uh.edu';">Contact</button>
        </div>
      </div>
    </div>
  </div>