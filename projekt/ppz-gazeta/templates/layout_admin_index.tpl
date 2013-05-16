<table>
    <tr>
        <th>Lp.</th>
        <th>Imie</th>
        <th>Nazwisko</th>
        <th>Nazwa uzytkownika</th>
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
        {if $u.idUzytkownik != $iduzytkownika}	
        	<td>
		<a href="admin_edituser.php?id={$u.idUzytkownik}">edytuj</a> |
		<a onclick="return confirm('Czy na pewno chcesz usunac uzytkownika?');" href="admin_removeuser.php?id={$u.idUzytkownik}">usun</a> |
            	<a href="admin_resetpassword.php?id={$u.idUzytkownik}">reset hasla</a> |
            	<a href="admin_changerole.php?id={$u.idUzytkownik}&rola={$u.rola}">zmien role</a>
		</td>
	{/if}
	</tr>
	
   {/foreach}

</table>
