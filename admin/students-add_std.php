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
            
      <?php 
      include "includes/db.php";
      global $connection;
      if (isset($_POST['create_std'])) {
          $std_name = ucwords(mysqli_real_escape_string($connection,$_POST['std_name']));
          $std_dept = mysqli_real_escape_string($connection,$_POST['std_dept']);
          $std_sem = mysqli_real_escape_string($connection,$_POST['std_sem']);
          $std_intake = mysqli_real_escape_string($connection,$_POST['std_intake']);
          $std_section = mysqli_real_escape_string($connection,$_POST['std_section']);
          $std_prog_type = mysqli_real_escape_string($connection,$_POST['std_prog_type']);
          $std_program = mysqli_real_escape_string($connection,$_POST['std_program']);
          $std_shift = mysqli_real_escape_string($connection,$_POST['std_shift']);
          $std_email = mysqli_real_escape_string($connection,$_POST['std_email']);
          $std_contact_no = mysqli_real_escape_string($connection,$_POST['std_contact_no']);
          $std_gender = mysqli_real_escape_string($connection,$_POST['std_gender']);
          $std_blood_grp = mysqli_real_escape_string($connection,$_POST['std_blood_grp']);
          $std_ability_type = mysqli_real_escape_string($connection,$_POST['std_ability_type']);
          $std_current_address = mysqli_real_escape_string($connection,$_POST['std_current_address']);
          $std_permanent_address = mysqli_real_escape_string($connection,$_POST['std_permanent_address']);
          $std_birth_id = mysqli_real_escape_string($connection,$_POST['std_birth_id']); 
          $std_details = mysqli_real_escape_string($connection,$_POST['std_details']);

///Passsword encrypting
          $std_password = "BUBT";
         //  $query = "SELECT randSalt FROM students_basic ";
         //  $select_ranSalt_query = mysqli_query($connection,$query);
         //  if (!$select_ranSalt_query) {
         //     die("query filed " .mysqli_error($connection));
         // }  
         //  $row = mysqli_fetch_array($select_ranSalt_query);
         //  $salt = $row['randSalt']; 
         //  $std_password = crypt($std_password,$salt);
/// ending Passsword encrypting


         
 
 ///file query
          $std_image = $_FILES['std_image']['name'];
          $destination = "assets/tchrimages/" . $std_image;  
          $file = $_FILES['std_image']['tmp_name'];
          move_uploaded_file($file, $destination);
///ending file query

///create_student_id
          $std_sem_one = "Spring";
          $std_sem_two = "Fall";
          if ($std_sem==$std_sem_one) {
            $cmp_std_sem=1;
          }elseif ($std_sem==$std_sem_two) {
            $cmp_std_sem=2;
          }else{
            $cmp_std_sem=3;
          }


          $student_shift_one ="Day";
          $student_shift_two ="Eveening";
         if ($std_shift==$student_shift_one) {
            $cmp_std_shift=1;
          }elseif ($std_shift==$student_shift_two) {
            $cmp_std_shift=2;
          }else{
            $cmp_std_shift=0;
          }

          $query = "SELECT dept_code FROM departments WHERE dept_name = '$std_dept' ";
          $result = mysqli_query($connection,$query);
           if (!$result) {
            die("dept code query failed ".mysqli_error($connection));
          }
          
          $row=mysqli_fetch_array($result);
          $dept_code = $row['dept_code'];
          $year = date('y');
          $education_year = $year . ($year + 1);
          
         if ($std_sift==$student_shift_one) {
            $query = "SELECT * FROM students_basic WHERE std_dept = '$std_dept'  ORDER BY std_id DESC LIMIT 1";

          $result = mysqli_query($connection, $query);
          if (!$result) {
            die("student id query failed ".mysqli_error($connection));
          }
          $result_exists = mysqli_num_rows($result);
          if($result_exists > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $std_id = intval($row['std_id']) + 1;
            }
          } else {
            $std_id = $education_year . $dept_code . $cmp_std_sem . $cmp_std_shift . '001';
          }
         }elseif ($std_shift==$student_shift_two) {
            $query = "SELECT * FROM students_basic_evening WHERE std_dept = '$std_dept'  ORDER BY std_id DESC LIMIT 1";

          $result = mysqli_query($connection, $query);
          if (!$result) {
            die("student id query failed ".mysqli_error($connection));
          }
          $result_exists = mysqli_num_rows($result);
          if($result_exists > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $std_id = intval($row['std_id']) + 1;
            }
          } else {
            $std_id = $education_year . $dept_code . $cmp_std_sem . $cmp_std_shift . '001';
          }
         }else{
           $query = "SELECT * FROM students_basic WHERE std_dept = '$std_dept'  ORDER BY std_id DESC LIMIT 1";

          $result = mysqli_query($connection, $query);
          if (!$result) {
            die("student id query failed ".mysqli_error($connection));
          }
          $result_exists = mysqli_num_rows($result);
          if($result_exists > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $std_id = intval($row['std_id']) + 1;
            }
          } else {
            $std_id = $education_year . $dept_code . $cmp_std_sem . $cmp_std_shift . '001';
          }
         }
