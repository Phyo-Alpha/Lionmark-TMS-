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

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-edit-courses') === true) {
    $validator = Form::validate('form-edit-courses', FORMVALIDATION_PHP_LANG);
    $validator->required()->validate('course_duration');
    $validator->float()->validate('course_duration');
    $validator->integer()->validate('course_duration');
    $validator->min(-99999999999)->validate('course_duration');
    $validator->max(99999999999)->validate('course_duration');
    $validator->required()->validate('course_code');
    $validator->maxLength(30)->validate('course_code');
    $validator->required()->validate('course_title');
    $validator->maxLength(255)->validate('course_title');
    $validator->required()->validate('course_description');
    $validator->maxLength(255)->validate('course_description');
    $validator->required()->validate('learning_outcome');
    $validator->maxLength(255)->validate('learning_outcome');
    $validator->required()->validate('fee_details');
    $validator->maxLength(255)->validate('fee_details');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['form-edit-courses'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/DB.php';
        $db = new DB(DEBUG);
        $db->setDebugMode('register');
        $values = array();
        if (isset($_POST['course_duration'])) {
            $values['course_duration'] = intval($_POST['course_duration']);
        }
        $values['course_code'] = $_POST['course_code'];
        $values['course_title'] = $_POST['course_title'];
        $values['course_description'] = $_POST['course_description'];
        $values['learning_outcome'] = $_POST['learning_outcome'];
        $values['fee_details'] = $_POST['fee_details'];
        $where = $_SESSION['courses_editable_primary_keys'];

        // begin transaction
        $db->transactionBegin();

        try {
            // update courses
            if (DEMO !== true && !$db->update('courses', $values, $where, DEBUG_DB_QUERIES)) {
                $error = $db->error();
                throw new \Exception($error);
            } else {
                // ALL OK
                if (!DEBUG_DB_QUERIES) {
                    $db->transactionCommit();

                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-edit-courses');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:' . ADMIN_URL . 'courses');
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
        return 'courses.' . $k;
    }, array_keys($params)),
    $params
);
$_SESSION['courses_editable_primary_keys'] = $where_params;

if (!isset($_SESSION['errors']['form-edit-courses']) || empty($_SESSION['errors']['form-edit-courses'])) { // If no error registered
    $from = 'courses';
    $columns = '*';

    $where = $_SESSION['courses_editable_primary_keys'];

    // if restricted rights
    if (ADMIN_LOCKED === true && Secure::canUpdateRestricted('courses')) {
        $where = array_merge($where, Secure::getRestrictionQuery('courses'));
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
    $_SESSION['form-edit-courses']['course_id'] = $row->course_id;
    $_SESSION['form-edit-courses']['course_duration'] = $row->course_duration;
    $_SESSION['form-edit-courses']['course_code'] = $row->course_code;
    $_SESSION['form-edit-courses']['course_title'] = $row->course_title;
    $_SESSION['form-edit-courses']['course_description'] = $row->course_description;
    $_SESSION['form-edit-courses']['learning_outcome'] = $row->learning_outcome;
    $_SESSION['form-edit-courses']['fee_details'] = $row->fee_details;
}
// $params come from data-forms.php
$pk_url_params = http_build_query($params, '', '/');

$form = new Form('form-edit-courses', 'horizontal', 'novalidate');
$form->setAction(ADMIN_URL . 'courses/edit/' . $pk_url_params);
$form->startFieldset();

// course_id --

$form->setCols(2, 10);
$form->addInput('hidden', 'course_id', '');

// course_duration --

$form->setCols(2, 10);
$form->addInput('number', 'course_duration', '', 'Course Duration', 'required');

// course_code --
$form->addInput('text', 'course_code', '', 'Course Code', 'required');

// course_title --
$form->addInput('text', 'course_title', '', 'Course Title', 'required');

// course_description --
$form->addInput('text', 'course_description', '', 'Course Description', 'required');

// learning_outcome --
$form->addInput('text', 'learning_outcome', '', 'Learning Outcome', 'required');

// fee_details --
$form->addInput('text', 'fee_details', '', 'Fee Details', 'required');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' prepend"></i>' . CANCEL, 'class=btn btn-warning, data-ladda-button=true, data-style=zoom-in, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' append"></i>', 'class=btn btn-success, data-ladda-button=true, data-style=zoom-in', 'btn-group');
$form->setCols(0, 12);
$form->centerContent();
$form->printBtnGroup('btn-group');
$form->endFieldset();
$form->addPlugin('pretty-checkbox', '#form-edit-courses');
$form->addPlugin('formvalidation', '#form-edit-courses', 'default', array('language' => FORMVALIDATION_JAVASCRIPT_LANG));
