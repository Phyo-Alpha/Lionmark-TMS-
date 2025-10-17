<?php

/* database connection

Databases supported by PDO
==========================

Driver name     DSN parameter        Supported databases
--------------------------------------------------------
PDO_CUBRID      cubrid               Cubrid
PDO_DBLIB       dblib                FreeTDS / Microsoft SQL Server / Sybase
PDO_FIREBIRD    firebird             Firebird
PDO_IBM         ibm                  IBM DB2
PDO_INFORMIX    informix             IBM Informix Dynamic Server
PDO_MYSQL       mysql                MySQL 3.x/4.x/5.x
PDO_OCI         oci                  Oracle Call Interface
PDO_ODBC        odbc                 ODBC v3 (IBM DB2, unixODBC et win32 ODBC)
PDO_PGSQL       pgsql                PostgreSQL
PDO_SQLITE      sqlite               SQLite 3 et SQLite 2
PDO_SQLSRV      sqlsrv               Microsoft SQL Server / SQL Azure
PDO_4D          4d                   4D

*/

// DSN parameter of PDO::__construct()
define('PDO_DRIVER', 'mysql');

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
    // settings for local server
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'lionmarks_tms');
    define('DB_USER', 'lionmarks_user');
    define('DB_PASS', 'lionmarks_password');
    define('DB_PORT', '3309'); // leave empty to use the default port
} else {
    // settings for production server
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'u739449679_tmstp');
    define('DB_USER', 'u739449679_nilar');
    define('DB_PASS', 'Colla01?!');
    define('DB_PORT', ''); // leave empty to use the default port
}
