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
                              $("input:checked").each(function() {
                                 if($(this).attr("checked")){ 
                                     $("#wnetrze"+i).css("background-color","lightgreen");
                                     $("#removelink"+i).replaceWith("<span style='color:#191970;'>z³¹czono</span>");
                                }
                                 i+=1;
                              });
                                
                             //odznacz checked
                              $("input:checked").each(function() {
                                 $(this).removeAttr("checked");
                              });
                            
                             $('#laczenie').html('  <td colspan="4" style=" border-width:2px;" > z³¹czono wybrane</td>     <td colspan="3" style=" border-width:2px;"><input type="button" value="     PayPal     " /></td>');
                            // window.location.reload(true);
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
         <form>
          <table  class="tableWydanieKoszyk" >
              <tr style=" background-color: #B0C4DE; font-weight: bold;"><td colspan="2" style="text-align:left; width:20px;">Lp.</td> <td>Nazwa</td> <td>Data dodania</td> <td colspan="2" style=" text-align:left;">Cena</td></tr>
             {foreach from = $pokaz_koszyk item = a}
               {if $pokaz_koszyk==null} <tr ><td colspan="6" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Koszyk jest pusty</td></tr>{/if}
                    <tr {php}echo "id='wnetrze".$nr."'";{/php}>
                        <td  style="width:20px; text-align:left;">{php}echo $nr.'.';{/php}</td>
                        <td  style="width:20px; text-align:left;"> <input type="checkbox"  name="artykuly[]" value={$a.Sciezka} checked="checked" /> </td>
                        <td >{$a.Tytul}</td> 
                        <td >{$a.data}</td>
                        <td style="text-align:left;">{$a.Cena} z³</td>
                        {assign var="tmp" value=$a.Cena}
                        <td style="text-align:center;"> <a {php}echo "id='removelink".$nr."'";{/php} href="basket_removeorder.php">usuñ</a></td>
                    </tr>
                   {php}
                        $nr+=1;
                        $sumaCeny+= $this->get_template_vars('tmp');
                   {/php}
                
             {/foreach}
               
               
                    <tr>
                        <td colspan="4" align="right" style="  font-weight: bold; color:red;">Razem:</td>
                         <td colspan="3" style="text-align:left; color:red; "><span id="sumaCeny">{php}echo $sumaCeny;{/php}</span> z³</td>
                    </tr>
                     <tr id="laczenie">
                         <td colspan="4" style=" border-width:2px;" > <a href="#" style="margin-right:40px; font-weight: bold;" onclick=" Zlacz_Artykuly()">Z³¹cz wybrane</a>    Nadaj nazwê:<input type="text" id="newFileName" name="newFileName" size="25" maxlength="25"/></td>
                         <td colspan="3" style=" border-width:2px;"><input type="button" value="     PayPal     " /></td>
                    </tr>
               
           </table>
          <form>
           <br/>

