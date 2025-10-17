<?php

declare(strict_types=1);

namespace phpformbuilder;

use phpformbuilder\Validator\Validator;
use phpformbuilder\database\Mysql;
use common\Utils;

/**
 * FormExtended class
 *
 * This class extends the Form class and adds additional functionality.
 */
class FormExtended extends Form
{
    /* =============================================
    CRUD GENERATOR
    ============================================= */

    /**
     * register options to revert them with $this->optionsRevert() after $this->optionsJustifyCenter()
     * @var array
     */
    private $savedOptions = array();

    /**
     * Starts a new row and column in the form layout.
     *
     * @param string $row_class The CSS class for the row element.
     * @param string $col_class The CSS class for the column element.
     * @return void
     */
    public function startRowCol(string $row_class = 'row', string $col_class = 'col'): void
    {
        $this->addHtml('<div class="' . $row_class . '">');
        $this->addHtml('<div class="' . $col_class . '">');
    }

    /**
     * Ends the current row and column in the form layout.
     *
     * @return void
     */
    public function endRowCol(): void
    {
        $this->addHtml('</div>');
        $this->addHtml('</div>');
    }

    /**
     * Starts a new card in the form layout.
     *
     * @param string $title The title of the card.
     * @param string $classname The CSS class for the card element.
     * @param string $header_classname The CSS class for the card header element.
     * @param string $heading_elements The additional elements to be included in the card header.
     * @param bool $has_body Whether the card has a body or not.
     * @return void
     */
    public function startCard(string $title, string $classname = '', string $header_classname = '', string $heading_elements = '', bool $has_body = true): void
    {
        $start_card = Utils::startCard($title, $classname, $header_classname, $heading_elements, $has_body);
        $this->addHtml($start_card);
    }

    /**
     * Ends the current card in the form layout.
     *
     * @param bool $has_body Whether the card has a body or not.
     * @return void
     */
    public function endCard(bool $has_body = true): void
    {
        $end_card = Utils::endCard($has_body);
        $this->addHtml($end_card);
    }

    /**
     * Adds a select input for choosing a Bootstrap theme.
     *
     * @return void
     */
    public function addBootstrapThemeSelect(): void
    {
        $bs5_available_themes = array(
            'default' => 'Bootstrap default theme',
            'cerulean' => 'A calm blue sky',
            'cosmo' => 'An ode to Metro',
            'cyborg' => 'Jet black and electric blue',
            'darkly' => 'Flatly in night mode',
            'flatly' => 'Flat & modern',
            'journal' => 'Crisp like a new sheet of paper',
            'litera' => 'The medium is the message',
            'lumen' => 'Light & shadow',
            'lux' => 'A touch of class',
            'materia' => 'Material is the metaphor',
            'minty' => 'A fresh feel',
            'morph' => 'A neumorphic layer',
            'pulse' => 'A trace of purple',
            'quartz' => 'A glassmorphic layer',
            'sandstone' => 'A touch of warmth',
            'simplex' => 'Mini & minimalmist',
            'slate' => 'Shades of gunmetal gray',
            'solar' => 'A spin on solarized',
            'spacelab' => 'Silvery and sleek',
            'superhero' => 'The brave and the blue',
            'united' => 'Ubuntu orange and unique font',
            'yeti' => 'A friendly foundation',
            'zephyr' => 'Breezy and beautiful'
        );

        foreach ($bs5_available_themes as $key => $value) {
            $palette = '<div style\=\'padding-left:2rem\' class\=\'d-inline-flex\'><span class\=\'primary\'></span><span class\=\'success\'></span><span class\=\'info\'></span><span class\=\'warning\'></span><span class\=\'danger\'></span><span class\=\'light\'></span><span class\=\'dark\'></span></div>';
            $this->addOption('bootstrap_theme', $key, '', '', 'data-html=<div class\=\'palette palette-' . $key . ' d-flex flex-nowrap justify-content-between\'><span>' . ucfirst($key) . '<small class\=\'text-muted\'> - ' . $value . '</small></span>' . $palette . '</div>');
        }

        $this->addSelect('bootstrap_theme', 'Bootstrap theme', 'data-slimselect=true, data-allow-deselect=false, data-show-search=false, required');
    }

