function showRSS(str) {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("rssOutput").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","controller/getrss.php?q="+str,true);
    xmlhttp.send();
}

$(document).ready(function() {

    //Change flux RSS
    var nbArticle = 0;
    setInterval(function() {
        showRSS(nbArticle.toString());
        nbArticle++;
        if(nbArticle == 9)
        {
            nbArticle = 0;
        }
    }, 3000);
})
