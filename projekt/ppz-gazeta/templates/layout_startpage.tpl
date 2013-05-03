{php}$nr=0;   {/php}
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
    <div class="label_newest"> Najnowowsze wydania</div>
    <div class="wishes">¿yczymy owocnych zakupów</div>
    	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
            
            <div class="ws_images">
                <ul>
                    {foreach from = $pokaz_najnowsze_wydania item = w}
                        <li>
                            <img src="{$w.SciezkaZdjecia}" title="{$w.Tytul}" alt="{$w.Tytul}" id="wows1_{php}echo $nr;{/php}"/>
                        </li>
                        {php}$nr+=1;{/php}
                    {/foreach} 
                </ul>
            </div>
                
            {php}$nr=1;{/php}
            <div class="ws_bullets">
                <div>
                   {foreach from = $pokaz_najnowsze_wydania item = w}                   
                       <a href="#" title="{$w.Tytul}"><img width="45px" height="48px" src="{$w.SciezkaZdjecia}" alt="{$w.Tytul}"/>{php}echo $nr;{/php}</a>
                        {php}$nr+=1;{/php}
                    {/foreach} 
                </div>
            </div>
            <a class="wsl" href="http://wowslider.com">jQuery Auto Image Slider by WOWSlider.com v3.4</a>
           <div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="flow_engine/engine1/wowslider.js"></script>
	<script type="text/javascript" src="flow_engine/engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
</div>