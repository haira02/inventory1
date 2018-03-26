<!Doctype html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <link rel= "stylesheet" href = "style/bootstrap.min.css">
    
</head>


<body style="background-color: #EEE;">
            <div class = "jumbotron">
    
    <nav class = "navbar navbar-inverse navbar-fixed-top" id ="my-navbar">
        <div class "container">
            <div class ="navbar-header">
                <button type = "button" class ="navbar-toggle" data-toggle = "collapse" data-target = "#navbar-collapse">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    </button>
                   </div>
<div class = "collapse navbar-collapse" id="navbar-collapse">
    <ul class = "nav navbar-nav">
        <li><a href = "index.php">Home page</a>
        <li><a href = "signin.php">Login</a>
        <li><a href = "signup.php">SignUp</a>
        </ul>
       
             
        </div>      
            </div>
            </nav>
    
                
                    
   <div class ="container">
     <section>
         <div class ="page-header" id ="Registration">
             <h2>SignUp</h2>
          </div>
            
           <div class = "row">
               <div class = "col-sm-3">
               <form action="process_sign_up.php" method="post">
                  <label for = "Fname">First Name</label>
                  <input type = "text" class ="form-control" name="fname" placeholder="Enter Your first name" required=""><br />
                  
                  <label for = "Lname">Last Name</label>
                  <input type = "text" class ="form-control" name="lname" placeholder="Enter your last name" required=""><br />
                   
                  <label for = "Lname">Email</label>
                  <input type = "email" class ="form-control" name="email" placeholder="Enter your email" required=""><br />
                  
                  <label for = "password">Password</label>
                  <input type = "password" class ="form-control" name="pass" required=""><br />
                  
                  <label for = "password">Confirm password</label>
                  <input type = "password" class ="form-control" name="repass" required=""><br />
                   
                  <input type="submit" value="Sign Up" name="sign-up" class="btn btn-lg btn-primary btn-block" />
                </form>
                </div>
              </div>
    </section>
  </div>
               
                </body>
</html>