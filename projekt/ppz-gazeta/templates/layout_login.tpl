<form method="post">
    <table style="float: right">
        {if $msg}
            <tr><td class="warning" colspan="2">{$msg}</td></tr>
        {/if}
        <th colspan="2">Zaloguj siê:</th>
        
        <tr>
            <td>Login:</td>
            <td><input type="text" id="user" name="username" {if $usertext!=null}value={$usertext}{/if} /></td>
        </tr>
        
        <tr>
            <td>Has³o</td>
            <td><input type="password" id="pass" name="password"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="login" name="login" value="Zaloguj"/>
            </td>
        </tr>
    </table>

</form>
