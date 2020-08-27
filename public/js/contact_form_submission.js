//adds the alert element to the page and hides it
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
  //regex to validate email format
  const regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var email = $.trim($('#email').val());

  if(email == '' || regex.test(email.toLowerCase()) == false){
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

//Used to display error with improper form entry
function submissionError(){
  $("#contactFormSubmissionBtn").addClass('error-button');
  $("#contactFormSubmissionBtn").text('Missing Information');
  $("#badInfoAlert").show();
}

function submitContact() {
  var status = null;

  if(validateForm()){
    //ajax call to backend if form data is valid
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
        //Disable message button and display message sent on button
        200: function(){
          $("#contactFormSubmissionBtn").text('Message Sent');
          $("#contactFormSubmissionBtn").prop('disabled', true);
        },
        //Display error button on errored call
        400: function(){
          submissionError();
        }
      }
    });
  }
  //if form data is not valid
  else{
    submissionError();
  }
}
