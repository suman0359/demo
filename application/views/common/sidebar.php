
   <?php  //echo $c; ?>
    
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <?php  
                   
                       $name=$this->session->userdata("username");
                       $user_type=$this->session->userdata("user_type");
                       $id=$this->session->userdata("uid");
                       $permission_department=$this->session->userdata('permissiond');
                       $userinfo=$this->CM->getwhere('user',array('id'=>$id));
                    ?>
                    
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php  echo base_url(""); ?>uploads/<?php echo $userinfo->image ;?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php  echo $name; ?></p>

                            <a href="<?php echo base_url(); ?>"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <div class="sidebar_menu_po"> 
                        <ul class="sidebar-menu"> 
                 
                        <li class="">
                            <a href="<?php echo base_url(); ?>home">
                                <i class="fa fa-home"></i> <span>Home</span>
                            </a>
                        </li>
                        </ul>
                   
                         <?php 
                         $this->load->view('common/menu')
                         ?>
                     </div>
                </section>
                <!-- /.sidebar -->
            </aside>
