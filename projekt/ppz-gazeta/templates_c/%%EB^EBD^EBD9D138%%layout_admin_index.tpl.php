<?php /* Smarty version 2.6.26, created on 2013-05-13 22:47:03
         compiled from layout_admin_index.tpl */ ?>
<table>
    <tr>
        <th>Lp.</th>
        <th>Imiê</th>
        <th>Nazwisko</th>
        <th>Nazwa u¿ytkownika</th>
        <th>Data rejestracji</th>
        <th>Rola</th>
    </tr>
    
   <?php $_from = $this->_tpl_vars['uzytkownicy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['uzytkownicy'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['uzytkownicy']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['u']):
        $this->_foreach['uzytkownicy']['iteration']++;
?>
	<tr>
		<td><?php echo $this->_foreach['uzytkownicy']['iteration']; ?>
</td>
		<td><?php echo $this->_tpl_vars['u']['Imie']; ?>
</td>
		<td><?php echo $this->_tpl_vars['u']['Nazwisko']; ?>
</td>
		<td><?php echo $this->_tpl_vars['u']['Login']; ?>
</td>
		<td><?php echo $this->_tpl_vars['u']['rola']; ?>
</td>
        <td>
			<a href="admin_edituser.php?id=<?php echo $this->_tpl_vars['u']['idUzytkownik']; ?>
">edytuj</a> |
			<a onclick="return confirm('Czy na pewno chcesz usun¹æ u¿ytkownika?');" href="admin_removeuser.php?id=<?php echo $this->_tpl_vars['u']['idUzytkownik']; ?>
">usuñ</a> |
            <a href="admin_resetpassword.php?id=<?php echo $this->_tpl_vars['u']['idUzytkownik']; ?>
">reset has³a</a>
		</td>
	</tr>
   <?php endforeach; endif; unset($_from); ?>

</table>