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

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-create-learners') === true) {
    $validator = Form::validate('form-create-learners', FORMVALIDATION_PHP_LANG);
    $validator->maxLength(100)->validate('learner_username');
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
        $_SESSION['errors']['form-create-learners'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/DB.php';
        $db = new DB(DEBUG);
        $db->setDebugMode('register');

        // begin transaction
        $db->transactionBegin();

        $values = array();
        $values['learner_id'] = null;
        $values['learner_username'] = $_POST['learner_username'];
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
        try {
            // insert into learners
            if (DEMO !== true && $db->insert('learners', $values, DEBUG_DB_QUERIES) === false) {
                $error = $db->error();
                throw new \Exception($error);
            } else {
                // ALL OK
                if (!DEBUG_DB_QUERIES) {
                    $db->transactionCommit();

                    $_SESSION['msg'] = Utils::alert(INSERT_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-create-learners');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:' . ADMIN_URL . 'learners');
                    }

                    // if we don't exit here, $_SESSION['msg'] will be unset
                    exit();
                } else {
                    $debug_content .= $db->getDebugContent();
                    $db->transactionRollback();

                    $_SESSION['msg'] = Utils::alert(INSERT_SUCCESS_MESSAGE . '<br>(' . DEBUG_DB_QUERIES_ENABLED . ')', 'alert-success has-icon');
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

$form = new Form('form-create-learners', 'horizontal', 'novalidate');
$form->setAction(ADMIN_URL . 'learners/create');
$form->startFieldset();

// learner_id --

$form->setCols(2, 10);
$form->addInput('hidden', 'learner_id', '');

// learner_username --

$form->setCols(2, 10);
$form->addInput('text', 'learner_username', '', 'Learner Username', '');

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
$form->addPlugin('pretty-checkbox', '#form-create-learners');
$form->addPlugin('formvalidation', '#form-create-learners', 'default', array('language' => FORMVALIDATION_JAVASCRIPT_LANG));
