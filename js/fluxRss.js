function showRSS(str) {
    if (str.length==0) {
        document.getElementById("rssOutput").innerHTML="";
        return;
    }
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
    xmlhttp.open("GET","../Controller/getrss.php?q="+str,true);
    xmlhttp.send();
}
$(document).ready(function() {

    //Change flux RSS
    var nbArticle = 0;
    setInterval(function() {
        showRSS(nbArticle.toString());
        nbArticle++;
        if(nbArticle == 4)
        {
            nbArticle = 0;
        }
    }, 3000);
});

