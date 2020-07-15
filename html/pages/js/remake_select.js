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

    //項目ごとに選択の時
    // product要素を取得
    var category = document.getElementsByName("category");
    // 選択状態の値を取得
    for ( var a="", i=category.length; i--; ) {
      if ( category[i].checked ) {
        var category_select = category[i].value ;
        break ;
      }
    }

    // color要素を取得
    var color = document.getElementsByName( "color" );
    // 選択状態の値を取得
    for ( var a="", i=color.length; i--; ) {
      if ( color[i].checked ) {
        var color_select = color[i].value ;
        break ;
      }
    }

    //組み合わせの時
    var categoryColor = document.getElementsByName("combi");
    // 選択状態の値を取得
    for ( var a="", i=categoryColor.length; i--; ) {
      if ( categoryColor[i].checked ) {
        var select = categoryColor[i].value ;
        break ;
      }
    }
    if (select) {
        var select_data = select.split(",");
        category_select = select_data[0];
        color_select = select_data[1];
    
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
  


