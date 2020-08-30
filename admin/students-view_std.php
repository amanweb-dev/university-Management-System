 header Start -->
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
            <table class="table table-bordered table-hover">
              <h2>View All Students</h2>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Dept</th>
                        <th>Semester</th>
                        <th>Shift</th>
                        <th>Intake</th>
                        <th>Section</th>   
                        <th>Edit</th> 
                        <th>Delete</th>
                        <th>View Pro</th>
                       
                    </tr>
                </thead>
                 <tbody>
                  <?php 
                      include "includes/db.php";
                      global $connection;

                      $query = "SELECT * FROM students_basic UNION SELECT * FROM students_basic_evening ORDER BY std_shift ";
                      $select_std = mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_std)) {
                        $std_id=$row['std_id'];
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

                      
                          echo "<tr>";
                          echo "<td>$std_id</td>";
                          echo "<td>$std_name</td>";
                          echo "<td>$std_dept</td>";
                          echo "<td>$std_sem</td>";
                          echo "<td>$std_shift</td>";
                          echo "<td>$std_intake</td>";
                          echo "<td>$std_section</td>";

                          echo "<td><a href='students-edit_std.php?p_id={$std_id}&shift={$std_shift}'><button type='button' class='btn btn-warning'>Edit</button></a></td>";

                          echo "<td><a href='students-view_std.php?delete={$std_id}&shift={$std_shift}'><button type='button' class='btn btn-danger'>Delete</button></a></td>";

                          echo "<td><a href='students-profile_std.php?s_id={$std_id}&shift={$std_shift}'><button type='button' class='btn btn-danger'>View</button></a></td>";
                          
                          echo "</tr>";       
                          
                      }

                   ?>
                   <?php 

                        global $connection;
                         if(isset($_GET['delete'])) {
                          $the_std_id = $_GET['delete'];
                          $the_std_shift = $_GET['shift'];

                          if ($the_std_shift=='Day') {
                           $query = "DELETE FROM students_basic WHERE std_id = '{$the_std_id}' ";
                         $delete_std_query = mysqli_query($connection,$query);
                         header("Location: students-view_std.php");
                          }elseif ($the_std_shift=='Eveening') {
                         $query = "DELETE FROM students_basic_evening WHERE std_id = '{$the_std_id}' ";
                         $delete_std_query = mysqli_query($connection,$query);
                         header("Location: students-view_std.php");
                          }else{
                            $query = "DELETE FROM students_basic WHERE std_id = '{$the_std_id}' ";
                         $delete_std_query = mysqli_query($connection,$query);
                         header("Location: students-view_std.php");
                          }
                         
                      }

                    ?>

                 
              </tbody>
            </table>
           
            <!-- end row -->

           <!--  <div class="row">  
                <div class="col-xl-4">
                    <div class="card-box">
                      
                      
                    </div>
                </div>
            </div> -->
            
                <!-- end col -->

        </div>
            <!--- end row -->

    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer start-->
<?php include "includes/admin_footer.php"; ?>
<!-- Footer end