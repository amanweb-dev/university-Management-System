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
       if (isset($_GET['p_id']) && isset($_GET['shift'])) {
            $the_std_id = $_GET['p_id'];
            $the_std_shift = $_GET['shift'];
         if ($the_std_shift=='Day') {
           $query = "SELECT * FROM students_basic WHERE std_id = '$the_std_id' ";
         $select_std_by_id = mysqli_query($connection,$query);
         while($row=mysqli_fetch_assoc($select_std_by_id)) {
            $std_id=$row['std_id'];
            $std_edu_year=$row['std_edu_year'];
            $std_name=$row['std_name'];
            $std_dept=$row['std_dept'];
            $std_sem=$row['std_sem'];
            $std_intake=$row['std_intake'];
            $std_section=$row['std_section'];
            $std_prog_type=$row['std_prog_type'];
            $std_program=$row['std_program'];
            $std_shift=$row['std_shift'];
            $std_email=$row['std_email'];
            $std_contact_no=$row['std_contact_no'];
            $std_gender=$row['std_gender'];
            $std_blood_grp=$row['std_blood_grp'];
            $std_ability_type=$row['std_ability_type'];
            $std_image=$row['std_image'];
            $std_current_address=$row['std_current_address'];
            $std_permanent_address=$row['std_permanent_address'];
            $std_birth_id=$row['std_birth_id'];
            $std_password=$row['std_password'];
            $std_details=$row['std_details'];
            $randSalt=$row['randSalt'];
            }
         }elseif ($the_std_shift=='Eveening') {
           $query = "SELECT * FROM students_basic_evening WHERE std_id = '$the_std_id' ";
         $select_std_by_id = mysqli_query($connection,$query);
         while($row=mysqli_fetch_assoc($select_std_by_id)) {
            $std_id=$row['std_id'];
            $std_edu_year=$row['std_edu_year'];
            $std_name=$row['std_name'];
            $std_dept=$row['std_dept'];
            $std_sem=$row['std_sem'];
            $std_intake=$row['std_intake'];
            $std_section=$row['std_section'];
            $std_prog_type=$row['std_prog_type'];
            $std_program=$row['std_program'];
            $std_shift=$row['std_shift'];
            $std_email=$row['std_email'];
            $std_contact_no=$row['std_contact_no'];
            $std_gender=$row['std_gender'];
            $std_blood_grp=$row['std_blood_grp'];
            $std_ability_type=$row['std_ability_type'];
            $std_image=$row['std_image'];
            $std_current_address=$row['std_current_address'];
            $std_permanent_address=$row['std_permanent_address'];
            $std_birth_id=$row['std_birth_id'];
            $std_password=$row['std_password'];
            $std_details=$row['std_details'];
            $randSalt=$row['randSalt'];
            }
         }else{
           $query = "SELECT * FROM students_basic WHERE std_id = '$the_std_id' ";
         $select_std_by_id = mysqli_query($connection,$query);
         while($row=mysqli_fetch_assoc($select_std_by_id)) {
            $std_id=$row['std_id'];
            $std_edu_year=$row['std_edu_year'];
            $std_name=$row['std_name'];
            $std_dept=$row['std_dept'];
            $std_sem=$row['std_sem'];
            $std_intake=$row['std_intake'];
            $std_section=$row['std_section'];
            $std_prog_type=$row['std_prog_type'];
            $std_program=$row['std_program'];
            $std_shift=$row['std_shift'];
            $std_email=$row['std_email'];
            $std_contact_no=$row['std_contact_no'];
            $std_gender=$row['std_gender'];
            $std_blood_grp=$row['std_blood_grp'];
            $std_ability_type=$row['std_ability_type'];
            $std_image=$row['std_image'];
            $std_current_address=$row['std_current_address'];
            $std_permanent_address=$row['std_permanent_address'];
            $std_birth_id=$row['std_birth_id'];
            $std_password=$row['std_password'];
            $std_details=$row['std_details'];
            $randSalt=$row['randSalt'];
            }
         }
         
        }
