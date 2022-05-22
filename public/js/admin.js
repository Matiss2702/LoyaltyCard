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
    id =$('#modify-id').val()
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/product/update/" + id,
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
    let data = { id: $id, csrf_token_name: csrf_token }
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

function add_user(csrf_token) {
  lastname = $('#add-lastname').val()
  firstname = $('#add-firstname').val()
  password= $('#add-password').val()
  mail = $('#add-mail').val()
  address = $('#add-address').val()
  city = $('#add-city').val()
  zipcode = $('#add-zipcode').val()
  country = $('#add-country').val()
  group_id = $('#add-group_id').val()
  fidelity_points = $('#add-fidelity_points').val()
  let data = { lastname: lastname, firstname: firstname,password: password, mail: mail, address: address, city: city, zipcode: zipcode,country: country,group_id: group_id,fidelity_points: fidelity_points, csrf_token_name: csrf_token }
  if ($("#add-check-status").is(":checked")) {
    data['status'] = '1'
  } else {
    data['status'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/user/create/",
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

function modify_user(id,csrf_token) {
  id =$('#modify-id').val()
  lastname = $('#modify-lastname').val()
  firstname = $('#modify-firstname').val()
  password = $('#modify-password').val()
  mail = $('#modify-mail').val()
  address = $('#modify-address').val()
  city = $('#modify-city').val()
  zipcode = $('#modify-zipcode').val()
  country = $('#modify-country').val()
  group_id = $('#modify-group_id').val()
  fidelity_points = $('#modify-fidelity_points').val()
  let data = { id: id, lastname: lastname, firstname: firstname, mail: mail, address: address, city: city, zipcode: zipcode,country: country,group_id: group_id,fidelity_points: fidelity_points, csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/user/update/" + id,
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

function delete_user(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/user/delete/"+id,
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

function add_warehouse(csrf_token) {
  warehouse_name = $('#add-name').val()
  company_id = $('#add-company_id').val()
  address = $('#add-address').val()
  city = $('#add-city').val()
  zipcode = $('#add-zipcode').val()
  country = $('#add-country').val()
  let data = { name: name, company_id: company_id, address: address, city: city, zipcode: zipcode, country: country, csrf_token_name: csrf_token }
  if ($("#add-check-status").is(":checked")) {
    data['status'] = '1'
  } else {
    data['status'] = '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/warehouse/create/",
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

function modify_warehouse(id,csrf_token) {
  id =$('#modify-id').val()
  warehouse_name = $('#modify-name').val()
  company_id = $('#modify-company_id').val()
  address = $('#modify-address').val()
  city = $('#modify-city').val()
  zipcode = $('#modify-zipcode').val()
  country = $('#modify-country').val()
  let data = { id: id, name: warehouse_name, company_id: company_id, address: address, city: city, zipcode: zipcode, country: country, csrf_token_name: csrf_token  }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/warehouse/update/" + id,
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

function delete_warehouse(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/warehouse/delete/"+id,
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
function add_subcription(csrf_token) {
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

function modify_subcription(id,csrf_token) {
    id =$('#modify-id').val()
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/group/update/" + id,
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

function delete_subcription(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/group/delete/"+id,
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
function add_product_type(csrf_token) {
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

function modify_product_type(id,csrf_token) {
    id =$('#modify-id').val()
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/order/update/" + id,
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

function delete_product_type(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/order/delete/"+id,
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
function add_partner(csrf_token) {
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

function modify_partner(id,csrf_token) {
    id =$('#modify-id').val()
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/partner/update/" + id,
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

function delete_partner(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/partner/delete/"+id,
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
function add_order_product(csrf_token) {
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

function modify_order_product(id,csrf_token) {
    id =$('#modify-id').val()
    product_name =$('#modify-name').val()
    price = $('#modify-price').val()
    product_types_id= $('#modify-product-type').val()
    image = $('#modify-hidden-img').val()
    reduction = $('#modify-reduction').val()
    description = $('#modify-description').val()
  let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
    if($("#modify-check-status").is(":checked")){
      data['status']= '1'
    } else{
        data['status']= '0'
    }
    console.log(data)
    $.ajax({
      url: "/admin/orderproduct/update/" + id,
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

function delete_order_product(id,csrf_token){
    let data = { id: id, csrf_token_name: csrf_token }
    $.ajax({
        url: "/admin/orderproduct/delete/"+id,
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

function add_order(csrf_token) {
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
    url: "/admin/order/create/",
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

function modify_order(id,csrf_token) {
  id =$('#modify-id').val()
  product_name =$('#modify-name').val()
  price = $('#modify-price').val()
  product_types_id= $('#modify-product-type').val()
  image = $('#modify-hidden-img').val()
  reduction = $('#modify-reduction').val()
  description = $('#modify-description').val()
let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
  if($("#modify-check-status").is(":checked")){
    data['status']= '1'
  } else{
      data['status']= '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/order/update/" + id,
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

function delete_order(id,csrf_token){
  let data = { id: id, csrf_token_name: csrf_token }
  $.ajax({
      url: "/admin/order/delete/"+id,
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
function add_group(csrf_token) {
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
    url: "/admin/group/create/",
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
function modify_group(id,csrf_token) {
  id =$('#modify-id').val()
  product_name =$('#modify-name').val()
  price = $('#modify-price').val()
  product_types_id= $('#modify-product-type').val()
  image = $('#modify-hidden-img').val()
  reduction = $('#modify-reduction').val()
  description = $('#modify-description').val()
let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
  if($("#modify-check-status").is(":checked")){
    data['status']= '1'
  } else{
      data['status']= '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/group/update/" + id,
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

function delete_group(id,csrf_token){
  let data = { id: id, csrf_token_name: csrf_token }
  $.ajax({
      url: "/admin/group/delete/"+id,
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

function add_company(csrf_token) {
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
function modify_company(id,csrf_token) {
  id =$('#modify-id').val()
  product_name =$('#modify-name').val()
  price = $('#modify-price').val()
  product_types_id= $('#modify-product-type').val()
  image = $('#modify-hidden-img').val()
  reduction = $('#modify-reduction').val()
  description = $('#modify-description').val()
let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
  if($("#modify-check-status").is(":checked")){
    data['status']= '1'
  } else{
      data['status']= '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/user/update/" + id,
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

function delete_company(id,csrf_token){
  let data = { id: id, csrf_token_name: csrf_token }
  $.ajax({
      url: "/admin/user/delete/"+id,
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
function add_stock(csrf_token) {
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
    url: "/admin/stock/create/",
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
function modify_stock(id,csrf_token) {
  id =$('#modify-id').val()
  warehouse_name =$('#modify-name').val()
  price = $('#modify-price').val()
  product_types_id= $('#modify-product-type').val()
  image = $('#modify-hidden-img').val()
  reduction = $('#modify-reduction').val()
  description = $('#modify-description').val()
let data = { id: id, name: product_name, price: price,product_types_id: product_types_id,image: image,reduction: reduction,description: description,csrf_token_name: csrf_token }
  if($("#modify-check-status").is(":checked")){
    data['status']= '1'
  } else{
      data['status']= '0'
  }
  console.log(data)
  $.ajax({
    url: "/admin/stock/update/" + id,
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

function delete_stock(id,csrf_token){
  let data = { id: id, csrf_token_name: csrf_token }
  $.ajax({
      url: "/admin/stock/delete/"+id,
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