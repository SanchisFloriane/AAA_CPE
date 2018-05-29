<div class="input-group">
    <input id="txtFilter" type="text" class="form-control" onkeyup="filter()"
           placeholder="Filtrer les pathologies (regexp)"
           aria-label="Filtrer les pathologies (regexp)"
           aria-describedby="basic-addon2">

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


<table class="table">
    <thead>
    <tr>
        <th scope="col">Type</th>
        <th scope="col">First</th>
        <th scope="col">Second</th>
        <th scope="col">Third</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$pathos item=patho}
    <tr data-meridien="{$patho->getMer()}"  onclick="$('#pathos-detail-{$patho->getIdP()}').collapse('toggle')">
        <th class="type" scope="row">{$patho->getType()}</th>
        <td>{$patho->getMer()}</td>
        <td class="desc">{$patho->getDesc()}</td>
        <td>{$patho->getIdP()}</td>
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
        return str.replace(/[\-\[\]\/\(\)\*\+\?\.\\\^\$]/g, "\\$&");
    }

    function filter() {
        const reducer = (regex, current) =>  regex +'|'+ current.dataset.regex;
        let caracteristiques = $("#caracteristiquesToggles").children(".active").toArray().reduce(reducer, '');
        let types = $("#typeToggles").children(".active").toArray().reduce(reducer, '');
        let meridiens = $("#meridienToggles").children(".active").toArray().reduce(reducer, '');
        let regexp = '';
            regexp+=types;
            regexp+=caracteristiques;
            regexp=escapeRegExp(regexp).substr(1);
        let regexpMeridien = escapeRegExp(meridiens.substr(1));

        $('.type').each(function () {
            $(this).parent().toggleClass("d-none",!$(this).text().match(regexp))
        });

        $("[data-meridien]:not(.d-none)").each(function () {
            $(this).toggleClass("d-none",!$(this).first().data('meridien').match(regexpMeridien))
        });


        $("[data-meridien]:not(.d-none)").children('.desc').each(function () {
            let hide = ($(this).text().match($('#txtFilter').val()) === null);
            $(this).parent().toggleClass("d-none", hide)
        });

    }
</script>
