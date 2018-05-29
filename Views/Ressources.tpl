<div class="tab">
    <button class="tablinks" onclick="openMenu(event, 'Auteurs')" id="defaultOpen">Auteurs</button>
    <button class="tablinks" onclick="openMenu(event, 'Bibliographie')">Bibliographie</button>
    <button class="tablinks" onclick="openMenu(event, 'Sources')" >Sources</button>
    <button class="tablinks" onclick="openMenu(event, 'Webographie')">Webographie</button>
</div>

<div id="Auteurs" class="tabcontent jumbotron bg-light pt-2 pb-2">
    <h3>Auteurs</h3>
    <br>
    <ul>
        <li>Sanchis Floriane</li>
        <li>Picot Alexis</li>
        <li>Dumas Tanguy</li>
        <li>Dépasse Sébastien</li>
        <li>De Paoli Benoit</li>
        <li>Lepine Flavien</li>
        <li>Pracca Basile</li>
    </ul>
</div>

<div id="Bibliographie" class="tabcontent jumbotron bg-light pt-2 pb-2">
    <h3>Bibliographie</h3>
    <br>
    <p>Nous n'avons pas utilisé de livre pour nos recherches.</p>
</div>

<div id="Sources" class="tabcontent jumbotron bg-light pt-2 pb-2">
    <h3>Sources</h3>
    <br>
    <p>Voici les sources que l'on a utilisées :
        <ul>
            <li>https://www.smarty.net/docsv2/fr/</li>
            <li>http://php.net/</li>
            <li>https://stackoverflow.com/</li>
            <li>https://www.docker.com/</li>
        </ul>
    </p>
</div>

<div id="Webographie" class="tabcontent jumbotron bg-light pt-2 pb-2">
    <h3>Webographie</h3>
    <br>
    <p>Voici la webographie utilisée :
        <ul>
            <li>https://github.com/dropbox/zxcvbn/blob/master/README.md</li>
            <li>https://www.siteground.com/tutorials/phpmyadmin/query/</li>
            <li>https://openclassrooms.com/courses/un-moteur-de-template-smarty</li>
            <li>https://www.wanadev.fr/23-tuto-docker-comprendre-docker-partie1/</li>
            <li>https://www.w3schools.com/pHP/default.asp</li>
        </ul>
    </p>
</div>

<script>

    function openMenu(evt, itemMenu) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(itemMenu).style.display = "block";
        evt.currentTarget.className += " active";
    }


    $(document).ready(function() {
    // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    });

</script>