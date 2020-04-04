<!-- HtmlView:on -->
<?php
  session_start();

  if(isset($_SESSION['Valid']))
  {
    $Valid = $_SESSION['Valid'];
  }

  if(isset($_SESSION['Unauthorized']))
  {
    $Unauthorized = $_SESSION['Unauthorized'];
  }

  if(isset($_SESSION['ID']))
  {
    session_destroy();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="loginStyle.css">
    <title>Login/Signup Page</title>
  </head>
  <body>
    <header id="MainHeader">
      <div class="container">
        <h1>Login/SignUp</h1>
      </div>
    </header>
    <nav class="navbar">
      <div class="container">
        <ul>
          <li><a href="#">Home</a></li>
        </ul>
      </div>
    </nav>
    <section id="loginFormDiv">
      <div class="containerloginForm">
        <header>
          <h2>Log In</h2>
        </header>
        <form class="loginForm" action="login.php" method="post">
          <label for="Email">Email:</label>
          <input type="text" name="email" placeholder="Enter Email" contenteditable="true" required>
          <br>
          <label for="Password">Password:</label>
          <input type="password" name="Password" placeholder="Enter Password" contenteditable="true" required>
          <br>
          <button type="submit">Login</button>
        </form>
      </div>
    </section>
    <section id="signupFormDiv">
      <div class="containersignupForm">
        <header>
          <h2>Sign Up</h2>
        </header>
        <form class="signupForm" action="signup.php" method="post">
          <label for="Email">Email:</label>
          <input type="text" name="Email" placeholder="Enter Email" contenteditable="true" maxlength="45" required>
          <br>
          <label for="FName">First Name:</label>
          <input type="text" name="FName" placeholder="First Name" contenteditable="true" maxlength="20" required>
          <br>
          <label for="LName">Last Name:</label>
          <input type="text" name="LName" placeholder="Last Name" contenteditable="true" maxlength="20" required>
          <br>
          <label for="Address">Address:</label>
          <input type="text" name="Address" placeholder="Address" contenteditable="true" maxlength="45" required>
          <br>
          <label for="City">City:</label>
          <input type="text" name="City" placeholder="City" contenteditable="true" maxlength="20" required>
          <br>
          <label for="StateAbbr">State:</label>
          <select class="" name="StateAbbr" required>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
      	    <option value="AZ">Arizona</option>
        	  <option value="AR">Arkansas</option>
         	  <option value="CA">California</option>
        	  <option value="CO">Colorado</option>
        	  <option value="CT">Connecticut</option>
        	  <option value="DE">Delaware</option>
        	  <option value="DC">District Of Columbia</option>
        	  <option value="FL">Florida</option>
        	  <option value="GA">Georgia</option>
        	  <option value="HI">Hawaii</option>
        	  <option value="ID">Idaho</option>
        	  <option value="IL">Illinois</option>
        	  <option value="IN">Indiana</option>
        	  <option value="IA">Iowa</option>
        	  <option value="KS">Kansas</option>
        	  <option value="KY">Kentucky</option>
        	  <option value="LA">Louisiana</option>
        	  <option value="ME">Maine</option>
        	  <option value="MD">Maryland</option>
        	  <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
        	  <option value="MN">Minnesota</option>
        	  <option value="MS">Mississippi</option>
        	  <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
        	  <option value="NE">Nebraska</option>
        	  <option value="NV">Nevada</option>
        	  <option value="NH">New Hampshire</option>
        	  <option value="NJ">New Jersey</option>
        	  <option value="NM">New Mexico</option>
        	  <option value="NY">New York</option>
        	  <option value="NC">North Carolina</option>
        	  <option value="ND">North Dakota</option>
        	  <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
        	  <option value="OR">Oregon</option>
        	  <option value="PA">Pennsylvania</option>
        	  <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
        	  <option value="SD">South Dakota</option>
        	  <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
        	  <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
        	  <option value="WV">West Virginia</option>
        	  <option value="WI">Wisconsin</option>
        	  <option value="WY">Wyoming</option>
          </select>
          <br>
          <label for="Zipcode">Zip Code:</label>
          <input type="number" name="Zipcode" placeholder="#####" contenteditable="true" maxlength="5" required>
          <br>
          <label for="Password">Password:</label>
          <input type="password" name="Password" placeholder="Password" contenteditable="true" minlength="6" maxlength="20" required>
          <br>
          <label for="CPassword">Confirm Password:</label>
          <input type="password" name="CPassword" placeholder="Confirm Password" contenteditable="true" minlength="6" maxlength="20" required>
          <br>
          <button type="submit">Sign Up</button>
        </form>
      </div>
    </section>
    <div class="clr"></div>
    <?php
    if (isset($_SESSION['Valid']))
    {
       echo '<p style="margin-left:825px;">'.$Valid.'</p>';
       session_destroy();
    }
    elseif (isset($_SESSION['Unauthorized']))
    {
       echo '<p style="margin-left:255px;">'.$Unauthorized.'</p>';
       session_destroy();
    }
     ?>
    <footer class="mainFooter">
      <p>Copyright &copy; 2019 Software Design Project</p>
    </footer>
  </body>
</html>
