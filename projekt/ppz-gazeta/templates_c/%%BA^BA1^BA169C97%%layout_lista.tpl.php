<?php /* Smarty version 2.6.26, created on 2013-04-26 18:08:44
         compiled from layout_lista.tpl */ ?>
<?php if ($_GET['msg'] == '1'): ?>
	<p class="msg">Rejestracja pomyslna. </p>
<?php endif; ?>
<?php if ($_GET['msg'] == '2'): ?>
	<p class="msg">Logowanie pomyslne. </p>
<?php endif; ?>

  
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
        
       