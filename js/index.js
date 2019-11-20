//曲名で絞り込み
class ListChanger {
  constructor(idName) {
    this.selectBox = document.getElementById(idName);
  }
  change(value) {
    const items = this.selectBox.children;
    const reg = new RegExp('.*' + value + '.*', 'i');

    let i;

    if (value === '') {
      for (i = 0; i < items.length; i++) {
        items[i].style.display = '';
      }
      return;
    }

    for (i = 0; i < items.length; i++) {
      if (items[i].textContent.match(reg)) {
        items[i].style.display = '';
      } else {
        items[i].style.display = 'none';
      }
      items[i].selected = false;
    }
    // 選択状態にする
    for (i = 0; i < this.selectBox.length; i++) {
      if (this.selectBox[i].textContent.match(reg)) {
        this.selectBox[i].selected = true;
        break;
      }
    }
  }
}

const menObj = new ListChanger('music_add');
$('#user_list_search_men').on('input keyup  blur', function() {
  menObj.change(this.value);
});

//曲をセレクトすると歌手をセレクトする
$('#music_add').on('change', function() {
  let id = $('option:selected').attr('name');
  console.log(id);
  $('[name=' + id + ']').attr('selected', true);
  $('#artist_add').attr('disabled', true);
});

//曲をセレクトすると歌手が固定されちゃうのでリセットボタン
$('#reset').on('click', function() {
  $('#music_add').val('norequire');
  $('#artist_add').val('norequire');
});

//カラオケの点数登録ボタン
$('#send').on('click', function(e) {
  let user = $('[name="user"]').val();
  let title = $('[name="title"]').val();
  console.log(title);
  let artist = $('[name="artist"]').val();
  let innumber = $('[name="innumber"]').val();
  let comment = $('[name="comment"]').val();
  if (user.length == 0) {
    return alert('名前を入力しないと送信できませーん。');
  } else if (title == 'norequire') {
    return alert('曲名を入力してください');
    // } else if (artist == 'norequire') {
    // return alert('歌手を入力しないと送信できませーん');
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
    alert('投稿完了！');

    //初期状態に戻す
    $('#music_add').val('norequire');
    $('#artist_add').val('norequire');
    $('#number').val('norequire');
    $('#comment').val('');
  } //else 閉じタグ
});

//曲を登録する
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
  alert('曲を追加しました！');

  //そのままセレクトに追加して選択状態に
  $('#artist_add').append(
    '<option selected value="' + artist_name + '">' + artist_name + '</option?'
  );
  $('#music_add').append(
    '<option selected value="' + music_name + '">' + music_name + '</option?'
  );

  //初期状態
  $('#music_name').val('');
  $('#artist_name').val('');
});