    /**
     * Adds a select input for choosing a navigation style.
     *
     * @param string $select_name The name of the select input.
     * @param string $label The label for the select input.
     * @return void
     */
    public function addNavStyleSelect(string $select_name, string $label): void
    {
        $available_styles = array('primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark');

        foreach ($available_styles as $st) {
            $this->addOption($select_name, $st, '', '', 'data-html=<div class\=\'palette palette-' . BOOTSTRAP_THEME . ' d-flex flex-nowrap justify-content-between\'><span>' . ucfirst($st) . '</span><div style\=\'padding-left:2rem\' class\=\'d-inline-flex\'><span class\=\'' . $st . '\'></span></div></div>');
        }
        $this->addSelect($select_name, $label, 'data-slimselect=true, data-allow-deselect=false, data-show-search=false, required');
    }

    /**
     * Adds validation for auto-generated fields.
     *
     * @param string $column_name The name of the column.
     * @param int $index The index of the field.
     * @param string $function The validation function to be applied.
     * @param string $value The value to be validated.
     * @param string $validation_helper_text The helper text for the validation.
     * @return void
     */
    public function addValidationAutoFields(string $column_name, int $index, string $function, string $value, string $validation_helper_text = ''): void
    {
        $input_function = 'cu_auto_validation_function_' . $column_name . '-' . $index;
        $input_arguments = 'cu_auto_validation_arguments_' . $column_name . '-' . $index;
        $this->groupElements($input_function, $input_arguments);
        $this->addHtml('<div class="row"><div class="col mb-2">');
        $options = array(
            'horizontalLabelCol' => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
            'horizontalElementCol' => 'col-md-8 mb-md-2 mb-lg-0 col-lg-3'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_function, $function, FUNCTION_CONST, 'class=form-control-sm, data-index=' . $index . ', data-column-name=' . $column_name . ', readonly');
        if (!empty($validation_helper_text)) {
            $this->addHelper($validation_helper_text, $input_arguments);
        }
        $options = array(
            'horizontalLabelCol' => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
            'horizontalElementCol' => 'col-md-8 mb-md-2 mb-lg-0 col-lg-5'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_arguments, $value, ARGUMENTS, 'class=form-control-sm, readonly');
        $this->addHtml('</div></div>');
    }

