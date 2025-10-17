<?php
use phpformbuilder\database\DB;
session_start();

include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/conf/conf.php';

// register the database connection settings
require_once '../class/phpformbuilder/database/db-connect.php';

// Include the database utility functions
require_once '../class/phpformbuilder/database/DB.php';
$db = new DB();

/* $columns = $db->getColumns('actor');
var_dump($columns); */

/* $values = [
    'actor_id'   => null,
    'first_name' => 'John',
    'last_name'  => 'Why not working ćžčđš',
];
$db->insert('actor', $values); */
$where  = array('last_name' => 'migliori');
$db->delete('actor', $where);

// Begin a transaction
$db->transactionBegin();
try {
    $values = array(
        'actor_id' => null,
        'first_name' => 'gilles',
        'last_name' => 'migliori',
        'last_update' => '2022-09-09 05:05:03'
    );
    if (!$db->insert('actor', $values)) {
        throw new \Exception($db->error());
    }

    // continue if no error was thrown
    $lid = $db->getLastInsertId();
    echo 'getLastInsertId: ' . $lid;
    $values = array(
        'actor_id' => $lid + 1,
        'first_name' => 'gilles',
        'last_name' => 'migliori',
        'last_update' => '2022-09-09 05:05:03'
    );
    if (!$db->insert('actor', $values)) {
        throw new \Exception($db->error());
    }

    $lid = $db->getLastInsertId();
    echo 'getLastInsertId 2: ' . $lid;

    $db->transactionRollback();

    // commit and save the entire transaction if no error was thrown
    // $db->transactionCommit();
} catch (\Exception $e) {
    // If there was a problem, rollback the transaction
    // as if no database actions here had ever happened
    $db->transactionRollback();

    // Show the error
    echo $e->getMessage();
}



/* try {
    $db->transactionBegin();
    $values = array(
        'actor_id' => null,
        'first_name' => 'gilles',
        'last_name' => 'migliori',
        'last_update' => '2022-09-09 05:05:03'
    );
    if ($db->insert('actor', $values)) {
        $lid = $db->getLastInsertId();
        echo 'getLastInsertId: ' . $lid;
        $values = array(
            'actor_id' => $lid,
            'first_name' => 'gilles',
            'last_name' => 'migliori',
            'last_update' => '2022-09-09 05:05:03'
        );
        if ($db->insert('actor', $values)) {
            $lid = $db->getLastInsertId();
            echo 'getLastInsertId 2: ' . $lid;
            $db->transactionCommit();
        }
    }
} catch (Exception $e) {
    $db->transactionRollback();
    var_dump($e->getMessage());
} */
