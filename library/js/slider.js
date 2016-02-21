function ch_width(){
		var ch_width = document.getElementById('mywidth').value;
		document.getElementById('slide1').innerHTML = ch_width + 'см';
		price();
	}
	function ch_height(){
		var ch_height = document.getElementById('myheight').value;
		document.getElementById('slide2').innerHTML = ch_height + 'см';
		price();
	}

	function price(){

		var ch_width = document.getElementById('mywidth').value;
		var ch_height = document.getElementById('myheight').value;
		//unit
		var ch_unit = document.getElementById('unit').value;
		switch(ch_unit) {
  case '1':  // if (x === 'value1')  жалюзи
                var kvard = ch_width * ch_height;
                if ( kvard < 10000) kvard = 10000;
                var price = kvard * 1309;
		document.getElementById('price').innerHTML = (price / 10000).toFixed(2) + 'рублей';
                document.getElementById("calc_pict").src="http://gardine.ru/wp-content/uploads/2016/02/blinds_1.png";
    break;

  case '2':  //  рулонки
                if (ch_width < 60) ch_width = 60;
                if (ch_height>200){
                    var price = ch_width * 3266;
		document.getElementById('price').innerHTML = (price / 100).toFixed(2) + 'рублей';
                } else {
                    var price = ch_width * 2048;
		document.getElementById('price').innerHTML = (price / 100).toFixed(2) + 'рублей';
                        }
                document.getElementById("calc_pict").src="http://gardine.ru/wp-content/uploads/2016/02/blinds_2.png";
    break;

  case '3':  // плиссе
    var price = (ch_width * ch_height * 2338) * 1.7;
		document.getElementById('price').innerHTML = (price / 10000).toFixed(2)+ 'рублей';
          document.getElementById("calc_pict").src="http://gardine.ru/wp-content/uploads/2016/02/blinds_3.png";
    break;
  case '4':  // деревянные
    var price = ch_width * ch_height * 4728;
		document.getElementById('price').innerHTML = (price / 10000).toFixed(2) + 'рублей';
                document.getElementById("calc_pict").src="http://gardine.ru/wp-content/uploads/2016/02/blinds_4.png";
    break;
  case '5':  // вертикальные
    var price = ch_width * ch_height * 792;
		document.getElementById('price').innerHTML = (price / 10000).toFixed(2) + 'рублей';
                document.getElementById("calc_pict").src="http://gardine.ru/wp-content/uploads/2016/02/blinds_5.png";
    break;

  //default:
  //  ...
  //  [break]
						} // end switch
	}