    /**
     * Adds custom validation fields.
     *
     * @param string $column_name The name of the column.
     * @param int $index The index of the field.
     * @param string $validation_helper_text The helper text for the validation.
     * @return void
     */
    public function addCustomValidationFields(string $column_name, int $index, string $validation_helper_text = ''): void
    {
        $select_name = 'cu_validation_function_' . $column_name . '-' . $index;
        $input_name = 'cu_validation_arguments_' . $column_name . '-' . $index;
        $div_attr = ' class="row validation-dynamic" data-index="' . $index . '"';
        $this->groupElements($select_name, $input_name, 'validation_remove-' . $index);
        $this->addHtml('<div' . $div_attr . '><div class="col">');
        $options = array(
            'horizontalLabelCol' => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
            'horizontalElementCol' => 'col-md-8 mb-md-2 mb-lg-0 col-lg-3'
        );
        $this->setOptions($options);
        $this->addOption($select_name, 'required', 'required');
        $this->addOption($select_name, 'email', 'email');
        $this->addOption($select_name, 'float', 'float');
        $this->addOption($select_name, 'integer', 'integer');
        $this->addOption($select_name, 'min', 'min');
        $this->addOption($select_name, 'max', 'max');
        $this->addOption($select_name, 'between', 'between');
        $this->addOption($select_name, 'minLength', 'minLength');
        $this->addOption($select_name, 'maxLength', 'maxLength');
        $this->addOption($select_name, 'length', 'length');
        $this->addOption($select_name, 'startsWith', 'startsWith');
        $this->addOption($select_name, 'notStartsWith', 'notStartsWith');
        $this->addOption($select_name, 'endsWith', 'endsWith');
        $this->addOption($select_name, 'notEndsWith', 'notEndsWith');
        $this->addOption($select_name, 'ip', 'ip');
        $this->addOption($select_name, 'url', 'url');
        $this->addOption($select_name, 'date', 'date');
        $this->addOption($select_name, 'minDate', 'minDate');
        $this->addOption($select_name, 'maxDate', 'maxDate');
        $this->addOption($select_name, 'ccnum', 'ccnum');
        $this->addOption($select_name, 'oneOf', 'oneOf');
        $this->addOption($select_name, 'hasLowercase', 'hasLowercase');
        $this->addOption($select_name, 'hasUppercase', 'hasUppercase');
        $this->addOption($select_name, 'hasNumber', 'hasNumber');
        $this->addOption($select_name, 'hasSymbol', 'hasSymbol');
        $this->addOption($select_name, 'hasPattern', 'hasPattern');
        $this->addSelect($select_name, FUNCTION_CONST, 'data-slimselect=true, data-index=' . $index . ', data-column-name=' . $column_name . ', data-show-search=false');
        if (!empty($validation_helper_text)) {
            $this->addHelper($validation_helper_text, $input_name);
        }
        $options = array(
            'horizontalLabelCol' => 'col-md-4 mb-md-2 col-lg-2',
            'horizontalElementCol' => 'col-md-8 mb-md-2 col-lg-4'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_name, '', ARGUMENTS);

        // remove button
        $options = array(
            'horizontalElementCol' => 'col-12 mb-md-4 col-lg-1 mb-lg-0'
        );
        $this->setOptions($options);
        $this->addBtn('button', 'validation_remove-' . $index, (string) $index, '<i class="fas fa-circle-xmark"></i>', 'class=btn btn-sm btn-danger validation-remove-element-button, aria-label=Close, data-index=' . $index);
        $this->addHtml('</div></div>');
    }

