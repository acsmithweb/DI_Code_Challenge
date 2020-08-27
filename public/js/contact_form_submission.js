$('.alert .close').on('click', function(e) {
  $(this).parent().hide();
  $("#contactFormSubmissionBtn").removeClass('error-button');
  $("#contactFormSubmissionBtn").text('Send Message');
});

function validateForm() {
  var name_valid = validName();
  var email_valid = validEmail();
  var message_valid = validMessage();

  if (name_valid == true && email_valid == true && message_valid == true){
    return true;
  }
  else{
    return false;
  }
}

function validName() {
  var name = $.trim($('#name').val());

  if(name == ''){
    $('#name').addClass('validation-error');
    return false;
  }
  else{
    $('#name').removeClass('validation-error');
    return true;
  }
}

function validEmail() {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var email = $.trim($('#email').val());
  console.log(re.test(email.toLowerCase()));

  if(email == '' || re.test(email.toLowerCase()) == false){
    $('#email').addClass('validation-error');
    return false;
  }
  else{
    $('#email').removeClass('validation-error');
    return true;
  }
}

function validMessage() {
  var message = $.trim($('#message').val());

  if(message == ''){
    $('#message').addClass('validation-error');
    return false;
  }
  else{
    $('#message').removeClass('validation-error');
    return true;
  }
}

function submissionError(){
  $("#contactFormSubmissionBtn").addClass('error-button');
  $("#contactFormSubmissionBtn").text('Missing Information');
  $("#badInfoAlert").show();
}

function submitContact() {
  var status = null;

  if(validateForm()){
    $.ajax({
      type: "POST",
      url: "/public/php/api/ContactInfoApi.php",
      data: {
        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        message: $('#message').val()
      },
      data_type:'json',
      success: console.log('success!'),
      statusCode:{
        200: function(){
          $("#contactFormSubmissionBtn").text('Message Sent');
          $("#contactFormSubmissionBtn").prop('disabled', true);
        },
        400: function(){
          submissionError();
        }
      }
    });
  }
  else{
    submissionError();
  }
}
