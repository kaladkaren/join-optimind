<form class="form-signin" method="post" action="<?php echo base_url('cms/applicants/attempt_login') ?>">
  <h2 class="form-signin-heading" style="background: black;"> CMS LOGIN</h2>
  <div class="login-wrap">
    <input type="text" name="email" class="form-control" placeholder="Email" autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password">
    <?php if ($login_msg = $this->session->login_msg): ?>
      <p style="color: <?php echo $login_msg['color'] ?>"><?php echo $login_msg['message'] ?></p>
    <?php endif; ?>
    <button style="background: black; box-shadow: 0px 4px dimgray"
    class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>

    <a href="<?php echo base_url('cms/applicants/forgot_password') ?>">Forgot Password</a>
  </div>
</form>


<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Applicant Registration
            <?php 
              $flash_succ_msg = @$this->session->flash_msg;
              $flash_err_msg = @$this->session->flash_msg_err;
            ?>
            <?php if ($flash_err_msg): ?>
              <p style="color: <?php echo $flash_err_msg['color'] ?>"><?php echo $flash_err_msg['message'] ?></p>
            <?php endif; ?>
            
            <?php if ($flash_succ_msg): ?>
              <p style="color: <?php echo $flash_succ_msg['color'] ?>"><?php echo $flash_succ_msg['message'] ?></p>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            
              <div class="panel-body">
                <form id="main-form" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/applicants/add')?>">

                  <div class="panel-body">
                    <div class="form-group">
                    <label >Positions *</label>
                    <select class="form-control" name="position_id" required>
                      <option value="">Select a Job Position</option>
                      <?php foreach (getPositions($this) as $key => $value): #helpers/custom_helper.php ?>
                        <option value="<?php echo $value->id ?>">
                          <?php echo $value->position_name ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                    <div class="form-group">
                      <label >First Name</label>
                      <input type="text" class="form-control" name="fname" required>
                    </div>

                    <div class="form-group">
                      <label >Last Name</label>
                      <input type="text" class="form-control" name="lname" required>
                    </div>

                    <div class="form-group">
                      <label >Email *</label>
                      <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                      <label >Mobile Number *</label>
                      <input type="number" class="form-control" name="mobile_num" required>
                    </div>

                    <div class="form-group">
                      <label >Year Graduated</label>
                      <input type="number" class="form-control" name="year_graduated" required>
                    </div>

                    <div class="form-group">
                      <label >Years Experience</label>
                      <input type="number" class="form-control" name="years_experience" required>
                    </div>

                    <div class="form-group">
                      <label >Upload Resume </label>
                      <input type="file" class="form-control" name="resume" required>
                    </div>

                    <div class="form-group">
                      <label >Password</label>
                      <input type="password" class="form-control" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <label >Confirm Password</label>
                      <input type="password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
                    </div>

                    <div class="form-group">
                      <input class="btn btn-info" type="submit" value="Send Message">
                    </div>

                  </div>

                </form>
            
              </div>

            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>