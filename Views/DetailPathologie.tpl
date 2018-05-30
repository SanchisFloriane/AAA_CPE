<!DOCTYPE html>
<html lang="fr" >
  <head>
    <title>Detail Pathologie</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
<table>
<tr>
    <td colspan="1" class="p-0">
        <div >
            <div class="container bg-light p-3 ">
                <p>
                {if $patho->getYinMer() eq '1'}
                    <h2 class="float-right"><span class="badge badge-default badge-success">Yin</span></h2>
                {/if}
                <h3 class="display-4">{$patho->getDesc()|ucfirst}<br>{$patho->getNomMer()}</h3>
                <p class="lead">
                {assign var="keywords" value=","|explode:$patho->getSymptomes()}
                {foreach from=$keywords item=keyword}
                    <span class="badge badge-pill badge-primary">{$keyword|trim|ucfirst}</span>
                {/foreach}</p>
            </div>
        </div>
    </td>
</table>