    /**
     * Adds filter fields to the form.
     *
     * @param string $table The table name.
     * @param array $columns The columns of the table.
     * @param array $columns_types The data types of the columns.
     * @param int $index The index of the filter field.
     * @return void
     */
    public function addFilterFields(string $table, array $columns, array $columns_types, int $index): void
    {
        $this->setCols(2, 8);
        $this->groupElements('filter-mode-' . $index, 'filter_remove-' . $index);

        $clazz = 'primary-200';
        if (Utils::pair($index)) {
            $clazz = 'primary-100';
        }

        // filter mode
        $this->addHtml('<div id="filters-ajax-elements-' . $index . '" class="row filters-dynamic text-bg-' . $clazz . ' shadow-sm" data-index="' . $index . '"><div class="col-12 py-2">');
        $this->addRadio('filter-mode-' . $index, SIMPLE, 'simple', 'checked');
        $this->addRadio('filter-mode-' . $index, ADVANCED, 'advanced');
        $this->printRadioGroup('filter-mode-' . $index, 'Mode');

        // remove button
        $this->setOptions(['horizontalLabelCol' => '', 'horizontalElementCol' => 'col text-end']);
        $this->addBtn('button', 'filter_remove-' . $index, (string) $index, '', 'class=btn-close ms-auto filters-remove-element-button, data-bs-toggle=tooltip, data-bs-title=' . REMOVE_THIS_FILTER . ', aria-label=Close, data-index=' . $index);
        $this->setOptions(['horizontalElementCol' => 'col-sm-8']);

        // ajax
        $this->setCols(2, 10);
        $this->addRadio('filter-ajax-' . $index, NO, (string) false, 'checked');
        $this->addRadio('filter-ajax-' . $index, YES, (string) true);
        $this->addHelper(AJAX_LOADING_HELP, 'filter-ajax-' . $index);
        $this->printRadioGroup('filter-ajax-' . $index, AJAX_LOADING);

        // simple filters
        $this->startDependentFields('filter-mode-' . $index, 'simple');
        $columns_count = count($columns);
        $datetime_field_types = explode(',', DATETIME_FIELD_TYPES);
        $table_datefields = array();
        for ($i = 0; $i < $columns_count; $i++) {
            $column_name = $columns[$i];
            $column_type = $columns_types[$i];
            $this->addOption('filter_field_A-' . $index, $column_name, $table . '.' . $column_name);
            if (in_array($column_type, $datetime_field_types)) {
                $table_datefields[] = $column_name;
            }
        }
        $this->setCols(2, 10);
        $this->addHtml('<span class="form-text text-muted">' . FILTER_HELP_1 . '</span>', 'filter_field_A-' . $index, 'after');
        $this->addSelect('filter_field_A-' . $index, FIELDS_TO_FILTER, 'data-slimselect=true, data-show-search=false');

        // dependent field for date fields
        if (!empty($table_datefields)) {
            $this->startDependentFields('filter_field_A-' . $index, implode(', ', $table_datefields));
            $this->addRadio('filter-daterange-' . $index, NO, (string) false, 'checked');
            $this->addRadio('filter-daterange-' . $index, YES, (string) true);
            $this->addHelper(FILTER_BY_DATE_RANGE_HELPER, 'filter-daterange-' . $index);
            $this->printRadioGroup('filter-daterange-' . $index, FILTER_BY_DATE_RANGE);
            $this->endDependentFields();
        }

        $this->endDependentFields();

        // advanced filters
        $this->startDependentFields('filter-mode-' . $index, 'advanced');
        $this->setCols(2, 4);
        $this->groupElements('filter_select_label-' . $index, 'filter_option_text-' . $index);
        $this->addInput('text', 'filter_select_label-' . $index, '', LABEL);
        $this->addInput('text', 'filter_option_text-' . $index, '', VALUE_S);

        $this->groupElements('filter_fields-' . $index, 'filter_field_to_filter-' . $index);
        $this->addInput('text', 'filter_fields-' . $index, '', FIELDS);
        $this->addInput('text', 'filter_field_to_filter-' . $index, '', FIELDS_TO_FILTER);

        $this->setCols(2, 10);
        $this->addInput('text', 'filter_from-' . $index, '', SQL_FROM);
        if (!isset($_SESSION['form-select-fields']['filter_type-' . $index])) {
            $_SESSION['form-select-fields']['filter_type-' . $index] = 'text';
        }
        $this->setCols(2, 6);
        $this->groupElements('filter_type-' . $index, 'filter_test-' . $index);
        $this->addRadio('filter_type-' . $index, TEXT, 'text');
        $this->addRadio('filter_type-' . $index, BOOLEAN_CONST, 'boolean');
        $this->printRadioGroup('filter_type-' . $index, VALUES_TYPE);
        $this->setCols(0, 4);
        $this->addBtn('button', 'filter_test-' . $index, (string) $index, TEST, 'class=btn btn-sm btn-success pull-right');
        $this->endDependentFields();

        $this->addHtml('</div></div>');
    }

    /**
     * Get the documentation link.
     *
     * @param string $url The URL of the documentation.
     * @return string The HTML link to the documentation.
     */
    public function getDocLink(string $url): string
    {
        return '<a href="' . $url . '" class="text-info ms-2" data-bs-toggle="tooltip" data-bs-title="' . DOC . '" target="_blank"><i class="' . ICON_INFO . ' fa-xl"></i></a>';
    }

    /**
     * Get the hidden fields.
     *
     * @return string The hidden fields.
     */
    public function getHiddenFields(): string
    {
        return $this->hidden_fields;
    }

    /**
     * Set the options to justify center.
     *
     * @return void
     */
    public function optionsJustifyCenter(): void
    {
        $this->savedOptions = array(
            'elementsWrapper' => $this->options['elementsWrapper'],
            'horizontalLabelCol' => $this->options['horizontalLabelCol'],
            'horizontalElementCol' => $this->options['horizontalElementCol']
        );
        $options = array(
            'elementsWrapper' => '<div class ="row align-items-center justify-content-center"></div>',
            'horizontalLabelCol' => 'col flex-grow-0 ms-5 text-nowrap',
            'horizontalElementCol' => 'col flex-grow-0 text-nowrap'
        );
        $this->setOptions($options);
    }

