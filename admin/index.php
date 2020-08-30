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

                <div class="col-xl-3 col-sm-6">
                    <div class="card-box widget-box-two widget-two-custom">
                        <i class="mdi mdi-account-multiple widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Unique Visitors</p>
                            <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup">236521</span></h2>
                            <p class="m-0">Jan - Apr 2017</p>
                        </div>
                    </div>
                </div><!-- end col -->
   
            </div>
            <!-- end row -->

            <div class="row">  
                <div class="col-xl-4">
                    <div class="card-box">
                        <script type="text/javascript">
                              google.charts.load('current', {'packages':['bar']});
                              google.charts.setOnLoadCallback(drawChart);

                              function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                  ['Year', 'Sales', 'Expenses', 'Profit'],
                                  ['2014', 1000, 400, 200],
                                  ['2015', 1170, 460, 250],
                                  ['2016', 660, 1120, 300],
                                  ['2017', 1030, 540, 350]
                                ]);

                                var options = {
                                  chart: {
                                    title: 'Company Performance',
                                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                                  }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                              }
                            </script>
                              <div id="columnchart_material" style="width: 1080px; height: 500px;"></div>
                    </div>
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