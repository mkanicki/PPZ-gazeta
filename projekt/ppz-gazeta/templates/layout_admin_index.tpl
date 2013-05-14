<table>
    <tr>
        <th>Lp.</th>
        <th>Imiê</th>
        <th>Nazwisko</th>
        <th>Nazwa u¿ytkownika</th>
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
        <td>
			<a href="admin_edituser.php?id={$u.idUzytkownik}">edytuj</a> |
			<a onclick="return confirm('Czy na pewno chcesz usun¹æ u¿ytkownika?');" href="admin_removeuser.php?id={$u.idUzytkownik}">usuñ</a> |
            <a href="admin_resetpassword.php?id={$u.idUzytkownik}">reset has³a</a>
		</td>
	</tr>
   {/foreach}

</table>