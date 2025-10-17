<?php

/*
We use a customized version of the "classicmodels" database as a MySQL sample database.
Download the SQL file at https://www.phpformbuilder.pro/documentation/phpformbuildersampledatabase.sql.zip
Original source: https://www.mysqltutorial.org/mysql-sample-database.aspx
*/

use phpformbuilder\database\DB;

// register the database connection settings
require_once '../phpformbuilder/database/db-connect.php';

// Include the database utility functions
require_once '../phpformbuilder/database/DB.php';

echo '<style>
body {
    color: #222;
}
h3 {
    margin:5rem 1rem .5rem;padding:1rem;border:1px solid indianred;color:indianred;
}
h3:first-of-type {
    margin-top: 0;
}
p, table {
    margin-left: 1rem;
    margin-right: 1rem;
</style>';

// Connect to the database
$db = new DB(true);



/*===========================================================
= $db->execute($sql, $placeholders = false, $debug = false) =
============================================================*/

echo '<h3>$db->execute($sql, $placeholders = false, $debug = false)</h3>';

// Execute a SQL query and return whether it was successful or not
// (FYI: You can also use $db->safe() to return a safe quoted string for SQL)
$sql = "INSERT INTO productlines (id, name, description) VALUES (null, 'bikes', 'Lorem ipsum')";
$id = $db->execute($sql);

// Execute a SQL query with placeholders (better because it stops SQL Injection hacks)
$sql = "DELETE FROM productlines WHERE name = :name AND description = :description";
$values = array('name' => 'bikes', 'description' => 'Lorem ipsum');
$success = $db->execute($sql, $values);

// Execute the same SQL statement but only in debug mode
// In debug mode, the record will not be saved
$success = $db->execute($sql, $values, true);



/*=========================================================
= $db->query($sql, $placeholders = false, $debug = false) =
=========================================================*/

echo '<h3>$db->query($sql, $placeholders = false, $debug = false)</h3>';

// Execute a SQL query to return an object containing all rows
$sql = "SELECT * FROM customers WHERE country = 'Indonesia'";
$db->query($sql);

// Execute the same query in debug mode
$db->query($sql, array(), true);

// Execute the same query using placeholders (better because it stops SQL Injection hacks)
$sql = "SELECT id, first_name, last_name FROM customers WHERE country = :country";
$values = array('country' => 'Indonesia');
$db->query($sql, $values);

// Execute the same query in debug mode
$db->query($sql, $values, true);

echo '<p>';
// loop through the results
while ($row = $db->fetch()) {
    echo $row->first_name . ' ' . $row->last_name . '<br>';
}
echo '</p>';



/*=================================================================================================
= $db->queryRow($sql, $placeholders = false, $debug = false, $fetch_parameters = \PDO::FETCH_OBJ) =
=================================================================================================*/

echo '<h3>$db->queryRow($sql, $placeholders = false, $debug = false, $fetch_parameters = \PDO::FETCH_OBJ)</h3>';

$sql = 'SELECT first_name, last_name FROM customers WHERE id = :id LIMIT 1';
$row = $db->queryRow($sql, array('id' => 5));

echo '<p>' . $row->first_name . ' - ' . $row->last_name . '</p>';



/*==============================================================
= $db->queryValue($sql, $placeholders = false, $debug = false) =
==============================================================*/

echo '<h3>$db->queryValue($sql, $placeholders = false, $debug = false)</h3>';

// Execute a SQL query to return only one value
$sql = 'SELECT last_name FROM customers WHERE id = 1';
$value = $db->queryValue($sql);

// Show the value
echo '<p>' . $value . '</p>';



/*======================================================================================
= $db->select($from, $values = '*', $where = false, $extras = array(), $debug = false) =
======================================================================================*/

echo '<h3>$db->select($from, $values = \'*\', $where = false, $extras = array(), $debug = false)</h3>';

// Select rows without using SQL
$values = array('id', 'first_name', 'last_name');
$where = array('country' => 'Indonesia');
$db->select('customers', $values, $where);

// We can make more complex where clauses in the Select, Update, and Delete methods
$values = array('id', 'first_name', 'last_name');
$where = array(
    'zip_code IS NOT NULL',
    'id >' => 10,
    'last_name LIKE' => '%Ge%'
);
$db->select('customers', $values, $where);

// Let's sort by descending ID and run it in debug mode
$extras = array('order_by' => 'id DESC');
$db->select('customers', $values, $where, $extras, true);

echo '<p>';
// loop through the results
while ($row = $db->fetch()) {
    echo $row->first_name . ' ' . $row->last_name . '<br>';
}
echo '</p>';



/*===========================================================================================================
= $db->selectRow($from, $values = '*', $where = false, $debug = false, $fetch_parameters = \PDO::FETCH_OBJ) =
===========================================================================================================*/

echo '<h3>$db->selectRow($from, $values = \'*\', $where = false, $debug = false, $fetch_parameters = \PDO::FETCH_OBJ)</h3>';

// Grab one row - get the values of the customer in the record with ID 12
$row = $db->selectRow('customers', '*', array('id' => 12));
// Show some of the values
echo '<p>' . $row->first_name . ' ' . $row->last_name . '</p>';



/*===========================================================================================================
= $db->selectValue($from, $field, $where = false, $debug = false) =
===========================================================================================================*/

echo '<h3>$db->selectValue($from, $field, $where = false, $debug = false)</h3>';

// Grab one value - get the email of the customer in the record with ID 32
$value = $db->selectValue('customers', 'email', array('id' => 32));

// Show the value
echo '<p>' . $value . '</p>';



/*==============================================
= $db->insert($table, $values, $debug = false) =
==============================================*/

echo '<h3>$db->insert($table, $values, $debug = false)</h3>';

// Insert a new record
$values = array('id' => null, 'customers_id' => 5, 'payment_date' => '2022-05-11', 'amount' => 2224.5);
$success = $db->insert('payments', $values);

// Show the last insert id
if ($success) {
    echo '<p>Last insert id is: ' . $db->getLastInsertId() . '</p>';
}

// Try it in debug mode
// In debug mode, the record will not be saved
$success = $db->insert('payments', $values, true);



/*==============================================================
= $db->update($table, $values, $where = false, $debug = false) =
==============================================================*/

echo '<h3>$db->update($table, $values, $where = false, $debug = false)</h3>';

// Update an existing record
$update = array('amount' => 3565);
$where  = array('customers_id' => 5, 'payment_date' => '2022-05-11');
$success = $db->update('payments', $update, $where);

// Try it in debug mode
// In debug mode, the record will not be updated
$success = $db->update('payments', $update, $where, true);



/*=====================================================
= $db->delete($table, $where = false, $debug = false) =
=====================================================*/

echo '<h3>$db->delete($table, $where = false, $debug = false)</h3>';

// Delete records
$where  = array('active' => false);
$where  = array('customers_id' => 5, 'payment_date' => '2022-05-11');
$success = $db->delete('payments', $where);

// Try it in debug mode
// In debug mode, the record will not be deleted
$success = $db->delete('payments', $where, true);



/*==============================================================
= $db->getColumns($table, $fetch_parameters = \PDO::FETCH_OBJ) =
==============================================================*/

echo '<h3>$db->getColumns($table, $fetch_parameters = \PDO::FETCH_OBJ)</h3>';

$columns = $db->getColumns('payments');

if (!$columns) {
    echo 'No column found.';
} else {
    // loop the columns
    foreach ($columns as $column) {
        var_dump($column);
    }
}



/*=============================================
=         $db->getColumnNames($table)         =
=============================================*/

echo '<h3>$db->getColumnNames($table)</h3>';

$columns_names = $db->getColumnsNames('payments');

if (!$columns_names) {
    echo 'No column found.';
} else {
    var_dump($columns_names);
}



/*=============================================
=              $db->getTables()               =
=============================================*/

echo '<h3>$db->getTables()</h3>';

// Retrieve the tables from the database into an array
$tables = $db->getTables();

if (!$tables) {
    echo 'No table found.';
} else {
    echo '<p>';
    // loop the tables
    foreach ($tables as $table) {
        echo $table . '<br>';
    }
    echo '</p>';
}



/*==========================================================================
= $db->convertQueryToSimpleArray($array, $value_field, $key_field = false) =
==========================================================================*/

echo '<h3>$db->convertQueryToSimpleArray($array, $value_field, $key_field = false)</h3>';

$db->select('customers', 'city, country', false, array('order_by' => 'country', 'limit' => 5));
$result = $db->fetchAll(\PDO::FETCH_ASSOC);
var_dump($result);

$array = $db->convertQueryToSimpleArray($result, 'city', 'country');
var_dump($array);



/*==========================================================================================================================
= $db->getHTML($sql, $placeholders = false, $showCount = true, $styleTable = null, $styleHeader = null, $styleData = null) =
==========================================================================================================================*/

echo '<h3>$db->getHTML($sql, $placeholders = false, $showCount = true, $styleTable = null, $styleHeader = null, $styleData = null)</h3>';

$html = $db->getHTML('SELECT * FROM customers LIMIT 3');
if ($html) {
    echo $html;
} else {
    echo 'There was an error in your SQL.';
}
