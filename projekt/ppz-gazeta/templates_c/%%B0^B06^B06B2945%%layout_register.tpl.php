<?php /* Smarty version 2.6.26, created on 2013-04-22 21:24:31
         compiled from layout_register.tpl */ ?>
<form method="post">
    <table style="float: right">
        <th colspan="2">Zarejestruj siê:</th>
        
        <tr>
            <td>Imiê:</td>
            <td><input type="text" id="Imie" value="<?php echo $this->_tpl_vars['uzytkownik']['Imie']; ?>
" class="<?php echo $this->_tpl_vars['bledy']['Imie']; ?>
" name="Imie"/></td>
        </tr>
        
        <tr>
            <td>Nazwisko:</td>
            <td><input type="text" id="Nazwisko" value="<?php echo $this->_tpl_vars['uzytkownik']['Nazwisko']; ?>
" class="<?php echo $this->_tpl_vars['bledy']['Nazwisko']; ?>
" name="Nazwisko"/></td>
        </tr>
        
        <tr>
            <td>Adres e-mail:</td>
            <td><input type="text" id="Email" value="<?php echo $this->_tpl_vars['uzytkownik']['Email']; ?>
" class="<?php echo $this->_tpl_vars['bledy']['Email']; ?>
" name="Email"/></td>
        </tr>
        
        <tr>
            <td>Login:</td>
            <td><input type="text" id="Login" value="<?php echo $this->_tpl_vars['uzytkownik']['Login']; ?>
" class="<?php echo $this->_tpl_vars['bledy']['Login']; ?>
" name="Login"/></td>
        </tr>
        
        <tr>
            <td>Has³o:</td>
            <td><input type="password" id="pass1" class="<?php echo $this->_tpl_vars['bledy']['Haslo']; ?>
" name="Haslo"/></td>
        </tr>
        
        <tr>
            <td>PotwierdŸ has³o:</td>
            <td><input type="password" id="pass2" class="<?php echo $this->_tpl_vars['bledy']['Haslo2']; ?>
" name="Haslo2"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" id="register" name="register" value="Zarejestruj"/>
            </td>
        </tr>
    </table>

</form>