if (isset($_POST['update_std'])) {
          $std_name = ucwords(mysqli_real_escape_string($connection,$_POST['std_name']));
          $std_intake = mysqli_real_escape_string($connection,$_POST['std_intake']);
          $std_section = mysqli_real_escape_string($connection,$_POST['std_section']);
          $std_prog_type = mysqli_real_escape_string($connection,$_POST['std_prog_type']);
          $std_program = mysqli_real_escape_string($connection,$_POST['std_program']);
          $std_email = mysqli_real_escape_string($connection,$_POST['std_email']);
          $std_contact_no = mysqli_real_escape_string($connection,$_POST['std_contact_no']);
          $std_gender = mysqli_real_escape_string($connection,$_POST['std_gender']);
          $std_blood_grp = mysqli_real_escape_string($connection,$_POST['std_blood_grp']);
          $std_ability_type = mysqli_real_escape_string($connection,$_POST['std_ability_type']);
          $std_current_address = mysqli_real_escape_string($connection,$_POST['std_current_address']);
          $std_permanent_address = mysqli_real_escape_string($connection,$_POST['std_permanent_address']);
          $std_birth_id = mysqli_real_escape_string($connection,$_POST['std_birth_id']); 
          $std_details = mysqli_real_escape_string($connection,$_POST['std_details']);
          $the_std_id = mysqli_real_escape_string($connection,$_POST['the_std_id']);
          $the_std_shift = mysqli_real_escape_string($connection,$_POST['the_std_shift']);
 
///Passsword encrypting
          $std_password = "BUBT";
         //  mysqli_real_escape_string($connection,$_POST['std_password']);
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
          if ($the_std_shift=='Day') {
            if (empty($std_image)) {
            $query = "SELECT * FROM students_basic WHERE std_id = $the_std_id ";
            $select_std_image = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_std_image)) {
            $std_image = $row['std_image'];
            }
          }
          }elseif ($the_std_shift=='Eveening') {
            if (empty($std_image)) {
            $query = "SELECT * FROM students_basic_evening WHERE std_id = $the_std_id ";
            $select_std_image = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_std_image)) {
            $std_image = $row['std_image'];
            }
          }
          }else{
            if (empty($std_image)) {
            $query = "SELECT * FROM students_basic WHERE std_id = $the_std_id ";
            $select_std_image = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_std_image)) {
            $std_image = $row['std_image'];
            }
          }
          }
           
