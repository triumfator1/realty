(function($){
  $('#add_realty_form').submit(function (e) {
    e.preventDefault();
    const form = $(this);
    $("#btnSubmit").prop("disabled", true);
    $.post({
      url: ajaxUrl,
      dataType: 'JSON',
      data: {
        action: 'add_realty',
        type: form.find('[name="type"]').val(),
        realty_name: form.find('[name="realty_name"]').val(),
        square: form.find('[name="square"]').val(),
        price: form.find('[name="price"]').val(),
        address: form.find('[name="address"]').val(),
        square_liv: form.find('[name="square_liv"]').val(),
        floor: form.find('[name="floor"]').val(),
        city: form.find('[name="city"]').val(),
        description: form.find('[name="description"]').val(),
      },
    }).done(function (response) {
      alert(response.data);
      $("#btnSubmit").prop("disabled", false);
    }).fail(function (e) {
      console.log("ERROR : ", e);
      $("#btnSubmit").prop("disabled", false);
    })
  });
})(jQuery);