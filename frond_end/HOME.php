<?php
// Function to verify password hash
function verifyPasswordWithSalt($password, $stored_password) {
    $salt = "D5f6g7H8i9J0k1L2";
    $passwordWithSalt=$salt.$password;
  return password_verify($passwordWithSalt, $stored_password);
}


// Database configuration
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "abil";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $email);

    // SQL query to fetch user from database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify password
        if (verifyPasswordWithSalt($password, $stored_password))  {
            // Passwords match, user is authenticated
            //echo "Login successful!";
            header("Location: dashboard.html");

            // Redirect to dashboard or wherever you want
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Invalid password!";

        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Sans-serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- Serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- css -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/general.css" />
    <link rel="stylesheet" href="../css/queries.css" />
    <title>Bus Tracking System</title>
  </head>
  
  <body>
    <header class="header">
      <a href="../html/index.html" class="logo heading-font">
        <ion-icon name="bus" class="logo-icon"></ion-icon>
        <p class="logo-text">CBMS</p>
      </a>

      <nav class="main-nav">
        <ul class="main-nav-list heading-font">
          <li><a class="main-nav-link" href="#steps">Steps</a></li>
          <li><a class="main-nav-link" href="#features">Features</a></li>
          <li>
            <a class="main-nav-link Sign-in-link" href="#">Sign in</a>
          </li>
          <!-- <li><a class="main-nav-link" href="#pricing">Pricing</a></li> -->
          <li><a class="main-nav-link nav-cta" href="../html/signup.php">Sign up</a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>
    <main>
      <section class="hero-section">
        <div class="container">
          <div class="hero-img">
            <img
              src="../img/hero-img.jpg"
              width="100%"
              height="100%"
              alt="main-img"
            />
          </div>
          <div class="hero-text">
            <h1 class="main-heading heading-font">Track your bus with CBMS</h1>
            <p>
              The College Bus Managemat System is the best choice <br />for
              efficiently managing your buses with real-time location tracking.<br />
              we  aim to make transportation more secure fast and convenient
            </p>
            <div class="explore">
              <a href="#steps" class="link link-btn-Explore">Explore</a>
            </div>
          </div>
        </div>
      </section>
      
      </div>
      <section class="steps" id="steps">
        <h2 class="Steps-heading heading-font">Steps</h2>
        <div class="step-1-3">
          <div class="step step-1">
            <div class="step-info">
              <h3>01</h3>
              <h4 class="heading-font">Create Account</h4>
              <p>
                Only Fill the form and become the member CBMS family and explore
                our various plans
              </p>
            </div>
            <div class="step-img">
              <img
                src="../img/undraw_Sign_up_n6im.png"
                height="100%"
                width="100%"
              />
            </div>
          </div>
          <div class="step step-3">
            <div class="step-info">
              <h3>03</h3>
              <h4 class="heading-font">HardWare Installation</h4>
              <p>
                We will come to your place with all required things and setup
                all the equipments
              </p>
            </div>
            <div class="step-img">
              <img
                src="../img/undraw_Order_delivered_re_v4ab.png"
                height="100%"
                width="100%"
              />
            </div>
          </div>
        </div>
        <div class="step-2-4">
          <div class="step step-2">
            <div class="step-info">
              <h3>02</h3>
              <h4 class="heading-font">Choose Number of vehicles</h4>
              <p>
                Choose how many vehicles you want to add for tracking and select
                the plan as per your need.
              </p>
            </div>
            <div class="step-img">
              <img
                src="../img/undraw_search_app_oso2.png"
                height="100%"
                width="100%"
              />
            </div>
          </div>
          <div class="step step-4">
            <div class="step-info">
              <h3>04</h3>
              <h4 class="heading-font">Software Setup</h4>
              <p>
                We will create the admin user for your organization and provide
                you the all essential functionality to efficiently manage your
                buses.
              </p>
            </div>
            <div class="step-img">
              <img
                src="../img/undraw_Software_engineer_re_tnjc.png"
                height="100%"
                width="100%"
              />
            </div>
          </div>
        </div>
      </section>
      <section class="features" id="features">
        <h2 class="heading-font features-heading">Features</h2>
        <div class="features-box box-1">
          <img
            src="../img/undraw_My_location_re_r52x.png"
            height="100%"
            width="100%"
            alt="location tracking image"
          />
          <h3 class="heading-font">Live Bus Tracking</h3>
          <p>
            Track your organization bus live with CBMS accurate tracking ystem
          </p>
        </div>
        <div class="features-box box-1">
          <img
            src="../img/undraw_Messenger_re_8bky.png"
            height="100%"
            width="100%"
            alt="location tracking image"
          />
          <h3 class="heading-font">Inform Passenger</h3>
          <p>
            Our automatic message sender will inform all passenger which are at
            next stop in how much time bus will reach there stop.
          </p>
        </div>
        <div class="features-box box-1">
          <img
            src="../img/undraw_Surveillance_re_8tkl.png"
            height="100%"
            width="100%"
            alt="location tracking image"
          />
          <h3 class="heading-font">Monitor your drivers</h3>
          <p>
            With the help of live tracking you can monitor which routes drivers
            are taking are they following speed limits and much more..
          </p>
        </div>
        <div class="features-box box-1">
          <img
            src="../img/undraw_Savings_re_eq4w.png"
            height="100%"
            width="100%"
            alt="location tracking image"
          />
          <h3 class="heading-font">Value For Money</h3>
          <p>
            We are not going to charge any brand cost to
            you will get all things at fair cost.
          </p>
        </div>
      </section>
      <div class="CTA-container">
        <div class="empty" id="cta"></div>
        <section class="CTA" >
          <div class="CTA-text">
            <h3 class="heading-font">
              Becoming member of CBMS family is one step away
            </h3>
            <p>
              Sign up to CBMS and explore our various plan's and give us chance
              to serve you the best bus tracking service
            </p>
            <div class="CTA-btn">
              <a href="../html/signup.php"  class="CTA-link heading-font">Sign Up</a>
            </div>
          </div>
          <div class="CTA-img">
            <img
              src="../img/undraw_fill_form_re_cwyf.png"
              height="100%"
              width="100%"
              alt="form filling person"
            />
          </div>
        </section>
      </div>
    </main>
    <div class="seprate"></div>
    <footer>
      <div class="icon">
        <div>
          <a href="#" class="heading-font foot-icon-link">
            <ion-icon name="bus" class="foot-logo"></ion-icon>
            <p class="logo-text">CBMS</p>
          </a>
        </div>
        <div class="social">
          <a href="#">
            <ion-icon name="logo-instagram" class="social-icon"></ion-icon
          ></a>
          <a href="#"><ion-icon name="logo-facebook" class="social-icon"></ion-icon
          ></a>
          <a href="#"
            ><ion-icon name="logo-linkedin" class="social-icon"></ion-icon
          ></a>
        </div>
        <div class="Copyright-text">
          Copyright ©<span class="year"> 2024</span> by CBMS,Inc. <br />All rights reserved.
        </div>
      </div>
      <div class="contact">
        <h3>Contact us</h3>
        <address>
          College of Engineering Kallooppara
        </address>
        <a href="tel:8848881575">8848881575</a>
        <a href="mailto:track@cbms.com">track@cbms.com</a>
      </div>
      <div class="account">
        <h3>Account</h3>
        <a href="#cta">Create account</a>
        <a href="#" class="Sign-in-link-foot">Sign in</a>
        <a href="#" class="Help">Help & Support</a>
      </div>
    </footer>
    <div class="Sign-in-modal hidden">
      <div class="Sign-in-window">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
          <div class="email">
            <label for="email-log-in">Email</label>
            <input type="email" id="email-log-in" name="email" placeholder="rohit@gmail.com">
          </div>
          <div class="password">
            <label for="password-log-in">Password</label>
            <input type="password" id="password-log-in" name="password" placeholder="******">
          </div>
          <input class="Sign-in" type="submit" value="Sign In">
        </form>
        <div class="Sign-in-img">
          <img src="../img/undraw_Access_account_re_8spm.png" alt="person accessing his account" height="100%" width="100%">
        </div>
      </div>
    </div>

    <div class="Help-Support hidden">
      <form>
        <h2>Help & Support</h2>
        <fieldset>
          <label for="Question">Question</label>
          <input id="Question" type="text" placeholder="Where to see cost of service ?">
        </fieldset>
        <fieldset>
          <label for="desc">Tell us more&mdash;how can we help</label>
          <textarea id="desc"  rows="5" cols="33" placeholder="I can not able to find prices of your services"></textarea> 
        </fieldset>
        <fieldset>
          <label for="user-email">Your email address </label>
          <input id="user-email" type="email" placeholder="rohit@gmail.com">
        </fieldset>
        <button type="submit" class="heading-font">Sent mail</button>
      </form>
    </div>
    <div class="overlay hidden"></div>
    <!-- ionicons -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>

    <!-- My Script -->
    <script src="../js/script.js"></script>
  </body>
</html>
