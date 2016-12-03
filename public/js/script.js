$(function() {
  // 新規登録 モーダル
  $('.signup-show').click(function() {
    $('.signup-modal-wrapper').css('display','block');
  });

  $('#close-modal').click(function() {
    $('.signup-modal-wrapper').css('display','none');
  });

  // ログインモーダル
  $('.login-show').click(function() {
    $('.login-modal-wrapper').css('display','block');
  });

  $('#close-modal2').click(function() {
    $('.login-modal-wrapper').css('display','none');
  });


  $('.commentshowup').click(function() {
    if ($(this).next().css('display') === 'none') {
      $(this).next().css('display','block');
    } else if ( $(this).next().css('display') === 'block' ) {
      $(this).next().css('display','none');
    }
  });


  // $('.commentshowup').on("click", function() {
  //   $(this).next().slideToggle();
  // });



});

