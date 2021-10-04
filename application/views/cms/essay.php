<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Essay Exam
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <form id="main-form1" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('cms/exam/update_essay/') . $res->id; ?>">

              <div class="panel-body">

                <div class="form-group">
                  <label >Topic *</label>
                  <textarea style="height: 150px;" class="form-control" name="topic" required><?php echo $res->topic; ?></textarea>
                </div>

                <div class="form-group">
                  <input class="btn btn-info" type="submit" value="Update Essay">
                </div>

              </div>

            </form>
            
          </div>
        </section>

      </div>
     </div>
      
      <!-- page end-->
    </section>
  </section>

  <script type="text/javascript">

  </script>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>

