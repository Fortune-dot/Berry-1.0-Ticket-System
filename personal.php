<?php
//let's start the session
session_start();

//finally, let's store our posted values in the session variables
//$_SESSION['date'] = $_POST['date'];
//$_SESSION['email_address'] = $_POST['email'];
//$_SESSION['phone_number'] = $_POST['phone'];



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Berry Booker 1.0</title>
    <link href="#" rel="stylesheet" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
          $( "#datepicker" ).datepicker();
        } );
        </script>
    <link rel="stylesheet" href="custom.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
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
              <li >Booking Details</li>
              <li class="active" >Personal Details</li>
              <li>Billing & Checkout</li>
              <li>Finish and Print</li>
            </ul>
          </div>
          <div class="right-side">
            <form action="index.php" method="post">
            <div class="main">
              
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
                  <select onchange="calculateAmount()" id="adults" name="adults" required>
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

            </div>
            </form>
            <form action="billing.php" method="POST">
            <div class="main active ">
              <div class="text">
                <h2>Personal Details</h2>
              </div>
              <?php
              
      
             $Adultnumber = $_SESSION['adultnumber'];
             echo '<h5>Adults('.$_SESSION['adultnumber'].')</h5>';
                switch ($Adultnumber) {
                    case "1":
                        include'./Templates/adults/adult1.php';
                        break;
                    case "2":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        break;
                    case "3":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        break;
                    case "4":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        break;
                    case "5":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        break;
                    case "6":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        include'./Templates/adults/adult6.php';
                        break;
                    case "7":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        include'./Templates/adults/adult6.php';
                        include'./Templates/adults/adult7.php';
                        break;
                    case "8":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        include'./Templates/adults/adult6.php';
                        include'./Templates/adults/adult7.php';
                        include'./Templates/adults/adult8.php';
                        break;
                    case "9":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        include'./Templates/adults/adult6.php';
                        include'./Templates/adults/adult7.php';
                        include'./Templates/adults/adult8.php';
                        include'./Templates/adults/adult9.php';
                        break;
                    case "10":
                        include'./Templates/adults/adult1.php';
                        include'./Templates/adults/adult2.php';
                        include'./Templates/adults/adult3.php';
                        include'./Templates/adults/adult4.php';
                        include'./Templates/adults/adult5.php';
                        include'./Templates/adults/adult6.php';
                        include'./Templates/adults/adult7.php';
                        include'./Templates/adults/adult8.php';
                        include'./Templates/adults/adult9.php';
                        include'./Templates/adults/adult10.php';
                        break;
                        
                    default:
                        #nothing here
                    }
//*******************************Youth*******************************/
                $Youthnumber = $_SESSION['youthnumber'];
                echo '<h5>Youths('.$_SESSION['youthnumber'].')</h5>';
                switch ($Adultnumber) {
                    case "1":
                        include'./Templates/youth/youth1.php';
                        break;
                    case "2":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        break;
                    case "3":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        break;
                    case "4":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        break;
                    case "5":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        break;
                    case "6":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        include'./Templates/youth/youth6.php';
                        break;
                    case "7":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        include'./Templates/youth/youth6.php';
                        include'./Templates/youth/youth7.php';
                        break;
                    case "8":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        include'./Templates/youth/youth6.php';
                        include'./Templates/youth/youth7.php';
                        include'./Templates/youth/youth8.php';
                        break;
                    case "9":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        include'./Templates/youth/youth6.php';
                        include'./Templates/youth/youth7.php';
                        include'./Templates/youth/youth8.php';
                        include'./Templates/youth/youth9.php';
                        break;
                    case "10":
                        include'./Templates/youth/youth1.php';
                        include'./Templates/youth/youth2.php';
                        include'./Templates/youth/youth3.php';
                        include'./Templates/youth/youth4.php';
                        include'./Templates/youth/youth5.php';
                        include'./Templates/youth/youth6.php';
                        include'./Templates/youth/youth7.php';
                        include'./Templates/youth/youth8.php';
                        include'./Templates/youth/youth9.php';
                        include'./Templates/youth/youth10.php';
                        break;
                        
                    default:
                      #nothing here
                    }               
//*******************************Youth*******************************/
            $ChildNumber = $_SESSION['childnumber'];
            echo '<h5>Children('.$_SESSION['childnumber'].')</h5>';
            switch ($ChildNumber) {
                case "1":
                    include'./Templates/children/child1.php';
                    break;
                case "2":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    break;
                case "3":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    break;
                case "4":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    break;
                case "5":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    break;
                case "6":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    include'./Templates/children/child6.php';
                    break;
                case "7":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    include'./Templates/children/child6.php';
                    include'./Templates/children/child7.php';
                    break;
                case "8":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    include'./Templates/children/child6.php';
                    include'./Templates/children/child7.php';
                    include'./Templates/children/child8.php';
                    break;
                case "9":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    include'./Templates/children/child6.php';
                    include'./Templates/children/child7.php';
                    include'./Templates/children/child8.php';
                    include'./Templates/children/child9.php';
                    break;
                case "10":
                    include'./Templates/children/child1.php';
                    include'./Templates/children/child2.php';
                    include'./Templates/children/child3.php';
                    include'./Templates/children/child4.php';
                    include'./Templates/children/child5.php';
                    include'./Templates/children/child6.php';
                    include'./Templates/children/child7.php';
                    include'./Templates/children/child8.php';
                    include'./Templates/children/child9.php';
                    include'./Templates/children/child10.php';
                    break;
                    
                default:
                  #nothing here
                }                                        
            ?> 
              <div class="buttons button_space">
                <a href="index.php">
                  <span class="btn btn-outline-primary" style="width:110px; height:40px; padding:10px;"> Back</span>
                </a>
                <button class="next_button" type="submit" name="submit" >Next Step</button>
              </div>
            </div>
            </form>
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
    