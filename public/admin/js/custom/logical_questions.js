$(document).ready(function() {

  $('#add_choice').click(function(){
    let additionalChoice = `
      <div class="form-group">
        <div class="row">

          <div class="col-md-1">
            <label></label>
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

          <div class="col-md-1">
            <label style="visibility:hidden">Remove</label>
            <button class="btn btn-xs btn-danger remove-choice" type="button"><i class="fa fa-times"></i></button>
          </div>

        </div>
      </div>`

    $('#choices_group').append(additionalChoice)
  })




  //Updating
  $('.edit-row').on('click', function(){
    $('.modal').modal()
    $('#main-form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=name]').removeAttr('required')
    $('input[name=email]').removeAttr('required')
    $('select[name=role]').removeAttr('required')
    $('input[name=password]').removeAttr('required')
    $('input[id=confirm_password]').removeAttr('required')

    $('input[name=name]').val(payload.name)
    $('input[name=email]').val(payload.email)

    $('select[name=role] option').each(function() {
      $(this).removeAttr('selected')
    });
    $('select[name=role] option').filter(function () { return $(this).html() == payload.role; }).attr('selected', 'selected')

    $('#main-form').attr('action', base_url + 'cms/admin/update/' + payload.id)
    
  })

  $('.modal').on('hidden.bs.modal', function () {
    $('select[name=role] option:selected').removeAttr('selected');
  })


})
