<div id="list">
{foreach from=$wydania item=w name=wydania}
        <ul>
            <li>Id Wydania: {$w.idWydanie}, Tytuł: {$w.Tytul} <a onclick="return confirm('Czy na pewno chcesz usunąć?');" href="admin_removewydanie.php?id={$w.idWydanie}">usuń</a>
                <ul>
            {foreach from=$artykul item=a name=artykul}
                {if $w.idWydanie == $a.idWydanie}
                <li>
                    <td>Id artykułu: {$a.idArtykul}</td>
                    <td>Tytuł: {$a.Tytul}</td>
                    <td><a onclick="return confirm('Czy na pewno chcesz usunąć?');" href="admin_removeartykul.php?id={$a.idArtykul}">usuń</a></td>
                </li>
                {/if}
            {/foreach}
            </ul>
            </li>
            
        </ul>
    {/foreach}
</div>
