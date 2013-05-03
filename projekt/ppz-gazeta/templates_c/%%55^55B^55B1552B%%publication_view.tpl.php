<?php /* Smarty version 2.6.26, created on 2013-04-27 02:18:53
         compiled from publication_view.tpl */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<?php echo '
<script type="text/javascript">
    function dodajDoKoszyka(idArtykulu,elem)
    {
        $.post(
            \'koszyk-ajax.php\',
            { id_artykulu : idArtykulu},
            function(response) {
               if(response===\'ok\') { 
                   alert(response);   
                    $(elem).replaceWith("<span style=\'color: green\'>dodane!</span>");
                  
                    ilosc = $("#basket_label").html() * 1;
                    $("#basket_label").replaceWith("<span id=\'basket_label\'>"+(ilosc + 1)+"</span>");
                 
                 } else {
                    alert("Wystąpił błąd, prosimy spróbować ponownie.");
                }
                
            }
        );

        return false;
    }
</script>
'; ?>



<?php $nr=1; ?> 

<img id="2222" src='<?php echo $this->_tpl_vars['wydanie_name']; ?>
'>

<table id="3333" class="tableWydanieKoszyk" >
      <tr style=" background-color: #B0C4DE; font-weight: bold;"><td style="text-align:left; width:20px;">Lp.</td> <td>Tytuł</td> <td>Cena</td> <td >Liczba pobrań</td> <td style="width:200px;"></td></tr>

            <?php if ($this->_tpl_vars['artykuly_wydania'] == null): ?> <tr ><td colspan="5" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Wydanie nie zawiera artykułów</td></tr><?php endif; ?>
           <?php $_from = $this->_tpl_vars['artykuly_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
               <tr>
                   <td style="text-align:left; width:20px;"><?php echo $nr; ?>.</td>
                   <td><?php echo $this->_tpl_vars['a']['Tytul']; ?>
</td> <td><?php echo $this->_tpl_vars['a']['Cena']; ?>
 zł</td>
                   <td><?php echo $this->_tpl_vars['a']['LiczbaPobran']; ?>
</td>
                   <td style="width:200px;">
                           <?php  if(isset($_SESSION['id_uzytkownika'])){ ;  ?>     <a href="#" style="color:#191970; font-weight: bold; text-decoration: none;" onclick="return dodajDoKoszyka(<?php echo $this->_tpl_vars['a']['IdArtykul']; ?>
, this)">dodaj do koszyka</a> <?php  }else{ echo "<span></span>";}  ?>
                   </td>
               </tr>
               <?php $nr+=1; ?>
           <?php endforeach; endif; unset($_from); ?> 

</table>