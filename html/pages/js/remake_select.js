firebase.auth().onAuthStateChanged(function(user) {
    //ログイン状態判別
    if (user) {
        //colorの取得
        db.collection("color").orderBy("color_name").limit(3)
            .get().then(function (querySnapshot) {
            var num =  1;
            querySnapshot.forEach(function(doc) {
                const color = doc.data()
                //colorの出力
                console.log(color);
                var elem = document.getElementById("color" + num);
                // console.log(elem);

                // elem.insertAdjacentHTML('afterbegin', '<b>Test:</b>');

                // elem.innerHTML = "<span></span>"+color.color_id+" "+color.color_name;
                // elem.firstElementChild.style.backgroundColor = getColorCode(color.color_id);

                // num += 1;
                // elem.innerHTML = color.color_id+" "+color.color_name;
            });
        })
        .catch(function(error) {
            console.log("Error getting documents: ", error);
        });

    } else{
      location.href = "./index.html"
  }
});   
//jquery タブ切り替え
$(function () {
  $("input[type='radio']").removeAttr('checked');
  $('#combi_select').css('background-color', '#B5C76A')
  $('#combi_select').click(function (e) {
    $('#cate_select').css('background-color', '#707070')
    $('#combi_select').css('background-color', '#B5C76A')
    $('.cate_con').fadeOut(1);
    $('#combi_con').fadeIn(1);
    $('input').prop('checked', false);
  });
  $('#cate_select').click(function (e) {
    $("input").removeAttr('checked');
    $('#cate_select').css('background-color', '#B5C76A')
    $('#combi_select').css('background-color', '#707070')
    $('.cate_con').fadeIn(1);
    $('#combi_con').fadeOut(1);
    $('input').prop('checked', false);
  });
})

function Confirmation() {

    // product要素を取得
    var category = document.getElementsByName( "category" ) ;
    // 選択状態の値を取得
    for ( var a="", i=category.length; i--; ) {
      if ( category[i].checked ) {
        var category_select = category[i].value ;
        break ;
      }
    }
    
    // color要素を取得
    var color = document.getElementsByName( "color" ) ;
    // 選択状態の値を取得
    for ( var a="", i=color.length; i--; ) {
      if ( color[i].checked ) {
        var color_select = color[i].value ;
        break ;
      }
    }

    // GET URLのパラメータ取得
    var arg  = new Object;
    url = location.search.substring(1).split('&');
    
    for(i=0; url[i]; i++) {
        var k = url[i].split('=');
        arg[k[0]] = k[1];
    }
    var product_id = arg.product_id;
    let corse_number = arg.corse_number;

    //ページ遷移
    var next_page = "./remake_details.php";
    location.href = next_page + "?product_id=" + product_id + "&category=" + category_select + "&color=" + color_select + "&corse_number=" + corse_number;


}
  


