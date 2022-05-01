$(document).on("click", ".delete-product", function() {

  $('#delete-product').attr('data-id',$(this).data('id'))
var deleteModal = new bootstrap.Modal($('#delete-product'), {
keyboard: false
}) 
deleteModal.show()
});

$(document).on("change", "#image", function() {
    if (this.files && this.files[0]) {
          var reader = new FileReader();
  
          reader.onload = function (e) {
              $('#img').attr('src', e.target.result);
          };
          reader.readAsDataURL(this.files[0]);
      }
  });

  function add_product(csrf_token) {
    product_name =$('#name').val()
    price = $('#price').val()
    product_types_id= $('#product_type_id').val()
    image = $('#image').val()
    reduction = $('#reduction').val()
    description = $('#description').val()
    let data = {  name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/product/create/",
      type: "POST",
      data: data,
      success: function (reponse) {
        // toastr.options.timeOut = 750;
        // toastr.options.fadeOut = 1000;
        // toastr.options.onHidden = function () {
        //   window.location.reload();
        // };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        // toastr.options.timeOut = 750;
        // toastr.options.fadeOut = 1000;
        // toastr.options.onHidden = function () {
        //   window.location.reload();
        // };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
  }

function delete_product($id,csrf_token){
    let data = { id: $id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/product/delete/"+$id,
        type: "POST",
        data: data,
        success: function (reponse) {
        // toastr.options.timeOut = 750;
        // toastr.options.fadeOut = 1000;
        // toastr.options.onHidden = function () {
        //     window.location.reload();
        // };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        // var errors = JSON.parse(reponse.responseText)
        // toastr.options.timeOut = 750;
        // toastr.options.fadeOut = 1000;
        // toastr.options.onHidden = function () {
        //     window.location.reload();
        // };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}