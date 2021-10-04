<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Add Logical Question
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>


          <div class="panel-body">
            <form id="main-form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/products/add')?>">

              <div class="panel-body">

                <div class="form-group">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label >Question *</label>
                        <textarea style="height: 150px;" class="form-control" name="question" required></textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <button type="button" class="btn btn-primary" id="add_choice"><i class="fa fa-plus"></i> Add Choice</button>
                        <br><br>
                        <div class="form-group">
                          <label>
                            <input type="checkbox" name="has_image[]"> Check if choices has image.
                          </label>
                        </div>

                        <hr>
                        <div id="choices_group">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-1">
                                <label><i class="fa fa-check"></i></label>
                                <input type="radio" class="form-control" name="answer_id" required>
                              </div>

                              <div class="col-md-5">
                                <label>Answer</label>
                                <input type="text" class="form-control" name="answer[]" required>
                              </div>

                              <div class="col-md-5">
                                <label>Upload Image</label>
                                <input type="file" class="form-control" name="image_url[]" required>
                              </div>

                            </div>
                          </div>

                        </div>
                        
                      </div>
                    </div>

                  </div>
                </div>

                <div class="form-group">
                  <input class="btn btn-info" type="submit" value="Add Logical Question">
                </div>

              </div>

            </form>
            
          </div>

          <header class="panel-heading">
            List Logical Exam
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>

          <div class="panel-body">
            
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer Key</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php $i = 1; foreach ($res as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->question; ?></td>
                        <td><?php echo $value->answer_id; ?></td>
                        <td>
                          <button type="button"
                          data-payload='<?php echo json_encode(['id' => $value->id, 'role' => $value->role, 'name' => $value->name, 'email' => $value->email])?>'
                          class="edit-row btn btn-info btn-xs">Edit</button>
                          <button type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-delete btn-danger btn-xs">Delete</button>
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
              <label >Role</label>
              <select class="form-control" name="role">
                <option value="">Select a Role</option>
                <option value="Admin">Admin</option>
                <option value="Recruitment Assistant">Recruitment Assistant</option>
                <option value="HR Manager">HR Manager</option>
              </select>
            </div>
            <div class="form-group">
              <label >Email address</label>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
              <label >Password</label>
              <input type="password" class="form-control" name="password" placeholder="New Password">
            </div>
            <div class="form-group">
              <label >Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
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

  <script src="<?php echo base_url('public/admin/js/custom/') ?>logical_questions.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
