 <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url();?>Dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src="<?=base_url();?>assets/dist/img/nokia_logo_white.png" style="width:50%; height: 100%;"></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li >
              <a href="<?=base_url()?>Auth/logout"><span class="hidden-xs"><?php echo $this->session->userdata("nama_lengkap"); ?></span><i style="margin-left: 40px;" class="fa fa-sign-out"></i> Logout</a>
          </li>
          <?php if($this->session->userdata('nama_group') == "Admin"){ ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Maintenance</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style=" height: 50px;">
                <p style="margin-top: 0px;">
                  <?php if($this->session->userdata('maintenance')){ ?>
                  <a href="<?=base_url();?>Auth/setMaintenance/0"><button class="btn btn-success btn-xs">On</button></a>
                  <?php }else{ ?>
                  <a href="<?=base_url();?>Auth/setMaintenance/1"><button class="btn btn-danger btn-xs">Off</button></a>
                  <?php } ?>
                </p>
              </li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>

  <!--Sidebar ASIDE-->
  <aside class="main-sidebar">
    <section class="sidebar inner-container" style="height: 790px; overflow-y: scroll;">
     <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" style="overflow-y: hidden;">
        <?php

          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Dashboard" == $this->session->userdata('nama_menu')[$i]){
        ?>
            <li class="<?php if($current_page == 'Dashboard'){ echo 'active'; }?>">
              <a href="<?php echo base_url('Dashboard');?>" >
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
        <?php
            break;
            }
          }
        ?>
        
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Log User" == $this->session->userdata('nama_menu')[$i] ||"Data User" == $this->session->userdata('nama_menu')[$i] || "Group User" == $this->session->userdata('nama_menu')[$i] || "Cron Job" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Log User | NOKIA' || $page_title == 'Data User | NOKIA' || $page_title == 'Access User | NOKIA' || $page_title == 'Group User | NOKIA' || $page_title == 'Cron Job | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-users"></i> <span>User</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Log User" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Log User | NOKIA'){ echo 'active'; }?>">
                  <a href="<?php echo base_url('LogUser');?>" >
                    <i class="fa fa-list"></i> <span>Log User</span>
                  </a>
                </li>
              <?php
                    break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Data User" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Data User | NOKIA') { echo 'active'; } ?>">
				      <a href="<?php echo base_url('DataUser');?>"><i class="fa fa-circle-o"></i>Data user</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Group User" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Group User | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('GroupData');?>"><i class="fa fa-circle-o"></i>Group User</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Cron Job" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Cron Job | NOKIA') { echo 'active'; } ?>">
        <a href="<?php echo base_url('Cronjob');?>"><i class="fa fa-circle-o"></i>Cronjob</a></li>
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>

        
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Master Received" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Master Received | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-database"></i> <span>Master</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Master Received" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Master Received | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('MasterReceived');?>"><i class="fa fa-circle-o"></i>Received</a></li>
				
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
	<!-- mulai -->
	<?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Phase" == $this->session->userdata('nama_menu')[$i] ||"PO Type" == $this->session->userdata('nama_menu')[$i] || "Region" == $this->session->userdata('nama_menu')[$i] || "NE Type" == $this->session->userdata('nama_menu')[$i] ||"Site Status" == $this->session->userdata('nama_menu')[$i] || "PO Status" == $this->session->userdata('nama_menu')[$i] || "CR Status" == $this->session->userdata('nama_menu')[$i] ||"Doc Status" == $this->session->userdata('nama_menu')[$i] || "ATP Method" == $this->session->userdata('nama_menu')[$i] || "Partner" == $this->session->userdata('nama_menu')[$i] ||"Tower" == $this->session->userdata('nama_menu')[$i] ||"WP Name" == $this->session->userdata('nama_menu')[$i] ||"Site Category" == $this->session->userdata('nama_menu')[$i] ||"Sowd Category" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Phase | NOKIA' || $page_title == 'PO Type | NOKIA' || $page_title == 'Region | NOKIA' || $page_title == 'NE Type | NOKIA' || $page_title == 'Site Status | NOKIA' || $page_title == 'PO Status | NOKIA' || $page_title == 'CR Status | NOKIA' || $page_title == 'Doc Status | NOKIA' || $page_title == 'ATP Method | NOKIA' || $page_title == 'Partner | NOKIA' || $page_title == 'Tower | NOKIA' || $page_title == 'WP Name | NOKIA' || $page_title == 'Site Category | NOKIA' || $page_title == 'Sowd Category | NOKIA' ){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-database"></i> <span>Master Data</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Phase" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Phase | NOKIA'){ echo 'active'; }?>">
                  <a href="<?php echo base_url('Phase');?>">
                    <i class="fa fa-circle-o"></i><span>Phase</span>
                  </a>
                </li>
              <?php	
                    break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("PO Type" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'PO Type | NOKIA') { echo 'active'; } ?>">
				<a href="<?php echo base_url('PoType');?>"><i class="fa fa-circle-o"></i>PO Type</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Region" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Region | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('Region');?>"><i class="fa fa-circle-o"></i>Region</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("NE Type" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'NE Type | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('NeType');?>"><i class="fa fa-circle-o"></i>NE Type</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Site Status" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Site Status | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('SiteStatus');?>"><i class="fa fa-circle-o"></i>Site Status</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("PO Status" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'PO Status | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('PoStatus');?>"><i class="fa fa-circle-o"></i>PO Status</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("CR Status" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'CR Status | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('CrStatus');?>"><i class="fa fa-circle-o"></i>CR Status</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Doc Status" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Doc Status | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('DocStatus');?>"><i class="fa fa-circle-o"></i>Doc Status</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("ATP Method" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'ATP Method | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('AtpMethod');?>"><i class="fa fa-circle-o"></i>ATP Method</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Partner" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Partner | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('Partner');?>"><i class="fa fa-circle-o"></i>Partner</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Tower" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Tower | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('Tower');?>"><i class="fa fa-circle-o"></i>Tower</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("WP Name" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'WP Name | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('WpName');?>"><i class="fa fa-circle-o"></i>WP Name</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Site Category" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Site Category | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('SiteCategory');?>"><i class="fa fa-circle-o"></i>Site Category</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			  <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Sowd Category" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Sowd Category | NOKIA') { echo 'active'; } ?>">
			  <a href="<?php echo base_url('SowdCategory');?>"><i class="fa fa-circle-o"></i>Sowd Category</a></li>
              <?php 
                  break;
                  }
                }
              ?>
       
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
	
	<?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Upload Site" == $this->session->userdata('nama_menu')[$i] ||"Site Info" == $this->session->userdata('nama_menu')[$i] || "Progress" == $this->session->userdata('nama_menu')[$i] || "Progress Update" == $this->session->userdata('nama_menu')[$i] || "ATF" == $this->session->userdata('nama_menu')[$i] ||"MCR" == $this->session->userdata('nama_menu')[$i] || "BINDER" == $this->session->userdata('nama_menu')[$i] || "SPE" == $this->session->userdata('nama_menu')[$i] ||"Certificate" == $this->session->userdata('nama_menu')[$i] || "Commercial" == $this->session->userdata('nama_menu')[$i] || "Closing" == $this->session->userdata('nama_menu')[$i] ||"IPM" == $this->session->userdata('nama_menu')[$i] || "Database TSS" == $this->session->userdata('nama_menu')[$i] || "Issue Register Nokia" == $this->session->userdata('nama_menu')[$i] || "Issue Register Partner" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Upload Site | NOKIA' || $page_title == 'Site Info | NOKIA' || $page_title == 'Progress | NOKIA' || $page_title == 'Progress Update | NOKIA' || $page_title == 'ATF | NOKIA' || $page_title == 'MCR | NOKIA' || $page_title == 'BINDER | NOKIA' || $page_title == 'SPE | NOKIA' || $page_title == 'Certificate | NOKIA' || $page_title == 'Commercial | NOKIA' || $page_title == 'Closing | NOKIA' || $page_title == 'IPM | NOKIA' || $page_title == 'Database TSS | NOKIA' || $page_title == 'Issue Register Nokia | NOKIA' || $page_title == 'Issue Register Partner | NOKIA' || $page_title == 'Issue Register Partner Detail | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-database"></i> <span>Site Tracker</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Upload Site" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Upload Site | NOKIA'){ echo 'active'; }?>">
                  <a href="<?php echo base_url('UploadData');?>">
                    <i class="fa fa-circle-o"></i><span>Upload Site</span>
                  </a>
                </li>
              <?php	
                    break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Site Info" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Site Info | NOKIA') { echo 'active'; } ?>">
				        <a href="<?php echo base_url('SiteInfo');?>"><i class="fa fa-circle-o"></i>Site Info</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Progress" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Progress | NOKIA') { echo 'active'; } ?>">
			         <a href="<?php echo base_url('Progress');?>"><i class="fa fa-circle-o"></i>Progress</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Progress" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Progress Update | NOKIA') { echo 'active'; } ?>">
               <a href="<?php echo base_url('ProgressUpdate');?>"><i class="fa fa-circle-o"></i>Progress Update</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("ATF" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'ATF | NOKIA') { echo 'active'; } ?>">
			          <a href="<?php echo base_url('ATF');?>"><i class="fa fa-circle-o"></i>ATF</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("MCR" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'MCR | NOKIA') { echo 'active'; } ?>">
			           <a href="<?php echo base_url('MCR');?>"><i class="fa fa-circle-o"></i>MCR</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			         <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("BINDER" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'BINDER | NOKIA') { echo 'active'; } ?>">
			           <a href="<?php echo base_url('BINDER');?>"><i class="fa fa-circle-o"></i>BINDER</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("SPE" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'SPE | NOKIA') { echo 'active'; } ?>">
			          <a href="<?php echo base_url('SPE');?>"><i class="fa fa-circle-o"></i>SPE</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Certificate" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Certificate | NOKIA') { echo 'active'; } ?>">
			         <a href="<?php echo base_url('Certificate');?>"><i class="fa fa-circle-o"></i>Certificate</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Commercial" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Commercial | NOKIA') { echo 'active'; } ?>">
			          <a href="<?php echo base_url('Commercial');?>"><i class="fa fa-circle-o"></i>Commercial</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			        <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Closing" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Closing | NOKIA') { echo 'active'; } ?>">
			         <a href="<?php echo base_url('Closing');?>"><i class="fa fa-circle-o"></i>Closing</a></li>
              <?php 
                  break;
                  }
                }
              ?>
			       <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("IPM" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'IPM | NOKIA') { echo 'active'; } ?>">
			         <a href="<?php echo base_url('IPM');?>"><i class="fa fa-circle-o"></i>IPM</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Database TSS" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Database TSS | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('DatabaseTss');?>"><i class="fa fa-circle-o"></i>Database TSS</a></li>
              <?php 
                  break;
                  }
                }
              ?>
           
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Issue Register Nokia" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Issue Register Nokia | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('IssueRegisterNokia');?>"><i class="fa fa-circle-o"></i>Issue Register Nokia</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
              for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Issue Register Partner" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Issue Register Partner | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('IssueRegisterPartner');?>"><i class="fa fa-circle-o"></i>Issue Register Partner</a></li>
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
<!-- Site -->