///ending create student id


           if (empty($std_name && $std_dept && $std_intake && $std_program)) {
           echo " Please Fill All Information";
          }else{
            if ($std_shift=='Day') {

                $query= "SELECT course_code FROM courses WHERE course_dept_name = '$std_dept' ";
                 $result = mysqli_query($connection,$query);
                 $crs_cdes=array();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $crs_cde = array($row['course_code']);  
                    $crs_cdes = array_merge($crs_cdes,$crs_cde);
                  }
                  $decde_crs_cdes_mrg = json_encode($crs_cdes);

               $query = "INSERT INTO students_basic(std_id,std_edu_year,std_name,std_dept,std_sem,std_intake, std_section,std_prog_type,std_program,std_shift,std_email,std_contact_no,std_gender,std_blood_grp,std_ability_type,std_image,std_current_address,std_permanent_address,std_birth_id,std_password,std_details,std_total_course,std_incomplete_course) ";

               $query .="VALUES('{$std_id}',{$education_year},'{$std_name}','{$std_dept}','{$std_sem}',{$std_intake},{$std_section},'{$std_prog_type}','{$std_program}','{$std_shift}','{$std_email}','{$std_contact_no}','{$std_gender}','{$std_blood_grp}','{$std_ability_type}','{$std_image}','{$std_current_address}','{$std_permanent_address}','{$std_birth_id}','{$std_password}','{$std_details}','{$decde_crs_cdes_mrg}','{$decde_crs_cdes_mrg}')";

               $create_std_query = mysqli_query($connection,$query);
                if (!$create_std_query) {
                  die("create_std_query failed ".mysqli_error($connection));
                  }
                   
                  header("Location: students-add_std.php");

                }elseif ($std_shift=='Eveening') {

                    $query= "SELECT course_code FROM courses WHERE course_dept_name = '$std_dept' ";
                 $result = mysqli_query($connection,$query);
                 $crs_cdes=array();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $crs_cde = array($row['course_code']);  
                    $crs_cdes = array_merge($crs_cdes,$crs_cde);
                  }
                  $decde_crs_cdes_mrg = json_encode($crs_cdes);

                   $query = "INSERT INTO students_basic_evening(std_id,std_edu_year,std_name,std_dept,std_sem,std_intake, std_section,std_prog_type,std_program,std_shift,std_email,std_contact_no,std_gender,std_blood_grp,std_ability_type,std_image,std_current_address,std_permanent_address,std_birth_id,std_password,std_details,std_total_course,std_incomplete_course) ";

                   $query .="VALUES('{$std_id}',{$education_year},'{$std_name}','{$std_dept}','{$std_sem}',{$std_intake},{$std_section},'{$std_prog_type}','{$std_program}','{$std_shift}','{$std_email}','{$std_contact_no}','{$std_gender}','{$std_blood_grp}','{$std_ability_type}','{$std_image}','{$std_current_address}','{$std_permanent_address}','{$std_birth_id}','{$std_password}','{$std_details}','{$decde_crs_cdes_mrg}','{$decde_crs_cdes_mrg}')";

                   $create_std_query = mysqli_query($connection,$query);
                   if (!$create_std_query) {
                      die("create_std_query failed ".mysqli_error($connection));
                    }
                   header("Location: students-add_std.php");
                }else{
                   $query= "SELECT course_code FROM courses WHERE course_dept_name = '$std_dept' ";
                 $result = mysqli_query($connection,$query);
                 $crs_cdes=array();
                  while ($row = mysqli_fetch_assoc($result)) {
                    $crs_cde = array($row['course_code']);  
                    $crs_cdes = array_merge($crs_cdes,$crs_cde);
                  }
                  $decde_crs_cdes_mrg = json_encode($crs_cdes);

               $query = "INSERT INTO students_basic(std_id,std_edu_year,std_name,std_dept,std_sem,std_intake, std_section,std_prog_type,std_program,std_shift,std_email,std_contact_no,std_gender,std_blood_grp,std_ability_type,std_image,std_current_address,std_permanent_address,std_birth_id,std_password,std_details,std_total_course,std_incomplete_course) ";

               $query .="VALUES('{$std_id}',{$education_year},'{$std_name}','{$std_dept}','{$std_sem}',{$std_intake},{$std_section},'{$std_prog_type}','{$std_program}','{$std_shift}','{$std_email}','{$std_contact_no}','{$std_gender}','{$std_blood_grp}','{$std_ability_type}','{$std_image}','{$std_current_address}','{$std_permanent_address}','{$std_birth_id}','{$std_password}','{$std_details}'),'{$decde_crs_cdes_mrg}','{$decde_crs_cdes_mrg}')";

                   $create_std_query = mysqli_query($connection,$query);
                   if (!$create_std_query) {
                      die("create_std_query failed ".mysqli_error($connection));
                    }
                   header("Location: students-add_std.php");
                }

         

       }

      }

      ?>
            
        <h3 class="text-center">Add Students</h3><hr>
          <div class="row"> 
            <div class="col-md-6">      
              <form action="students-add_std.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="std_name">Add Name</label>
                    <input type="text" class="form-control" name="std_name" placeholder="Md Al Mamun" >
                </div>
                 <div class="form-group">
                    <label for="std_dept">Add Department Name</label>
                    <select name="std_dept" id="">
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
                    <label for="std_sem">Add Semester</label></br>
                    <select name="std_sem" id="">
                      <option value= 'Spring'>Spring</option>
                      <option value= 'Fall'>Fall</option>
                      <option value= 'Summer'>Summer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="std_intake">Add Batch Number</label>
                    <input type="text" class="form-control" name="std_intake" placeholder="36" >
                </div>
                 <div class="form-group">
                    <label for="std_section">Add Section</label></br>
                    <select name="std_section" id="">
                      <option value= ''>None</option>
                      <?php 
                        for ($i=1; $i <= 15; $i++) { 
                          echo "<option value= '$i'>$i</option>";
                        }

                       ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="std_prog_type">Add Program Type</label></br>
                    <select name="std_prog_type" id="">
                      <option value= 'Under Graduate'>Under Graduate</option>
                      <option value= 'Graduate'>Graduate</option>
                    </select>
                </div>
                 <div class="form-group">
                    <label for="std_program">Add Program</label></br>
                    <select name="std_program" id="">
                      <?php 
                        global $connection;
                        $query = "SELECT * FROM departments";
                        
                        $result = mysqli_query($connection,$query);
                        while ($row=mysqli_fetch_assoc($result)) {
                            $dept_prog_one = $row['dept_prog_one'];
                            $dept_prog_two = $row['dept_prog_two'];
                            $dept_prog_three = $row['dept_prog_three'];

                            if ($dept_prog_two=='' && $dept_prog_three=='') {
                              echo "<option value='$dept_prog_one'>$dept_prog_one</option>";
                            }elseif ($dept_prog_three=='' && $dept_prog_two != '') {
                               echo "<option value='$dept_prog_one'>$dept_prog_one</option>";
                               echo "<option value='$dept_prog_two'>$dept_prog_two</option>";
                            }elseif($dept_prog_three !='' && $dept_prog_two != '' && $dept_prog_three != ''){
                             echo "<option value='$dept_prog_one'>$dept_prog_one</option>";
                             echo "<option value='$dept_prog_two'>$dept_prog_two</option>";
                              echo "<option value='$dept_prog_three'>$dept_prog_three</option>";
                            }   

                        }
                        ?>
                      
                      
                    </select>
                 </div>
                <div class="form-group">
                    <label for="std_shift">Add Shift</label></br>
                    <select name="std_shift" id="">
                      <option value= 'NULL'>None</option>
                      <option value= 'Day'>Day</option>
                      <option value= 'Eveening'>Eveening</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="std_email">Add Email</label>
                    <input type="text" class="form-control" name="std_email"  placeholder="mamun@gmail.com" >
                </div>
                
                
                <div class="form-group">
                    <label for="std_contact_no">Add Contact No</label>
                    <input type="text" class="form-control" name="std_contact_no" placeholder="01775251044" >
                </div>
                 <div class="form-group">
                    <label for="std_gender">Add Gender</label></br>
                    <select name="std_gender" id="">
                      <option value= 'male'>Male</option>
                      <option value= 'Female'>Female</option>
                      <option value= 'Other'>Other</option>
                    </select>
                </div>
                
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                    <label for="std_blood_grp">Add Blood Group</label></br>
                    <select name="std_blood_grp" id="">
                      <option value= 'A+'>A+</option>
                      <option value= 'A-'>A-</option>
                      <option value= 'B+'>B+</option>
                      <option value= 'B-'>B-</option>
                      <option value= 'AB+'>AB+</option>
                      <option value= 'AB-'>AB-</option>
                      <option value= 'O+'>O+</option>
                      <option value= 'O-'>O-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="std_ability_type">Student Ability Type</label></br>
                    <select name="std_ability_type" id="">
                      <option value= 'Normal'>Normal</option>
                      <option value= 'Abnormal'>Abnormal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="std_image">Upload Image</label></br>
                     <input type="file" name="std_image">
                </div>
                <div class="form-group">
                    <label for="std_current_address">Add Current Address</label>
                    <input type="text" class="form-control" name="std_current_address" placeholder="Mirpur 2, Dhaka" >
                </div>
                <div class="form-group">
                    <label for="std_permanent_address">Add Parmanent Address</label>
                    <input type="text" class="form-control" name="std_permanent_address" placeholder="Dhanmondi, Dhaka" >
                </div>
                <div class="form-group">
                    <label for="std_birth_id">Add Birth Id</label>
                    <input type="text" class="form-control" name="std_birth_id" placeholder="12345678912345678" >
                </div>
               <!--  <div class="form-group">
                    <label for="std_password">Add Password</label>
                    <input type="text" class="form-control" name="std_password" placeholder="*******" >
                </div> -->
                 <div class="form-group">
                    <label for="std_details">Add Details about past all institute and result</label>
                    <textarea class="form-control" name="std_details" id="" rows="6"></textarea>
                </div>
              </div>
               <div class="form-group">
                  <input type="submit" class="btn btn-primary" name="create_std" value="Create Student">
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
<!-- Footer end