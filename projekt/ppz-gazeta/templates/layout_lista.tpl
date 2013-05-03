{if $smarty.get.msg == '1'}
	<p class="msg">Rejestracja pomyslna. </p>
{/if}
{if $smarty.get.msg == '2'}
	<p class="msg">Logowanie pomyslne. </p>
{/if}

  
	{foreach from = $pokaz_mini_wydania item = m}
           
            <div id='{$m.idWydanie}' class='miniatura_container' onmouseover= "showView( '{$m.SciezkaZdjecia}','1111')"  onmouseout= " hideView()" onclick=" return PokazWydanie('{$m.SciezkaZdjecia}','{$m.idWydanie}')">
                <img class='miniatura'  title="{$m.Tytul}: {$m.data}" src="{$m.SciezkaZdjecia}" />
            </div>
           
	{/foreach}    
        
       