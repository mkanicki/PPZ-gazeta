<form method="post">
    <table style="float: right">
        <th colspan="2">Zarejestruj siê:</th>
        
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
        
        <tr>
            <td>Has³o:</td>
            <td><input type="password" id="pass1" class="{$bledy.Haslo}" name="Haslo"/></td>
        </tr>
        
        <tr>
            <td>PotwierdŸ has³o:</td>
            <td><input type="password" id="pass2" class="{$bledy.Haslo2}" name="Haslo2"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="register" name="register" value="Zarejestruj"/>
            </td>
        </tr>
    </table>

</form>
