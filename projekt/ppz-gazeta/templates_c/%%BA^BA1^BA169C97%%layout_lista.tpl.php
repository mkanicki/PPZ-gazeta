<?php /* Smarty version 2.6.26, created on 2013-05-11 00:06:47
         compiled from layout_lista.tpl */ ?>
      <span style="margin-left: 70px; font-size: 20px; color:#191970;"><b> Wydania </b></span>
         <br/><br/>
	<?php $_from = $this->_tpl_vars['pokaz_mini_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['m']):
?>
           
            <div id='<?php echo $this->_tpl_vars['m']['idWydanie']; ?>
' class='miniatura_container' onmouseover= "showView( '<?php echo $this->_tpl_vars['m']['SciezkaZdjecia']; ?>
','1111')"  onmouseout= " hideView()" onclick=" return PokazWydanie('<?php echo $this->_tpl_vars['m']['SciezkaZdjecia']; ?>
','<?php echo $this->_tpl_vars['m']['idWydanie']; ?>
')">
                <img class='miniatura'  title="<?php echo $this->_tpl_vars['m']['Tytul']; ?>
: <?php echo $this->_tpl_vars['m']['data']; ?>
" src="<?php echo $this->_tpl_vars['m']['SciezkaZdjecia']; ?>
" />
            </div>
           
	<?php endforeach; endif; unset($_from); ?>    
        
       