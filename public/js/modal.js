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