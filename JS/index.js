$('.toggle').on('click', function() {
  $('.container').stop().addClass('active');
});

$('.close').on('click', function() {
  $('.container').stop().removeClass('active');
});
//
//$('#waiting-screen').hide();
//
//
//$('#ajaxSendResponse').on('click', function() {
//  $('#regForm').hide();
//  $('#waitnig-screen').show();
//   return false;
//});