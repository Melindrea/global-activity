<?php

// Klass som handskas med cachen och hämtar upp de olika feedsen beroende på
// hur många man vill ha, och troligtvis litet andra parametrar

/*
function smk_meta_statistics()
{
    $key = 'title_meta_optimiser_count';
    $count = get_transient($key);
    if ($count) { //False-y, if it does not have a value, it should move on
        return $count;
    }
    $api = new Rubus_Api();
    $json = json_decode($api->fetch('statistics', '4ShZyDo%rsiSwnrZ!DjCCW{'), true);
    if (count($json['errors']) > 0) {
        return get_option($key);
    } else {
        $count = $json['count'];
        set_transient($key, $count, 60*30);
        update_option($key, $count);
        return $count;
    }
}

public function fetch($action, $password, $body = array())
{
    $apiURL = $this->url.'/'.$action;
    $body['password'] = $password;
    $args = array(
        'headers' => $this->headers,
        'body' => $body,
        'sslverify' => false,
    );

    $response = wp_remote_post($apiURL, $args);
    if (is_wp_error($response)) {
        return '{"errors":["Vi kan inte hämta din sida just nu"]}';
    } else {
        return wp_remote_retrieve_body($response);
    }
}
 */
