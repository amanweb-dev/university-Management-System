<?php include "includes/db.php"; ?>
<?php include "includes/std_header.php"; ?>

<?php 
global $connection;
$std_id =  $_SESSION['std_id']; 
$std_password = $_SESSION['std_password']; 
$std_shift = $_SESSION['std_shift']; 
$std_dept = $_SESSION['std_dept'];


if (isset($_POST['submit_rglr'])) {

    $course_reg_rglr =  strtoupper(mysqli_real_escape_string($connection,$_POST['course_reg_rglr']));
    $crs_reg_ary = array($course_reg_rglr);

         $query= "SELECT course_code FROM courses WHERE course_dept_name = '$std_dept' ";
         $result = mysqli_query($connection,$query);
         $crs_cdes=array();
          while ($row = mysqli_fetch_assoc($result)) {
            $crs_cde = array($row['course_code']);  
            $crs_cdes = array_merge($crs_cdes,$crs_cde);
          }
        $differ = array_diff($crs_reg_ary,$crs_cdes);

        if (!$differ) {
            echo "This course is available"."<br>";

            if ($std_shift=="Day") {
               $query_incmplt = "SELECT  std_crnt_course FROM students_basic WHERE std_id = '$std_id' ";
               $result_incmplt = mysqli_query($connection,$query_incmplt);
               if (!$result_incmplt) {
                   die("result_incmplt query failed ".mysqli_error($connection));
               }
                $std_crnt_coursesss=array();
                while ($row=mysqli_fetch_array($result_incmplt)) {
                    $std_crnt_course=$row['std_crnt_course'];
                   // $std_crnt_coursesss=json_decode($std_crnt_course);
                    
                }
                
                //$std_crnt_course_new=array($std_crnt_course);
                $std_crnt_coursesss = array($std_crnt_course);
                //var_dump($std_crnt_coursesss);
                $differ = array_diff($crs_reg_ary,$std_crnt_coursesss);
                if ($differ) {
                    echo "This course is not in Current Courses. So you can register"."<br>";

                   $query_cmplt = "SELECT  std_complete_course FROM students_basic WHERE std_id = '$std_id' ";
                   $result_cmplt = mysqli_query($connection,$query_cmplt);
                   if (!$result_cmplt) {
                       die("result_cmplt query failed ".mysqli_error($connection));
                   }

                    while ($row=mysqli_fetch_array($result_cmplt)) {
                        $std_complete_course=$row['std_complete_course'];
                       
                    }
                     $std_complete_course_dcd = json_decode($std_complete_course);
                     $std_complete_course_dcd = array($std_complete_course_dcd);

                     $differss = array_diff($crs_reg_ary,$std_complete_course_dcd);
                     if ($differss) {
                         echo "THis courses is not in Completed courses.So Finally You can register"."<br>";
                         var_dump($differ);
                         


                     }else{
                        echo "you have completed this course already.So can not be processed";
                     }


                }else{
                    echo "You have completed This course"."<br>";
                }

            }

        }else{
            echo "your entered corse is not availble";
            var_dump($differ);

        }


    
}

 ?>

    <div class="section-padding anex-bg">
        <div class="header-area">
            <div class="logo-area text-center">
                <a href=""><img src="assets/img/osis_logo.png" alt=""></a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="info-area-wrapper">
                        <div class="info-area-innner">
                            <div class="namebar text-center">
                                <div class="anex-btns">
                                    <a href="" class="anex-btn log-out-btn">log out</a>
                                    <a href="" class="anex-btn settings-btn">settings</a>
                                </div>
                                <div class="student-name">
                                    <h3>amanullah aman</h3>
                                </div>
                                <div class="student-pic">
                                    <img src="assets/img/aman.jpeg" alt="">
                                </div>
                            </div>
                            <div class="stident-info-menu">
                                <ul class="menu-list">
                                    <li><a href="std.php">Home</a></li>
                                    <li><a href="std_rtn.php">Routine</a></li>
                                    <li><a href="">Fess & waiver</a></li>
                                     <li><a href="">Application</a></li>
                                    <li><a href="">Due Documents</a></li>
                                    <li><a href="std_crs_reg.php">Course Reg</a></li>
                                </ul>
                            </div>



                            <div class="container">
                                 <div class="row">
                                     <div class="col-md-6">
                                        <h3 class="text-center">Regulare Course Registration</h3>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="course_reg_one"> Inseart A Course Code</label>
                                                <input type="text" class="form-control" name="course_reg_rglr" placeholder="CSE 101" >
                                            </div>
                                             <div class="form-group btn_input">
                                                <input type="submit" class="btn btn-primary" name="submit_rglr" value="Register">
                                            </div>
                                        </form>
                                     </div>
                                     <!-- <div class="col-md-6">
                                        <h3 class="text-center">Retake Course Registration</h3>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="course_reg_retake"> Inseart A Course Code</label>
                                                <input type="text" class="form-control" name="course_reg_rtk" placeholder="CSE 101" >
                                            </div>
                                             <div class="form-group btn_input">
                                                <input type="submit" class="btn btn-primary" name="submit_rtk" value="Register">
                                            </div>
                                        </form>
                                      </div> -->            
                                 </div>
                             </div> 


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/std_footer.php"; ?>
   
