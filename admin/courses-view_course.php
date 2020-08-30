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
            <table class="table table-bordered table-hover">
              <h2>View All courses</h2>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Dept</th>
                        <th>Credits</th>
                        <th>Prereq</th>
                        <th>Cost Day</th>
                        <th>Cost Evng</th>
                        <th>Book</th>    
                        <th>Edit</th> 
                        <th>Delete</th>
                       
                    </tr>
                </thead>
                 <tbody>
                  <?php 
                      include "includes/db.php";
                      global $connection;
                      $query = "SELECT * FROM courses ";
                      $select_courses = mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_courses)) {
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
                        if (empty($course_pdf)) {
                          $course_pdf="../../index.php";
                        }
                          // $user_create_date = $row['user_date'];
                          echo "<tr>";
                          echo "<td>$course_code</td>";
                          echo "<td>$course_title</td>";
                          echo "<td>$course_dept_name</td>";
                          echo "<td>$course_credits</td>";
                          echo "<td>$course_prerequisites</td>";
                          echo "<td>$course_total_cost_day</td>";
                          echo "<td>$course_total_cost_evng</td>";
                         echo "<td><a href='assets/pdfFile/$course_pdf'  target='_blank'>View Book</a></td>";

                         

                          echo "<td><a href='courses-edit_course.php?p_id={$course_code}&d_name={$course_dept_name}'><button type='button' class='btn btn-warning'>Edit</button></a></td>";

                          echo "<td><a href='courses-view_course.php?delete={$course_code}&d_name={$course_dept_name}'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                          
                          echo "</tr>";       
                          
                      }

                   ?>
                   <?php 

                         if(isset($_GET['delete'])) {
                          $the_course_code = $_GET['delete'];
                          $course_dept_name = $_GET['d_name'];
                         $query = "DELETE FROM courses WHERE course_code = '{$the_course_code}' AND course_dept_name ='{$course_dept_name}' ";
                         $delete_query = mysqli_query($connection,$query);
                         if (!$delete_query) {
                           die("delete course query ".mysqli_error($connection));
                         }
                         header("Location: courses-view_course.php");
                      }

                    ?>

                 
              </tbody>
            </table>
           
            <!-- end row -->

            
                <!-- end col -->

        </div>
            <!--- end row -->

    </div> <!-- container -->

</div> <!-- content -->

<!-- Footer start-->
<?php include "includes/admin_footer.php"; ?>
<!-- Footer end-->