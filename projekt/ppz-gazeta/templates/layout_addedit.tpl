<form method="post" >
    <table style="float: right">
        <th colspan="2">{if isset($uzytkownik.idUzytkownik)}Edycja danych{else}Zarejestruj siê:{/if}</th>
        
        <tr>
            <td>Imiê:</td>
            <td><input type="text" id="Imie" value="{$uzytkownik.Imie}" class="{$bledy.Imie}" name="Imie"/></td>
        </tr>
        
        <tr>
            <td>Nazwisko:</td>
            <td><input type="text" id="Nazwisko" value="{$uzytkownik.Nazwisko}" class="{$bledy.Nazwisko}" name="Nazwisko"/></td>
        </tr>
        
        <tr>
            <td>Adres e-mail:</td>
            <td><input type="text" id="Email" value="{$uzytkownik.Email}" class="{$bledy.Email}" name="Email"/></td>
        </tr>
        
        <tr>
            <td>Login:</td>
            <td><input type="text" id="Login" value="{$uzytkownik.Login}" class="{$bledy.Login}" name="Login"/></td>
        </tr>
        
        {if !isset($uzytkownik.idUzytkownik)}
            <tr>
                <td>Has³o:</td>
                <td><input type="password" id="pass1" class="{$bledy.Haslo}" name="Haslo"/></td>
            </tr>
            
            <tr>
                <td>PotwierdŸ has³o:</td>
                <td><input type="password" id="pass2" class="{$bledy.Haslo2}" name="Haslo2"/></td>
            </tr>
        {/if}
        
        
        <tr>
            <td></td>
            <td>
                {if isset($uzytkownik.idUzytkownik)}
                    <input type="submit" id="edit" name="edit" value="Edytuj"/>
                {else}
                    <input type="submit" id="register" name="register" value="Zarejestruj"/>
                {/if}
                
            </td>
        </tr>
    </table>

</form>
