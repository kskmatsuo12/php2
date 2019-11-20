$('#send').on('click', function(e) {
  let user = $('[name="user"]').val();
  let title = $('[name="title"]').val();
  let artist = $('[name="artist"]').val();
  let innumber = $('[name="innumber"]').val();
  let comment = $('[name="comment"]').val();
  if (user.length == 0) {
    return alert('名前を入力しないと送信できませーん。');
  } else if (title == 'norequire') {
    return alert('曲名を入力してください');
  } else if (artist == 'norequire') {
    return alert('歌手を入力しないと送信できませーん');
  } else if (innumber == 'norequire') {
    return alert('点数を入力して下さい！');
  } else {
    console.log('test');
    $.ajax({
      type: 'POST',
      url: './get.php',
      data: {
        'user': user,
        'title': title,
        'artist': artist,
        'innumber': innumber,
        'comment': comment
      },
      success: function(response) {
        console.log(response);
      }
    });

    $('#');
    $('#artist_select').val('norequire');
    $('#music_select').val('norequire');
    $('#number_select').val('norequire');
    $('#comment').empty();

    $('#minutes').empty();
    $('#name').empty();
    $('#play').empty();
    $('#result').empty();
  } //else 閉じタグ
});

$('#send_music').on('click', function(e) {
  console.log('MUSIC登録しました');
  let music_name = $('[name="music_name"]').val();
  let artist_name = $('[name="artist_name"]').val();
  $.ajax({
    type: 'POST',
    url: './music.php',
    data: {
      'music_name': music_name,
      'artist_name': artist_name
    },
    success: function(response) {
      console.log(response);
    }
  });
  $('#artist_add').append(
    '<option value="' + artist_name + '">' + artist_name + '</option?'
  );
  $('#music_add').append(
    '<option value="' + music_name + '">' + music_name + '</option?'
  );
  $('#music_name').val('');
  $('#artist_name').val('');
});
