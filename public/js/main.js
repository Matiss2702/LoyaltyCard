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
      toastr.success(reponse.message)
    },
    error: function (reponse) {
      toastr.options.timeOut = 750;
      toastr.options.fadeOut = 1000;
      toastr.options.onHidden = function () {
        window.location.reload();
      };
      toastr.error(reponse.statusText)
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
      toastr.success(reponse.statusText)
    },
    error: function (reponse) {
      console.log(reponse)
      var errors = JSON.parse(reponse.responseText)
      console.log(errors)
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

function send(csrf_token) {
  lastname = $('#signup-lastname').val()
  firstname = $('#signup-firstname').val()
  mail = $('#signup-email').val()
  sender = $('#signup-manager').val()
  let data = { lastname: lastname, firstname: firstname, mail: mail, sender: sender, csrf_token_name: csrf_token }
  $.ajax({
    url: "/register/",
    type: "POST",
    data: data,
    success: function () {

      toastr.success('email envoyé avec succès!')
    },
    error: function () {
      toastr.error('Erreur a la sauvegarde!')
    }
  })
}

function reset(csrf_token) {

  mail = $('#reset-email').val()
  let data = { mail: mail, csrfmiddlewaretoken: csrf_token }
  $.ajax({
    url: "/reset_password/",
    type: "POST",
    data: data,
    success: function () {
      toastr.success('email envoyé avec succès!')
    },
    error: function () {
      toastr.error('Erreur a la sauvegarde!')
    }
  })
}
