/*
 * Dodaje do diva o id = \main_panel\ powiekszone zdjecie miniatury wydania o id podanym w argumencie.
 *
 * @param id: identyfikator obrazka
 * @param name: lokalizacja obrazka
 *  
 */
  function showView(name,id) {

            $('#main-panel').children().hide();
             var elem = document.createElement("img");
            elem.src = name;

            elem.setAttribute("height", $("#main-panel").height()-300);
            elem.setAttribute("hspace", $('#list').width()/2);
            var elemIdName = id;
            elem.setAttribute('id',elemIdName);
            elem.setAttribute("width", ($("#main-panel").width() - $('#list').width()) );
            document.getElementById("main-panel").appendChild(elem);

    }
/*
 * Usuwa powiekszone zdjecie miniatury wydania  z wnetrza diva o id = \main_panel\ .
 *  
 */
    function hideView() {
            var d = document.getElementById('main-panel');
            var elemIdName = '1111';
            var olddiv = document.getElementById(elemIdName);
            d.removeChild(olddiv);	

            $('#main-panel').children().show();

    }
/*
 * Ustawia atrybuty podgladu zdjecia wydania. Atrybutami ustawianymi sa: height, hspace, width.
 *
 */
function SetAttrImageView() {
             var elem = document.getElementById('2222');
            elem.setAttribute("height", $("#main-panel").height()-300);
            elem.setAttribute("hspace", $('#list').width()/2);
            elem.setAttribute("width", ($("#main-panel").width() - $('#list').width()) );
    }

/*
 * Wyswietla na stale podglad zdjecia wydania o id, lokacji podanej w argumencie poprzez zapytanie Ajax
 *
 * @param id: identyfikator obrazka
 * @param wyd_name: lokacja obrazka
 *  
 */
      function PokazWydanie(wyd_name,id) {

              $.post(
                    'mainAjax.php',
                    {wydanie_name : wyd_name, id_wydania: id},
                    function(response) {
                        if(response) {                               

                               $("#main-panel").html(response);
                               SetAttrImageView();

                        } 
                        else {
                            alert("Wyst¹pi³ b³¹d, prosimy spróbowaæ ponownie.");
                        }

                    }
                );

        return false;   
    }
    
///