    /**
     * Revert the options to the saved options.
     *
     * @return void
     */
    public function optionsRevert(): void
    {
        $this->options = array_merge($this->options, $this->savedOptions);
        $this->elements_end_wrapper = $this->getElementWrapper($this->options['elementsWrapper'], 'end');
        $this->elements_start_wrapper = $this->getElementWrapper($this->options['elementsWrapper'], 'start');
    }

    /**
     * create Validator object and auto-validate all required fields
     * @param  string $form_ID the form ID
     * @param  string $lang the active language
     * @return object          the Validator
     */
    public static function validate(string $form_ID, string $lang = 'en'): \phpformbuilder\Validator\Validator
    {
        include_once dirname(__FILE__) . '/Validator/Validator.php';
        include_once dirname(__FILE__) . '/Validator/Exception.php';
        $validator = new Validator($_POST, $lang);
        $required = $_SESSION[$form_ID]['required_fields'];
        if ($form_ID === 'form-select-fields' && isset($_POST['action']) && isset($_POST['form-select-fields'])) {
            // remove from the validator all the fields that are not relevant with the posted action
            $required_prefixes = array(
                'build_create_edit' => 'cu_',
                'build_paginated_list' => 'rp_',
                'build_single_element_list' => 'rs_',
                'build_delete' => 'field_delete_confirm_'
            );
            if ($_POST['action'] == 'build_read') {
                $action = $_POST['list_type'];
            } else {
                $action = $_POST['action'];
            }
            $required_prefix = $required_prefixes[$action];
            foreach ($_SESSION[$form_ID]['required_fields'] as $key => $req) {
                if (strpos($req, $required_prefix) === false) {
                    unset($_SESSION[$form_ID]['required_fields'][$key]);
                }
            }
            $required = $_SESSION[$form_ID]['required_fields'];
        }
        foreach ($required as $field) {
            $do_validate = true;

            // if dependent field, test parent posted value & validate only if parent posted value matches condition
            if (!empty($_SESSION[$form_ID]['required_fields_conditions'][$field])) {
                $parent_field = $_SESSION[$form_ID]['required_fields_conditions'][$field]['parent_field'];
                $show_values = preg_split('`,(\s)?`', (string) $_SESSION[$form_ID]['required_fields_conditions'][$field]['show_values']);
                $inverse = $_SESSION[$form_ID]['required_fields_conditions'][$field]['inverse'];

                if (!isset($_POST[$parent_field])) {
                    // if parent field is not posted (nested dependent fields)
                    $do_validate = false;
                } elseif (!in_array($_POST[$parent_field], $show_values) && !$inverse) {
                    // if posted parent value doesn't match show values
                    $do_validate = false;
                } elseif (in_array($_POST[$parent_field], $show_values) && $inverse) {
                    // if posted parent value does match show values but dependent is inverted
                    $do_validate = false;
                }
            }
            if ($do_validate) {
                if (isset($_POST[$field]) && is_array($_POST[$field])) {
                    $field = $field . '.0';
                }
                $validator->required()->validate($field);
            }
        }

        return $validator;
    }

    /* =============================================
        Complete contact form
    ============================================= */

