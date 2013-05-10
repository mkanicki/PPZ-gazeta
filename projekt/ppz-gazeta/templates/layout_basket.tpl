
{literal}
    <script>

        
         function Zlacz_Artykuly() {
            var myCheckboxes  = new Array();
            var tbName =  document.getElementById("newFileName").value;
            var sumaCeny = document.getElementById("sumaCeny").innerText;//value;
            
            $("input:checked").each(function() {
               myCheckboxes.push($(this).val());
            });
            
            if( (tbName==="") || (myCheckboxes.length < 1 )){
                alert("B³¹d: Nie podano nazwy pliku, b¹dz nie wybrano artyku³ów.");
                document.getElementById("newFileName").focus();
                return false;
            }

              $.post(
                    'koszyk-ajax.php',
                    {tab_artykuly: myCheckboxes,
                     newName: tbName,
                     cena: sumaCeny},
                    function(){
                             
                             
                               var i=1;
                               var countMerged=0;
                              $("input:checked").each(function() {
                                 if($(this).attr("checked")){ 
                                     $("#wnetrze"+i).css("background-color","lightgreen");
                                     $("#removelink"+i).replaceWith("");
                                     $("#buylink"+i).replaceWith("<td colspan =\"2\"><span style='color:#191970;'>z³¹czono</span></td>");
                                     countMerged +=1;
                                }
                                 i+=1;
                              });
                                
                              
                             //odznacz checked
                              $("input:checked").each(function() {
                                 $(this).removeAttr("checked");
                              });
                            
                             var ilosc = $("#basket_label").html() * 1;
                             $("#basket_label").replaceWith("<span id='basket_label'>"+(ilosc - countMerged +1)+"</span>");
                             
                            $('#laczenie').html('  <td colspan="8" style=" border-width:2px; font-weight:bold; color:green;" > z³¹czono wybrane</td>');
                            // window.location.reload(true);
                    }
                );

        return false;   
    }
    
    function usunZKoszyka(idKoszyka, elem)
        {
            $.post(
                'koszyk2-ajax.php',
                { idKoszyk : idKoszyka, usun : 1 },
                function(response) {
                    if(response == 'ok') {

                        $(elem).replaceWith("<span style='color: red'>usuniete!</span>");

                        ilosc = $("#basket_label").html() * 1;
                        $("#basket_label").replaceWith("<span id='basket_label'>"+(ilosc - 1)+"</span>");
                    } else {
                        alert("Wyst¹pi³ b³¹d, prosimy spróbowaæ ponownie.");
                    }
                }
            );

            return false;
        }
    </script>
{/literal}

{php}   
   $nr=1;
   $sumaCeny=0.0;
{/php}  
      
        <br/>
        {php} echo $_SESSION['platnosc'];{/php}

           
          <table  class="tableWydanieKoszyk" >
              <tr style=" background-color: #B0C4DE; font-weight: bold;"><td colspan="2" style="text-align:left; width:20px;">Lp.</td> <td>Nazwa</td> <td>Data dodania</td> <td colspan="3" style=" text-align:left;">Cena</td></tr>
                {php}   $items = $this->get_template_vars('pokaz_koszyk'); 
                      if(!isset($items[0]))   echo ' <tr ><td colspan="7" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Koszyk jest pusty</td> </tr> ';
               {/php}
              {foreach from = $pokaz_koszyk item = a}
                 
                    <tr {php}echo "id='wnetrze".$nr."'";{/php}>
                        <td  style="width:20px; text-align:left;">{php}echo $nr.'.';{/php}</td>
                        <td  style="width:20px; text-align:left;"> <input type="checkbox"   value={$a.Sciezka} checked="checked" /> </td>
                        <td >{$a.Tytul}</td>                         
                        <td >{$a.data}</td>  
                        <td style="text-align:left;">{$a.Cena} $</td> 
                        <td {php}echo "id='buylink".$nr."'";{/php} style="text-align:left; width:80px;"><form method="POST" action="PayPal/process.php"  >
                                                                    <input type="hidden" name="itemnumber" value={$a.idArtykul} />
                                                                    <input type="hidden" name="itemprice" value={$a.Cena} />
                                                                    <input type="hidden" name="itemname" value={$a.Tytul} />
                                                                    <input type="hidden" name="itempath" value={$a.Sciezka} />
                                                                    <input  style="width:80px; height:20px; font-weight: bold;" type="submit" name="submitbutt" value="kup" />
                                                                </form>
                        </td>
                        {assign var="tmp" value=$a.Cena}
                        <td {php}echo "id='removelink".$nr."'";{/php} style="text-align:center; width:80px;"><button type="button" style="width:80px; height:20px;"> <a  href="#" onclick="return usunZKoszyka({$a.idKoszyk}, this)">usuñ</a></button></td>
                    </tr>

                   {php}
                        $nr+=1;
                        $sumaCeny+= $this->get_template_vars('tmp');
                   {/php}
                
             {/foreach}
               
               
                    <tr>
                        <td colspan="4" align="right" style="  font-weight: bold; color:red;">Razem:</td>
                         <td colspan="4" style="text-align:left; color:red; "><span id="sumaCeny">{php}echo $sumaCeny;{/php}</span> $</td>
                    </tr>
                    {php}if($nr > 2){;
                    {/php}
                     <tr id="laczenie">
                         <td colspan="4" style=" border-width:2px;" > <a href="#" style="margin-right:40px; font-weight: bold;" onclick=" Zlacz_Artykuly()">Z³¹cz wybrane</a>    Nadaj nazwê:<input type="text" id="newFileName"  size="25" maxlength="25"/></td>
                         <td colspan="4" style=" border-width:2px;"></td>
                    </tr>
                    {php};}{/php}
               
           </table>
