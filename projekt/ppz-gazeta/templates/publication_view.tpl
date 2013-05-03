<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
{literal}
<script type="text/javascript">
    function dodajDoKoszyka(idArtykulu,elem)
    {
        $.post(
            'koszyk-ajax.php',
            { id_artykulu : idArtykulu},
            function(response) {
               if(response==='ok') { 
                   alert(response);   
                    $(elem).replaceWith("<span style='color: green'>dodane!</span>");
                  
                    ilosc = $("#basket_label").html() * 1;
                    $("#basket_label").replaceWith("<span id='basket_label'>"+(ilosc + 1)+"</span>");
                 
                 } else {
                    alert("Wystąpił błąd, prosimy spróbować ponownie.");
                }
                
            }
        );

        return false;
    }
</script>
{/literal}


{php}$nr=1;{/php} 

<img id="2222" src='{$wydanie_name}'>

<table id="3333" class="tableWydanieKoszyk" >
      <tr style=" background-color: #B0C4DE; font-weight: bold;"><td style="text-align:left; width:20px;">Lp.</td> <td>Tytuł</td> <td>Cena</td> <td >Liczba pobrań</td> <td style="width:200px;"></td></tr>

            {if $artykuly_wydania==null} <tr ><td colspan="5" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Wydanie nie zawiera artykułów</td></tr>{/if}
           {foreach from = $artykuly_wydania item = a}
               <tr>
                   <td style="text-align:left; width:20px;">{php}echo $nr;{/php}.</td>
                   <td>{$a.Tytul}</td> <td>{$a.Cena} zł</td>
                   <td>{$a.LiczbaPobran}</td>
                   <td style="width:200px;">
                           {php} if(isset($_SESSION['id_uzytkownika'])){ ; {/php}     <a href="#" style="color:#191970; font-weight: bold; text-decoration: none;" onclick="return dodajDoKoszyka({$a.IdArtykul}, this)">dodaj do koszyka</a> {php} }else{ echo "<span></span>";} {/php}
                   </td>
               </tr>
               {php}$nr+=1;{/php}
           {/foreach} 

</table>