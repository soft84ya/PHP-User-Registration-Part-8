<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP GET vs POST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <?php 
            //echo 'Hello Good Morning';
            //1. Check if the register data is comming or not
            if( isset($_GET['submitregistration']) ){
                echo 'ok';
                //1. DB Connection OPEN
                $conn = mysqli_connect('localhost',"root",'',"ecommerce_db");
                //Always filter/Sanitize the incomming data
                $name =  mysqli_real_escape_string($conn,$_GET['name']);
                $email =  mysqli_real_escape_string($conn,$_GET['email']);
                $pass =  mysqli_real_escape_string($conn,$_GET['pass']);
                $cpass =  mysqli_real_escape_string($conn,$_GET['cpass']);
                $dob =  mysqli_real_escape_string($conn,$_GET['dob']);
                $mobno =  mysqli_real_escape_string($conn,$_GET['mobno']);

                //Check if password and Confirm password match
                if( $pass == $cpass ){
                    //True
                    $pass = md5($pass);//MD5 is a 
                    echo 'ok we can procced';
                     //2. Build the query
                    $query = "INSERT INTO users_tbl(`name`,`email`,`password`,`dob`,`mobileno`)VALUES('$name','$email','$pass','$dob','$mobno')";


                    //3. Execute the query
                    mysqli_query($conn,$query);


                    //4. Display the result
                    echo '<div class="alert alert-success" role="alert">
                           User Registered Successfully!
                        </div>';

                }else{
                    //False
                    echo '<div class="alert alert-danger " role="alert">
                            Password and confirm password does not match!
                          </div>';
                }
                
                //5. DB Connection CLose
                mysqli_close($conn);

            }/* else{
                echo 'no';
            }
            */
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET" class="offset-3 w-50">
            <h1 class="text-center">Registration FORM</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="pass" required>
            </div>
            <div class="mb-3">
                <label for="cpass" class="form-label">Confirm Password</label>
                <input type="password" name="cpass" class="form-control" id="cpass" required >
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date Of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob" required>
            </div>
            <div class="mb-3">
                <label for="mobno" class="form-label">Mobile Number</label>
                <input type="number" name="mobno" class="form-control" id="mobno" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <input type="submit" name="submitregistration" value="Register Now" class="btn btn-primary" />
        </form>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>