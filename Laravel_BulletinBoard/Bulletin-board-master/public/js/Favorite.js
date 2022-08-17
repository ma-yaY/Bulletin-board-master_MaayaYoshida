$(function () {
  let favorite = $('.Favorite-toggle'); //Favorite-toggleのついたiタグを取得し代入。
  let FavoritePostId; //変数を宣言（なんでここで？）
  favorite.on('click', function () { //onはイベントハンドラー
    let $this = $(this); //this=イベントの発火した要素＝iタグを代入
    FavoritePostId = $this.data('post-id'); //iタグに仕込んだdata-review-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/Favorite', //通信先アドレスで、このURLをあとでルートで設定します
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'post_id': FavoritePostId //いいねされた投稿のidを送る
      },
    })
      //通信成功した時の処理
      .done(function (data) {
        console.log("通信に失敗しました");
        if ($this.hasClass('favorite')) {  //もし通信するときに<i>タグにfavoriteが入ってたら
          $this.addClass('favorite');   //favoritedを削除
          $this.removeClass('far');  // farを削除
          $this.addClass('fas');  // fasを追加
        } else {
          $this.removeClass('favorited');
          $this.removeClass('fas');
          $this.addClass('far');
        }
        $this.next('.Favorite-counter').html
          (data.review_PostFavorite_count);
      });
    fail(function () {
      console.log("失敗しました");

    });
  });
});
