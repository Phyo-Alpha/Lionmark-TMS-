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

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-edit-phpcg-users-profiles') === true) {
    $validator = Form::validate('form-edit-phpcg-users-profiles', FORMVALIDATION_PHP_LANG);
    $validator->required()->validate('profile_name');
    $validator->maxLength(100)->validate('profile_name');
    $validator->required()->validate('r_category');
    $validator->integer()->validate('r_category');
    $validator->min(-9)->validate('r_category');
    $validator->max(9)->validate('r_category');
    $validator->required()->validate('u_category');
    $validator->integer()->validate('u_category');
    $validator->min(-9)->validate('u_category');
    $validator->max(9)->validate('u_category');
    $validator->required()->validate('cd_category');
    $validator->integer()->validate('cd_category');
    $validator->min(-9)->validate('cd_category');
    $validator->max(9)->validate('cd_category');
    $validator->maxLength(255)->validate('cq_category');
    $validator->required()->validate('r_courses');
    $validator->integer()->validate('r_courses');
    $validator->min(-9)->validate('r_courses');
    $validator->max(9)->validate('r_courses');
    $validator->required()->validate('u_courses');
    $validator->integer()->validate('u_courses');
    $validator->min(-9)->validate('u_courses');
    $validator->max(9)->validate('u_courses');
    $validator->required()->validate('cd_courses');
    $validator->integer()->validate('cd_courses');
    $validator->min(-9)->validate('cd_courses');
    $validator->max(9)->validate('cd_courses');
    $validator->maxLength(255)->validate('cq_courses');
    $validator->required()->validate('r_learners');
    $validator->integer()->validate('r_learners');
    $validator->min(-9)->validate('r_learners');
    $validator->max(9)->validate('r_learners');
    $validator->required()->validate('u_learners');
    $validator->integer()->validate('u_learners');
    $validator->min(-9)->validate('u_learners');
    $validator->max(9)->validate('u_learners');
    $validator->required()->validate('cd_learners');
    $validator->integer()->validate('cd_learners');
    $validator->min(-9)->validate('cd_learners');
    $validator->max(9)->validate('cd_learners');
    $validator->maxLength(255)->validate('cq_learners');
    $validator->required()->validate('r_trainers');
    $validator->integer()->validate('r_trainers');
    $validator->min(-9)->validate('r_trainers');
    $validator->max(9)->validate('r_trainers');
    $validator->required()->validate('u_trainers');
    $validator->integer()->validate('u_trainers');
    $validator->min(-9)->validate('u_trainers');
    $validator->max(9)->validate('u_trainers');
    $validator->required()->validate('cd_trainers');
    $validator->integer()->validate('cd_trainers');
    $validator->min(-9)->validate('cd_trainers');
    $validator->max(9)->validate('cd_trainers');
    $validator->maxLength(255)->validate('cq_trainers');
    $validator->required()->validate('r_users');
    $validator->integer()->validate('r_users');
    $validator->min(-9)->validate('r_users');
    $validator->max(9)->validate('r_users');
    $validator->required()->validate('u_users');
    $validator->integer()->validate('u_users');
    $validator->min(-9)->validate('u_users');
    $validator->max(9)->validate('u_users');
    $validator->required()->validate('cd_users');
    $validator->integer()->validate('cd_users');
    $validator->min(-9)->validate('cd_users');
    $validator->max(9)->validate('cd_users');
    $validator->maxLength(255)->validate('cq_users');
    $validator->required()->validate('r_phpcg_users');
    $validator->integer()->validate('r_phpcg_users');
    $validator->min(-9)->validate('r_phpcg_users');
    $validator->max(9)->validate('r_phpcg_users');
    $validator->required()->validate('u_phpcg_users');
    $validator->integer()->validate('u_phpcg_users');
    $validator->min(-9)->validate('u_phpcg_users');
    $validator->max(9)->validate('u_phpcg_users');
    $validator->required()->validate('cd_phpcg_users');
    $validator->integer()->validate('cd_phpcg_users');
    $validator->min(-9)->validate('cd_phpcg_users');
    $validator->max(9)->validate('cd_phpcg_users');
    $validator->maxLength(255)->validate('cq_phpcg_users');
    $validator->required()->validate('r_phpcg_users_profiles');
    $validator->integer()->validate('r_phpcg_users_profiles');
    $validator->min(-9)->validate('r_phpcg_users_profiles');
    $validator->max(9)->validate('r_phpcg_users_profiles');
    $validator->required()->validate('u_phpcg_users_profiles');
    $validator->integer()->validate('u_phpcg_users_profiles');
    $validator->min(-9)->validate('u_phpcg_users_profiles');
    $validator->max(9)->validate('u_phpcg_users_profiles');
    $validator->required()->validate('cd_phpcg_users_profiles');
    $validator->integer()->validate('cd_phpcg_users_profiles');
    $validator->min(-9)->validate('cd_phpcg_users_profiles');
    $validator->max(9)->validate('cd_phpcg_users_profiles');
    $validator->maxLength(255)->validate('cq_phpcg_users_profiles');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['form-edit-phpcg-users-profiles'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/DB.php';
        $db = new DB(DEBUG);
        $db->setDebugMode('register');
        $values = array();
        $values['profile_name'] = $_POST['profile_name'];
        if (is_array($_POST['r_category'])) {
            $json_values = json_encode($_POST['r_category'], JSON_UNESCAPED_UNICODE);
            $values['r_category'] = $json_values;
        } else {
            $values['r_category'] = intval($_POST['r_category']);
        }
        if (is_array($_POST['u_category'])) {
            $json_values = json_encode($_POST['u_category'], JSON_UNESCAPED_UNICODE);
            $values['u_category'] = $json_values;
        } else {
            $values['u_category'] = intval($_POST['u_category']);
        }
        if (is_array($_POST['cd_category'])) {
            $json_values = json_encode($_POST['cd_category'], JSON_UNESCAPED_UNICODE);
            $values['cd_category'] = $json_values;
        } else {
            $values['cd_category'] = intval($_POST['cd_category']);
        }
        $values['cq_category'] = $_POST['cq_category'];
        if (is_array($_POST['r_courses'])) {
            $json_values = json_encode($_POST['r_courses'], JSON_UNESCAPED_UNICODE);
            $values['r_courses'] = $json_values;
        } else {
            $values['r_courses'] = intval($_POST['r_courses']);
        }
        if (is_array($_POST['u_courses'])) {
            $json_values = json_encode($_POST['u_courses'], JSON_UNESCAPED_UNICODE);
            $values['u_courses'] = $json_values;
        } else {
            $values['u_courses'] = intval($_POST['u_courses']);
        }
        if (is_array($_POST['cd_courses'])) {
            $json_values = json_encode($_POST['cd_courses'], JSON_UNESCAPED_UNICODE);
            $values['cd_courses'] = $json_values;
        } else {
            $values['cd_courses'] = intval($_POST['cd_courses']);
        }
        $values['cq_courses'] = $_POST['cq_courses'];
        if (is_array($_POST['r_learners'])) {
            $json_values = json_encode($_POST['r_learners'], JSON_UNESCAPED_UNICODE);
            $values['r_learners'] = $json_values;
        } else {
            $values['r_learners'] = intval($_POST['r_learners']);
        }
        if (is_array($_POST['u_learners'])) {
            $json_values = json_encode($_POST['u_learners'], JSON_UNESCAPED_UNICODE);
            $values['u_learners'] = $json_values;
        } else {
            $values['u_learners'] = intval($_POST['u_learners']);
        }
        if (is_array($_POST['cd_learners'])) {
            $json_values = json_encode($_POST['cd_learners'], JSON_UNESCAPED_UNICODE);
            $values['cd_learners'] = $json_values;
        } else {
            $values['cd_learners'] = intval($_POST['cd_learners']);
        }
        $values['cq_learners'] = $_POST['cq_learners'];
        if (is_array($_POST['r_trainers'])) {
            $json_values = json_encode($_POST['r_trainers'], JSON_UNESCAPED_UNICODE);
            $values['r_trainers'] = $json_values;
        } else {
            $values['r_trainers'] = intval($_POST['r_trainers']);
        }
        if (is_array($_POST['u_trainers'])) {
            $json_values = json_encode($_POST['u_trainers'], JSON_UNESCAPED_UNICODE);
            $values['u_trainers'] = $json_values;
        } else {
            $values['u_trainers'] = intval($_POST['u_trainers']);
        }
        if (is_array($_POST['cd_trainers'])) {
            $json_values = json_encode($_POST['cd_trainers'], JSON_UNESCAPED_UNICODE);
            $values['cd_trainers'] = $json_values;
        } else {
            $values['cd_trainers'] = intval($_POST['cd_trainers']);
        }
        $values['cq_trainers'] = $_POST['cq_trainers'];
        if (is_array($_POST['r_users'])) {
            $json_values = json_encode($_POST['r_users'], JSON_UNESCAPED_UNICODE);
            $values['r_users'] = $json_values;
        } else {
            $values['r_users'] = intval($_POST['r_users']);
        }
        if (is_array($_POST['u_users'])) {
            $json_values = json_encode($_POST['u_users'], JSON_UNESCAPED_UNICODE);
            $values['u_users'] = $json_values;
        } else {
            $values['u_users'] = intval($_POST['u_users']);
        }
        if (is_array($_POST['cd_users'])) {
            $json_values = json_encode($_POST['cd_users'], JSON_UNESCAPED_UNICODE);
            $values['cd_users'] = $json_values;
        } else {
            $values['cd_users'] = intval($_POST['cd_users']);
        }
        $values['cq_users'] = $_POST['cq_users'];
        if (is_array($_POST['r_phpcg_users'])) {
            $json_values = json_encode($_POST['r_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $values['r_phpcg_users'] = $json_values;
        } else {
            $values['r_phpcg_users'] = intval($_POST['r_phpcg_users']);
        }
        if (is_array($_POST['u_phpcg_users'])) {
            $json_values = json_encode($_POST['u_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $values['u_phpcg_users'] = $json_values;
        } else {
            $values['u_phpcg_users'] = intval($_POST['u_phpcg_users']);
        }
        if (is_array($_POST['cd_phpcg_users'])) {
            $json_values = json_encode($_POST['cd_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $values['cd_phpcg_users'] = $json_values;
        } else {
            $values['cd_phpcg_users'] = intval($_POST['cd_phpcg_users']);
        }
        $values['cq_phpcg_users'] = $_POST['cq_phpcg_users'];
        if (is_array($_POST['r_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['r_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $values['r_phpcg_users_profiles'] = $json_values;
        } else {
            $values['r_phpcg_users_profiles'] = intval($_POST['r_phpcg_users_profiles']);
        }
        if (is_array($_POST['u_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['u_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $values['u_phpcg_users_profiles'] = $json_values;
        } else {
            $values['u_phpcg_users_profiles'] = intval($_POST['u_phpcg_users_profiles']);
        }
        if (is_array($_POST['cd_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['cd_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $values['cd_phpcg_users_profiles'] = $json_values;
        } else {
            $values['cd_phpcg_users_profiles'] = intval($_POST['cd_phpcg_users_profiles']);
        }
        $values['cq_phpcg_users_profiles'] = $_POST['cq_phpcg_users_profiles'];
        $where = $_SESSION['phpcg_users_profiles_editable_primary_keys'];

        // begin transaction
        $db->transactionBegin();

        try {
            // update phpcg_users_profiles
            if (DEMO !== true && !$db->update('phpcg_users_profiles', $values, $where, DEBUG_DB_QUERIES)) {
                $error = $db->error();
                throw new \Exception($error);
            } else {
                // ALL OK
                if (!DEBUG_DB_QUERIES) {
                    $db->transactionCommit();

                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-edit-phpcg-users-profiles');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:' . ADMIN_URL . 'phpcgusersprofiles');
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
        return 'phpcg_users_profiles.' . $k;
    }, array_keys($params)),
    $params
);
$_SESSION['phpcg_users_profiles_editable_primary_keys'] = $where_params;

if (!isset($_SESSION['errors']['form-edit-phpcg-users-profiles']) || empty($_SESSION['errors']['form-edit-phpcg-users-profiles'])) { // If no error registered
    $from = 'phpcg_users_profiles';
    $columns = '*';

    $where = $_SESSION['phpcg_users_profiles_editable_primary_keys'];

    // if restricted rights
    if (ADMIN_LOCKED === true && Secure::canUpdateRestricted('phpcg_users_profiles')) {
        $where = array_merge($where, Secure::getRestrictionQuery('phpcg_users_profiles'));
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
    $_SESSION['form-edit-phpcg-users-profiles']['id'] = $row->id;
    $_SESSION['form-edit-phpcg-users-profiles']['profile_name'] = $row->profile_name;
    $_SESSION['form-edit-phpcg-users-profiles']['r_category'] = $row->r_category;
    $_SESSION['form-edit-phpcg-users-profiles']['u_category'] = $row->u_category;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_category'] = $row->cd_category;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_category'] = $row->cq_category;
    $_SESSION['form-edit-phpcg-users-profiles']['r_courses'] = $row->r_courses;
    $_SESSION['form-edit-phpcg-users-profiles']['u_courses'] = $row->u_courses;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_courses'] = $row->cd_courses;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_courses'] = $row->cq_courses;
    $_SESSION['form-edit-phpcg-users-profiles']['r_learners'] = $row->r_learners;
    $_SESSION['form-edit-phpcg-users-profiles']['u_learners'] = $row->u_learners;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_learners'] = $row->cd_learners;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_learners'] = $row->cq_learners;
    $_SESSION['form-edit-phpcg-users-profiles']['r_trainers'] = $row->r_trainers;
    $_SESSION['form-edit-phpcg-users-profiles']['u_trainers'] = $row->u_trainers;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_trainers'] = $row->cd_trainers;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_trainers'] = $row->cq_trainers;
    $_SESSION['form-edit-phpcg-users-profiles']['r_users'] = $row->r_users;
    $_SESSION['form-edit-phpcg-users-profiles']['u_users'] = $row->u_users;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_users'] = $row->cd_users;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_users'] = $row->cq_users;
    $_SESSION['form-edit-phpcg-users-profiles']['r_phpcg_users'] = $row->r_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['u_phpcg_users'] = $row->u_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_phpcg_users'] = $row->cd_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_phpcg_users'] = $row->cq_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['r_phpcg_users_profiles'] = $row->r_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['u_phpcg_users_profiles'] = $row->u_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['cd_phpcg_users_profiles'] = $row->cd_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['cq_phpcg_users_profiles'] = $row->cq_phpcg_users_profiles;
}
// $params come from data-forms.php
$pk_url_params = http_build_query($params, '', '/');

$form = new Form('form-edit-phpcg-users-profiles', 'horizontal', 'novalidate');
$form->setAction(ADMIN_URL . 'phpcgusersprofiles/edit/' . $pk_url_params);

$form->addHtml(USERS_PROFILES_HELPER);


$form->startFieldset();

// id --

$form->setCols(2, 10);
$form->addInput('hidden', 'id', '');

// profile_name --

$form->setCols(2, 10);
$form->addInput('text', 'profile_name', '', 'Profile Name', 'required');

// r_category --
$form->groupElements('r_category', 'u_category');

$form->setCols(2, 4);
$form->addOption('r_category', '2', 'Yes');
$form->addOption('r_category', '1', 'Restricted');
$form->addOption('r_category', '0', 'No');
$form->addSelect('r_category', 'Read Category', 'required, data-slimselect=true');

// u_category --
$form->addOption('u_category', '2', 'Yes');
$form->addOption('u_category', '1', 'Restricted');
$form->addOption('u_category', '0', 'No');
$form->addSelect('u_category', 'Update Category', 'required, data-slimselect=true');

// cd_category --

$form->setCols(2, 10);
$form->addOption('cd_category', '2', 'Yes');
$form->addOption('cd_category', '1', 'Restricted');
$form->addOption('cd_category', '0', 'No');
$form->addSelect('cd_category', 'Create/Delete Category', 'required, data-slimselect=true');

// cq_category --
$form->addInput('text', 'cq_category', '', 'Constraint Query Category<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');

// r_courses --
$form->groupElements('r_courses', 'u_courses');

$form->setCols(2, 4);
$form->addOption('r_courses', '2', 'Yes');
$form->addOption('r_courses', '1', 'Restricted');
$form->addOption('r_courses', '0', 'No');
$form->addSelect('r_courses', 'Read Courses', 'required, data-slimselect=true');

// u_courses --
$form->addOption('u_courses', '2', 'Yes');
$form->addOption('u_courses', '1', 'Restricted');
$form->addOption('u_courses', '0', 'No');
$form->addSelect('u_courses', 'Update Courses', 'required, data-slimselect=true');

// cd_courses --

$form->setCols(2, 10);
$form->addOption('cd_courses', '2', 'Yes');
$form->addOption('cd_courses', '1', 'Restricted');
$form->addOption('cd_courses', '0', 'No');
$form->addSelect('cd_courses', 'Create/Delete Courses', 'required, data-slimselect=true');

// cq_courses --
$form->addInput('text', 'cq_courses', '', 'Constraint Query Courses<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');

// r_learners --
$form->groupElements('r_learners', 'u_learners');

$form->setCols(2, 4);
$form->addOption('r_learners', '2', 'Yes');
$form->addOption('r_learners', '1', 'Restricted');
$form->addOption('r_learners', '0', 'No');
$form->addSelect('r_learners', 'Read Learners', 'required, data-slimselect=true');

// u_learners --
$form->addOption('u_learners', '2', 'Yes');
$form->addOption('u_learners', '1', 'Restricted');
$form->addOption('u_learners', '0', 'No');
$form->addSelect('u_learners', 'Update Learners', 'required, data-slimselect=true');

// cd_learners --

$form->setCols(2, 10);
$form->addOption('cd_learners', '2', 'Yes');
$form->addOption('cd_learners', '1', 'Restricted');
$form->addOption('cd_learners', '0', 'No');
$form->addSelect('cd_learners', 'Create/Delete Learners', 'required, data-slimselect=true');

// cq_learners --
$form->addInput('text', 'cq_learners', '', 'Constraint Query Learners<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');

// r_trainers --
$form->groupElements('r_trainers', 'u_trainers');

$form->setCols(2, 4);
$form->addOption('r_trainers', '2', 'Yes');
$form->addOption('r_trainers', '1', 'Restricted');
$form->addOption('r_trainers', '0', 'No');
$form->addSelect('r_trainers', 'Read Trainers', 'required, data-slimselect=true');

// u_trainers --
$form->addOption('u_trainers', '2', 'Yes');
$form->addOption('u_trainers', '1', 'Restricted');
$form->addOption('u_trainers', '0', 'No');
$form->addSelect('u_trainers', 'Update Trainers', 'required, data-slimselect=true');

// cd_trainers --

$form->setCols(2, 10);
$form->addOption('cd_trainers', '2', 'Yes');
$form->addOption('cd_trainers', '1', 'Restricted');
$form->addOption('cd_trainers', '0', 'No');
$form->addSelect('cd_trainers', 'Create/Delete Trainers', 'required, data-slimselect=true');

// cq_trainers --
$form->addInput('text', 'cq_trainers', '', 'Constraint Query Trainers<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');

// r_users --
$form->groupElements('r_users', 'u_users');

$form->setCols(2, 4);
$form->addOption('r_users', '2', 'Yes');
$form->addOption('r_users', '1', 'Restricted');
$form->addOption('r_users', '0', 'No');
$form->addSelect('r_users', 'Read Users', 'required, data-slimselect=true');

// u_users --
$form->addOption('u_users', '2', 'Yes');
$form->addOption('u_users', '1', 'Restricted');
$form->addOption('u_users', '0', 'No');
$form->addSelect('u_users', 'Update Users', 'required, data-slimselect=true');

// cd_users --

$form->setCols(2, 10);
$form->addOption('cd_users', '2', 'Yes');
$form->addOption('cd_users', '1', 'Restricted');
$form->addOption('cd_users', '0', 'No');
$form->addSelect('cd_users', 'Create/Delete Users', 'required, data-slimselect=true');

// cq_users --
$form->addInput('text', 'cq_users', '', 'Constraint Query Users<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');

// r_phpcg_users --
$form->groupElements('r_phpcg_users', 'u_phpcg_users');

$form->setCols(2, 4);
$form->addOption('r_phpcg_users', '2', 'Yes');
$form->addOption('r_phpcg_users', '1', 'Restricted');
$form->addOption('r_phpcg_users', '0', 'No');
$form->addSelect('r_phpcg_users', 'Read Phpcg Users', 'required, data-slimselect=true');

// u_phpcg_users --
$form->addOption('u_phpcg_users', '2', 'Yes');
$form->addOption('u_phpcg_users', '1', 'Restricted');
$form->addOption('u_phpcg_users', '0', 'No');
$form->addSelect('u_phpcg_users', 'Update Phpcg Users', 'required, data-slimselect=true');

// cd_phpcg_users --

$form->setCols(2, 10);
$form->addOption('cd_phpcg_users', '2', 'Yes');
$form->addOption('cd_phpcg_users', '0', 'No');
$form->addSelect('cd_phpcg_users', 'Create/Delete Phpcg Users', 'required, data-slimselect=true');

// cq_phpcg_users --
$form->addHelper('CREATE/DELETE rights on users table cannot be limited - this would be a nonsense', 'cq_phpcg_users', 'after');
$form->addInput('text', 'cq_phpcg_users', '', 'Constraint Query Phpcg Users', '');

// r_phpcg_users_profiles --
$form->groupElements('r_phpcg_users_profiles', 'u_phpcg_users_profiles');

$form->setCols(2, 4);
$form->addOption('r_phpcg_users_profiles', '2', 'Yes');
$form->addOption('r_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('r_phpcg_users_profiles', '0', 'No');
$form->addSelect('r_phpcg_users_profiles', 'Read Phpcg Users Profiles', 'required, data-slimselect=true');

// u_phpcg_users_profiles --
$form->addOption('u_phpcg_users_profiles', '2', 'Yes');
$form->addOption('u_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('u_phpcg_users_profiles', '0', 'No');
$form->addSelect('u_phpcg_users_profiles', 'Update Phpcg Users Profiles', 'required, data-slimselect=true');

// cd_phpcg_users_profiles --

$form->setCols(2, 10);
$form->addOption('cd_phpcg_users_profiles', '2', 'Yes');
$form->addOption('cd_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('cd_phpcg_users_profiles', '0', 'No');
$form->addSelect('cd_phpcg_users_profiles', 'Create/Delete Phpcg Users Profiles', 'required, data-slimselect=true');

// cq_phpcg_users_profiles --
$form->addInput('text', 'cq_phpcg_users_profiles', '', 'Constraint Query Phpcg Users Profiles<a href="#" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p>" class="append"><span class="badge text-bg-info">?</span></a>', '');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' prepend"></i>' . CANCEL, 'class=btn btn-warning, data-ladda-button=true, data-style=zoom-in, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' append"></i>', 'class=btn btn-success, data-ladda-button=true, data-style=zoom-in', 'btn-group');
$form->setCols(0, 12);
$form->centerContent();
$form->printBtnGroup('btn-group');
$form->endFieldset();
$form->addPlugin('pretty-checkbox', '#form-edit-phpcg-users-profiles');
$form->addPlugin('formvalidation', '#form-edit-phpcg-users-profiles', 'default', array('language' => FORMVALIDATION_JAVASCRIPT_LANG));
