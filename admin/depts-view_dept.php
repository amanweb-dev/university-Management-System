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
              <h2>View All Departments</h2>
                <thead>
                    <tr>
                        <th>Dept Code</th>
                        <th>Dept Name</th>
                        <th>Dept Cost Day</th>
                        <th>Dept Cost Evng</th>
                        <th>Dept Credits</th>   
                        <th>Edit</th> 
                        <th>Delete</th>
                       
                    </tr>
                </thead>
                 <tbody>
                  <?php 
                      include "includes/db.php";
                      global $connection;
                      $query = "SELECT * FROM departments ";
                      $select_departments = mysqli_query($connection,$query);
                      while ($row=mysqli_fetch_assoc($select_departments)) {
                        $dept_code=$row['dept_code'];
                        $dept_name=$row['dept_name'];
                        $dept_total_cost_day=$row['dept_total_cost_day'];
                        $dept_total_cost_evng=$row['dept_total_cost_evng'];
                        $dept_total_credits=$row['dept_total_credits'];
                      
                          echo "<tr>";
                          echo "<td>$dept_code</td>";
                          echo "<td>$dept_name</td>";
                          echo "<td>$dept_total_cost_day</td>";
                          echo "<td>$dept_total_cost_evng</td>";
                          echo "<td>$dept_total_credits</td>";

                          echo "<td><a href='depts-edit_dept.php?p_id={$dept_code}'><button type='button' class='btn btn-warning'>Edit</button></a></td>";

                          echo "<td><a href='depts-view_dept.php?delete={$dept_code}'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                          
                          echo "</tr>";       
                          
                      }

                   ?>
                   <?php 

                        global $connection;
                         if(isset($_GET['delete'])) {
                          $the_dept_code = $_GET['delete'];
                         $query = "DELETE FROM departments WHERE dept_code = '{$the_dept_code}' ";
                         $delete_dept_query = mysqli_query($connection,$query);
                         header("Location: depts-view_dept.php");
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