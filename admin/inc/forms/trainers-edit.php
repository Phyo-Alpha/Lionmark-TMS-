<?php

use phpformbuilder\Form;
use phpformbuilder\Validator\Validator;
use phpformbuilder\database\DB;
use common\Utils;
use secure\Secure;

include_once ADMIN_DIR . 'secure/class/secure/Secure.php';

$debug_content = '';

/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-edit-trainers') === true) {
    $validator = Form::validate('form-edit-trainers', FORMVALIDATION_PHP_LANG);
    $validator->maxLength(100)->validate('trainer_username');
    $validator->required()->validate('password');
    $validator->maxLength(255)->validate('password');
    $validator->required()->validate('email');
    $validator->maxLength(254)->validate('email');
    $validator->required()->validate('created_on');
    $validator->float()->validate('created_on');
    $validator->integer()->validate('created_on');
    $validator->min(-99999999999)->validate('created_on');
    $validator->max(99999999999)->validate('created_on');
    $validator->float()->validate('last_login');
    $validator->integer()->validate('last_login');
    $validator->min(-99999999999)->validate('last_login');
    $validator->max(99999999999)->validate('last_login');
    $validator->float()->validate('active');
    $validator->integer()->validate('active');
    $validator->min(-9)->validate('active');
    $validator->max(9)->validate('active');
    $validator->maxLength(50)->validate('first_name');
    $validator->maxLength(50)->validate('last_name');
    $validator->maxLength(100)->validate('company');
    $validator->maxLength(20)->validate('phone');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['form-edit-trainers'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/DB.php';
        $db = new DB(DEBUG);
        $db->setDebugMode('register');
        $values = array();
        $values['trainer_username'] = $_POST['trainer_username'];
        $values['password'] = $_POST['password'];
        $values['email'] = $_POST['email'];
        if (isset($_POST['created_on'])) {
            $values['created_on'] = intval($_POST['created_on']);
        }
        if (isset($_POST['last_login'])) {
            $values['last_login'] = intval($_POST['last_login']);
        }
        if (isset($_POST['active'])) {
            $values['active'] = intval($_POST['active']);
        }
        $values['first_name'] = $_POST['first_name'];
        $values['last_name'] = $_POST['last_name'];
        $values['company'] = $_POST['company'];
        $values['phone'] = $_POST['phone'];
        $where = $_SESSION['trainers_editable_primary_keys'];

        // begin transaction
        $db->transactionBegin();

        try {
            // update trainers
            if (DEMO !== true && !$db->update('trainers', $values, $where, DEBUG_DB_QUERIES)) {
                $error = $db->error();
                throw new \Exception($error);
            } else {
                // ALL OK
                if (!DEBUG_DB_QUERIES) {
                    $db->transactionCommit();

                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-edit-trainers');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:' . ADMIN_URL . 'trainers');
                    }

                    // if we don't exit here, $_SESSION['msg'] will be unset
                    exit();
                } else {
                    $debug_content .= $db->getDebugContent();
                    $db->transactionRollback();

                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE . '<br>(' . DEBUG_DB_QUERIES_ENABLED . ')', 'alert-success has-icon');
                }
            }
        } catch (\Exception $e) {
            $db->transactionRollback();
            $msg_content = DB_ERROR;
            if (DEBUG) {
                $msg_content .= '<br>' . $e->getMessage() . '<br>' . $db->getLastSql();
            }
            $_SESSION['msg'] = Utils::alert($msg_content, 'alert-danger has-icon');
        }
    } // END else
} // END if POST

// register editable primary keys, which are NOT posted and will be the query update filter
// $params come from data-forms.php
// replace 'fieldname' with 'table.fieldname' to avoid ambigous query
$where_params = array_combine(
    array_map(function ($k) {
        return 'trainers.' . $k;
    }, array_keys($params)),
    $params
);
$_SESSION['trainers_editable_primary_keys'] = $where_params;

if (!isset($_SESSION['errors']['form-edit-trainers']) || empty($_SESSION['errors']['form-edit-trainers'])) { // If no error registered
    $from = 'trainers';
    $columns = '*';

    $where = $_SESSION['trainers_editable_primary_keys'];

    // if restricted rights
    if (ADMIN_LOCKED === true && Secure::canUpdateRestricted('trainers')) {
        $where = array_merge($where, Secure::getRestrictionQuery('trainers'));
    }

    $db = new DB(DEBUG);
    $db->setDebugMode('register');

    $db->select($from, $columns, $where, array(), DEBUG_DB_QUERIES);
    if ($db->rowCount() < 1) {
        if (DEBUG) {
            exit($db->getLastSql() . ' : No Record Found');
        } else {
            exit('No Record Found');
        }
    }
    if (DEBUG_DB_QUERIES) {
        $debug_content .= $db->getDebugContent();
    }
    $row = $db->fetch();
    $_SESSION['form-edit-trainers']['trainer_id'] = $row->trainer_id;
    $_SESSION['form-edit-trainers']['trainer_username'] = $row->trainer_username;
    $_SESSION['form-edit-trainers']['password'] = $row->password;
    $_SESSION['form-edit-trainers']['email'] = $row->email;
    $_SESSION['form-edit-trainers']['created_on'] = $row->created_on;
    $_SESSION['form-edit-trainers']['last_login'] = $row->last_login;
    $_SESSION['form-edit-trainers']['active'] = $row->active;
    $_SESSION['form-edit-trainers']['first_name'] = $row->first_name;
    $_SESSION['form-edit-trainers']['last_name'] = $row->last_name;
    $_SESSION['form-edit-trainers']['company'] = $row->company;
    $_SESSION['form-edit-trainers']['phone'] = $row->phone;
}
// $params come from data-forms.php
$pk_url_params = http_build_query($params, '', '/');

$form = new Form('form-edit-trainers', 'horizontal', 'novalidate');
$form->setAction(ADMIN_URL . 'trainers/edit/' . $pk_url_params);
$form->startFieldset();

// trainer_id --

$form->setCols(2, 10);
$form->addInput('hidden', 'trainer_id', '');

// trainer_username --

$form->setCols(2, 10);
$form->addInput('text', 'trainer_username', '', 'Trainer Username', '');

// password --
$form->addInput('text', 'password', '', 'Password', 'required');

// email --
$form->addInput('text', 'email', '', 'Email', 'required');

// created_on --
$form->addInput('number', 'created_on', '', 'Created On', 'required');

// last_login --
$form->addInput('number', 'last_login', '', 'Last Login', '');

// active --
$form->addInput('number', 'active', '', 'Active', '');

// first_name --
$form->addInput('text', 'first_name', '', 'First Name', '');

// last_name --
$form->addInput('text', 'last_name', '', 'Last Name', '');

// company --
$form->addInput('text', 'company', '', 'Company', '');

// phone --
$form->addInput('text', 'phone', '', 'Phone', '');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' prepend"></i>' . CANCEL, 'class=btn btn-warning, data-ladda-button=true, data-style=zoom-in, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' append"></i>', 'class=btn btn-success, data-ladda-button=true, data-style=zoom-in', 'btn-group');
$form->setCols(0, 12);
$form->centerContent();
$form->printBtnGroup('btn-group');
$form->endFieldset();
$form->addPlugin('pretty-checkbox', '#form-edit-trainers');
$form->addPlugin('formvalidation', '#form-edit-trainers', 'default', array('language' => FORMVALIDATION_JAVASCRIPT_LANG));
