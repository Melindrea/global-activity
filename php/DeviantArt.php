<?php

//Function to simulate the WP function of the same name, remove when going a bit
//more live...
function wp_remote_get($url=null, $args=null)
{
    /* ERROR
    Array
(
    [headers] => Array
        (
            [server] => Apache
            [content-type] => text/html
            [date] => Tue, 09 Apr 2013 10:54:55 GMT
            [keep-alive] => timeout=45
            [connection] => close
            [content-length] => 114
        )

    [body] => 404 Not Found (http://www.deviantart.com/art/826) The URL http://www.deviantart.com/art/826 is not a deviation URL
    [response] => Array
        (
            [code] => 404
            [message] => Not Found
        )

    [cookies] => Array
        (
        )

    [filename] =>
)
     /*
    Array
(
    [headers] => Array
        (
            [server] => Apache
            [vary] => Accept-Encoding
            [cache-control] => max-age=180
            [content-type] => application/json; charset=utf-8
            [content-encoding] => deflate
            [date] => Tue, 09 Apr 2013 10:56:17 GMT
            [keep-alive] => timeout=45
            [expires] => Tue, 09 Apr 2013 10:59:17 GMT
            [connection] => close
            [content-length] => 288
        )

    [body] => {"version":"1.0","type":"photo","title":"Cassandra","category":"Digital Art > Drawings & Paintings > People > Fantasy","url":"http://fc03.deviantart.net/fs71/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","author_name":"stuntkid","author_url":"http://stuntkid.deviantart.com","provider_name":"deviantART","provider_url":"http://www.deviantart.com","thumbnail_url":"http://th08.deviantart.net/fs71/300W/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","thumbnail_url_150":"http://th03.deviantart.net/fs71/150/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","thumbnail_width":300,"thumbnail_height":300,"width":"800","height":"800"}
    [response] => Array
        (
            [code] => 200
            [message] => OK
        )

    [cookies] => Array
        (
        )

    [filename] =>
)
    */
   return array(
        "response" => array( "code" => 200, "message" => "OK"),
        //"body" => '404 Not Found (http://www.deviantart.com/art/826) The URL http://www.deviantart.com/art/826 is not a deviation URL',
        "body" => '{"version":"1.0","type":"photo","title":"Cassandra","category":"Digital Art > Drawings & Paintings > People > Fantasy","url":"http://fc03.deviantart.net/fs71/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","author_name":"stuntkid","author_url":"http://stuntkid.deviantart.com","provider_name":"deviantART","provider_url":"http://www.deviantart.com","thumbnail_url":"http://th08.deviantart.net/fs71/300W/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","thumbnail_url_150":"http://th03.deviantart.net/fs71/150/f/2013/098/1/2/cassandra_by_stuntkid-d60w0lm.jpg","thumbnail_width":300,"thumbnail_height":300,"width":"800","height":"800"}',
    );

}

$user = 'melindrea82';
$oEmbedUrl = "http://backend.deviantart.com/oembed?url=";


//RSS feed
$url = 'http://backend.deviantart.com/rss.xml?type=deviation&q=by%3A'.$user.'+sort%3Atime+meta%3Aall';
$doc = new DOMDocument();
$doc->load($url);
$deviations = array();
foreach ($doc->getElementsByTagName('item') as $node) {
    $link = $node->getElementsByTagName('link')->item(0)->nodeValue;
    $pubDate = $node->getElementsByTagName('pubDate')->item(0)->nodeValue;

    $pattern = "/\/art/i";
    if (preg_match($pattern, $link)) {
        $remote = wp_remote_get($oEmbedUrl.$link);
        $oEmbeded = json_decode($remote['body']);

        if (($remote['response']['code'] == 200) && ($oEmbeded != null)) {
            $oEmbeded->pubDate = strtotime($pubDate);
            array_push($deviations, $oEmbeded);
        }
    }
}

print_r($deviations);

