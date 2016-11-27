$(function() {
  // 新規登録 モーダル
  $('.signup-show').click(function() {
    $('.signup-modal-wrapper').css('display','block');
  });

  $('#close-modal').click(function() {
    $('.signup-modal-wrapper').css('display','none');
  });

  // ログイン　モーダル
  $('.login-show').click(function() {
    $('.login-modal-wrapper').css('display','block');
  });

  $('#close-modal').click(function() {
    $('.login-modal-wrapper').css('display','none');
  });

  // 画像スクロール
  $("#scroller_roll1").scroller_roll({
    title_show: 'enable',
    time_interval: '15',
    //  window_background_color: "#C1F0FF",
    window_padding: '10',
    border_size: '0',
    border_color: '#0099CC',
    images_width: 'auto',
    images_height: '100',
    images_margin: '60',
    title_size: '16',
    title_color: 'black',
    show_count: '4'
  });


});
