<table>
    <tr>
        <th>Lp.</th>
        <th>Imi�</th>
        <th>Nazwisko</th>
        <th>Nazwa u�ytkownika</th>
        <th>Rola</th>
    </tr>
    
   {foreach from=$uzytkownicy item=u name=uzytkownicy}
	<tr>
		<td>{$smarty.foreach.uzytkownicy.iteration}</td>
		<td>{$u.Imie}</td>
		<td>{$u.Nazwisko}</td>
		<td>{$u.Login}</td>
		<td>{$u.rola}</td>
		<td></td>
        <td>
			<a href="admin_edituser.php?id={$u.idUzytkownik}">edytuj</a> |
			<a onclick="return confirm('Czy na pewno chcesz usun�� u�ytkownika?');" href="admin_removeuser.php?id={$u.idUzytkownik}">usu�</a> |
            <a href="admin_resetpassword.php?id={$u.idUzytkownik}">reset has�a</a> |
            <a href="admin_changerole.php?id={$u.idUzytkownik}&rola={$u.rola}">zmień rolę</a>
		</td>
	</tr>
   {/foreach}

</table>