    /**
     * Create a contact form.
     *
     * @return self
     */
    public function createContactForm(): self
    {
        $framework = $this->framework;
        $this->startFieldset('Please fill in this form to contact us', '', 'class=text-center center-align mb-4');
        $this->groupElements('user-name', 'user-first-name');
        $this->setCols(3, 6);
        $this->addHelper('Name', 'user-name');
        $this->addInput('text', 'user-name', '', 'Full Name', 'placeholder=Name, required');
        $this->setCols(0, 3);
        $this->addHelper('First name', 'user-first-name');
        $this->addInput('text', 'user-first-name', '', '', 'placeholder=First Name, required');
        $this->setCols(3, 9);
        $this->addInput('email', 'user-email', '', 'Email', 'placeholder=Email, required');
        $this->addInput('text', 'user-phone', '', 'Phone', 'placeholder=Phone, required');
        $this->addTextarea('message', '', 'Message', 'cols=30, rows=4, required');
        $this->addPlugin('word-character-count', '#message', 'default', array('%maxAuthorized%' => 100));
        $this->centerContent();
        $this->addCheckbox('newsletter', 'Suscribe to Newsletter', '1', 'checked=checked');
        $this->printCheckboxGroup('newsletter', '');
        $this->setCols(0, 12);
        $this->addHcaptcha('321856aa-ff29-4ab6-840a-8db73ca51dbf', 'class=text-center center-align');

        $submit_btn_class = [
            'bs4' => 'btn btn-primary',
            'bs5' => 'btn btn-primary',
            'bulma' => 'button is-primary',
            'foundation' => 'button primary',
            'material' => 'btn waves-effect waves-light',
            'material-bootstrap' => 'btn btn-primary waves-effect waves-light',
            'tailwind' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center center-align mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
            'uikit' => 'uk-button uk-button-primary'
        ];

        $this->addBtn('submit', 'submit-btn', '1', 'Send', 'class=' . $submit_btn_class[$framework]);
        $this->endFieldset();

        // Custom radio & checkbox css
        if ($framework !== 'material') {
            $this->addPlugin('nice-check', '#' . $this->form_ID, 'default', ['skin' => 'red']);
        }

        // jQuery validation
        $this->addPlugin('formvalidation', '#' . $this->form_ID);

        return $this;
    }

    /* Contact form validation */

    /**
     * Validate the contact form.
     *
     * @param string $form_name The name of the form.
     * @return bool Returns true if the form is valid, false otherwise.
     */
    public static function validateContactForm(string $form_name): bool
    {
        // create validator & auto-validate required fields
        $validator = static::validate($form_name);

        // additional validation
        $validator->maxLength(100)->validate('message');
        $validator->email()->validate('user-email');
        // hcaptcha validation
        $validator->hcaptcha('0xE49dEF7c889f9a19F34C5AEE68D77EB78eB7870d', 'Captcha Error')->validate('h-captcha-response');

        // check for errors

        if ($validator->hasErrors()) {
            $_SESSION['errors'][$form_name] = $validator->getAllErrors();

            return false;
        } else {
            return true;
        }
    }

    /* =============================================
        Fields shorcuts and groups for users
    ============================================= */

    /**
     * Add an address field to the form.
     *
     * @param string $i The index of the address field.
     * @return $this
     */
    public function addAddress(string $i = ''): self
    {
        $index = $this->getIndex($i);
        $this->setCols(3, 9, 'md');
        $this->addTextarea('address' . $index, '', 'Address', 'required');
        $this->groupElements('zip_code' . $index, 'city' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'zip_code' . $index, '', 'Zip Code', 'required');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'city' . $index, '', 'City', 'required');
        $this->setCols(3, 9, 'md');
        $this->addCountrySelect('country' . $index, 'Country', 'class=no-autoinit, data-width=100%, required');

