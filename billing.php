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
             
              <div class="input-text">
              <form action="stk_initiate.php" method="POST" id="payment_form">
                <div class="input-div">
                  <input type="text" name="phone" value="<?php if(isset($_POST['pay'])){echo($_POST['phone']);};?>" required require />
                  <span>Mpesa Number</span>
                </div>
                <div class="input-div">
                
                </div>
              </div>
              <div class='buttons'>
              <a href="personal.php">
                  <span class="btn btn-outline-primary" style="width:100px; height:40px; padding:10px;"> Back</span>
              </a>
            <button class='btn btn-success' name='submit' type='submit' value='submit' style="background-color:green;width:100px; height:40px; padding:10px;">Buy Tickets</button>
           </div>
           </form>   
           <script>
            //Submitting the form using Javascript

            // Get the whole form, not the individual input-fields
            const form = document.getElementById('payment_form');

            /**
             * Add an onclick-listener to the whole form, the callback-function
             * will always know what you have clicked and supply your function with
             * an event-object as first parameter, `addEventListener` creates this for us
             */
            form.addEventListener('click', function(event){
                //Prevent the event from submitting the form, no redirect or page reload
                event.preventDefault();
                /**
                 * If we want to use every input-value inside of the form we can call
                 * `new FormData()` with the form we are submitting as an argument
                 * This will create a body-object that PHP can read properly
                 */
                const formattedFormData = new FormData(form);
                postData(formattedFormData);
            });

            async function postData(formattedFormData){
                /**
                 * If we want to 'POST' something we need to change the `method` to 'POST'
                 * 'POST' also expectes the request to send along values inside of `body`
                 * so we must specify that property too. We use the earlier created 
                 * FormData()-object and just pass it along.
                 */
                const response = await fetch('stk_initiate.php',{
                    method: 'POST',
                    body: formattedFormData
                });
                /*
                * Because we are using `echo` inside of `stk_initiate.php` the response
                * will be a string and not JSON-data. Because of this we need to use
                * `response.text()` instead of `response.json()` to convert it to someting
                * that JavaScript understands
                */
                const data = await response.text();
                //This should now print out the values that we sent to the backend-side
                console.log(data);
            }
           </script>           
           </div>
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
  <!--
    <script type="text/javascript">
      var myLink = document.querySelector('a[href="#"]');
      myLink.addEventListener("click", function (e) {
        e.preventDefault();
      });
    </script>
    -->
  </body>
</html>
    