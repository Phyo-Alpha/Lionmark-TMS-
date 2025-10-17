<?php
use secure\Secure;
use phpformbuilder\database\DB;
use common\Utils;

header("X-Robots-Tag: noindex", true);

include_once '../../../conf/conf.php';
include_once ADMIN_DIR . 'secure/class/secure/Secure.php';

session_start();

// user must have [restricted|all] CREATE/DELETE rights on $table
if ((Secure::canCreate('learners') || Secure::canCreateRestricted('learners')) && $_SERVER["REQUEST_METHOD"] == "POST") {
    /* =============================================
        delete if posted
    ============================================= */

    if (isset($_POST['records']) && is_array($_POST['records'])) {
        $db = new DB(DEBUG);
        try {
            // begin transaction
            $db->transactionBegin();
            foreach ($_POST['records'] as $record) {
                $key_value = explode('=', $record);
                $record_pk_value = urldecode($key_value[1]);

                // Delete from target table
                $where = array('learners.learner_id' => $record_pk_value);
                if (!DEMO && !$db->delete('learners', $where, DEBUG_DB_QUERIES)) {
                    throw new \Exception(FAILED_TO_DELETE);
                }
            } // end foreach
            // ALL OK
            // revert if DEBUG_DB_QUERIES is enabled
            $msg_debug = '';
            if (DEBUG_DB_QUERIES) {
                $db->transactionRollback();
                // gives an id to catch it with the Javascript callback
                $msg_debug .= '<br><strong id="debug-db-queries-is-enabled">' . DEBUG_DB_QUERIES_ENABLED . '</strong>';
            } else {
                $db->transactionCommit();
            }
            $msg = Utils::alert(count($_POST['records']) . BULK_DELETE_SUCCESS_MESSAGE . $msg_debug, 'alert-success has-icon');
        } catch (\Exception $e) {
            $db->transactionRollback();
            if (ENVIRONMENT == 'development' && !$db->show_errors) {
                $msg_content = DB_ERROR;
                if (ENVIRONMENT == 'development') {
                    $msg_content .= '<br>' . $e->getMessage() . '<br>' . $db->getLastSql();
                }
                $msg = Utils::alert($msg_content, 'alert-danger has-icon');
            }
        }
    } // END if (isset($_POST['records']))

    if (isset($msg)) {
        echo $msg;
    }
} // END if Secure
