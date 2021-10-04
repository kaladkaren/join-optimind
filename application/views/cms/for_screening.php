<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            For Screening Applicants
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">

          	<div class="row">
              <div class="col-md-4" style="text-align: left; font-style: bold;">
                <p><b>By Location </b></p>
              </div>

            </div>

            <form action="" method="GET">
              <div class="row">

                  <div class="col-md-4">
                    <select name="position_id" class="form-control">
                      <option value="">Areas</option>
                      <?php foreach (getPositions($this) as $key => $value): #helpers/custom_helper.php ?>
                        <option value="<?php echo $value->id ?>" <?=$value->id == ''. @$_GET['position_id'] .'' ? 'selected="selected"' : '' ?>>
                          <?php echo $value->position_name ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  
                  
                  <div class="col-md-2">
                      <input type="submit" value="Apply" class="btn btn-info btn-sm">
                  </div>
              </div>
            </form>
            <hr>
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Position</th>

                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile number</th>
                    <th>Download Resume</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php $i = 1; foreach ($res as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->position->position_name ?></td>
                        
                        <td><?php echo $value->applicant->fname ?></td>
                        <td><?php echo $value->applicant->lname ?></td>
                        <td><?php echo $value->applicant->email ?></td>
                        <td><?php echo $value->applicant->mobile_num ?></td>
                        <td><button class="btn btn-xs btn-primary">Download Resume</button></td>
                        <td>
                          <button type="button"
                          data-payload='<?php echo json_encode(['id' => $value->id, 'role' => $value->role, 'name' => $value->name, 'email' => $value->email])?>'
                          class="edit-row btn btn-info btn-xs"><i class="fa fa-eye"></i> View Info</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>


                    <?php else: ?>
                      <tr>
                        <td colspan="4" style="text-align:center">Empty table data</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>

                <style>
                .active_lg {
                  background: lightgray !important
                }
                </style>
                <ul class="pagination">
                  <ul class='pagination'>
                    <?php
                    $page = ($this->input->get('page')) ?: 1;

                    # squery block
                    $squery =  '';
                    if ($this->input->get('squery')) {
                      $squery = "&squery=" . $this->input->get('squery');
                    }
                    # / squery block

                    for ($i=1; $i <= $total_pages; $i++) { ?>
                      <li><a
                        class="<?php echo ($i == $page) ? 'active_lg' : '' ?>"
                        href="<?php echo base_url('cms')
                        . "?page=" . $i . $squery;
                        ?>"><?php echo $i ?></a></li>
                      <?php } ?>
                    </ul>
                  </ul>

              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>

  <!-- Modal -->
  <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Manage</h4>
        </div>
        <div class="modal-body">

          <form role="form" method="post" id="main-form">
            <div class="form-group">
              <label >Name</label>
              <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
              <label >Email address</label>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            
            <div class="form-group">
              <label >Status</label>
              <select class="form-control" name="role">
                <option value="">Select a status</option>
                <option value="approved">Approved</option>
                <option value="reject">Reject</option>

              </select>
            </div>

          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <input class="btn btn-info" type="submit" value="Save changes">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal -->

  <script src="<?php echo base_url('public/admin/js/custom/') ?>admin_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
