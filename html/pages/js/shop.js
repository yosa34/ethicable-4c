/**
        取得したcategory_idをもとにアイテムアイコンのファイルパスを返す

        @param number   取得したcategory_id
        @return String  category_idに対応するカテゴリ名
      **/
     function getRemakeImg(num) {
        // category_idの値によって表示するアイテムアイコンのファイルパスを切り替える
        let imgPass;
        switch(num) {
          case 1:
            imgPass = "./image/category/1.png";
            break;
          case 2:
            imgPass = "./image/category/2.png";
            break;
          case 3:
            imgPass = "./image/category/3.png";
            break;
          case 4:
            imgPass = "./image/category/4.png";
            break ;
          case 5:
            imgPass = "./image/category/5.png";
            break;
          case 6:
            imgPass = "./image/category/6.png";
            break;
          case 7:
            imgPass = "./image/category/7.png";
            break;
          case 8:
            imgPass = "./image/category/8.png";
            break;
          default :
            console.log("カテゴリーが存在しません");
            break;
        }
        // 画像ファイルパスを返す
        return imgPass;
      }

    /**
      取得したproduct_sizeをもとにサイズ名を返す

      @param number   取得したproduct_size
      @return String  product_sizeに対応するサイズ名
    **/
      function get_product_size(size) {
        // product_sizeの値によって対応するサイズ名を返す
        let sizeName;
        switch(size) {
          case 2:
            sizeName = "XS";
            break;
          case 3:
            sizeName = "S";
            break;
          case 4:
            sizeName = "M";
            break;
          case 5:
            sizeName = "L";
            break;
          case 6:
            sizeName = "XL";
            break;
          default :
            console.log("サイズが存在しません");
            break;
        }
        // product_sizeに対応するサイズ名を返す
        return sizeName;
      }

      /**
          取得したcolor_idをもとに対応するカラーコードを返す

          @param number 取得したcolor_id
          @return string color_idに対応するカラーコード
        **/
       function getColorCode(color_id) {
        let colorCode;
        switch(color_id) {
          case 0:
            colorCode = "#FFFFFF";
            break;
          case 1:
            colorCode = "#D5D3B5";
            break;
          case 3:
            colorCode = "#CEC9C4";
            break;
          case 8:
            colorCode = "#373537";
            break;
          case 9:
            colorCode = "#2C282D";
            break;
          case 27:
            colorCode = "#E97B6E";
            break;
          case 30:
            colorCode = "#DFCEC0";
            break;
          case 32:
            colorCode = "#CEB8A5";
            break;
          case 56:
            colorCode = "#77705A";
            break;
          case 59:
            colorCode = "#4B4E45";
            break;
          case 63:
            colorCode = "#3F4558";
            break;
          case 64:
            colorCode = "#A5ACD6";
            break;
          case 66:
            colorCode = "#507E96";
            break;
          case 69:
            colorCode = "#302E37";
            break;
          default:
            console.log("存在しないカラーIDです");
            break;
        }
        // カラーコードを返す
        return colorCode;
      }

      /**
        取得したcolor_idをもとに対応するカラー名を返す

        @param number 取得したcolor_id
        @return string color_idに対応するカラー名
      **/
      function getColorName(color_id) {

        let colorName;
          switch(color_id) {
          case 0:
            colorName = "WHITE";
            break;
          case 1:
            colorName = "OFF WHITE";
            break;
          case 3:
            colorName = "GRAY";
            break;
          case 8:
            colorName = "DARK GRAY";
            break;
          case 9:
            colorName = "BLACK";
            break;
          case 27:
            colorName = "ORANGE";
            break;
          case 30:
            colorName = "NATURAL";
            break;
          case 32:
            colorName = "BEIGE";
            break;
          case 56:
            colorName = "OLIVE";
            break;
          case 59:
            colorName = "DARK GREEN";
            break;
          case 63:
            colorName = "BLUE";
            break;
          case 64:
            colorName = "BLUE";
            break;
          case 66:
            colorName = "BLUE";
            break;
          case 69:
            colorName = "NAVY";
            break;
          default:
            console.log("存在しないカラーIDです");
            break;
        }
        console.log(colorName);
        return colorName;
      }