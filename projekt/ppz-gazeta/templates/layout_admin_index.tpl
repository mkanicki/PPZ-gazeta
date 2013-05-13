<table>
    <tr>
        <th>Lp.</th>
        <th>Imi�</th>
        <th>Nazwisko</th>
        <th>Nazwa u�ytkownika</th>
        <th>Data rejestracji</th>
        <th>Rola</th>
    </tr>

{foreach from=$uzytkownicy item=u name=uzytkownicy}
    <tr>
		<td>{$smarty.foreach.uzytkownicy.iteration}</td>
		<td>{$u.Imie}</td>
		<td>{$u.Nazwisko}</td>
		<td>{$u.Login}</td>
		<td>{$u.rola}</td>
	    <td><a href="admin_removeuser.php">usu�</a></td>
        <td><a href="admin_resetpassword.php">resetuj has�o</a></td>
        <td><a href="admin_addeditor.php">nadaj rol� redaktora</a></td>
        <td><a href="admin_removeeditor.php">usu� rol� redaktora</a></td>
	</tr>
{/foreach}

</table>