        return $this;
    }

    /**
     * Add a birth field to the form.
     *
     * @param string $i The index of the birth field.
     * @return $this
     */
    public function addBirth(string $i = ''): self
    {
        $index = $this->getIndex($i);
        $this->setCols(3, 4, 'md');
        $this->groupElements('birth_date' . $index, 'birth_zip_code' . $index);
        $this->addInput('text', 'birth_date' . $index, '', 'Birth Date', 'placeholder=click to open calendar, data-litepick=true, data-select-forward=false, data-dropdown-min-year=1920, data-dropdown-months=true, data-dropdown-years=true');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'birth_zip_code' . $index, '', 'Birth Zip Code');
        $this->setCols(3, 4, 'md');
        $this->groupElements('birth_city' . $index, 'birth_country' . $index);
        $this->addInput('text', 'birth_city' . $index, '', 'Birth  City');
        $this->setCols(2, 3, 'md');
        $this->addCountrySelect('birth_country' . $index, 'Birth Country', 'class=no-autoinit, data-width=100%');

        return $this;
    }

    /**
     * Add a civility select field to the form.
     *
     * @param string $i The index of the civility field.
     * @return $this
     */
    public function addCivilitySelect(string $i = ''): self
    {
        $index = $this->getIndex($i);
        $this->addOption('civility' . $index, 'M.', 'M.');
        $this->addOption('civility' . $index, 'M<sup>s</sup>', 'Ms');
        $this->addSelect('civility' . $index, 'Civility', 'required');

        return $this;
    }

    /**
     * Add a contact field to the form.
     *
     * @param string $i The index of the contact field.
     * @return $this
     */
    public function addContact(string $i = ''): self
    {
        $index = $this->getIndex($i);
        $this->groupElements('phone' . $index, 'mobile_phone' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'phone' . $index, '', 'Phone');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'mobile_phone' . $index, '', 'Mobile', 'required');
        $this->setCols(3, 9, 'md');
        $this->addInput('email', 'email_professional' . $index, '', 'BuisnessE-mail', 'required');
        $this->addInput('email', 'email_private' . $index, '', 'Personal E-mail');

        return $this;
    }

    /**
     * Add an identity field to the form.
     *
     * @param string $i The index of the identity field.
     * @return $this
     */
    public function addIdentity(string $i = ''): self
    {
        $index = $this->getIndex($i);
        $this->groupElements('civility' . $index, 'name' . $index);
        $this->setCols(3, 2, 'md');
        $this->addCivilitySelect($i);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'name' . $index, '', 'Name', 'required');
        $this->setCols(3, 9, 'md');
        $this->startDependentFields('civility' . $index, 'Mrs');
        $this->addInput('text', 'maiden_name' . $index, '', 'Maiden Name');
        $this->endDependentFields();
        $this->groupElements('firstnames' . $index, 'citizenship' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'firstnames' . $index, '', 'Firstnames', 'required');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'citizenship' . $index, '', 'Citizenship');

        return $this;
    }

    /* Submit buttons */

    /**
     * Add a back submit button to the form.
     *
     * @return $this
     */
    public function addBackSubmit(): self
    {
        $this->setCols(0, 12);
        $this->addHtml('<p>&nbsp;</p>');
        $this->addBtn('submit', 'back-btn', '1', 'Back', 'class=btn btn-warning button warning', 'submit_group');
        $this->addBtn('submit', 'submit-btn', '1', 'Submit', 'class=btn btn-success button success', 'submit_group');
        $this->printBtnGroup('submit_group');

        return $this;
    }

    /**
     * Add a cancel submit button to the form.
     *
     * @return $this
     */
    public function addCancelSubmit(): self
    {
        $framework = $this->framework;
        $cancel_btn_class = [
            'bs4' => 'btn btn-warning',
            'bs5' => 'btn btn-warning',
            'bulma' => 'button is-warning',
            'foundation' => 'button warning',
            'material' => 'btn orange darken-1 waves-effect waves-light',
            'material-bootstrap' => 'btn btn-warning waves-effect waves-light',
            'tailwind' => 'text-white bg-amber-500 hover:bg-amber-600 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-amber-900',
            'uikit' => 'uk-button uk-button-default'
        ];
        $submit_btn_class = [
            'bs4' => 'btn btn-primary',
            'bs5' => 'btn btn-primary',
            'bulma' => 'button is-primary',
            'foundation' => 'button primary',
            'material' => 'btn waves-effect waves-light',
            'material-bootstrap' => 'btn btn-primary waves-effect waves-light',
            'tailwind' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center center-align mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
            'uikit' => 'uk-button uk-button-primary'
        ];
        $this->centerContent();
        $this->addBtn('button', 'cancel-btn', '1', 'Cancel', 'class=' . $cancel_btn_class[$framework], 'submit_group');
        $this->addBtn('submit', 'submit-btn', '1', 'Submit', 'class=' . $submit_btn_class[$framework], 'submit_group');
        $this->printBtnGroup('submit_group');

        return $this;
    }

    /**
     * Get the index value.
     *
     * @param string|int $i The index value.
     * @return string|false The index value with a prefix or false if no index is provided.
     */
    private function getIndex($i): mixed
    {
        if ($i !== '') {
            return '-' . $i;
        }

        return false;
    }
}
