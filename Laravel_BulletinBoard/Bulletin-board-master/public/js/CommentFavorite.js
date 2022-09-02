$(function () {
  let CommentFavorite = $('.CommentFavorite-toggle'); //CommentFavorite-toggleのついたiタグを取得し代入。
  let CommentFavoritePostId; //変数を宣言（なんでここで？）
  CommentFavorite.on('click', function () { //onはイベントハンドラー
    let $this = $(this); //this=イベントの発火した要素＝iタグを代入
    CommentFavoritePostId = $this.data('comment-id'); //iタグに仕込んだComment-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/CommentFavorite', //通信先アドレスで、このURLをあとでルートで設定します
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'post_comment_id': CommentFavoritePostId //いいねされた投稿のidを送る
      },
    })
      //通信成功した時の処理
      .done(function (data) {
        console.log("読み込めました");
        if ($this.hasClass('CommentFavorite')) {  //もし通信するときに<i>タグにfavoriteが入ってたら
          $this.addClass('CommentFavorited');   //favoritedを削除
          $this.removeClass('CommentFavorite');
          $this.removeClass('far');  // farを削除
          $this.addClass('fas');  // fasを追加
        } else {
          $this.removeClass('CommentFavorited');
          $this.addClass('CommentFavorite');
          $this.removeClass('fas');
          $this.addClass('far');
        }
        $this.next('.CommentFavorite-counter').html
          (data.review_CommentFavorite_count);
      })
      .fail(function () {
        console.log("失敗しました");
      });
  });
});
