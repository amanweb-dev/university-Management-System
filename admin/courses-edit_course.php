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

          
            <!-- end row -->

            <div class="row">  
                <div class="col-xl-4">
                   <h3 class="text-center">Update your Course Item</h3><hr>
      <?php 
        include 'includes/db.php';
        global $connection;
         if (isset($_GET['p_id'])) {
            $the_course_code = $_GET['p_id'];
            $the_course_dept_name = $_GET['d_name'];
         
         $query = "SELECT * FROM courses WHERE course_code = '$the_course_code' AND course_dept_name = '$the_course_dept_name' ";
         $select_course_by_code = mysqli_query($connection,$query);
         while($row=mysqli_fetch_assoc($select_course_by_code)) {
              $course_code=$row['course_code'];
              $course_title=$row['course_title'];
              $course_dept_name=$row['course_dept_name'];
              $course_credits=$row['course_credits'];
              $course_type=$row['course_type'];
              $course_prerequisites=$row['course_prerequisites'];
              $cost_per_credit_day=$row['cost_per_credit_day'];
              $cost_per_credit_evng=$row['cost_per_credit_evng'];
              $course_total_cost_day=$row['course_total_cost_day'];
              $course_total_cost_evng=$row['course_total_cost_evng'];
              $course_pdf=$row['course_pdf'];

            }
        }
        
        if(isset($_POST['update_course'])) {

           // $course_code = strtoupper(mysqli_real_escape_string($connection,$_POST['course_code']));

            $course_title = mysqli_real_escape_string($connection,$_POST['course_title']);

            // $course_dept_name = strtoupper(mysqli_real_escape_string($connection,$_POST['course_dept_name']));

            $course_credits = mysqli_real_escape_string($connection,$_POST['course_credits']);
            $course_credits_prev = mysqli_real_escape_string($connection,$_POST['course_credits_prev']);

            $course_prereq = strtoupper(mysqli_real_escape_string($connection,$_POST['course_prereq']));

            $course_prerequisites = strtoupper(mysqli_real_escape_string($connection,$_POST['course_prerequisites']));

            $cost_per_credit_day = mysqli_real_escape_string($connection,$_POST['cost_per_credit_day']);
            $cost_per_credit_evng = mysqli_real_escape_string($connection,$_POST['cost_per_credit_evng']);

            $course_total_cost_day_prev = mysqli_real_escape_string($connection,$_POST['course_total_cost_day_prev']);
            $course_total_cost_evng_prev = mysqli_real_escape_string($connection,$_POST['course_total_cost_evng_prev']);

             $the_course_code_new = strtoupper(mysqli_real_escape_string($connection,$_POST['the_course_code_new']));

            // name of the uploaded file
            $course_pdf = $_FILES['course_pdf']['name'];

            // destination of the file on the server
            $destination = "assets/pdfFile/" . $course_pdf;

            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['course_pdf']['tmp_name'];

           
            move_uploaded_file($file, $destination);

            if (empty($course_pdf)) {
              $query = "SELECT * FROM courses WHERE course_code = '$the_course_code' ";
              $select_course_pdf = mysqli_query($connection,$query);
              while($row=mysqli_fetch_assoc($select_course_pdf)) {
              $course_pdf = $row['course_pdf'];
              }
            }
          
            if (empty($course_code && $course_title && $course_dept_name && $course_credits && $course_prereq  && $cost_per_credit_day)) {

               echo " Please Fill All Information";

             }else{
                //starting query for updating Department table
                //$course_total_cost_prev =$course_credits_prev*$course_cost_per_credit_prev;
                $course_total_cost_day =$course_credits*$cost_per_credit_day;
                $course_total_cost_evng =$course_credits*$cost_per_credit_evng;
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
                $dept_total_cost_day=$dept_total_cost_day-$course_total_cost_day_prev;
                $dept_total_cost_evng=$dept_total_cost_evng+ $course_total_cost_evng;
                $dept_total_cost_evng=$dept_total_cost_evng-$course_total_cost_evng_prev;
                $course_total_credits=$course_total_credits+$course_credits;
                $course_total_credits=$course_total_credits-$course_credits_prev;
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


                $query = "UPDATE courses SET ";
                // $query .= "course_code = '{$course_code}', ";
                $query .= "course_title = '{$course_title}', ";     
                // $query .= "course_dept_name = '{$course_dept_name}', ";
                $query .= "course_credits = {$course_credits}, ";
                $query .= "course_type = '{$course_prereq}', ";
                $query .= "course_prerequisites ='{$course_prerequisites}', ";
                $query .= "cost_per_credit_day = {$cost_per_credit_day}, ";
                $query .= "cost_per_credit_evng = {$cost_per_credit_evng}, ";
                $query .= "course_total_cost_day ={$course_total_cost_day}, ";
                $query .= "course_total_cost_evng ={$course_total_cost_evng}, ";
                $query .= "course_pdf = '{$course_pdf}' ";
                $query .= "WHERE course_code = '{$the_course_code_new}' ";

                $update_course = mysqli_query($connection,$query);
                if (!$update_course) {
                    die("update failed".mysqli_error($connection) );
                }
               
              }
          }
      ?>
                     <form action="courses-edit_course.php" method="post" enctype="multipart/form-data">
                        
                         <div class="form-group">
                            <label for="course-title">Edit Course Title</label>
                            <input type="text" class="form-control" name="course_title" value="<?php echo $course_title; ?>">
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
                            <input type="text" class="form-control" name="course_prerequisites" value="<?php echo $course_prerequisites; ?>">
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
                        <div class="form-group ">
                            <input type="hidden" class="form-control" name="the_course_code_new" value="<?php echo isset($_GET['p_id']) ? $_GET['p_id'] : ''; ?>">

                        </div>

                        <div class="form-group invisible">
                           <!--  <label for="course-per-credit">Add Course Credits</label> -->
                            <input type="hidden" class="form-control" name="course_credits_prev" value="<?php echo $course_credits; ?>">
                        </div>
                        <div class="form-group invisible">
                            <!-- <label for="course-per-credit">Add cost per credits</label> -->
                            <input type="hidden" class="form-control" name="course_total_cost_day_prev" value="<?php echo $course_total_cost_day; ?>">
                            <input type="hidden" class="form-control" name="course_total_cost_evng_prev" value="<?php echo $course_total_cost_evng; ?>">
                        </div>
                        

                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_course" value="Update Course">
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