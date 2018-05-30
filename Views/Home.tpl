<div class="jumbotron bg-light pt-2 pb-2">
    <h1 id="titleAccueil" class="align-self-center display-4 col">Bienvenue sur le site LI CHIN'ZEN</h1>
    <hr class="my-4">
    <div class="d-flex p-2 row">
        <div class="align-self-center col">
            <p class="lead">L’association des acupuncteurs met à votre disposition une plateforme en ligne dont les principales fonctionnalités sont :
            <ul>
                <li>1. De disposer d’un service en ligne leur permettant de consulter la liste des symptômes des
                    principales pathologies en acupuncture.</li>
                <li>2. De pouvoir n’afficher que certaines des pathologies en fonction de différents critères (type de
                    pathologie, choix des méridiens, etc.(voir la table 7.2).</li>
                <li>3. De rechercher les pathologies comportant certains symptômes.</li>
                <li>4. De recevoir le flux RSS de Google concernant l'actualité sur le mot : acupuncture</li>
            </ul>
        </div>
        <img src="img/logo.png" class="img-fluid rounded col-2 logoAccueil" alt="logo LI CHINZEN">
    </div>
    <hr class="my-4">

      <div id="rssOutput" class="d-flex p-2 row">
        <h2 id="titleRSS"></h2>
        <br>
        <p id="descriptionRSS"></p>
        <br>
    </div>


<script type="text/javascript">
    var url = "https://news.google.com/news/rss/search/section/q/acupuncture?hl=fr&gl=FR&ned=fr"; //feed url
var xhr = createCORSRequest("GET","https://api.rss2json.com/v1/api.json?rss_url="+url);
if (!xhr) {
  throw new Error('CORS not supported');
} else {
    xhr.send();
}
xhr.onreadystatechange = function() {
    if (xhr.readyState==4 && xhr.status==200) {
        var responseText = xhr.responseText;
        var result = JSON.parse(responseText);

var i =0;
        setInterval(function(){
            var e= result.items[i];
            $('#titleRSS').html(e.title);
            $('#descriptionRSS').html(e.description);
            i++;
            if(result.items.indexOf(e)===result.items.length)
                i=0;

        }
            , 3000);

       
    }
}
function createCORSRequest(method, url) {
    var xhr = new XMLHttpRequest();
    if ("withCredentials" in xhr) {
        xhr.open(method, url, true);
    } else if (typeof XDomainRequest != "undefined") {
        xhr = new XDomainRequest();
        xhr.open(method, url);
    } else {
        xhr = null;
    }
    return xhr;
}
</script>
</div>