$('.alert .close').on('click', function(e) {
  $(this).parent().hide();
  $("#contactFormSubmissionBtn").removeClass('error-button');
  $("#contactFormSubmissionBtn").text('Send Message');
});

function submitContact() {
  var status = null;

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
        $("#contactFormSubmissionBtn").addClass('error-button');
        $("#contactFormSubmissionBtn").text('Missing Information');
        $("#badInfoAlert").show();
      }
    }
  });
}
