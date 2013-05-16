<div id="list">
{foreach from=$wydania item=w name=wydania}
        
        
        <ul>
            <li>Id Wydania: {$w.idWydanie}, Tytuł: {$w.Tytul}
                <ul>
            {foreach from=$artykul item=a name=artykul}
                {if $w.idWydanie == $a.idWydanie}
                <li>
                    <td>Id artykułu: {$a.idArtykul}</td>
                    <td>Tytuł: {$a.Tytul}</td>
                </li>
                {/if}
            {/foreach}
            </ul>
            </li>
            
        </ul>
    {/foreach}
</div>
