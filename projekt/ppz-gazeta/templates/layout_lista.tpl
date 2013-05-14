      <span style="margin-left: 70px; font-size: 20px; color:#191970;"><b> Wydania </b></span>
         <br/><br/>
	{foreach from = $pokaz_mini_wydania item = m}
           
            <div id='{$m.idWydanie}' class='miniatura_container' onmouseover= "showView( '{$m.SciezkaZdjecia}','1111')"  onmouseout= " hideView()" onclick=" return PokazWydanie('{$m.SciezkaZdjecia}','{$m.idWydanie}')">
                <img class='miniatura'  title="{$m.Tytul}: {$m.data}" src="{$m.SciezkaZdjecia}" />
            </div>
           
	{/foreach}    
        
       