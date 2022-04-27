function sign_in() {
    $('#sign-in').addClass('active')
    $('#sign-up').removeClass('active')
    $('#reset-tab').removeClass('show active')
    $('#sign-up-tab').removeClass('show active')
    $('#sign-in-tab').addClass('show active')
  }
  
  function sign_up() {
     $('#sign-up').addClass('active')
     $('#sign-in').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#reset-tab').removeClass('show active')
     $('#sign-up-tab').addClass('show active')
  }
  
  function reset_pwd() {
     $('#sign-in').removeClass('active')
     $('#sign-up').removeClass('active')
     $('#sign-in-tab').removeClass('show active')
     $('#sign-up-tab').removeClass('show active') 
     $('#reset-tab').addClass('show active')
  }

  
  $(document).ready(function() {
   $("#check-pwd").click(function() {
       if ($("input[type=checkbox]").is(
         ":checked")) {
            $('#pwd').removeClass('d-none')
            $('#pwd-confirm').removeClass('d-none')
            $('#lbl-pwd').removeClass('d-none')
            $('#lbl-pwd-confirm').removeClass('d-none')
       } else {
         $('#pwd').addClass('d-none')
         $('#pwd-confirm').addClass('d-none')
         $('#lbl-pwd').addClass('d-none')
         $('#lbl-pwd-confirm').addClass('d-none')
       }
   });
});