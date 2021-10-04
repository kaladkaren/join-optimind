<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <!-- <section class="panel"> -->

          <div class="col-lg-6" style="padding-left: 0px;padding-right: 0px;">
            <section class="panel">
              <header class="panel-heading">
                Positions<?php if ($update_flash_msg = $this->session->update_flash_msg): ?>
                  <br><sub style="color: <?php echo $update_flash_msg['color'] ?>"><?php echo $update_flash_msg['message'] ?></sub>
                <?php endif; ?>
              </header>
              <div class="panel-body">

                <div class="form-group" style="margin-bottom: 50px;">
                  <div class="col-md-12" style="padding-right: 0px;padding-left: 0px;">
                    <form action="" method="GET">
                      <div class="input-group m-bot10">
                        <input type="text" class="form-control" name="position_name" placeholder="Search keyword by Position Name" value="<?php echo @$_GET['position_name'] ?>">
                        <div class="input-group-btn">
                          <button tabindex="-1" class="btn btn-white" type="submit" id="search_keyword">Search</button>
                          
                          <button tabindex="-1" class="btn btn-white" type="button">
                            <a href="<?php echo base_url('cms/positions') ?>">X </a>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 15px;">#</th>
                        <th>Position Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (count($res) > 0 ): ?>

                        <?php $i = 1; foreach ($res as $key => $value): ?>

                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo $value->position_name ?></td>
                            <td>
                              <?php if($value->is_technical == 1) : ?>
                                <button type="button" class="btn btn-primary btn-xs">Technical</button>
                              <?php else: ?>
                                <button type="button" class="btn btn-default btn-xs">Non-technical</button>
                              <?php endif; ?>
                            </td>

                            <td>
                              <?php if($value->is_available == 1) : ?>
                                <button type="button" class="btn btn-warning btn-xs">Active</button>
                              <?php else: ?>
                                <button type="button" class="btn btn-danger btn-xs">Inactive</button> 
                              <?php endif; ?>
                                
                            </td>

                            <td>
                              <button type="button" class="edit-row btn btn-info btn-xs"  data-payload='<?php echo json_encode($value, JSON_HEX_APOS|JSON_HEX_QUOT)?>'>
                                  <i class="fa fa-pencil"></i> Edit
                              </button>
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
                        href="<?php echo base_url('cms/positions')
                        . "?page=" . $i . $squery;
                        ?>"><?php echo $i ?></a></li>
                      <?php } ?>
                    </ul>

                  <center>
                    <ul class="pagination">
                      <?php echo @$pagination; ?>
                    </ul>
                  </center>
                </div>
              </div>
            </section>
          </div>

          <div class="col-lg-6" style="padding-right: 0px;">
            <section class="panel">
              <header class="panel-heading">
                Add New Position
                <?php if ($flash_msg = $this->session->flash_msg): ?>
                  <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
                <?php endif; ?>
              </header>
              <div class="panel-body">
                <form role="form" method="post" action="<?php echo base_url('cms/positions/add/') ?>">
                  <div class="form-group">
                    <label >Position Name *</label>
                    <input type="text" class="form-control" name="position_name"  required="">
                  </div>

                  <div class="form-group">
                    <label >Job Description *</label>
                    <textarea class="form-control" name="job_description" required=""></textarea>
                  </div>

                  <div class="form-group">
                    <label >Requirements *</label>
                    <textarea class="form-control" name="requirements" required=""></textarea>
                  </div>

                  <div class="form-group">
                    <label>
                      <input type="checkbox" name="is_technical"> Check if job position is technical.
                    </label>
                  </div>

                  <div class="form-group">
                    <label>
                      <input type="checkbox" checked="" name="is_available"> Check if job position is available.
                    </label>
                  </div>

                  <input type="submit" class="form-control btn-success" value="Add Position" style="color: white;font-size: 13px;color: #ffffff!important;width: 105px;float: right;">
                </form>
              </div>
            </section>
          </div>

        <!-- </section> -->
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
                <label >Position Name *</label>
                <input type="text" class="form-control" name="position_name"  required="">
              </div>

              <div class="form-group">
                <label >Job Description *</label>
                <textarea class="form-control" name="job_description" required="" style="height: 130px;"></textarea>
              </div>

              <div class="form-group">
                <label >Requirements *</label>
                <textarea class="form-control" name="requirements" required="" style="height: 130px;"></textarea>
              </div>

              <div class="form-group">
                <label>
                  <input type="checkbox" name="is_technical"> Check if job position is technical.
                </label>
              </div>

              <div class="form-group">
                <label>
                  <input type="checkbox" checked="" name="is_available"> Check if job position is available.
                </label>
              </div>

              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <input class="btn btn-info" type="submit" value="Save changes">
              </div>

            </form>
          </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <script>
    $(document).ready(function() {
      //Updating
      $('.edit-row').on('click', function(){
        $('.modal').modal()
        $('#main-form')[0].reset() // reset the form
        const payload = $(this).data('payload')

        $('.modal-body input[name=position_name]').removeAttr('required')
        $('.modal-body textarea[name=job_description]').removeAttr('required')
        $('.modal-body textarea[name=requirements]').removeAttr('required')

        $('.modal-body input[name=position_name]').val(payload.position_name)
        $('.modal-body textarea[name=job_description]').val(payload.job_description)
        $('.modal-body textarea[name=requirements]').val(payload.requirements)

        if(payload.is_available == 1){
          $('.modal-body input[name=is_available]').prop('checked', true);
        }else{
          $('.modal-body input[name=is_available]').prop('checked', false);

        }

        if(payload.is_technical == 1){
          $('.modal-body input[name=is_technical]').prop('checked', true);
        }else{
          $('.modal-body input[name=is_technical]').prop('checked', false);

        }

        $('#main-form').attr('action', base_url + 'cms/positions/update/' + payload.id)
        
      })

    })
  </script>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
