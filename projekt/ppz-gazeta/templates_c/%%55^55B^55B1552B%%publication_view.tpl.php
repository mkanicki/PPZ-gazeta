<?php /* Smarty version 2.6.26, created on 2013-05-07 19:09:41
         compiled from publication_view.tpl */ ?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">


<?php echo '
<script type="text/javascript">
    function dodajDoKoszyka(idArtykulu,elem)
    {
       
        $.post(
            \'koszyk2-ajax.php\',
            { id_artykulu : idArtykulu},
            function(response) {
                    if(response == \'ok\' ){
                        $(elem).replaceWith("<span style=\'color: green\'>dodane!</span>");

                        ilosc = $("#basket_label").html() * 1;
                        $("#basket_label").replaceWith("<span id=\'basket_label\'>"+(ilosc + 1)+"</span>");
                    } else {
                            alert("Artykuł już jest w koszyku.");
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

<table id="3333" class="tableWydanieKoszyk">
      <tr style=" background-color: #B0C4DE; font-weight: bold;"><td style="text-align:left; width:20px;">Lp.</td> <td>Tytuł</td> <td>Cena</td> <td >Liczba pobrań</td> <?php  if(isset($_SESSION['id_uzytkownika'])){ ;  ?> <td style="width:200px;"></td> <?php  }  ?> </tr>

            <?php if ($this->_tpl_vars['artykuly_wydania'] == null): ?> <tr ><td colspan="5" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Wydanie nie zawiera artykułów</td></tr><?php endif; ?>
           <?php $_from = $this->_tpl_vars['artykuly_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
               <tr>
                   <td style="text-align:left; width:20px;"><?php echo $nr; ?>.</td>
                   <td><?php echo $this->_tpl_vars['a']['Tytul']; ?>
</td>
                   <td><?php echo $this->_tpl_vars['a']['Cena']; ?>
 </td>
                   <td style="width:120px;"><?php echo $this->_tpl_vars['a']['LiczbaPobran']; ?>
</td>
                   <?php  if(isset($_SESSION['id_uzytkownika'])){ ;  ?>
                        <td style="width:200px;">
                              <a href="#" style="color:#191970; font-weight: bold; text-decoration: none;" onclick="return dodajDoKoszyka('<?php echo $this->_tpl_vars['a']['idArtykul']; ?>
', this)">dodaj do koszyka</a>
                        </td>
                   <?php  }  ?>
               </tr>
               <?php $nr+=1; ?>
           <?php endforeach; endif; unset($_from); ?> 

</table>