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
        <li>SANCHIS Floriane</li>
        <li>PICOT Alexis</li>
        <li>DUMAS Tanguy</li>
        <li>DEPASSE Sébastien</li>
        <li>DE PAOLI Benoit</li>
        <li>LEPINE Flavien</li>
        <li>PRACCA Basile</li>
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
            <li><a href = "https://www.smarty.net/docsv2/fr/">https://www.smarty.net/docsv2/fr/</a></li>
            <li><a href = "http://php.net/">http://php.net/</a></li>
            <li><a href = "https://stackoverflow.com/">https://stackoverflow.com/</a></li>
            <li><a href = "https://www.docker.com/">https://www.docker.com/</a></li>
        </ul>
</div>

<div id="Webographie" class="tabcontent jumbotron bg-light pt-2 pb-2">
    <h3>Webographie</h3>
    <br>
    <p>Voici la webographie utilisée :
        <ul>
            <li><a href ="https://github.com/dropbox/zxcvbn/blob/master/README.md">https://github.com/dropbox/zxcvbn/blob/master/README.md</a></li>
            <li><a href ="https://www.siteground.com/tutorials/phpmyadmin/query/">https://www.siteground.com/tutorials/phpmyadmin/query/</a></li>
            <li><a href ="https://openclassrooms.com/courses/un-moteur-de-template-smarty">https://openclassrooms.com/courses/un-moteur-de-template-smarty</a></li>
            <li><a href ="https://www.wanadev.fr/23-tuto-docker-comprendre-docker-partie1/">https://www.wanadev.fr/23-tuto-docker-comprendre-docker-partie1/</a></li>
            <li><a href ="https://www.w3schools.com/pHP/default.asp">https://www.w3schools.com/pHP/default.asp</a></li>
        </ul>
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