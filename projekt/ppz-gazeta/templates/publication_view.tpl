<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">


{literal}
<script type="text/javascript">
    function dodajDoKoszyka(idArtykulu,elem)
    {
       
        $.post(
            'koszyk2-ajax.php',
            { id_artykulu : idArtykulu},
            function(response) {
                    if(response == 'ok' ){
                        $(elem).replaceWith("<span style='color: green'>dodane!</span>");

                        ilosc = $("#basket_label").html() * 1;
                        $("#basket_label").replaceWith("<span id='basket_label'>"+(ilosc + 1)+"</span>");
                    } else {
                            alert("Artykuł już jest w koszyku.");
                    }
            }
        );

        return false;
    }
</script>
{/literal}


{php}$nr=1;{/php} 

<img id="2222" src='{$wydanie_name}'>

<table id="3333" class="tableWydanieKoszyk">
      <tr style=" background-color: #B0C4DE; font-weight: bold;"><td style="text-align:left; width:20px;">Lp.</td> <td>Tytuł</td> <td>Cena</td> <td >Liczba pobrań</td> {php} if(isset($_SESSION['id_uzytkownika'])){ ; {/php} <td style="width:200px;"></td> {php} } {/php} </tr>

            {if $artykuly_wydania==null} <tr ><td colspan="5" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Wydanie nie zawiera artykułów</td></tr>{/if}
           {foreach from = $artykuly_wydania item = a}
               <tr>
                   <td style="text-align:left; width:20px;">{php}echo $nr;{/php}.</td>
                   <td>{$a.Tytul}</td>
                   <td>{$a.Cena} </td>
                   <td style="width:120px;">{$a.LiczbaPobran}</td>
                   {php} if(isset($_SESSION['id_uzytkownika'])){ ; {/php}
                        <td style="width:200px;">
                              <a href="#" style="color:#191970; font-weight: bold; text-decoration: none;" onclick="return dodajDoKoszyka('{$a.idArtykul}', this)">dodaj do koszyka</a>
                        </td>
                   {php} } {/php}
               </tr>
               {php}$nr+=1;{/php}
           {/foreach} 

</table>