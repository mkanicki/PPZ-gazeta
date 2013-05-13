<?php /* Smarty version 2.6.26, created on 2013-05-13 21:47:08
         compiled from layout_startpage.tpl */ ?>
<?php $nr=0;    ?>
<div id="axis" >
    <form action="" method="POST">
        <table  id="search">
            <tr>
                <td> <input style="margin-left: 32px;" size="50" type="text" name="txtWyszukaj"> </td>
                <td> <input style="margin-left: 8px;" type="button" name="btnWyszukaj" value="Wyszukaj"></td>
            </tr>
        </table>
    </form>
    <img class="object arrow move-left" src="images/strzala.png"/>
    <div class="label_newest"> Najnowsze wydania</div>
    <div class="wishes">¿yczymy owocnych zakupów</div>
    	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
            
            <div class="ws_images">
                <ul>
                    <?php $_from = $this->_tpl_vars['pokaz_najnowsze_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['w']):
?>
                        <li>
                            <img src="<?php echo $this->_tpl_vars['w']['SciezkaZdjecia']; ?>
" title="<?php echo $this->_tpl_vars['w']['Tytul']; ?>
" alt="<?php echo $this->_tpl_vars['w']['Tytul']; ?>
" id="wows1_<?php echo $nr; ?>"/>
                        </li>
                        <?php $nr+=1; ?>
                    <?php endforeach; endif; unset($_from); ?> 
                </ul>
            </div>
                
            <?php $nr=1; ?>
            <div class="ws_bullets">
                <div>
                   <?php $_from = $this->_tpl_vars['pokaz_najnowsze_wydania']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['w']):
?>                   
                       <a href="#" title="<?php echo $this->_tpl_vars['w']['Tytul']; ?>
"><img width="45px" height="48px" src="<?php echo $this->_tpl_vars['w']['SciezkaZdjecia']; ?>
" alt="<?php echo $this->_tpl_vars['w']['Tytul']; ?>
"/><?php echo $nr; ?></a>
                        <?php $nr+=1; ?>
                    <?php endforeach; endif; unset($_from); ?> 
                </div>
            </div>
            <a class="wsl" href="http://wowslider.com">jQuery Auto Image Slider by WOWSlider.com v3.4</a>
           <div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="flow_engine/engine1/wowslider.js"></script>
	<script type="text/javascript" src="flow_engine/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
</div>