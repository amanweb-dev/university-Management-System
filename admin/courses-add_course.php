<!-- header Start -->
<?php include "includes/admin_header.php"; ?>
<!-- header end -->

 <!-- Top Bar Start -->
<?php include "includes/admin_topbar.php"; ?>
 <!-- Top Bar End -->

<!-- ========== Left Sidebar Start ========== -->
<?php include "includes/admin_left_sidebar.php"; ?>
<!-- Left Sidebar End -->


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <!--admin welcome star -->
            <?php include "includes/admin_welcome.php"; ?>
            <!--admin welcome end -->

           

            <div class="row">  
                <div class="col-md-6 offset-md-3">
                    <h3 class="text-center">Manage your Course Item</h3><hr>
      <?php 
      include "includes/db.php";
      global $connection;
      if (isset($_POST['create_course'])) {
          $course_code = strtoupper(mysqli_real_escape_string($connection,$_POST['course_code']));
          $course_title = mysqli_real_escape_string($connection,$_POST['course_title']);
          $course_dept_name = strtoupper(mysqli_real_escape_string($connection,$_POST['course_dept_name']));
          $course_credits = mysqli_real_escape_string($connection,$_POST['course_credits']);
          $course_prereq = strtoupper(mysqli_real_escape_string($connection,$_POST['course_prereq']));
          $prereq_course_code = strtoupper(mysqli_real_escape_string($connection,$_POST['prereq_course_code']));
          $cost_per_credit_day = mysqli_real_escape_string($connection,$_POST['cost_per_credit_day']);
          $cost_per_credit_evng = mysqli_real_escape_string($connection,$_POST['cost_per_credit_evng']);

          // name of the uploaded file
          $course_pdf = $_FILES['course_pdf']['name'];

          // destination of the file on the server
          $destination = "assets/pdfFile/" . $course_pdf;

          // the physical file on a temporary uploads directory on the server
          $file = $_FILES['course_pdf']['tmp_name'];

          // move the uploaded (temporary) file to the specified destination
          move_uploaded_file($file, $destination);

           if (empty($course_code && $course_title && $course_dept_name && $course_credits && $course_prereq  && $cost_per_credit_day && $cost_per_credit_evng)) {
           echo " Please Fill All Information";
       }else{
        //starting query for updating Department table
            $course_total_cost_day = $course_credits*$cost_per_credit_day;
            $course_total_cost_evng = $course_credits*$cost_per_credit_evng;
             $query = "SELECT course_credits,course_total_cost_day,course_total_cost_evng FROM courses WHERE course_dept_name = '{$course_dept_name}' " ;
            $result = mysqli_query($connection,$query);
             if (!$result) {
               die("course query failed".mysqli_error($connection));
           }
           $dept_total_cost_day=0;
           $dept_total_cost_evng=0;
           $course_total_credits=0;
           while($row = mysqli_fetch_assoc($result)){
           $course_total_credits += $row['course_credits'];
           $dept_total_cost_day += $row['course_total_cost_day'];
           $dept_total_cost_evng += $row['course_total_cost_evng'];
         }
            $dept_total_cost_day=$dept_total_cost_day+ $course_total_cost_day;
            $dept_total_cost_evng=$dept_total_cost_evng+ $course_total_cost_evng;
            $course_total_credits=$course_total_credits+$course_credits;
            $query = "UPDATE departments SET ";
          $query .= "dept_total_cost_day = {$dept_total_cost_day}, ";
          $query .= "dept_total_cost_evng = {$dept_total_cost_evng}, ";
          $query .= "dept_total_credits = {$course_total_credits} ";
           $query .= "WHERE dept_name = '{$course_dept_name}' ";
           $update_dept_two_clm = mysqli_query($connection,$query);
           if (!$update_dept_two_clm) {
               die("dept updated failed".mysqli_error($connection));
           }
          //end  query for updating Department table

          $query = "INSERT INTO courses(course_code,course_title,course_dept_name,course_credits,course_type,course_prerequisites,cost_per_credit_day,  cost_per_credit_evng,course_total_cost_day,course_total_cost_evng,course_pdf) ";

          $query .="VALUES('{$course_code}','{$course_title}','{$course_dept_name}',{$course_credits},'{$course_prereq}','{$prereq_course_code}',{$cost_per_credit_day},{$cost_per_credit_evng},{$course_total_cost_day},{$course_total_cost_evng},'{$course_pdf}')";

          $create_course_query = mysqli_query($connection,$query);
          if ($create_course_query) {

            $slct_all_crs_query = "SELECT std_total_course FROM students_basic WHERE  std_dept = '$course_dept_name' ";
            $crs_query_rslt = mysqli_query($connection,$slct_all_crs_query);
            if (!$crs_query_rslt) {
              die("crs_query_rslt failed ".mysqli_error($connection));
            }
            $course_code_array=array($course_code);
            while($crs_query_rslt_array = mysqli_fetch_array($crs_query_rslt)){
            $jsn_encd_crs_query_rsltsss= $crs_query_rslt_array['std_total_course'];
            $jsn_encd_crs_query_rslt= json_decode($jsn_encd_crs_query_rsltsss);
            $jsn_encd_crs_query_rslt=array($jsn_encd_crs_query_rslt);
            $crs_cdes_mrg = array_merge($jsn_encd_crs_query_rslt,$course_code_array);
            $decde_crs_cdes_mrg = json_encode($crs_cdes_mrg);
            };
            



            $std_crs_query = "UPDATE students_basic SET ";
            $std_crs_query .= "std_total_course = '{$decde_crs_cdes_mrg}',";
            $std_crs_query .= "std_incomplete_course = '{$decde_crs_cdes_mrg}' ";
            $std_crs_query .= "WHERE std_dept = '{$course_dept_name}' ";

            $create_course_query_jssn = mysqli_query($connection,$std_crs_query);
            if (!$create_course_query_jssn) {
              die("create_course_query_jssn failed ".mysqli_error($connection));
            }


            $slct_all_crs_query = "SELECT std_total_course FROM students_basic_evening WHERE  std_dept = '$course_dept_name' ";
            $crs_query_rslt = mysqli_query($connection,$slct_all_crs_query);
            if (!$crs_query_rslt) {
              die("crs_query_rslt failed ".mysqli_error($connection));
            }
            $jsn_encd_crs_query_rslt= json_decode($crs_query_rslt);
            $course_code_array=array($course_code);
            $crs_cdes_mrg = array_merge($jsn_encd_crs_query_rslt,$course_code_array);
            $decde_crs_cdes_mrg = json_decode($crs_cdes_mrg);


            $std_crs_query = "UPDATE students_basic_evening SET ";
            $std_crs_query .= "std_total_course = '{$decde_crs_cdes_mrg}',";
            $std_crs_query .= "std_incomplete_course = '{$decde_crs_cdes_mrg}' ";
            $std_crs_query .= "WHERE std_dept = '{$course_dept_name}' ";
            $create_course_query_jssn = mysqli_query($connection,$std_crs_query);
            if (!$create_course_query_jssn) {
              die("create_course_query_jssn failed ".mysqli_error($connection));
            }

            header("Location: courses-add_course.php");
           

          }else{
           die("course create failed".mysqli_error($connection));
          }
            

       }

      }

      ?>

                     <form action="courses-add_course.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="course-code">Add Course Code</label>
                            <input type="text" class="form-control" name="course_code" placeholder="CSE 101" >
                        </div>
                         <div class="form-group">
                            <label for="course-title">Add Course Title</label>
                            <input type="text" class="form-control" name="course_title"  placeholder="Computer Fundamentals">
                        </div>
                         <div class="form-group">
                            <label for="course-dept-name">Add Course Department Name</label>
                            <select name="course_dept_name" id="">
                                 <?php 
                                global $connection;
                                $query = "SELECT * FROM departments";
                                $result = mysqli_query($connection,$query);
                                while ($row=mysqli_fetch_assoc($result)) {
                                    $dept_code = $row['dept_code'];
                                    $dept_name = $row['dept_name'];
                                    echo "<option value='$dept_name'>$dept_name</option>";

                                }
                                ?>

                            </select>
                           
                            
                        </div>
                        <div class="form-group">
                            <label for="course-credits">Add Course Credits</label>
                            <select name="course_credits" id="">
                              <option value= '0'>Credits</option>
                              <option value= '0.25'>0.25</option>
                              <option value= '0.50'>0.50</option> 
                              <option value= '0.75'>0.75</option> 
                              <option value= '1.00'>1.00</option> 
                              <option value= '1.25'>1.25</option> 
                              <option value= '1.50'>1.50</option> 
                              <option value= '1.75'>1.75</option> 
                              <option value= '2.00'>2.00</option>
                              <option value= '2.25'>2.25</option>
                              <option value= '2.50'>2.50</option> 
                              <option value= '2.75'>2.75</option> 
                              <option value= '3.00'>3.00</option>
                              <option value= '3.25'>3.25</option>
                              <option value= '3.50'>3.50</option> 
                              <option value= '3.75'>3.75</option> 
                              <option value= '4.00'>4.00</option> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course-prereq">Add Course Type</label>
                            <select name="course_prereq" id="">
                              <option value= 'prereqisit'>Prereqisit Course</option>
                              <option value= 'normal'>Normal</option>
                              
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="prereq-course-code">Add Prereqisites Course</label>
                            <input type="text" class="form-control" name="prereq_course_code"  placeholder="CSE 100">
                        </div>
                        <div class="form-group">
                            <label for="course-per-credit-day">Add Cost Per Credits For Day</label>
                            <input type="text" class="form-control" name="cost_per_credit_day" placeholder="1650">
                        </div>
                         <div class="form-group">
                             <label for="course-per-credit-evng">Add Cost Per Credits For Evening</label>
                            <input type="text" class="form-control" name="cost_per_credit_evng" placeholder="1250">
                        </div>
                        <div class="form-group">
                            <label for="course-pdf">Upload Course pdf Book</label>
                             <input type="file" name="course_pdf">
                        </div>
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_course" value="Create Course">
                        </div>
                    </form>
                </div>
            </div>
            
                <!-- end col -->
        </div>
            <!--- end row -->

    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer start-->
<?php include "includes/admin_footer.php"; ?>
<!-- Footer end-->