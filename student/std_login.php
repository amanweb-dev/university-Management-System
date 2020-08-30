 <?php include "includes/db.php"; ?>
 <?php include "includes/std_header.php"; ?>
 
<?php 
global $connection;
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$userpassword);


    $query = "SELECT * FROM students_basic WHERE std_id = '{$username}' UNION SELECT * FROM students_basic_evening WHERE std_id = '{$username}' ";
    $select_std_query = mysqli_query($connection,$query);
    if (!$select_std_query) {
        die("query failed " . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_std_query)) {
          $std_id = $row['std_id'];
          $std_password = $row['std_password'];
          $std_shift = $row['std_shift'];
          $std_dept = $row['std_dept'];
         
    }


     
    if ($username === $std_id && password_verify($userpassword,$std_password)) {

        $_SESSION['std_id'] = $std_id; 
        $_SESSION['std_password'] = $std_password; 
        $_SESSION['std_shift'] = $std_shift; 
        $_SESSION['std_dept'] = $std_dept; 

         header("Location: ../student/std.php");

    }else{
         header("Location: ../student/std_login.php" );


    }


}



 ?>

    <div class="login-form-wrapper">
        <div class="global-menu">
            <ul>
                <li>
                <a href=""><img src="assets/img/index.png" alt=""></a>
                </li>
                <li>
                <a href="std_annex_reg.php"><img src="assets/img/inx.png" alt=""></a>
                </li>
                <li>
                <a href=""><img src="assets/img/in.png" alt=""></a>
                </li>
            </ul>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">

                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-4">   
                    <div class="login-form">
                       <div class="logo text-center"><a href=""><img src="assets/img/index.png" alt=""></a></div>
                        <div class="left-slide left-side-gate"></div>
                        <div class="right-slide right-side-gate"></div>
                        <form action="std_login.php" method="post" id="login_name">
                            <input type="text" id="UserName" name="username" placeholder="Enter your ID">
                            <input type="password" id="UserPassword" name="userpassword" placeholder="Enter your password">
                            <a href="" id="frgt-pass"><img src="assets/img/password.png" alt=""></a>
                            <input type="submit" id="LogIn-btn" name="login" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php include "includes/std_footer.php"; ?>