<!--report-->
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Summary Progress" == $this->session->userdata('nama_menu')[$i] || "Summary Certificate" == $this->session->userdata('nama_menu')[$i] || "Summary Commercial" == $this->session->userdata('nama_menu')[$i] || "Report MT ISAT" == $this->session->userdata('nama_menu')[$i] || "BOQ per Site MT1" == $this->session->userdata('nama_menu')[$i] || "Check Progress" == $this->session->userdata('nama_menu')[$i] || "Check Progress2" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Summary Progress | NOKIA' || $page_title == 'Summary Certificate | NOKIA' || $page_title == 'Summary Commercial | NOKIA' || $page_title == 'Report MT ISAT | NOKIA' || $page_title == 'BOQ per Site MT1' || $page_title == 'Check Progress' || $page_title == 'Check Progress2'){ echo 'active'; }?>">
            <a href="#"><i class="  glyphicon glyphicon-list-alt"></i> <span>Summary Report</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Summary Progress" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Summary Progress | NOKIA'){ echo 'active'; }?>">
                  <a href="<?php echo base_url('SummaryProgress');?>" >
                    <i class="fa fa-circle-o"></i><span>Summary Progress</span>
                  </a>
                </li>
              <?php
                    break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Summary Certificate" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Summary Certificate | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('SummaryCertificate');?>"><i class="fa fa-circle-o"></i>Summary Certificate</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Summary Commercial" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Summary Commercial | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('SummaryCommercial');?>"><i class="fa fa-circle-o"></i>Summary Commercial</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Report MT ISAT" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Report MT ISAT | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('ReportMtIsat');?>"><i class="fa fa-circle-o"></i>Report MT ISAT</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("BOQ per Site MT1" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'BOQ per Site MT1 | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('BOQperSiteMT1');?>"><i class="fa fa-circle-o"></i>BOQ per Site MT1</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Check Progress" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Check Progress | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('CheckProgress');?>"><i class="fa fa-circle-o"></i>Check Progress</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Check Progress2" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Check Progress2 | NOKIA') { echo 'active'; } ?>">
                <a href="<?php echo base_url('CheckProgress2');?>"><i class="fa fa-circle-o"></i>Check Progress2</a></li>
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Input TSS" == $this->session->userdata('nama_menu')[$i] || "Form Site Binder" == $this->session->userdata('nama_menu')[$i] || "Form New" == $this->session->userdata('nama_menu')[$i] || "Outstanding Approval MOS" == $this->session->userdata('nama_menu')[$i]){
        ?>
        <li class="<?php if($page_title == 'Input TSS | NOKIA' || $page_title == 'Form Site Progress | NOKIA' || $page_title == 'Form Site Binder | NOKIA' || $page_title == 'Form New | NOKIA' || $page_title == 'Outstanding Approval MOS | NOKIA'){ echo 'active'; }?>">
          <a href="#"><i class="glyphicon glyphicon-phone"></i> <span>Form Input Mobile</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
             <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Input TSS" == $this->session->userdata('nama_menu')[$i]){
              ?>
          		    <li class="<?php if($page_title == 'Input TSS | NOKIA') { echo 'active'; } ?>">
                    <a href="<?php echo base_url('InputTSS');?>"><i class="fa fa-circle-o"></i>Input TSS</a>
                  </li>
              <?php
                  }
                  if("Form Site Progress" == $this->session->userdata('nama_menu')[$i]){
              ?>
                  <li class="<?php if($page_title == 'Form Site Progress | NOKIA') { echo 'active'; } ?>">
                    <a href="<?php echo base_url('FormSiteProgress');?>"><i class="fa fa-circle-o"></i>Form Site Progress</a>
                  </li>
              <?php
                  }
                  if("Form Site Binder" == $this->session->userdata('nama_menu')[$i]){
              ?>
                  <li class="<?php if($page_title == 'Form Site Binder | NOKIA') { echo 'active'; } ?>">
                    <a href="<?php echo base_url('FormSiteBinder');?>"><i class="fa fa-circle-o"></i>Form Site Binder</a>
                  </li>
              <?php
                  }
                  if("Form New" == $this->session->userdata('nama_menu')[$i]){
              ?>
                  <li class="<?php if($page_title == 'Form New | NOKIA') { echo 'active'; } ?>">
                    <a href="<?php echo base_url('FormNew');?>"><i class="fa fa-circle-o"></i>Form New</a>
                  </li>
              <?php
                  }
                  if("Outstanding Approval MOS" == $this->session->userdata('nama_menu')[$i]){
              ?>
                  <li class="<?php if($page_title == 'Outstanding Approval MOS | NOKIA') { echo 'active'; } ?>">
                    <a href="<?php echo base_url('OutstandingApprovalMos');?>"><i class="fa fa-circle-o"></i>Outstanding Approval MOS</a>
                  </li>
              <?php
                  } 
                }
              ?>
          </ul>
        </li>
        <?php
              break;
            }
          }
        ?>
      </ul>
    </section>
    <!-- /.sidebar ASIDE -->
  </aside>
