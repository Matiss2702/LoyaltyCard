function change_image_add(new_image) {
  document.getElementById("add-hidden-img").setAttribute("value", new_image)
  document.getElementById("add-img").setAttribute("src", "/images/" + new_image)
}

function change_image_update(new_image) {
  document.getElementById("modify-hidden-img").setAttribute("value", new_image)
  document.getElementById("modify-img").setAttribute("src", "/images/" + new_image)
}

function add_image(csrf_token) {
  let file = document.getElementById('file-name').value
  let array = file.split('\\')
  let file_name = array.pop()
  var form_data = new FormData($('#upload-file')[0])
  $.ajax({
    url: "/add_image/",
    type: "POST",
    contentType: false,
    cache: false,
    processData: false,
    data: form_data,
    success: function (response) {
      console.log(file_name)
      toastr.success(response.message)
      if ($('#image-modal').attr('data-status') == "add") {
        change_image_add(file_name)
      } else {
        change_image_update(file_name)
      }
    },
    error: function (response) {
      var errors = JSON.parse(response.responseText)
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}
function add_product(csrf_token) {
  product_name = $('#add-name').val()
  price = $('#add-price').val()
  product_types_id = $('#add-product-type').val()
  image = $('#add-hidden-img').val()
  reduction = $('#add-reduction').val()
  description = $('#add-description').val()
  let data = { name: product_name, price: price, product_types_id: product_types_id, image: image, reduction: reduction, description: description, csrf_token_name: csrf_token }
  if ($("#add-check-status").is(":checked")) {
    data['status'] = '1'
  } else {
    data['status'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/product/create/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      var errors = JSON.parse(reponse.responseText)
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      for (var message in errors.messages) {
        toastr.error(errors.messages[message])
      }
    }
  })
}

function modify_product(id,csrf_token) {
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: $id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/product/update/" + $id,
      type: "POST",
      data: data,
      success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
        toastr.success(reponse.message)
      },
      error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
          window.location.reload();
        };
         for (var message in errors.messages){
           toastr.error(errors.messages[message])
         }
      }
    })
}

function delete_product(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/product/delete/"+id,
        type: "POST",
        data: data,
        success: function (reponse) {
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
        toastr.success(reponse.messages.success)
        },
        error: function (reponse) {
        var errors = JSON.parse(reponse.responseText)
        toastr.options.timeOut = 750;
        toastr.options.fadeOut = 1000;
        toastr.options.onHidden = function () {
            window.location.reload();
        };
        console.log(reponse)
         for (var message in errors.messages){
             toastr.error(errors.messages[message])
         }
        }
    })
}
