

{if !(is_bool($user)&&!$user)}
<div class="input-group">
    <input id="txtFilter" type="text" class="form-control" onkeyup="filter()"
           placeholder="Filtrer les pathologies par mots-clés (regexp)"
           aria-label="Filtrer les pathologies par mots-clés (regexp)"
           aria-describedby="basic-addon2"/>

    <div class="input-group-append">
        <div class="btn-group">
            <button class=" btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Méridien </button>
            <ul id="meridienToggles" class="dropdown-menu scrollable-menu">
                {foreach from=$meridiens item=meridien}
                    <div class="dropdown-item" data-regex="{$meridien->getCode()}" tabIndex="-1">{$meridien->getNom()}</div>
                {/foreach}
            </ul>
        </div>
        <div class="btn-group">
            <button class=" btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">Type </button>
            <ul id="typeToggles" class="dropdown-menu scrollable-menu">
                {foreach from=$typePathos key=nom item=regex}
                    <div class="dropdown-item" data-regex="{$regex}" tabIndex="-1">&nbsp;{$nom}</div>
                {/foreach}
            </ul>
        </div>
        <div class="btn-group">
           <button class=" btn-outline-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Caractéristiques </button>
            <ul id="caracteristiquesToggles" class="dropdown-menu scrollable-menu">
               {foreach from=$caracteristiquesPathos key=nom item=regex}
                    <div class="dropdown-item" data-regex="{$regex}" tabIndex="-1">&nbsp;{$nom}</div>
                {/foreach}
            </ul>
        </div>


    </div>
    {* <div id="filterType" class="input-group-append">

         <button data-type="plein"       class="active btn btn-outline-primary"    data-toggle="button" aria-pressed="true" autocomplete="off"  type="button">Plein</button>
         <button data-type="poumon"      class="active btn btn-outline-success"    data-toggle="button" aria-pressed="true" autocomplete="off"  type="button">Poumon</button>
         <button data-type="meridien"    class="active btn btn-outline-danger"     data-toggle="button" aria-pressed="true" autocomplete="off"  type="button">Méridien</button>
     </div>*}
</div>
{/if}

<table class="table">
    <thead>
    <tr>
        <th scope="col">Méridien</th>
        <th colspan="2" scope="col">Description</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$pathologies item=patho}
    <tr data-meridien="{$patho->getCodeMer()}" data-type="{$patho->getType()}" data-motcles="{$patho->getmotcles()}"  onclick="$('#pathos-detail-{$patho->getIdP()}').collapse('toggle')">
        <td>{$patho->getNomMer()|ucfirst}</td>
        <td class="desc">{$patho->getDesc()|ucfirst}</td>
        <td class="searchResult"></td>
        <tbody id="pathos-detail-{$patho->getIdP()}" class="collapse">

        </tbody>
    {/foreach}
    </tbody>
</table>

<script>

    $("#filterType").children().on('click', function (e) {
        e.stopImmediatePropagation()
        $(this).button('toggle');

        // do some stuff
        filter();
    });
    $("#meridienToggles").children().on('click', selectAndFilter);
    $("#typeToggles").children().on('click', selectAndFilter);
    $("#caracteristiquesToggles").children().on('click', selectAndFilter);

    function selectAndFilter(e) {
        e.stopImmediatePropagation()
        $(this).toggleClass('active');
        // do some stuff
        filter();
    }

    $("[id^='pathos-detail-']").on('show.bs.collapse', function (e) {
        $.get('?page=pathologie/'+e.target.id.replace('pathos-detail-', ''), function (data) {
            e.target.innerHTML = data;
        });

    });
    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\(\)\*\+\?\.\\]/g, "\\$&");
    }

    function filter() {
        $("[id^='pathos-detail-']").collapse('hide');
        $("[data-motcles]").each(function () {
            $(this).toggleClass("d-none",false);
        });
        var caracteristiques = $("#caracteristiquesToggles").children(".active").toArray().reduce((regex, current) =>  regex +'|'+ current.dataset.regex+'$', '');
        var types = $("#typeToggles").children(".active").toArray().reduce((regex, current) =>  regex +'|'+ current.dataset.regex, '');
        var meridiens = $("#meridienToggles").children(".active").toArray().reduce((regex, current) =>  regex +'|'+ current.dataset.regex, '');
        var regexp = '';
            if(escapeRegExp(types).substr(1)!=="")
                regexp+='('+escapeRegExp(types).substr(1)+')';
            regexp+='.*';
            if(escapeRegExp(caracteristiques).substr(1)!=="")
                regexp+='('+escapeRegExp(caracteristiques).substr(1)+')';
        var regexpMeridien = escapeRegExp(meridiens.substr(1));

        $('[data-type]:not(.d-none)').each(function () {
            $(this).parent().toggleClass("d-none",!$(this).first().data('type').match(regexp))
        });

        $("[data-meridien]:not(.d-none)").each(function () {
            $(this).toggleClass("d-none",!$(this).first().data('meridien').match(regexpMeridien))
        });


        $("[data-motcles]:not(.d-none)").each(function () {
            var $txtFilter = $('#txtFilter').val().trim();
            $(this).children('.searchResult').text('');
            if($txtFilter==="")return;
            var val = '.*'+$txtFilter+'.*';
            var match = $(this).data('motcles').match(val);
            var hide = (match === null);
            $(this).parent().toggleClass("d-none", hide);
            if(match!==null){
                var filter1 = $(this).data('motcles').split(',').filter(word => word.match(val));
                $(this).children('.searchResult').text(filter1.join(', '))
            }

        });

    }
</script>