///ending file query

         if (empty($std_name && $std_intake && $std_program && $std_password)) {
           echo " Please Fill All Information";
          }else{
                if ($the_std_shift=='Day') {
                 $query = "UPDATE students_basic SET ";
                $query .= "std_name = '{$std_name}', ";
                $query .= "std_intake = {$std_intake}, ";
                $query .= "std_section = {$std_section}, ";
                $query .= "std_prog_type = '{$std_prog_type}', ";
                $query .= "std_program = '{$std_program}', ";
                $query .= "std_email = '{$std_email}', ";
                $query .= "std_contact_no = '{$std_contact_no}', ";
                $query .= "std_gender = '{$std_gender}', ";
                $query .= "std_blood_grp = '{$std_blood_grp}', ";
                $query .= "std_ability_type = '{$std_ability_type}', ";
                $query .= "std_image = '{$std_image}', ";
                $query .= "std_current_address = '{$std_current_address}', ";
                $query .= "std_permanent_address = '{$std_permanent_address}', ";
                $query .= "std_birth_id = '{$std_birth_id}', ";
                $query .= "std_password = '{$std_password}', ";
                $query .= "std_details = '{$std_details}' ";         
                $query .= "WHERE std_id = '{$the_std_id}' ";

                $update_std = mysqli_query($connection,$query);
                if (!$update_std) {
                    die("update std failed".mysqli_error($connection) );
                }else{
                  echo "student update successfully";
                }

                }elseif ($the_std_shift=='Eveening') {
                 $query = "UPDATE students_basic_evening SET ";
                $query .= "std_name = '{$std_name}', ";
                $query .= "std_intake = {$std_intake}, ";
                $query .= "std_section = {$std_section}, ";
                $query .= "std_prog_type = '{$std_prog_type}', ";
                $query .= "std_program = '{$std_program}', ";
                $query .= "std_email = '{$std_email}', ";
                $query .= "std_contact_no = '{$std_contact_no}', ";
                $query .= "std_gender = '{$std_gender}', ";
                $query .= "std_blood_grp = '{$std_blood_grp}', ";
                $query .= "std_ability_type = '{$std_ability_type}', ";
                $query .= "std_image = '{$std_image}', ";
                $query .= "std_current_address = '{$std_current_address}', ";
                $query .= "std_permanent_address = '{$std_permanent_address}', ";
                $query .= "std_birth_id = '{$std_birth_id}', ";
                $query .= "std_password = '{$std_password}', ";
                $query .= "std_details = '{$std_details}' ";         
                $query .= "WHERE std_id = '{$the_std_id}' ";

                $update_std = mysqli_query($connection,$query);
                if (!$update_std) {
                    die("update std failed".mysqli_error($connection) );
                }else{
                  echo "student update successfully";
                }
                }else{
                   $query = "UPDATE students_basic SET ";
                $query .= "std_name = '{$std_name}', ";
                $query .= "std_intake = {$std_intake}, ";
                $query .= "std_section = {$std_section}, ";
                $query .= "std_prog_type = '{$std_prog_type}', ";
                $query .= "std_program = '{$std_program}', ";
                $query .= "std_email = '{$std_email}', ";
                $query .= "std_contact_no = '{$std_contact_no}', ";
                $query .= "std_gender = '{$std_gender}', ";
                $query .= "std_blood_grp = '{$std_blood_grp}', ";
                $query .= "std_ability_type = '{$std_ability_type}', ";
                $query .= "std_image = '{$std_image}', ";
                $query .= "std_current_address = '{$std_current_address}', ";
                $query .= "std_permanent_address = '{$std_permanent_address}', ";
                $query .= "std_birth_id = '{$std_birth_id}', ";
                $query .= "std_password = '{$std_password}', ";
                $query .= "std_details = '{$std_details}' ";         
                $query .= "WHERE std_id = '{$the_std_id}' ";

                $update_std = mysqli_query($connection,$query);
                if (!$update_std) {
                    die("update std failed".mysqli_error($connection) );
                }else{
                  echo "student update successfully";
                }
                }
              }

           
       }
       

      ?>
            
        <h3 class="text-center">Edit Students</h3><hr>
          <div class="row"> 
            <div class="col-md-6">      
              <form action="students-edit_std.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="std_name">Add Name</label>
                    <input type="text" class="form-control" name="std_name" value="<?php echo $std_name; ?>" >
                </div>
                 
                 
                <div class="form-group">
                    <label for="std_intake">Add Batch Number</label>
                    <input type="text" class="form-control" name="std_intake" value="<?php echo $std_intake; ?>" >
                </div>
                 <div class="form-group">
                    <label for="std_section">Add Section</label></br>
                    <select name="std_section" id="">
                      <option value= '<?php echo $std_section; ?>'><?php echo $std_section; ?></option>
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
                      echo "<option value='$std_program'>$std_program</option>";
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
                    <label for="std_email">Add Email</label>
                    <input type="text" class="form-control" name="std_email" value="<?php echo $std_email; ?>" >
                </div>
                
                
                <div class="form-group">
                    <label for="std_contact_no">Add Contact No</label>
                    <input type="text" class="form-control" name="std_contact_no" value="<?php echo $std_contact_no; ?>" >
                </div>
                 <div class="form-group">
                    <label for="std_gender">Add Gender</label></br>
                    <select name="std_gender" id="">
                      <option value= '<?php echo ucwords($std_gender); ?>'><?php echo ucwords($std_gender); ?></option>
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
                       <option value= '<?php echo $std_blood_grp; ?>'><?php echo $std_blood_grp; ?></option>
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
                      <option value= '<?php echo $std_ability_type; ?>'><?php echo $std_ability_type; ?></option>
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
                    <input type="text" class="form-control" name="std_current_address" value="<?php echo $std_current_address; ?>" >
                </div>
                <div class="form-group">
                    <label for="std_permanent_address">Add Parmanent Address</label>
                    <input type="text" class="form-control" name="std_permanent_address" value="<?php echo $std_permanent_address; ?>" >
                </div>
                <div class="form-group">
                    <label for="std_birth_id">Add Birth Id</label>
                    <input type="text" class="form-control" name="std_birth_id" value="<?php echo $std_birth_id; ?>" >
                </div>
                <div class="form-group">
                    <label for="std_password">Add Password</label>
                    <input type="text" class="form-control" name="std_password" placeholder="*******" >
                </div>
                 <div class="form-group">
                    <label for="std_details">Add Details about past all institute and result</label>
                    <textarea class="form-control" name="std_details" id="" rows="6"></textarea>
                </div>
                <div class="form-group ">
                    <input type="hidden" class="form-control" name="the_std_id" value="<?php echo isset($_GET['p_id']) ? $_GET['p_id'] : ''; ?>">
                </div>
                 <div class="form-group invisible">
                      <!-- <label for="std_edu_year">educational year</label> -->
                    <input type="hidden" class="form-control" name="std_edu_year" value="<?php echo $std_edu_year; ?>">
                 </div>
                  <div class="form-group invisible">
                      <!-- <label for="std_edu_year">educational year</label> -->
                    <input type="hidden" class="form-control" name="the_std_shift" value="<?php echo $the_std_shift; ?>">
                 </div>
                  
              </div>
               <div class="form-group btn_input">
                  <input type="submit" class="btn btn-primary text-center" name="update_std" value="Update Student">
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