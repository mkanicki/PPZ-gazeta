<form method="post" >
    <table style="float: left">
        <th colspan="2">Dodaj Artykul:</th>
        
        <tr>
            <td>Tytu�:</td>
            <td id="td_input"><input type="text" id="Tytul" class="{$bledy.Tytul}" name="Tytul"/></td>
        </tr>
        
        <tr>
            <td>Cena:</td>
            <td id="td_input"><input type="text" id="Cena" class="{$bledy.Cena}" name="Cena"/></td>
        </tr>
        <tr>
            <td>Wydania:</td>
            <td id="td_input">
                <select name="idWydanie">
                    {foreach from=$artykuly item=a name=artykuly}
                    <option value="{$a.idWydanie}">{$a.Tytul}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        
        <tr>
            <td></td>
            <td id="td_input">
                 <input type="submit" id="Dodaj" name="Dodaj" value="Dodaj"/>
            </td>
        </tr>
    </table>
</form>
