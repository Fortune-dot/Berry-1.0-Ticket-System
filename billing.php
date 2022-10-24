<?php
session_start();

if(isset($_POST['submit'])){

  include'./cases/adultswitch.php';
  include'./cases/childswitch.php';
  include'./cases/youthswitch.php';

   
}
include 'header.php';



?>
<body className="snippet-body">
    <div class="container">
      <div class="card">
        <div class="form">
          <div class="left-side">
            <div class="left-heading">
              <h3>🍓Berry Booker 1.0</h3>
            </div>
            <div class="steps-content">
              <h3>Step <span class="step-number">3</span></h3>
              <p class="step-number-content active">
                Billing and Checkout
              </p>
              <p class="step-number-content d-none">
                Get to know better by adding your diploma,certificate and
                education life.
              </p>
              <p class="step-number-content d-none">
                Help companies get to know you better by telling then about your
                past experiences.
              </p>
              <p class="step-number-content d-none">
                Add your profile piccture and let companies find youy fast.
              </p>
            </div>
            <ul class="progress-bar">
              <li>Booking Details</li>
              <li>Personal Details</li>
              <li  class="active" >Billing & Checkout</li>
              <li>Finish and Print</li>
            </ul>
          </div>
          <div class="right-side">
            <form action="index.php" method="post">
            <div class="main active">
              
              <div class="text">
                <h2>Your Booking Summary</h2>

              </div>
              <div class="input-text">
                <div class="input-div">
                   <?php 
                       $TotalTickets = $_SESSION['adultnumber'] + $_SESSION['childnumber'] + $_SESSION['youthnumber'];
                      echo "<h3>Number of Tickets: ".$TotalTickets."</h3>";
                      echo"<br>";
                      echo "<h4>Adult Tickets: ".$_SESSION['adultnumber']."</h4>";
                      echo"<br>";
                      echo "<h4>Youth Tickets: ".$_SESSION['youthnumber']."</h4>";
                      echo"<br>";
                      echo "<h4>Child Tickets: ".$_SESSION['childnumber']."</h4>";
                      echo"<br>";
                      echo"<h3 style='color:green;'> Total Price: KSH ".$_SESSION['totalcost']."</h3>";
                   ?>
                </div>
                <div class="input-div">
                    <h3>Payment Method</h3>
                    <select name="paymentmethod" id="paymentmethod">
                        <option value="creditcard">Mpesa</option>
                    </select>   
                </div>
              </div>
             <form action="billing.php" method="POST">
              <div class="input-text">
                <div class="input-div">
                  <input type="text" name="phone" value="<?php if(isset($_POST['pay'])){echo($_POST['phone']);};?>" required require />
                  <span>Mpesa Number</span>
                </div>
                <div class="input-div">
                
                </div>
              </div>
              <div class='buttons'>
            <button class='next_button' name='buy' type='submit'>Buy Tickets</button>
           </div>
           </form>
              <?php
