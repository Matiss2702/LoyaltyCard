function login(csrf_token) {
  "use strict";

  var check = true;
  const mail = document.getElementById('signin-mail').value
  const pwd = document.getElementById('signin-password').value

  $.ajax({
    url: "/login/",
    type: 'POST',
    data: { mail: mail, password: pwd, csrf_token_name: csrf_token },
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      console.log(reponse)
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.error(reponse.responseJSON.messages['error'])
    }
  })
}

function register(csrf_token) {
  lastname = $('#signup-lastname').val()
  firstname = $('#signup-firstname').val()
  mail = $('#signup-mail').val()
  password = $('#signup-password').val()
  pass_confirm = $('#signup-password-confirm').val()

  $.ajax({
    url: "/register/",
    type: 'POST',
    data: { lastname: lastname, firstname: firstname, mail: mail, password: password, pass_confirm: pass_confirm ,csrf_token_name: csrf_token },
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



function reset(csrf_token) {

  mail = $('#reset-mail').val()
  let data = { mail: mail, csrf_token_name: csrf_token }
  $.ajax({
    url: "/forgot/",
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

function forgot(csrf_token) {
  id = $('#reset-id').val()
  password = $('#reset-password').val()
  pass_confirm = $('#reset-confirm-password').val()
  let data = { id: id, password: password, pass_confirm: pass_confirm , csrf_token_name: csrf_token }
  $.ajax({
    url: "/reset_confirm/",
    type: "POST",
    data: data,
    success: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.href='/';
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
function profile(csrf_token) {
  firstname =$('#firstname').val()
  lastname = $('#lastname').val()
  address = $('#address').val()
  zipcode = $('#zipcode').val()
  city = $('#city').val()
  country = $('#country').val()
  let data = {  lastname: lastname, firstname: firstname,address: address,zipcode: zipcode,city: city, country: country ,csrf_token_name: csrf_token }
  if($("#check-pwd").is(":checked")){
    data['password']=$("#pwd").val()
    data['pass_confirm']=$("#pwd-confirm").val()
  }
  $.ajax({
    url: "/update/",
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

function add_to_cart(id,csrf_token) {
  product_name = $('#signup-name').val()
  sub_total= $('#signup-sub_total').val()
  image = $('#signup-image').val()
  reduction = $('#signup-reduction').val()
  quantity = $('#signup-quantity').val()
  description = $('#signup-description').val()

  $.ajax({
    url: "/product/add_cart/"+ id,
    type: 'POST',
    data: {name: product_name,sub_total: sub_total, image: image, reduction: reduction, quantity: quantity, description: description ,csrf_token_name: csrf_token },
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
function modify_cart(id,csrf_token) {
  quantity = $('#modify-quantity').val()

let data = { id: id, quantity: quantity,csrf_token: csrf_token }
  console.log(data)
  $.ajax({
    url: "/cart/update/" + id,
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

function delete_cart(id,csrf_token){
  let data = { id: $id, csrf_token_name: csrf_token }
  $.ajax({
      url: "/cart/remove/"+id,
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
