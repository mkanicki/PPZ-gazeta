<?php /* Smarty version 2.6.26, created on 2013-04-25 17:29:24
         compiled from tabelka.tpl */ ?>
<?php $nr=1; ?> 

<img id="2222" src='<?php echo $this->_tpl_vars['wydanie_name']; ?>
'>

<table id="3333" class="tableWydanieKoszyk" >
      <tr style=" background-color: #B0C4DE; font-weight: bold;"><td style="text-align:left; width:20px;">Lp.</td> <td>Tytu³</td> <td>Cena</td> <td>Liczba pobrañ</td> <td></td></tr>

            <?php if ($this->_tpl_vars['artykuly_wydania'] == null): ?> <tr ><td colspan="5" style=" background-color:#DF6F6F; text-align:center; color:white;  font-weight:bold; ">Wydanie nie zawiera artyku³ów</td></tr><?php endif; ?>
           <?php $_from = $this->_tpl_vars['artykuly_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
               <tr><td style="text-align:left; width:20px;"><?php echo $nr; ?></td> <td><?php echo $this->_tpl_vars['a']['Tytul']; ?>
</td> <td><?php echo $this->_tpl_vars['a']['Cena']; ?>
 zl</td>  <td><?php echo $this->_tpl_vars['a']['LiczbaPobran']; ?>
</td><td><a href="" >dodaj do koszyka</a></td></tr>
                <?php $nr+=1; ?>
           <?php endforeach; endif; unset($_from); ?> 

</table>