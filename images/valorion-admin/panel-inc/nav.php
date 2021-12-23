<?php include("panel-inc/session.php"); ?>
<?php $time = date("H:i:s"); ?>
<?php $date = date("m.d.Y"); ?>
<?php $username = $_SESSION['username']; ?>
        <!-- Aside Start-->
        <aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="index.php" class="logo-expanded">
                    <span class="nav-label">Internal Use</span>
                </a>
            </div>
            <!-- / brand -->
        
            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
                    <li class="active"><a href="#"> <span class="nav-label">Dashboard</span></a></li>
                    <li class="has-submenu"><a href="#"> <span class="nav-label">Navigation</span></a>
                        <ul class="list-unstyled">
                            <li><a href="items.php">Items</a></li>
                            <li><a href="maps.php">Maps</a></li>
                            <li><a href="monsters.php">Monsters</a></li>
                            <li><a href="quests.php">Quests</a></li>
                            <li><a href="shops.php">Shops</a></li>
							<li><a href="users.php">Users</a></li>
                        </ul>
                   </li>
                    <li class="has-submenu"><a href="#"> <span class="nav-label">Upload</span></a>
                        <ul class="list-unstyled">
                            <li><a href="items-upload.php">Items</a></li>
                            <li><a href="maps-upload.php">Maps</a></li>
                            <li><a href="monsters-upload.php">Monsters</a></li>
                        </ul>
                   </li>
                </ul>
            </nav>
                
        </aside>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <button type="button" class="navbar-toggle pull-left">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Search -->
                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                  <input type="text" placeholder="Search..." class="form-control">
                  <a href=""><i class="fa fa-search"></i></a>
                </form>
                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">
                    <ul class="nav navbar-nav hidden-xs">
                        <li class="dropdown">
                          <a data-toggle="dropdown" class="dropdown-toggle" href="#">English <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="#">Indonesia</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right navbar -->
                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
                        <!-- mesages -->  
                <form role="time" class="navbar-left app-search pull-left hidden-xs">
                  <h4> <?php echo $date; ?> <?php echo $time; ?> </h4>
                </form>
                        <!-- /messages -->
                        <!-- Notification -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge badge-sm up bg-pink count">3</span>
                            </a>
                            <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                                <li class="noti-header">
                                    <p>Notifications</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="pull-left"></span>
                                        <span>You Got No Noftications.</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- /Notification -->

                        <!-- user login dropdown start-->
                        <li class="dropdown text-center">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="username"><?php echo $username; ?> </span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                                <li><a href="#"><i class="fa fa-sign-out"></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->       
                    </ul>
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->