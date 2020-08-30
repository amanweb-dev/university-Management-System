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
                    <h3 class="text-center">Add Department</h3><hr>
        <?php 
            include "includes/db.php";
            global $connection;
            if (isset($_POST['create_dept'])) {
                $dept_code = mysqli_real_escape_string($connection,$_POST['dept_code']);
                $dept_name = strtoupper(mysqli_real_escape_string($connection,$_POST['dept_name']));
                $dept_prog_type = mysqli_real_escape_string($connection,$_POST['dept_prog_type']);
                $dept_prog_one = mysqli_real_escape_string($connection,$_POST['dept_prog_one']);
                $dept_prog_two = mysqli_real_escape_string($connection,$_POST['dept_prog_two']);
                $dept_prog_three = mysqli_real_escape_string($connection,$_POST['dept_prog_three']);
               

                 if (empty($dept_code && $dept_name && $dept_prog_type && $dept_prog_one)) {
                 echo " Please Fill All Information";
             }else{
              $query = "SELECT * FROM courses WHERE course_dept_name = '$dept_name' ";
              $result = mysqli_query($connection,$query);
                if (!$result) {
                  die("query failed". mysqli_error($connection));
                }
                $course_dept_name=0;
                $course_credits=0;
                $course_total_cost_day=0;
                $course_total_cost_evng=0;
               while ($row = mysqli_fetch_assoc($result)) {
                 $course_dept_name=$row['course_dept_name'];
                 $course_credits +=$row['course_credits'];
                 $course_total_cost_day +=$row['course_total_cost_day'];
                 $course_total_cost_evng +=$row['course_total_cost_evng'];
               }

               if ($course_dept_name==$dept_name) {
                 $query = "INSERT INTO departments(dept_code,dept_name,dept_prog_type,dept_prog_one,dept_prog_two,dept_prog_three,dept_total_cost_day,dept_total_cost_evng,dept_total_credits) ";

                      $query .="VALUES('{$dept_code}','{$dept_name}','{$dept_prog_type}','{$dept_prog_one}','{$dept_prog_two}','{$dept_prog_three}',{$course_total_cost_day},{$course_total_cost_evng},{$course_credits}) ";

                      $create_dept_query = mysqli_query($connection,$query);
                       if (!$create_dept_query) {
                  die("query failed". mysqli_error($connection));
                }
                      header("Location: depts-add_dept.php");

               }else {
                $query = "INSERT INTO departments(dept_code,dept_name,dept_prog_type,dept_prog_one,dept_prog_two,dept_prog_three,dept_total_cost_day,dept_total_cost_evng,dept_total_credits) ";

                $query .="VALUES('{$dept_code}','{$dept_name}','{$dept_prog_type}','{$dept_prog_one}','{$dept_prog_two}','{$dept_prog_three}',{$course_total_cost_day},{$course_total_cost_evng},{$course_credits}) ";

                $create_dept_query = mysqli_query($connection,$query);
                  if (!$create_dept_query) {
                  die("query failed". mysqli_error($connection));
                }
                      header("Location: depts-add_dept.php");
               }

             }

            }

        ?>

                     <form action="depts-add_dept.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="dept-code">Add Dept. Code</label>
                            <input type="text" class="form-control" name="dept_code">
                        </div>
                         <div class="form-group">
                            <label for="dept-name">Add Dept. Name</label>
                            <input type="text" class="form-control" name="dept_name">
                        </div>
                        <div class="form-group">
                            <label for="dept_prog_type">Add Program Type</label></br>
                            <select name="dept_prog_type" id="">
                              <option value= 'Under Graduate'>Under Graduate</option>
                              <option value= 'Graduate'>Graduate</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dept_prog_one">Add Program One</label></br>
                            <select name="dept_prog_one" id="">
                              <!-- undergraduate -->
                              <option value= 'BBA'>BBA</option>
                              <option value= 'B.Sc. in Computer Science & Information Technology (CSIT)'> B.Sc. in Computer Science & Information Technology (CSIT)</option>
                              <option value= 'B.Sc. in Computer Science & Engineering (CSE)'> B.Sc. in Computer Science & Engineering (CSE)</option>
                              <option value= 'B. Sc. in Electrical and Electronic Engineering (EEE)'>B. Sc. in Electrical and Electronic Engineering (EEE)</option>
                              <option value= 'B. Sc. in Textile Engineering'>B. Sc. in Textile Engineering</option>
                              <option value= 'B. Architechture (B.Arch.)'>B. Architechture (B.Arch.)</option>
                              <option value= 'BA (Hons.) in English '>BA (Hons.) in English </option>
                              <option value= 'B.Sc. (Hons.) in Economics'>B.Sc. (Hons.) in Economics</option>
                              <option value= 'B.Sc. (Hons.) in Environment and Development Economics'>B.Sc. (Hons.) in Environment and Development Economics</option>
                              <option value= 'LL.B (Hons.)'>LL.B (Hons.)</option>
                              <!-- graduate programm-->
                              <option value= 'LLMBA (Regular)'>LLMBA (Regular)</option>
                              <option value= 'MBA (Executive)'>MBA (Executive)</option>
                              <option value= 'MBM (Master of Bank Management)'>MBM (Master of Bank Management)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-One-Year)'>M.Sc. in Mathematics (General/Thesis-One-Year)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-Two-Year)'>M.Sc. in Mathematics (General/Thesis-Two-Year)</option>
                              <option value= 'MA in English'>MA in English</option>
                              <option value= 'MA in English Language Teaching (ELT)'>MA in English Language Teaching (ELT)</option>
                              <option value= 'M.Sc. in Economics'>M.Sc. in Economics</option>
                              <option value= 'LL.M'>LL.M</option>
                              
                            </select>
                         </div>
                         <div class="form-group">
                            <label for="dept_prog_two">Add Program Two</label></br>
                            <select name="dept_prog_two" id="">
                              <!-- undergraduate -->
                              <option value= ''>NULL</option>
                              <option value= 'BBA'>BBA</option>
                              <option value= 'B.Sc. in Computer Science & Information Technology (CSIT)'> B.Sc. in Computer Science & Information Technology (CSIT)</option>
                              <option value= 'B.Sc. in Computer Science & Engineering (CSE)'> B.Sc. in Computer Science & Engineering (CSE)</option>
                              <option value= 'B. Sc. in Electrical and Electronic Engineering (EEE)'>B. Sc. in Electrical and Electronic Engineering (EEE)</option>
                              <option value= 'B. Sc. in Textile Engineering'>B. Sc. in Textile Engineering</option>
                              <option value= 'B. Architechture (B.Arch.)'>B. Architechture (B.Arch.)</option>
                              <option value= 'BA (Hons.) in English '>BA (Hons.) in English </option>
                              <option value= 'B.Sc. (Hons.) in Economics'>B.Sc. (Hons.) in Economics</option>
                              <option value= 'B.Sc. (Hons.) in Environment and Development Economics'>B.Sc. (Hons.) in Environment and Development Economics</option>
                              <option value= 'LL.B (Hons.)'>LL.B (Hons.)</option>
                              <!-- graduate programm-->
                              <option value= 'LLMBA (Regular)'>LLMBA (Regular)</option>
                              <option value= 'MBA (Executive)'>MBA (Executive)</option>
                              <option value= 'MBM (Master of Bank Management)'>MBM (Master of Bank Management)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-One-Year)'>M.Sc. in Mathematics (General/Thesis-One-Year)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-Two-Year)'>M.Sc. in Mathematics (General/Thesis-Two-Year)</option>
                              <option value= 'MA in English'>MA in English</option>
                              <option value= 'MA in English Language Teaching (ELT)'>MA in English Language Teaching (ELT)</option>
                              <option value= 'M.Sc. in Economics'>M.Sc. in Economics</option>
                              <option value= 'LL.M'>LL.M</option>
                              
                            </select>
                         </div>
                         <div class="form-group">
                            <label for="dept_prog_three">Add Program three</label></br>
                            <select name="dept_prog_three" id="">
                              <!-- undergraduate -->
                              <option value= ''>Null</option>
                              <option value= 'BBA'>BBA</option>
                              <option value= 'B.Sc. in Computer Science & Information Technology (CSIT)'> B.Sc. in Computer Science & Information Technology (CSIT)</option>
                              <option value= 'B.Sc. in Computer Science & Engineering (CSE)'> B.Sc. in Computer Science & Engineering (CSE)</option>
                              <option value= 'B. Sc. in Electrical and Electronic Engineering (EEE)'>B. Sc. in Electrical and Electronic Engineering (EEE)</option>
                              <option value= 'B. Sc. in Textile Engineering'>B. Sc. in Textile Engineering</option>
                              <option value= 'B. Architechture (B.Arch.)'>B. Architechture (B.Arch.)</option>
                              <option value= 'BA (Hons.) in English '>BA (Hons.) in English </option>
                              <option value= 'B.Sc. (Hons.) in Economics'>B.Sc. (Hons.) in Economics</option>
                              <option value= 'B.Sc. (Hons.) in Environment and Development Economics'>B.Sc. (Hons.) in Environment and Development Economics</option>
                              <option value= 'LL.B (Hons.)'>LL.B (Hons.)</option>
                              <!-- graduate programm-->
                              <option value= 'LLMBA (Regular)'>LLMBA (Regular)</option>
                              <option value= 'MBA (Executive)'>MBA (Executive)</option>
                              <option value= 'MBM (Master of Bank Management)'>MBM (Master of Bank Management)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-One-Year)'>M.Sc. in Mathematics (General/Thesis-One-Year)</option>
                              <option value= 'M.Sc. in Mathematics (General/Thesis-Two-Year)'>M.Sc. in Mathematics (General/Thesis-Two-Year)</option>
                              <option value= 'MA in English'>MA in English</option>
                              <option value= 'MA in English Language Teaching (ELT)'>MA in English Language Teaching (ELT)</option>
                              <option value= 'M.Sc. in Economics'>M.Sc. in Economics</option>
                              <option value= 'LL.M'>LL.M</option>
                              
                            </select>
                         </div>
                          
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_dept" value="Create Dept">
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