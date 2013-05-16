<form method="post">
<table class="">
    <tr>
        <td>Imie:</td><td>{$uzytkownik.Imie}</td>
    </tr>
    <tr>
        <td>Nazwisko:</td><td>{$uzytkownik.Nazwisko}</td>
    </tr>
    <tr>
        <td>Login:</td><td>{$uzytkownik.Login}</td>
    </tr>
    <tr>
        <td>Aktualna rola:</td><td>{php}echo $_GET['rola']{/php}</td>
    </tr>
    <tr>
            <td>Nadaj rolê:</td>
            
            <td>
                <select name="idRola" style="width: auto;">
                    {foreach from=$role item=r}
                        <option value="{$r.idRola}">{$r.Nazwa}</option>
                    {/foreach}
                </select>
            </td>
           
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="edytuj" value="Edytuj"/></td>
    </tr>
</table>
</form>
