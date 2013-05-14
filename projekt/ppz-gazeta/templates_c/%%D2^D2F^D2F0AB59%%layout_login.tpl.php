<?php /* Smarty version 2.6.26, created on 2013-04-22 20:53:30
         compiled from layout_login.tpl */ ?>
<form method="post">
    <table style="float: right">
        <?php if ($this->_tpl_vars['msg']): ?>
            <tr><td class="warning" colspan="2"><?php echo $this->_tpl_vars['msg']; ?>
</td></tr>
        <?php endif; ?>
        <th colspan="2">Zaloguj siê:</th>
        
        <tr>
            <td>Login:</td>
            <td><input type="text" id="user" name="username" <?php if ($this->_tpl_vars['usertext'] != null): ?>value=<?php echo $this->_tpl_vars['usertext']; ?>
<?php endif; ?> /></td>
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