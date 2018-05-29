<?php

/*require_once("feedparser.php");
echo "ok";
echo FeedParser("https://news.google.com/news/rss/search/section/q/pathology/pathology?hl=en&gl=US&ned=us", 5);
*/
//get the q parameter from URL
$q = $_GET["q"];

//find out which feed was selected
    $xml = ("https://news.google.com/news/rss/search/section/q/pathology/pathology?hl=en&gl=US&ned=us");

    $xmlDoc = new DOMDocument();
    $xmlDoc->load($xml);


    //get and output "<item>" elements
    $x = $xmlDoc->getElementsByTagName('item');
    $item_title = $x->item(intval($q))->getElementsByTagName('title')
        ->item(0)->childNodes->item(0)->nodeValue;
    $item_link = $x->item(intval($q))->getElementsByTagName('link')
        ->item(0)->childNodes->item(0)->nodeValue;
    $item_desc = $x->item(intval($q))->getElementsByTagName('description')
        ->item(0)->childNodes->item(0)->nodeValue;

echo("<h2 class=\"titleRSS\"><p><a href = '" . $item_link . "'>" . $item_title . "</a></h2>");
echo("<br>");
echo("<p class=\"descriptionRSS\">". $item_desc ."</p>");
echo("<br>");
?>

