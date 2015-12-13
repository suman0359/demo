

    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url()?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                BBT Inventory
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                
                    <ul class="nav navbar-nav">
                       
                        <!-- User Account: style can be found in dropdown.less -->
                         <?php  
                         $this->db=$this->load->database('default',true);
                            $name=$this->session->userdata("username");
                            $id=$this->session->userdata("uid");
                            $userinfo=$this->CM->getwhere('user',array('id'=>$id));
                           
                       ?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               
                                <span>
                                
                                <?php
                                   echo $name ;
                                ?>
                                <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url(); ?>uploads/<?php echo $userinfo->image ;?>" class="img-circle" alt="User Image" />
                                    <p>
                                            <?php
                                                    echo $name ;
                                                ?>
                                                <small><a href="<?php  echo base_url();  ?>index.php/user/pas_chng/<?php echo  $id; ?>">Change your password ?</a></small>
                                    </p>
                                </li>
                                     
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php  echo base_url();  ?>user/profile/<?php echo  $id; ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url()?>index.php/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
               
                
                </div>
            </nav>
        </header>