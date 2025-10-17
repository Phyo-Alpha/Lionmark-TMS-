<?php

/* Build breadcrumb*/

$breadcrumb = array();

// get Home link class
$home_active = false;
if (!isset($match['params']['item'])) {
    $home_active = true;
}

$home_link = 'home';
if (DEMO) {
    $home_link = 'home?lang=' . LANG;
}

// Add Home link
$breadcrumb[] = array(
    'active' => $home_active,
    'link'   => $home_link,
    'text'   => '<i class="' . ICON_HOME . '"></i>'
);

// get current item
if (isset($match['params']['item'])) {
    $text         = '';
    $json         = file_get_contents('crud-data/db-data.json');
    $json_data    = json_decode($json, true);
    $current_item = $match['params']['item'];
    foreach ($json_data as $table => $data) {
        if ($data['item'] == $current_item) {
            $text = $data['table_label'];
        }
    }
    $breadcrumb[] = array(
        'active' => true,
        'link'   => $current_item,
        'text'   => $text
    );
}