if(isset($_POST['buy'])){



//THIS IS THE MPESA STK PUSH CODE START

  date_default_timezone_set('Africa/Nairobi');

  # access token
  $consumerKey = 'nk16Y74eSbTaGQgc9WF8j6FigApqOMWr'; //Fill with your app Consumer Key
  $consumerSecret = '40fD1vRXCq90XFaU'; // Fill with your app Secret

  # define the variales
  # provide the following details, this part is found on your test credentials on the developer account
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
   $PartyA = $_POST['phone']; // This is your phone number, 
  $AccountReference = '2255';
  $TransactionDesc = 'Test Payment';
  $Amount = $_SESSION['totalcost'];
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'https://morning-basin-87523.herokuapp.com/callback_url.php';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);

  echo $curl_response;

}else{
   # code...
  };

              
              ?>

              
            </div>
            </form>
            <div class="main">
              <small><i class="fa fa-smile-o"></i></small>
              <div class="text">
                <h2>Personal Details</h2>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" required require />
                  <span>Full name</span>
                </div>
                <div class="input-div">
                  <input type="text" required />
                  <span>Phone</span>
                </div>
                <div class="input-div">
                    <input type="text" required />
                    <span>Email</span>
                  </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                    <input type="text" required require />
                    <span>ID/Passport</span>
                  </div>
                  <div class="input-div">
                    <input type="text" required />
                    <span>Address</span>
                  </div>
                  <div class="input-div">
                      <input type="text" required />
                      <span>Country</span>
                    </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <select>
                    <option>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Transgender</option>

                  </select>
                </div>
              </div>
              <div class="buttons button_space">
                <button class="back_button">Back</button>
                <button class="next_button">Next Step</button>
              </div>
            </div>
            <div class="main">
              <small><i class="fa fa-smile-o"></i></small>
              <div class="text">
                <h2>Work Experiences</h2>
                <p>Can you talk about your past work experience?</p>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" required require />
                  <span>Experience 1</span>
                </div>
                <div class="input-div">
                  <input type="text" required require />
                  <span>Position</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" required />
                  <span>Experience 2</span>
                </div>
                <div class="input-div">
                  <input type="text" required />
                  <span>Position</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" required />
                  <span>Experience 3</span>
                </div>
                <div class="input-div">
                  <input type="text" required />
                  <span>Position</span>
                </div>
              </div>
              <div class="buttons button_space">
                <button class="back_button">Back</button>
                <button class="next_button">Next Step</button>
              </div>
            </div>

            <div class="main">
              <small><i class="fa fa-smile-o"></i></small>
              <div class="text">
                <h2>User Photo</h2>
                <p>Upload your profile picture and share yourself.</p>
              </div>
              <div class="user_card">
                <span></span>
                <div class="circle">
                  <span><img src="https://i.imgur.com/hnwphgM.jpg" /></span>
                </div>
                <div class="social">
                  <span><i class="fa fa-share-alt"></i></span>
                  <span><i class="fa fa-heart"></i></span>
                </div>
                <div class="user_name">
                  <h3>Peter Hawkins</h3>
                  <div class="detail">
                    <p><a href="#">Izmar,Turkey</a>Hiring</p>
                    <p>17 last day . 94Apply</p>
                  </div>
                </div>
              </div>
              <div class="buttons button_space">
                <button class="back_button">Back</button>
                <button class="submit_button">Submit</button>
              </div>
            </div>
            <div class="main">
              <svg
                class="checkmark"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 52 52"
              >
                <circle
                  class="checkmark__circle"
                  cx="26"
                  cy="26"
                  r="25"
                  fill="none"
                />
                <path
                  class="checkmark__check"
                  fill="none"
                  d="M14.1 27.2l7.1 7.2 16.7-16.8"
                />
              </svg>

              <div class="text congrats">
                <h2>Congratulations!</h2>
                <p>
                  Thanks Mr./Mrs. <span class="shown_name"></span> your
                  information have been submitted successfully for the future
                  reference we will contact you soon.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript" src="#"></script>
    <script type="text/javascript">
     



      function contentchange() {
        step_num_content.forEach(function (content) {
          content.classList.remove("active");
          content.classList.add("d-none");
        });
        step_num_content[formnumber].classList.add("active");
      }

      function validateform() {
        validate = true;
        var validate_inputs = document.querySelectorAll(".main.active input");
        validate_inputs.forEach(function (vaildate_input) {
          vaildate_input.classList.remove("warning");
          if (vaildate_input.hasAttribute("require")) {
            if (vaildate_input.value.length == 0) {
              validate = false;
              vaildate_input.classList.add("warning");
            }
          }
        });
        return validate;
      }
    </script>
    <script src="./app.js"></script>
    <script type="text/javascript">
      var myLink = document.querySelector('a[href="#"]');
      myLink.addEventListener("click", function (e) {
        e.preventDefault();
      });
    </script>
  </body>
</html>
    