<table class="">
    <tr>
        <th>Lp.</th>
        <th>Id Wydania</th>
        <th>Tytul</th>
        <th>Id Artykułu</th>
        <th>Data wydania</th>
        <th>Data artykułu</th>
        <th>Cena</th>
    </tr> 
    {foreach from=$wydania item=w name=wydania}
        <tr>
            <td>{$smarty.foreach.wydania.iteration}</td>
            <td>{$w.idWydanie}</td>
            <td>{$w.Tytul}</td>
            <td>{if $w.idArtykul == null} - {else} {$w.idArtykul} {/if}</td>
            <td>{$w.DataWydania}</td>
            <td>{if $w.DataArtykul == null} - {else} {$w.DataArtykul} {/if}</td>
            <td>{if $w.Cena == null} - {else} {$w.Cena} {/if}</td>
        </tr>
    {/foreach}
        
</table>
