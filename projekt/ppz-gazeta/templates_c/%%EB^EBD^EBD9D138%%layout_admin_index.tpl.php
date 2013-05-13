<?php /* Smarty version 2.6.26, created on 2013-05-13 21:47:10
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
			<a href="admin.uzytkownicy.edycja.php?id=<?php echo $this->_tpl_vars['u']['id']; ?>
">edytuj</a> |
			<a href="#">usuñ</a>
		</td>
	</tr>
   <?php endforeach; endif; unset($_from); ?>

</table>