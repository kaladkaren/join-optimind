
<section id="container" class="">
  <!--header start-->
  <header class="header dark-bg">
    <div class="sidebar-toggle-box">
      <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo" >JOIN <span style="color: #3eba6f;">OPTIMIND</span></a>
    <!--logo end-->
    <div class="top-nav ">
      <ul class="nav pull-right top-menu">
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <!-- <img alt="" src="img/avatar1_small.jpg"> -->
            <span class="username">Welcome back, <?php echo $this->session->userdata('name'); ?></span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu extended logout">
            <li><a href="<?php echo base_url('cms/login/logout') ?>"><i class="fa fa-key"></i> Log Out</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </header>
  <!--header end-->
  <!--sidebar start-->
  <aside>
    <div id="sidebar"  class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <li>
          <a href="<?php echo base_url('cms') ?>"
            class="<?php echo $this->uri->segment(1) === 'cms' && ($this->uri->segment(2) === null || $this->uri->segment(2) === 'dashboard') ? 'active': ''; ?>">
            <i class="fa fa-dashboard"></i>
            <span>Admin Management</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url('cms/positions') ?>"
            class="<?php echo $this->uri->segment(2) === 'positions' && ($this->uri->segment(2) === null || $this->uri->segment(2) === 'positions') ? 'active': ''; ?>">
            <i class="fa fa-briefcase"></i>
            <span>Job Positions</span>
          </a>
        </li>

        <li class="sub-menu">

          <a href="javascript:;" class="<?php echo (in_array($this->uri->segment(3), ['essay', 'logical']))  ? 'active': ''; ?>">
            <i class="fa fa-files-o"></i>
            <span>Exam Management</span>
          </a>
          <ul class="sub" >
            <li><a <?php echo $this->uri->segment(3) === 'essay' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/exam/essay') ?>">Essay</a></li>
            <li><a <?php echo $this->uri->segment(3) === 'logical' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/exam/logical') ?>">Logical</a></li>
          </ul>
        </li>

        <li class="sub-menu">

          <a href="javascript:;" class="<?php echo (in_array($this->uri->segment(3), ['unprocessed', 'for_screening', 'exams', 'technical']))  ? 'active': ''; ?>">
            <i class="fa fa-tasks"></i>
            <span>Applications</span>
          </a>
          <ul class="sub" >
            <li><a <?php echo $this->uri->segment(3) === 'unprocessed' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/applications/unprocessed') ?>">Unprocessed</a></li>
            <li><a <?php echo $this->uri->segment(3) === 'for_screening' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/applications/for_screening') ?>">For Screening</a></li>
            <li><a <?php echo $this->uri->segment(3) === 'exams' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/applications/exams') ?>">Online Application (Exam)</a></li>

            <li><a <?php echo $this->uri->segment(3) === 'technical' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/applications/technical') ?>">Completed Technical Exam</a></li>

          </ul>
        </li>

        <li>
          <a href="<?php echo base_url('cms/reports') ?>"
            class="<?php echo $this->uri->segment(2) === 'reports' && ($this->uri->segment(2) === null || $this->uri->segment(2) === 'reports') ? 'active': ''; ?>">
            <i class="fa fa-calendar"></i>
            <span>Reports</span>
          </a>
        </li>


      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>
  <!--sidebar end-->
