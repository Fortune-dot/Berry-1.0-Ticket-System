<?php
//let's start the session
session_start();


include'header.php';

if(isset($_POST['calculate'])){

  $programme = $_POST['programme'];
  $venue = $_POST['venue'];
  $date = $_POST['date'];
  $adultnumber = $_POST['adults'];
  $youthnumber = $_POST['youth'];
  $childnumber = $_POST['children'];

  $_SESSION['programme'] = $_POST['programme'];
  $_SESSION['venue'] = $_POST['venue'];
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['adultnumber'] = $_POST['adults'];
  $_SESSION['youthnumber'] = $_POST['adults'];
  $_SESSION['childnumber'] = $_POST['children'];

  

  if($programme == '1'){
    $programmename = 'Workshop';
    $adultprice = 2500;
    $youthprice = 1250;
    $childprice = 500;
  }else if($programme == '2'){
    $programmename = 'University';
    $adultprice = 500;
    $youthprice = 500;
    $childprice = 300;
  }else if($programme == '3'){
    $programmename = 'HighSchool';
    $adultprice = 400;
    $youthprice = 400;
    $childprice = 400;
  }else{
    echo 'Please select a programme';
  };

  $Total = ($adultprice * $adultnumber) + ($youthprice * $youthnumber) + ($childprice * $childnumber);
  $formattedTotal = number_format($Total);
  $_SESSION['totalcost'] = $formattedTotal;

};

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
              <h3>Step <span class="step-number">1</span></h3>
              <p class="step-number-content active">
                Enter Event details to get started.
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
              <li class="active">Booking Details</li>
              <li>Personal Details</li>
              <li>Billing & Checkout</li>
              <li>Finish and Print</li>
            </ul>
          </div>
          <div class="right-side">
            <form action="index.php" method="post">
            <div class="main active">
              
              <div class="text">
                <h2>Your Booking Information</h2>

              </div>
              <div class="input-text">
                <div class="input-div">
                    <div class="input-div">
                        <select id="programme" name="programme" value="<?php if(isset($_POST['calculate'])){echo($programmename);};?>" >
                          <option value="" selected disabled>Programme Type</option>
                          <option value="1">Workshop</option>
                          <option value="2">University/College</option>
                          <option value="3">Highschool</option>
                        </select>
                      </div>
                </div>
                <div class="input-div">
                    <div class="input-div">
                        <select required require >
                          <option>Programme Class</option>
                          <option>Economy</option>
                        </select>
                      </div>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <input type="text" name="venue" value="<?php if(isset($_POST['calculate'])){echo($venue);};?>" required require />
                  <span>Venue</span>
                </div>
                <div class="input-div">
                  <input type="text" id="datepicker" name="date" value="<?php if(isset($_POST['calculate'])){echo($date);};?>" required require />
                  <span>Date</span>
                </div>
              </div>
              <div class="input-text">
                <div class="input-div">
                  <select onchange="calculateAmount()" id="adults" name="adults" >
                    <option value="" disabled selected >No of Adults</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
                <div class="input-div">
                  <select onchange="calculateAmount()" id="youth" name="youth">
                    <option value="" disabled selected >No of Youth</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
                <div class="input-div">
                    <select onchange="calculateAmount()" id="children" name="children">
                      <option value="" disabled selected >No of Children</option>
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>
              </div>
              <?php
              if(isset($_POST['calculate'])){
                echo "<div class='input-text'>
                       <h3>Total:".$formattedTotal."  </h3>
                      </div>";
              echo"<div class='buttons'>
                    
                  <a href='personal.php'>
                  <span  class='btn btn-primary'>Next</sp>
                  </a>
              </div>";
              }else{
                echo"<div class='buttons'>
                  <button class='next_button' name='calculate' type='submit'>Calculate</button>
              </div>";

              }
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
    