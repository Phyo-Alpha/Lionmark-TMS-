<?php

// phpcs:disable PSR1.Files.SideEffects
define('ACCOUNT_NOT_ACTIVATED', 'Dieses Konto ist nicht aktiviert');
define('ACTION_BUTTONS_TARGET', 'Ziel der Aktionsschaltflächen');
define('ACTION_CONST', 'Aktion');
define('ADD', 'Hinzufügen');
define('ADD_CATEGORY', 'Kategorie hinzufügen');
define('ADD_EDIT_VALUES', 'Werte hinzufügen / bearbeiten');
define('ADD_FILTER', 'Filter hinzufügen');
define('ADD_NEW', 'Neuer Eintrag hinzufügen');
define('ADD_TO_NAVBAR', 'Zur Navigationsleiste hinzufügen');
define('ADDRESS', 'Adresse');
define('ADMIN', 'Verwaltung');
define('ADMIN_NAVBAR', 'Admin-Navbar');
define('ADMIN_AUTHENTICATION_MODULE', 'Das Benutzerauthentifizierungsmodul');
define('ADMIN_AUTHENTICATION_MODULE_ENABLED', 'Benutzerauthentifizierung aktiviert');
define('ADMIN_AUTHENTICATION_MODULE_IS_ENABLED', 'Das Benutzerauthentifizierungsmodul ist <span class="text-success-800">aktiviert</span>');
define('ADMIN_AUTHENTICATION_MODULE_DISABLED', 'Benutzerauthentifizierung deaktiviert');
define('ADMIN_AUTHENTICATION_MODULE_INSTALLED', 'Das Benutzerauthentifizierungsmodul wurde erfolgreich installiert. Die Seite wird in ein paar Sekunden automatisch neu geladen.');
define('ADMIN_AUTHENTICATION_MODULE_IS_DISABLED', 'Das Benutzerauthentifizierungsmodul ist <span class="text-danger-800">deaktiviert</span>');
define('ADMIN_AUTHENTICATION_MODULE_IS_NOT_INSTALLED', 'Das Benutzerauthentifizierungsmodul ist nicht installiert.');
define('ADMIN_DASHBOARD', 'Admin-Dashboard');
define('ADMIN_FILTERED_COLUMNS_CLASS_HELPER', 'Geben Sie eine oder mehrere CSS-Klassen ein, um den Stil der gefilterten Spalten in den Admin-READ-Listen festzulegen. Z.B.: bg-gray-200');
define('ADMIN_FILTERED_COLUMNS_CLASS_TXT', 'CSS-Klasse der gefilterten Spalten');
define('ADMIN_PASSWORD_HELP', 'Mindestens 6 Zeichen. Großbuchstaben (s) + obligatorische Kleinbuchstaben (s). Vorgeschlagene Zahl (s) + Symbol (s)');
define('ADVANCED', 'Erweitert');
define('AJAX_LOADING', 'Ajax-Laden');
define('ALL', 'Alle');
define('ALL_ON_THE_SAME_PAGE', 'Alle auf einer Seite');
define('ALL_RECORDS', 'Alle Datensätze');
define('ARGUMENTS', 'Argumente');
define('ARRAY_VALUE_TYPE', 'Array (Ankreuzfeld oder Mehrfachauswahl)');
define('AT_LEAST', 'Mindestens');
define('AUTHENTICATION_MODULE', 'Authentifizierungsmodul');
define('AUTO', 'Automatisch');
define('BACKUP_VERSION', 'Sicherungsversion');
define('BOOLEAN_CONST', 'Boolescher Wert');
define('BUILD', 'Erstellen');
define('BULK_DELETE_BUTTON', 'Massenlöschung zulassen');
define('BULK_DELETE_SUCCESS_MESSAGE', 'Datensatz (Datensätze) gelöscht');
define('CANCEL', 'Abbrechen');
define('CASCADE_DELETE_OPTIONS', 'Kaskaden-Löschoptionen');
define('CHANGES_RECORDED', 'Die Änderungen wurden aufgezeichnet');
define('CHAR_COUNT', 'Zeichenzähler');
define('CHAR_COUNT_MAX', 'Maximale Anzahl von Zeichen');
define('CHARACTERS', 'Zeichen');
define('CHECKBOXES', 'Kontrollkästchen');
define('CHOOSE_DATABASE', 'Datenbank');
define('CHOOSE_LIST_TYPE', 'Listenart');
define('CHOOSE_SELECT_OPTIONS', 'Wählen Sie die Optionen für das Auswahlfeld');
define('CHOOSE_TABLE', 'Wählen Sie eine Tabelle');
define('CHOOSE_VALUES_FROM_TABLE', 'Werte in einer Datenbanktabelle auswählen');
define('CITY', 'Stadt');
define('CLICK_TO_EDIT', 'Zum Bearbeiten anklicken');
define('CLICK_TO_OPEN_THE_ICONPICKER', 'Klicken Sie, um die Icon-Auswahl zu öffnen');
define('CLICK_TO_REFRESH', 'Anklicken zum Aktualisieren und Anzeigen von Änderungen');
define('CLOSE', 'Schließen');
define('CLOSE_WINDOW', 'Sie können dieses Fenster sicher schließen.');
define('COLOR', 'Farbe');
define('COLUMN', 'Spalte');
define('COMPARE', 'Vergleichen');
define('CONFIGURATION', 'Konfiguration');
define('CONSTRAINT_USERS_CREATE_HELPER', 'CREATE/DELETE-Rechte auf der Tabelle users können nicht eingeschränkt werden - das wäre Unsinn');
define('CONSTRAINT_QUERY_TIP', '<p>WHERE Abfrage bei eingeschränkten Rechten.</p><p>Beispiel: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> wird automatisch durch die ID des verbundenen Benutzers ersetzt.</p>');
define('CREATE_IMAGE_THUMBNAILS', 'Miniaturbilder erstellen');
define('CREATED_UPDATED_FILES', 'Erstellte / bearbeitete Dateien');
define('CROP', 'Zuschneiden');
define('CRUD_GENERATOR', 'CRUD-Generator');
define('CURRENT_VERSION_UP_TO_DATE', 'Aktuelle Version ist auf dem neuesten Stand');
define('CURRENT_VIEW', 'Aktuelle Ansicht');
define('CUSTOM', 'Benutzerdefiniert');
define('CUSTOMIZE_THEME_AND_NAVBARS', 'Thema und Navigationsleisten anpassen');
define('CUSTOM_VALUES', 'Benutzerdefinierte Werte');
define('DATABASE_CONST', 'Datenbank');
define('DATABASE_HAS_NO_TABLE', 'Ihre Datenbank hat keine Tabellen. Bitte erstellen Sie einige Tabellen, um Ihr Datenbank-Admin-Panel zu generieren');
define('DATE_CONST', 'Datum');
define('DATE_DISPLAY_FORMAT', 'Datumsanzeigeformat');
define('DATE_HELPER', 'Verfügbare Formate anzeigen');
define('DATE_NOW_HIDDEN', 'Verstecktes aktuelles Datum');
define('DATE_NOW_HIDDEN_HELPER', 'Das Feld ausblenden und den Wert auf das aktuelle Datum setzen (no|yes)');
define('DB_ERROR', 'Fehler bei der Aufzeichnung');
define('DB_RELATIONS_REFRESHED', 'Datenbankbeziehungen wurden aufgefrischt');
define('DB_STRUCTURE_LOADED', 'Die Datenbankstruktur wurde geladen.');
define('DEFAULT_CONST', 'Voreinstellung');
define('DEBUG_DB_QUERIES_ENABLED', 'Simulieren und Debuggen ist aktiviert. Die Datenbankabfragen zum Einfügen/Aktualisieren/Löschen werden simuliert, nicht ausgeführt.');
define('DEFAULT_SEARCH_FIELD', 'Standardfeld für die Suche');
define('DELETE_CONST', 'Entfernen'); // Vermeidung von 'löschen"
define('DELETE_ACTION', 'Löschung');
define('DELETE_CACHE_AND_REFRESH', 'Zum Löschen des Caches und Aktualisieren klicken');
define('DELETE_RECORDS_FROM', 'Datensätze löschen aus ');
define('DELETE_SELECTED_RECORDS', 'Ausgewählte Datensätze löschen');
define('DELETE_SUCCESS_MESSAGE', '1 Datensatz gelöscht');
define('DETAIL', 'Detail');
define('DIFF_FILES', 'Dateien vergleichen');
define('DISABLE', 'Deaktivieren');
define('DISABLED', 'Deaktiviert');
define('DISPLAY', 'Anzeige');
define('DISPLAY_ALL', 'Alles anzeigen');
define('DISPLAY_OF_DATA_TABLES', 'Anzeige von Datentabellen');
define('DISPLAY_NAME', 'Angezeigter Name');
define('DISPLAY_VALUE', 'Angezeigter Wert');
define('DOC', 'Anklicken, um die Dokumentation in einer neuen Registerkarte zu öffnen');
define('DOMAIN', 'Bereich');
define('DRAG_ME', 'Ziehen Sie mich');
define('EDIT', 'Bearbeiten');
define('EDITABLE_CONTENT', 'Bearbeitbarer Inhalt');
define('EDIT_IN_PLACE', 'direktes bearbeiten');
define('EMAIL', 'E-Mail');
define('ENABLE', 'Aktivieren');
define('ENABLED', 'Aktiviert');
define('ENABLE_SORTING', 'Sortierung einschalten');
define('ENTER_YOUR_CREDENTIALS_BELOW', 'Geben Sie Ihre Anmeldedaten unten ein');
define('ERROR', 'Fehler');
define('ERROR_CANT_CREATE_DIR', 'Verzeichnis kann nicht erstellt werden');
define('ERROR_CANT_WRITE_FILE', 'Datei kann nicht erstellt/bearbeitet werden');
define('ERROR_FILE_NOT_FOUND', 'Datei nicht gefunden. Sie müssen diese Seite mit dem CRUD-Generator erstellen, bevor Sie auf sie zugreifen können');
define('EXPORT', 'Exportieren');
define('EXPORT_BUTTON', '"Export"-Schaltfläche');
define('EXTERNAL_RELATIONS', 'Externe Beziehungen');
define('FAILED_TO_CONNECT_DB', 'Fehler beim Verbinden mit der Datenbank');
define('FAILED_TO_DELETE', 'Konnte nicht gelöscht werden');
define('FAILURE', 'Fehlschlag');
define('FIELD', 'Feld');
define('FIELD_DELETE_CONFIRM', 'Feld zur Bestätigung der Löschung');
define('FIELD_HEIGHT', 'Feldhöhe');
define('FIELD_TYPE', 'Feldtyp');
define('FIELD_WIDTH', 'Feldbreite');
define('FIELDS', 'Felder');
define('FIELDS_TO_DISPLAY', 'Anzuzeigende Felder');
define('FIELDS_TO_FILTER', 'Zu filternde Felder');
define('FILE', 'Datei');
define('FILE_AUTHORIZED', 'Zugelassene Dateitypen');
define('FILE_NOT_FOUND', 'Datei nicht gefunden');
define('FILE_PATH', 'Dateipfad');
define('FILE_URL', 'Datei-URL');
define('FILTER', 'Filter');
define('FILTER_BY_DATE_RANGE', 'Filter nach Datumsbereich');
define('FILTER_BY_DATE_RANGE_HELPER', 'Wenn "Ja", werden die Benutzer die Datensätze zwischen 2 Daten auswählen. Andernfalls wählen sie ein einzelnes Datum.<br><span class="text-orange-600">Kann nicht mit Ajax-Laden verwendet werden.</span>');
define('FILTER_DROPDOWNS', 'Filter (Dropdown-Listen zum Filtern der Ergebnisse)');
define('FILTER_HELP_1', 'Filterfeld');
define('FILTER_HELP_2', 'Zugehöriges Feld - Optional - (Beispiel: Vorname + Nachname)');
define('FILTER_LIST', 'Die Liste filtern');
define('FIRST_NAME', 'Vorname');
define('FORGOT_PASSWORD', 'Passwort vergessen');
define('FORMS_GENERATED', 'Erstellte Formulare');
define('FUNCTION_CONST', 'Funktion');
define('GENERAL_SETTINGS', 'Allgemeine Einstellungen');
define('GENERATED_FILTER', 'Filter generiert');
define('GROUP_WARNING', 'Das gruppierte Feld %field% muss mit einem zweiten zusammenhängenden Feld gruppiert werden');
define('GROUP_WIDTH_WARNING', 'Die Gruppe [%field1%, %field2%] überschreitet die maximale Breite (100%)');
define('GROUPED', 'Gruppiert');
define('HEIGHT', 'Höhe');
define('HELP_TEXT', 'Hilfetext');
define('HIDE', 'Ausblenden');
define('HOME', 'Startseite');
define('HTML', 'Html');
define('HUMAN_READABLE_NAMES', 'In der Verwaltung angezeigte Feldnamen');
define('IMAGE', 'Bild');
define('IMAGE_EDITOR', 'Bildbearbeitungsprogramm');
define('IMAGE_PATH', 'Bilderpfad');
define('IMAGE_URL', 'Bild-URL');
define('IN_A_PAGINATED_LIST', 'In einer Liste mit Seiten');
define('INFO_REGISTERED', 'Informationen registriert');
define('INSTALL_ADMIN_AUTHENTICATION_MODULE', 'Das Benutzerauthentifizierungsmodul installieren');
define('INSERT_SUCCESS_MESSAGE', '1 Datensatz hinzugefügt');
define('INSUFFICIENT_RIGHTS_IN_AUTHENTICATION_MODULE', 'Ihr Benutzerprofil erlaubt es Ihnen nicht, den <span class="fw-bold">%TABLE%</span> Inhalt zu lesen oder zu bearbeiten. <br>Um auf diese Ressource zuzugreifen, müssen Sie Ihren Administrator bitten, Ihre Rechte zu erweitern.');
define('INVALID_CHARS_ERROR', 'Die folgenden %target_name% enthalten ungültige Zeichen, die nicht dem Standard entsprechen:<br>%target_values%<br><br>Sie <span class="fw-bold">MÜSSEN</span> diese Namen ändern, da sonst die PHPCG-Funktionalitäten nicht mehr funktionieren.<br><br>Erlaubte Zeichen sind: Kleinbuchstaben, Großbuchstaben, Zahlen und Unterstriche. Zahlen sind als 1. Zeichen nicht erlaubt.<br><br><span class="fw-bold">Klicken Sie anschließend auf die Schaltfläche "Datenbankstruktur neu laden".</span>.');
define('LABEL', 'Label');
define('LAST_NAME', 'Name');
define('LIST_CONSTANT', 'Liste');
define('LIST_GENERATED', 'Liste erzeugt');
define('LOAD', 'Laden');
define('LOADING_PLEASE_WAIT', 'Laden ... bitte warten');
define('LOGIN_ERROR', 'Authentifizierungsfehler');
define('LOGIN_TO_YOUR_ACCOUNT', 'Anmelden');
define('LOGOUT', 'Abmelden');
define('LOWERCASE', 'Kleinbuchstaben');
define('LOWERCASE_CHARACTERS', 'Kleinbuchstaben');
define('MAIN_SETTINGS', 'Haupteinstellungen');
define('MAX_HEIGHT', 'Maximale Höhe');
define('MAX_SIZE_HELPER', 'Leer lassen, wenn keine Begrenzung');
define('MAX_WIDTH', 'Maximale Breite');
define('MERGE', 'Zusammenführen');
define('MERGE_DONE', 'Die Datei %FILE% wurde aktualisiert.');
define('MATCHING_RECORDS_WILL_BE_DELETED', 'Übereinstimmende Datensätze in der/den folgenden Tabelle(n) werden gleichzeitig gelöscht');
define('MESSAGE_SENT', 'Nachricht gesendet');
define('MISSING_TABLE_IN_AUTHENTICATION_MODULE', 'Die <span class="fw-bold">%TABLE%</span> Tabelle wird im Adminpanel verwendet, wurde aber nicht mit dem Authentifizierungsmodul installiert. <br> Das Authentifizierungsmodul muss neu installiert werden, um die Tabelle <span class="fw-bold">%TABLE%</span> in der Verwaltung der Profilrechte hinzuzufügen.<br><a class="text-danger" href="https://www.phpcrudgenerator.com/documentation/index#admin-user-authentication-module" target="_blank">Wie man das Admin-Benutzerauthentifizierungsmodul neu installiert/aktualisiert</a>');
define('MOBILE_PHONE', 'Mobiltelefon');
define('MULTIPLE_CONST', 'Mehrfach');
define('NAME', 'Name');
define('NEED_HELP', 'Hilfe nötig');
define('NESTED_TABLE', 'Verschachtelte Tabelle');
define('NEW_VERSION', 'Neue Version');
define('NO', 'Nein');
define('NO_HTML', 'Kein html');
define('NO_PRIMARY_KEY', 'Kein Primärschlüssel gefunden. Der Primärschlüssel ist für das Funktionieren Ihrer Verwaltung unerlässlich.');
define('NO_RECORD_FOUND', 'Kein Datensatz gefunden');
define('NO_RELATIONSHIP_FOUND', 'Keine Beziehung gefunden');
define('NO_RESULT_FOUND', 'Kein Ergebnis gefunden');
define('NO_VALUE_SELECTED', 'Bitte setzen Sie Werte für das Feld ');
define('NONE', 'Keine');
define('NOTHING_TO_MERGE', '<p>Die Quell- und Zieldatei sind identisch.</p><p>Es gibt nichts zusammenzuführen.</p>');
define('NUMBER', 'Zahl');
define('NUMBERS', 'Zahlen');
define('OK', 'Ok');
define('OPEN_ADMIN_PAGE', 'Öffne die Verwaltungsseite');
define('OPEN_URL', 'URL öffnen');
define('OPEN_URL_BUTTON', '<em>"URL öffnen"</em> Schaltfläche');
define('OPTIONS', 'Optionen');
define('ORDER_BY', 'Ordnen nach');
define('ORGANIZE_ADMIN_NAVBAR', 'Admin-Navbar organisieren');
define('PAGE', 'Seite');
define('PAGINATED_LIST', 'Liste mit Seiten');
define('PASSWORD', 'Kennwort');
define('PASSWORD_CONSTRAINT', 'Beschränkungen');
define('PASSWORD_EDIT_HELPER', 'Leer lassen, um das aktuelle Passwort zu behalten');
define('PHONE', 'Telefon');
define('PHP_ERRORS_MONITOR_ENABLED_HELPER', 'Aktivieren, um eine E-Mail zu erhalten, wenn ein PHP-Fehler auftritt.');
define('PHP_ERRORS_MONITOR_ENABLED_TXT', 'PHP ERRORS Überwachung aktivieren');
define('PHP_ERRORS_MONITOR_RECIPIENT_EMAILS_HELPER', 'Geben Sie eine E-Mail-Adresse oder mehrere durch Komma getrennte Adressen an');
define('PHP_ERRORS_MONITORING_TXT', 'PHP-Fehlerüberwachung');
define('PRINT', 'Drucken');
define('PROFILE', 'Profil');
define('PURCHASE_CODE', 'Einkaufscode');
define('QUERY', 'Abfrage');
define('QUERY_FAILED', 'Die Abfrage ist fehlgeschlagen');
define('RECORDING', 'Aufzeichnung');
define('RECORDS', 'Datensätze');
define('REFERENCED_TABLE', 'Referenzierte Tabelle');
define('REFERENCED_COLUMN', 'Referenzierte Spalte');
define('REFRESH', 'Aktualisieren');
define('RELATIONS', 'Beziehungen');
define('REFRESH_DB_RELATIONS', 'Aktualisieren der Datenbankbeziehungen');
define('REFRESH_DB_STRUCTURE', 'Aktualisieren der Datenbankstruktur');
define('REINSTALL', 'Neu installieren');
define('REINSTALL_TIP', 'Alle Benutzerdaten löschen und eine neue Installation starten. Klicken Sie vor der Bestätigung für weitere Details.');
define('REMOVE', 'Entfernen');
define('REMOVE_ADMIN_AUTHENTICATION_MODULE_HELPER', '<p>Damit werden alle Benutzer- und Profildateien aus dem Admin und Generator sowie die Tabellen "%USERS_TABLE%" und "%USERS_TABLE%_profiles" aus Ihrer Datenbank gelöscht.</p>');
define('REMOVE_FROM_NAVBAR', 'Aus der Navigationsleiste entfernen');
define('REMOVE_THIS_FILTER', 'Diesen Filter entfernen');
define('REQUIRED', 'Erforderlich');
define('RESET', 'Zurücksetzen');
define('RESET_TABLE_DATA', 'Tabellendaten zurücksetzen');
define('RESTRICTED', 'Eingeschränkt');
define('RESULTS_PER_PAGE', 'Ergebnisse');
define('SAVE_CHANGES', 'Änderungen speichern');
define('SEARCH', 'Suche');
define('SEARCHING', 'Suchen ...');
define('SELECT_CONST', 'Auswählen');
define('SELECT_ACTION', 'Eine Aktion auswählen');
define('SELECT_DATABASE', 'Eine Datenbank auswählen');
define('SELECT_FIELDS_TYPES_FOR_CREATE_UPDATE', 'Wählen Sie die Feldtypen und Optionen für Create | Update');
define('SELECT_MULTIPLE', 'Mehrere auswählen');
define('SELECT_OPTIONS_FOR_PAGINATED_LIST', 'Optionen aus der Liste mit Seitenangaben');
define('SELECT_OPTIONS_FOR_SINGLE_ELEMENT_LIST', 'Optionen der Einzelsatzliste');
define('SELECT_OPTIONS_FOR_DELETE_FORM', 'Optionen für das Löschungsformular');
define('SELECT_TABLES_USED_IN_ADMIN', 'In der Verwaltung verwendete Tabellen');
define('SELECT_TABLES_USED_IN_ADMIN_HELP', 'Die ausgewählten Tabellen werden verwendet, um Benutzerrechteprofile zu definieren');
define('SESSION_EXPIRED', 'Die Sitzung ist abgelaufen. Bitte verbinden Sie das CRUD erneut mit Ihrer Datenbank.');
define('SHOW', 'Anzeigen');
define('SHOW_SEARCH_RESULTS', 'Suchergebnisse anzeigen');
define('SIGN_IN', 'Anmelden');
define('SIDEBAR_EMPTY_ALERT', 'Seitenleiste ist leer');
define('SIDE_BY_SIDE_COMPARISON', 'Seitenweiser Vergleich');
define('SIDE_BY_SIDE_COMPARISON_HELPER', 'Klicken Sie auf die Teile, die Sie in der linken und rechten Spalte behalten wollen, dann <span class="fw-bold">"' . MERGE . '"</span>, um Ihre Auswahl zu speichern');
define('SIMPLE', 'Einfach');
define('SINGLE', 'Einzigartig');
define('SINGLE_RECORD', 'Einzelner Datensatz');
define('SITE_ADMINISTRATOR', 'Hauptadministrator');
define('SKIP_THIS_FIELD', 'Nicht in der Liste anzeigen');
define('SQL_FROM', 'SQL FROM');
define('STATUS', 'Status');
define('STRUCTURE', 'Struktur');
define('STRUCTURE_AND_DATA', 'Struktur und Daten');
define('STRUCTURE_ONLY', 'Struktur');
define('STYLES_PREFERENCES_FAILURE', 'Ihre Stilvorgaben konnten leider nicht gespeichert werden.');
define('STYLES_PREFERENCES_REGISTERED', 'Ihre Stilvorgaben wurden gespeichert.');
define('STYLES_REVERT', 'Zu den Standardstilen zurückkehren');
define('SUBMIT', 'Speichern');
define('SUCCESS', 'Erfolg');
define('SYMBOLS', 'Symbole');
define('TABLE', 'Tabelle');
define('TABLE_HAS_BEEN_REMOVED', 'Die Tabelle %table% wurde aus dem Generator und der Administrationsoberfläche entfernt');
define('TABLES', 'Tabellen');
define('TEST', 'Test');
define('TEXT', 'Text');
define('TEXT_INPUT', 'Eingabetext');
define('TEXT_NUMBER', 'Text / Zahl');
define('TEXTAREA', 'Textbereich');
define('TIME_DISPLAY_FORMAT', 'Zeitanzeigeformat');
define('TIME_PLACEHOLDER', 'Zeit');
define('TINYMCE', 'Tinymce');
define('TOGGLE_ALL', 'Alles umschalten');
define('TOGGLE_FULL_SCREEN', 'Vollbild umschalten');
define('TOOLS', 'Werkzeuge');
define('TOOLTIP', 'Tooltip');
define('TYPE', 'Typ');
define('TYPE_2_OR_MORE_CHARACTERS', '2 oder mehr Zeichen eingeben');
define('UNABLE_TO_MERGE', 'Zusammenführen nicht möglich: Nicht alle Konflikte wurden gelöst.');
define('INCOMPATIBLE_FIELD_TYPES', 'Inkompatible Feldtypen');
define('INCOMPATIBLE_FIELD_TYPES_TEXT', 'Das CRUD-System akzeptiert keine binären Daten. Wenn Sie diesen Datentyp verwenden, wird empfohlen, Ihre Daten als Dateien außerhalb Ihrer Datenbank zu speichern und die Pfade zu diesen Dateien in Textfeldern innerhalb Ihrer Datenbank zu speichern.<br>Die betroffenen Felder sind die folgenden:');
define('UNHANDLED_FIELD_TYPES', 'Unbehandelte Feldtypen');
define('UNHANDLED_FIELD_TYPES_TEXT', 'Die folgenden Feldtypen werden vom CRUD-System nicht behandelt und werden als "<em>Text</em>"-Felder betrachtet:');
define('UNINSTALL_SUCCESS_MESSAGE', 'Der PHP CRUD Generator wurde erfolgreich zurückgesetzt.');
define('UPDATE_SUCCESS_MESSAGE', '1 geänderter Datensatz');
define('UPPERCASE', 'Großbuchstaben');
define('UPPERCASE_CHARACTERS', 'Großbuchstaben');
define('URL', 'Url');
define('USER_MANAGEMENT', 'Benutzerverwaltung');
define('USER_MANAGEMENT_SUCCESSFULLY_CREATED', 'Benutzerverwaltung erfolgreich erstellt. Sie können jetzt Benutzer & Profile hinzufügen/bearbeiten.<br><span class="fw-bold">Die Formulare zum Löschen von Benutzern und Benutzerprofilen müssen mit dem CRUD Generator erstellt werden.</span>');
define('USERS_TABLE_NAME', '<em class="badge text-bg-dark-100">Benutzername</em> Tabellenname');
define('USERS_TABLE_NAME_HELP', 'Nur Kleinbuchstaben + Unterstrich (_)');
define('VALIDATION', 'Validierung');
define('VALUE', 'Wert');
define('VALUE_S', 'Wert(e)');
define('VALUES', 'Werte');
define('VALUES_TO_DISPLAY', 'Anzuzeigende Werte');
define('VALUES_TYPE', 'Art der Werte');
define('VIEW_DETAIL', 'Details anzeigen');
define('VIEW_RECORD_BUTTON', 'Schaltfläche "Datensatz anzeigen"');
define('WIDTH', 'Breite');
define('WITH_A_VERTICAL_SCROLL_BAR', 'Mit einer vertikalen Bildlaufleiste');
define('WITHOUT_A_SCROLLBAR', 'Ohne Bildlaufleiste');
define('WRONG_DATE', 'Falsches Datum');
define('WRONG_DATE_FORMAT', 'Falsches Datumsformat');
define('WRONG_TABLE_DATA', 'Falsche Tabellendaten');
define('YES', 'Ja');
define('ZIP_CODE', 'Postleitzahl');

// Titel und Beschreibungen der Admin- und Generatorseiten
define('GENERATOR_PAGE_TITLE', 'PHP CRUD - Admin Panel Generator');
define('GENERATOR_PAGE_DESC', 'Dieser CRUD Generator verbindet sich mit Ihrer Datenbank und analysiert die Tabellen, Felder und die relationale Struktur. Er ermöglicht es Ihnen, mit wenigen Klicks ein komplettes und professionelles Admin-Dashboard zu erstellen');
define('ADMIN_HOME_PAGE_SUBTITLE', 'Admin Dashboard - Home');
define('ADMIN_HOME_PAGE_DESC', 'Admin Dashboard');
define('ADMIN_HOME_PAGE_SUBTITLE_DEMO', 'Sakila Datenbank Demo');
define('ADMIN_HOME_PAGE_DESC_DEMO', 'Bootstrap Admin Dashboard mit CRUD Funktionalitäten. Dieses Admin-Panel wurde zu Demo-Zwecken mit der MySQL Sakila Datenbank erstellt');
define('ADMIN_LIST_PAGE_DESC_DEMO', 'Dieses Bootstrap 5 Admin-Dashboard wurde aus der Sakila Demo-Datenbank mit PHP CRUD GENERATOR erstellt.');

// Paginierung
define('PAGINATION_RESULTS', 'Ergebnisse');
define('PAGINATION_TO', 'bis');
define('PAGINATION_OF', 'von');

// Tooltips
define('BULK_DELETE_BUTTON_TIP', '<a href="#" data-bs-toggle="tooltip" title="Fügen Sie neben jedem Datensatz ein Kontrollkästchen und eine globale Schaltfläche \'Delete\' ein"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('CREATE_IMAGE_THUMBNAILS_TIP', '<a href="#" data-bs-toggle="tooltip" data-bs-html="true" title="Thumbnails, die in Unterordnern des gewählten Bildordners erzeugt werden:<br>[Bildordner]/thumbs/lg/image.jpg<br>[Bildordner]/thumbs/md/image.jpg<br>[image folder]/thumbs/sm/image.jpg<br><br>Bilder und Thumbnail-Größen können in <em>class/phpformbuilder/plugins/fileuploader/image-upload/php/ajax_upload_file.php</em> bearbeitet werden"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('DATE_DISPLAY_TIP', '<a href="#" data-bs-toggle="tooltip" title="Datum in der Verwaltungsoberfläche angezeigt"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('GROUPED_SINGLE_TIP', '<a href="#" data-bs-toggle="tooltip" title="Die gruppierten Felder werden in den Formularen in derselben Zeile angezeigt."><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('FILE_AUTHORIZED_HELPER', 'Kommagetrennte Liste. Beispiel: doc, docx, xls, xlsx, pdf, txt');
define('FILE_PATH_TIP', '<a href="#" data-bs-toggle="tooltip" title="Pfad des Dateiverzeichnisses vom Stammverzeichnis der Website. Beispiel: uploads/documents/"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('FILE_URL_TIP', '<a href="#" data-bs-toggle="tooltip" title="Url des Dateiverzeichnisses. Beispiel: uploads/documents/"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('IMAGE_EDITOR_TIP', '<a href="#" data-bs-toggle="tooltip" title="Editor zum Zuschneiden und Drehen von Bildern in der Verwaltungsoberfläche"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('IMAGE_PATH_TIP', '<a href="#" data-bs-toggle="tooltip" title="Pfad des Bildverzeichnisses vom Stammverzeichnis der Website. Beispiele: assets/images/ oder assets/img/"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('IMAGE_URL_TIP', '<a href="#" data-bs-toggle="tooltip" title="Url des Bildverzeichnisses. Beispiele: assets/images/ oder assets/img/"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('SINGLE_RECORD_TIP', '<a href="#" data-bs-toggle="tooltip" title="Choose \'' . SINGLE_RECORD . '\', wenn Ihre Tabelle nur einen Datensatz enthält. Die Details des Datensatzes werden auf der Seite zeilenweise und nicht als Liste angezeigt. Dies ist zum Beispiel für eine allgemeine Konfigurationstabelle nützlich, in der ein einzelner Datensatz alle Einstellungen enthält."><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('TIME_DISPLAY_TIP', '<a href="#" data-bs-toggle="tooltip" title="In der Verwaltungsoberfläche angezeigte Zeit"><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');
define('VIEW_RECORD_BUTTON_TIP', '<a href="#" data-bs-toggle="tooltip" title="Ermöglicht es den Verwaltungsbenutzern, die Details jedes Datensatzes mit einer Schaltfläche aus der READ-Liste neben den Schaltflächen zum Bearbeiten/Löschen anzuzeigen."><i class="fas fa-xl fa-question-circle text-secondary-700 append"></i></a>');

// Monate
define('JANUAR', 'Januar');
define('FEBRUAR', 'Februar');
define('MARCH', 'März');
define('APRIL', 'April');
define('MAI', 'Mai');
define('JUNI', 'Juni');
define('JULY', 'Juli');
define('AUGUST', 'August');
define('SEPTEMBER', 'September');
define('OCTOBER', 'Oktober');
define('NOVEMBER', 'November');
define('DECEMBER', 'Dezember');

// Hilfe-HTML-Inhalt
define('AJAX_LOADING_HELP', 'Aktivieren Sie das Ajax-Laden, wenn Ihre Tabelle sehr viele Datensätze enthält.');
define('ADMIN_AUTHENTICATION_MODULE_HELPER', 'Das Installationsprogramm für das Benutzerauthentifizierungsmodul ermöglicht die <a href="https://www.phpcrudgenerator.com/tutorials/user-profiles-and-rights" class="text-info-800">Konfiguration der Zugriffsrechte auf die Admin-Elemente</a>.<br><strong>Es sollte daher zuletzt installiert werden, nachdem alle Elemente des CRUD</strong> erstellt wurden.');
define('AUTO_INCREMENT_HELP', '<p class="text-muted">Auto-Increment-Feldwerte werden in CREATE-Formularen automatisch generiert<br>Validierung erfolgt automatisch und kann nicht geändert werden</p>');
define('CREATE_IMAGE_THUMBNAILS_HELP', 'Wenn Sie die Generierung von Miniaturbildern aktivieren, müssen Sie innerhalb Ihres Upload-Verzeichnisses einen Ordner mit dem Namen \'thumbs\' und innerhalb des Verzeichnisses \'thumbs\' drei Ordner mit den Namen \'lg\', \'md\' und \'sm\' erstellen.');
define('DRAG_AND_DROP_HELP', 'Drag & Drop zum Organisieren - <span class="text-gray">Leere Kategorien werden automatisch entfernt</span>');
define('FIELD_DELETE_CONFIRM_HELP', '<p class="text-muted">Felder, die dem Benutzer in der Verwaltung zur Bestätigung des Löschens angezeigt werden</p>');

$filter_help = '<div class="w-100 p-5 text-bg-info-200">' . "\n";
$filter_help .= '<p class="alert alert-info has-icon">Verwenden Sie <a href="https://www.activedbsoft.com/overview-querytool.html" rel="nofollow" target="_blank">FlySpeed SQL Query</a>, um Ihre Abfragen zu erstellen und zu testen</p>';
$filter_help .= '<dl class="dl-horizontal mb-20">' . "\n";
$filter_help .= '<dt>' . LABEL . '</dt>' . "\n";
$filter_help .= '<dd>Label, das neben der Dropdown-Liste angezeigt wird.<br>Beispiel : "Autor"</dd>' . "\n";
$filter_help .= '<dt>' . VALUE_S . '</dt>' . "\n";
$filter_help .= '<dd>Felder, die in der Dropdown-Liste angezeigt werden sollen, getrennt durch "+".<br>Beispiel : "autoren.name + autoren.vorname"</dd>' . "\n";
$filter_help .= '<dt>' . FIELDS . '</dt>' . "\n";
$filter_help .= '<dd>Felder für die Abfrage SQL SELECT.<br>Beispiel : "authors.name, authors.first_name, articles.authors_id"</dd>' . "\n";
$filter_help .= '<dt>' . FIELDS_TO_FILTER . '</dt>' . "\n";
$filter_help .= '<dd>Das Feld, das zum Filtern der Abfrage verwendet wird.<br>Beispiel : "articles.authors_id"</dd>' . "\n";
$filter_help .= '<dt>' . SQL_FROM . '</dt>' . "\n";
$filter_help .= '<dd>SQL FROM query.<br>Beispiel : "articles Left Join authors On articles.authors_id = authors.id"</dd>' . "\n";
$filter_help .= '<dt>' . VALUES_TYPE . '</dt>' . "\n";
$filter_help .= '<dd>Text oder Boolescher Wert.</dd>' . "\n";
$filter_help .= '</dl>' . "\n";
$filter_help .= '<p><span class="fw-bold">Die als Beispiel angeführte Abfrage lautet wie folgt :</span></p><pre class=" mb-20"><code>SELECT DISTINCT authors.name, authors.first_name, articles.authors_id FROM articles INNER JOIN authors ON articles.authors_id = authors.id</code></pre>' . "\n";
$filter_help .= '<p><span class="fw-bold">Wenn der Benutzer einen Eintrag aus der Liste ausgewählt hat :</span></p><pre><code>SELECT DISTINCT authors.name, authors.first_name, articles.authors_id FROM articles INNER JOIN authors ON articles.authors_id = authors.id WHERE articles.authors_id = [gebuchter Wert]</code></pre>' . "\n";
$filter_help .= '</div>' . "\n";
define('FILTER_HELP', $filter_help);
$filter_help_3 = '<p class="alert alert-warning has-icon">Verwenden Sie <span class="badge text-lowercase bg-yellow-400"><code>table.field</code></span> anstelle von <span class="badge text-lowercase bg-yellow-400"><code>field</code></span>, um mehrdeutige Abfragen zu vermeiden.</p>';
define('FILTER_HELP_3', $filter_help_3);
define('RESET_DATA_CHOICES_HELP_1', '<p>In beiden Fällen müssen die Tabelle und ihre Daten neu erstellt werden und werden aus dem Adminbereich entfernt.</p>');
define('RESET_DATA_CHOICES_HELP_2', '<p><span class="text-danger-300 prepend">*</span>Wenn die Tabellenstruktur geändert wurde, wird sie aktualisiert (Felder hinzufügen/ändern/löschen). Vorhandene Daten werden <span class="fw-bold">beibehalten</span> (benutzerdefinierte Feldnamen, Filter, Feldtypen, Auswahlwerte, ...)</p>');
define('RESET_DATA_CHOICES_HELP_3', '<p><span class="text-danger-400 prepend">**</span>Wenn sich die Tabellenstruktur geändert hat, wird sie aktualisiert (Felder hinzufügen/ändern/löschen). Vorhandene Daten werden <span class="fw-bold">zurückgesetzt</span> (benutzerdefinierte Feldnamen, Filter, Feldtypen, Auswahlwerte, ...)</p>');
define('REFRESH_DB_RELATIONS_HELPER', 'Klicken Sie auf diese Schaltfläche, wenn Sie Beziehungen in Ihrer Datenbank geändert haben, damit der CRUD-Generator sie berücksichtigt.');
define('REFRESH_DB_STRUCTURE_HELPER', 'Klicken Sie auf diese Schaltfläche, wenn Sie Ihre Datenbankstruktur geändert haben, damit der CRUD-Generator die Änderungen berücksichtigen kann.');
define('REFRESH_TABLE_HELPER', 'Klicken Sie auf diese Schaltfläche, wenn Sie Ihre Tabellenstruktur für den CRUD-Generator geändert haben, um die Änderungen zu berücksichtigen.');
define('ALLOW_CRUD_IN_LIST', 'Benutzern das Hinzufügen/Bearbeiten/Löschen von Datensätzen aus der <span class="fw-bold">LESELISTE</span> erlauben');
define('EXPLAIN_RELATION', 'Erkläre diese Beziehung');

$relation_many_to_many = '<div class="w-100 p-5 text-bg-info-200">';
$relation_many_to_many .= '<p class="h5"><span class="badge text-bg-info">MANY_TO_MANY Relation</span></p><p>Wenn Sie diese Beziehung aktivieren, können Sie einen oder mehrere <code class="badge text-bg-info-400">%target_table%</code> mit jedem Tabellendatensatz <code class="badge text-bg-info-400">%origin_table%</code> verknüpfen.</p><p class="mb-5">Die <code class="badge text-bg-info-400">%Zwischentabelle%</code> ist in diesem Fall eine <span class="fw-bold">reine relationale Tabelle</span>, die die <code class="badge text-bg-info-400">%Zieltabelle%</code> mit der <code class="badge text-bg-info-400">%Herkunftstabelle%</code> verbindet.</p><p>Die <span class="fw-bold">Leseliste</span> zeigt die Datensätze der Tabelle <code class="badge text-bg-info-400">%target_table%</code> in einer verschachtelten Tabelle an.</p><p>Die Formulare <span class="fw-bold">CREATE</span> und <span class="fw-bold">EDIT</span> ermöglichen es, die Datensätze der Tabelle <code class="badge text-bg-info-400">%target_table%</code> mit der <code class="badge text-bg-info-400">%origin_table%</code> zu verknüpfen,<br>Oder um die Datensätze der Tabelle <code class="badge text-bg-info-400">%target_table%</code> hinzuzufügen/zu bearbeiten/zu löschen.</p>';
$relation_many_to_many .= '</div>';
define('EXPLAIN_RELATION_MANY_TO_MANY', $relation_many_to_many);

$relation_one_to_many = '<div class="w-100 p-5 text-bg-info-200">';
$relation_one_to_many .= '<p class="h5"><span class="badge text-bg-info">ONE_TO_MANY Relation</span></p><p class="mb-5">Wenn Sie diese Beziehung aktivieren, wird die <span class="fw-bold">Leseliste</span> für jeden Datensatz in der Tabelle <code class="badge text-bg-info-400">%target_table%</code> die passenden Einträge der Tabelle <code class="badge text-bg-info-400">%original_table%</code> in einer Sub-Drop-Down Tabelle anzeigen.</p><p>Wenn Sie die <span class="fw-bold"><em>' . ALLOW_CRUD_IN_LIST . '</em></span> aktivieren, können die Benutzer die Datensätze aus der Tabelle <code class="badge text-bg-info-400">%origin_table%</code> direkt aus dieser Untertabelle hinzufügen/bearbeiten/löschen.</p>';
$relation_one_to_many .= '</div>';
define('EXPLAIN_RELATION_ONE_TO_MANY', $relation_one_to_many);

$reinstall_help = '<p>Mit diesem Formular können Sie mit einem Klick die Originalversion von PHP CRUD Generator wiederherstellen und eine neue Installation starten.</p>';
$reinstall_help .= '<p class="text-danger">Warnung: Dateien und Daten werden dauerhaft gelöscht.</p>';
$reinstall_help .= '<p>Wenn Sie ein Backup machen wollen:</p>';
$reinstall_help .= '<ol><li>Erstelle eine Kopie der Verzeichnisse "admin" und "generator"</li>';
$reinstall_help .= '<li>Machen Sie eine SQL-Sicherung Ihrer Tabelle %PHPCG_USERDATA_TABLE%</li></ol>';
$reinstall_help .= '<p class="mb-5">Sie können diese dann wiederherstellen, um den Generator und den Admin mit all Ihren Daten zu finden.</p>';
define('REINSTALL_HELP', $reinstall_help);

define('SIDE_BY_SIDE_COMPARISON_NEED_HELP', '<h3>Warum dieses Tool?</h3><p>Dieses Tool ist nützlich, wenn Sie Code-Änderungen in Admin-Dateien vorgenommen haben, die vom CRUD-Generator generiert wurden.<br>Es ermöglicht Ihnen, Ihre Änderungen wiederherzustellen, nachdem Sie diese Dateien vom CRUD-Generator neu generiert haben.</ p> <h3>Wie funktioniert es?</h3> <p>Wenn Sie die Verwaltungsdateien mit dem CRUD-Generator generieren, wird eine eventuell vorhandene Vorgängerversion automatisch im Ordner <span class="badge text-bg-light">generator/backup-files</span> gespeichert.<br> Wenn Sie den Code der Verwaltungsdateien geändert und diese Dateien dann mit dem CRUD-Generator neu generiert haben, finden Sie Ihren geänderten Code in der linken Spalte (gespeicherte Version).<br> Die rechte Spalte zeigt den Code der aktiven Datei, die in der Verwaltung verwendet wird.<br> Die Unterschiede zwischen den beiden Versionen sind hervorgehoben.</p> <ol class="numbered"> <li class="mb-2">Klicken Sie auf die Teile des Codes, die Sie in der linken oder rechten Spalte behalten möchten.</li> <li class="mb-2">Klicken Sie auf das <span class="badge text-bg-light">' . MERGE . '</span>, um die Änderungen zu übernehmen.</li> </ol> <p>Die Änderungen werden in die aktive Datei übernommen, die in der Verwaltung verwendet wird.<br> Die Sicherungsdatei <span class="badge text-bg-light">generator/backup-files</span> wird unverändert beibehalten.</p>');

$allow_records_management_in_forms = 'Benutzern die Verwaltung von %target_table% über die Formulare "Add/Edit %origin_table%" erlauben';
define('ALLOW_RECORDS_MANAGEMENT_IN_FORMS', $allow_records_management_in_forms);

define('WRONG_TABLE_DATA_MESSAGE', '<div class="alert alert-danger has-icon my-4"> <p><span class="fw-bold">Ihre Navigationsleiste verwendet eine oder mehrere Tabellen, deren Struktur neu generiert werden muss.</span></p> <ol> <li>Öffnen Sie den Generator</li> <li>Wählen Sie Ihre Tabelle aus und klicken Sie auf die Schaltfläche "Zurücksetzen"</li> <li>Wählen Sie "Struktur" und validieren Sie.</li> <li>Dann aktualisieren Sie diese Seite, um Ihre Navigationsleiste zu konfigurieren</li> </ol></div>');
include_once ADMIN_DIR . 'secure/conf/conf.php';
$ut = 'users_table';
if (defined('USERS_TABLE')) {
    $ut = USERS_TABLE;
}

$users_profiles_helper = '<div class="card card-body bg-gray-100 mb-5">';
$users_profiles_helper .= '<h4 class="card-title text-center my-3"><a class="dropdown-toggle text-gray-700" data-bs-toggle="collapse" href="#users-profiles-helper" role="button" aria-expanded="false" aria-controls="users-profiles-helper">Hinweise zur Einschränkung der Rechte von Benutzern</a></h4>';
$users_profiles_helper .= '<div class="collapse" id="users-profiles-helper">';
$users_profiles_helper .= '<ol>';
$users_profiles_helper .= '<li>Setzen Sie die <span class="fw-bold"><em>Lesen</em></span>, <span class="fw-bold"><em>Update</em></span>, <span class="fw-bold"><em>Erstellen/Löschen</em></span> Rechte der Tabelle, die Sie auf "<span class="fw-bold">Restricted</span>" in der Dropdown-Liste einschränken möchten</li>';
$users_profiles_helper .= '<li>In das Feld <span class="fw-bold"><em>Einschränkungsabfrage</em></span> geben Sie die <span class="fw-bold"><em>WHERE</em></span>-Abfrage ein, mit der die Rechte des Benutzers eingeschränkt werden sollen</li>';
$users_profiles_helper .= '</ol>';
$users_profiles_helper .= '<h4 class="badge text-bg-secondary px-3 py-2">Beispiel: </h4><p><code>WHERE your_table.' . $ut . '_ID = CURRENT_USER_ID</code></p>';
$users_profiles_helper .= '<hr>';
$users_profiles_helper .= '<p><code class="fw-bold">CURRENT_USER_ID</code> wird automatisch durch die ID des verbundenen Benutzers ersetzt.</p>';
$users_profiles_helper .= '<hr>';
$users_profiles_helper .= '<p>Ihre Tabelle <span class="fw-bold">MUSS</span> eine <span class="fw-bold">direkte oder indirekte</span> Beziehung mit <code class="fw-bold">' . $ut . '</code> haben. Zum Beispiel:</p>';
$users_profiles_helper .= '<ul>';
$users_profiles_helper .= '<li class="mb-2"><code class="fw-bold">Ihre_Tabelle.' . $ut . '_ID</code> => <code class="fw-bold">' . $ut . '.ID</code> (direkte Beziehung)</li>';
$users_profiles_helper .= '<li><code class="fw-bold">ihre_tabelle.t2_ID</code> => <code class="fw-bold">t2.ID</code><br><code class="fw-bold">t2.' . $ut . '_ID</code> => <code class="fw-bold">' . $ut . '.ID</code> (indirekte Beziehung)</li>';
$users_profiles_helper .= '</ul>';
$users_profiles_helper .= '</div>';
$users_profiles_helper .= '</div>';
define('USERS_PROFILES_HELPER', $users_profiles_helper);

// Überprüfungshilfen
$validation_helper_texts = array(
    'between' => 'between($min, $max, $include = TRUE, $message = null)',
    'callback' => 'callback($callback, $message = null, $params = array())',
    'captcha' => 'captcha($field, $message = null)',
    'ccnum' => 'ccnum($message = null)',
    'date' => 'Datum($message = null)',
    'digits' => 'digits($message = null)',
    'email' => 'email($message = null)',
    'endsWith' => 'endsWith($sub, $message = null)',
    'float' => 'float($message = null)',
    'hasLowercase' => 'hasLowercase($message = null)',
    'hasNumber' => 'hasNumber($message = null)',
    'hasPattern' => 'hasPattern(\\\'/regex/\\\', $message = null)',
    'hasSymbol' => 'hasSymbol($message = null)',
    'hasUppercase' => 'hasUppercase($message = null)',
    'integer' => 'integer($message = null)',
    'ip' => 'ip($message = null)',
    'length' => 'length($length, $message = null)',
    'matches' => 'matches($field, $label, $message = null)',
    'max' => 'max($limit, $include = TRUE, $message = null)',
    'maxDate' => 'maxDate($date, $format, $message = null)',
    'maxLength' => 'maxLength($length, $message = null)',
    'min' => 'min($limit, $include = TRUE, $message = null)',
    'minDate' => 'minDate($date, $format, $message = null)',
    'minLength' => 'minLength($length, $message = null)',
    'notEndsWith' => 'notEndsWith($sub, $message = null)',
    'notMatches' => 'notMatches($field, $label, $message = null)',
    'notStartsWith' => 'notStartsWith($sub, $message = null)',
    'oneOf' => 'oneOf($allowed, $message = null)',
    'required' => 'required($message = null)',
    'startsWith' => 'startsWith($sub, $message = null)',
    'url' => 'url($message = null)'
);

// Hilfsmittel für Kennworteinschränkungen
$lower_char = mb_strtolower(LOWERCASE_CHARACTERS, 'UTF-8');
$char = mb_strtolower(CHARACTERS, 'UTF-8');
define('MIN_3', AT_LEAST . ' 3 ' . $lower_char);
define('MIN_4', AT_LEAST . ' 4 ' . $lower_char);
define('MIN_5', AT_LEAST . ' 5 ' . $lower_char);
define('MIN_6', AT_LEAST . ' 6 ' . $lower_char);
define('MIN_7', AT_LEAST . ' 7 ' . $lower_char);
define('MIN_8', AT_LEAST . ' 8 ' . $lower_char);
define('LOWER_UPPER_MIN_3', AT_LEAST . ' 3 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_MIN_4', AT_LEAST . ' 4 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_MIN_5', AT_LEAST . ' 5 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_MIN_6', AT_LEAST . ' 6 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_MIN_7', AT_LEAST . ' 7 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_MIN_8', AT_LEAST . ' 8 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE);
define('LOWER_UPPER_NUMBER_MIN_3', AT_LEAST . ' 3 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_MIN_4', AT_LEAST . ' 4 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_MIN_5', AT_LEAST . ' 5 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_MIN_6', AT_LEAST . ' 6 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_MIN_7', AT_LEAST . ' 7 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_MIN_8', AT_LEAST . ' 8 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_3', AT_LEAST . ' 3 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_4', AT_LEAST . ' 4 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_5', AT_LEAST . ' 5 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_6', AT_LEAST . ' 6 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_7', AT_LEAST . ' 7 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);
define('LOWER_UPPER_NUMBER_SYMBOL_MIN_8', AT_LEAST . ' 8 ' . $char . ' - ' . LOWERCASE . ' + ' . UPPERCASE . ' + ' . NUMBERS . ' + ' . SYMBOLS);

// Sichere Installationsmeldungen
define('USER_DATA_RESERVED_NAME', '"user_data" ist ein reservierter Tabellenname - bitte wählen Sie einen anderen für Ihre Benutzertabelle');
define('USER_TABLE_ALREADY_EXISTS', 'Die Tabelle mit dem Namen "%posted_table%" existiert bereits. Sie müssen einen anderen Namen wählen.');
define('WRONG_PATTERN', 'Der Tabellenname darf nur Kleinbuchstaben und Unterstriche (_) enthalten');

// Konfigurations-Formular
define('ADMIN_ACTION_BUTTONS_POSITION_TXT', 'Position der Admin ACTION-Schaltflächen');
define('ADMIN_LOGO_HELPER', 'Das hochgeladene Bild wird auf 100px Höhe skaliert');
define('ADMIN_LOGO_TXT', 'Verwaltungslogo');
define('COLLAPSE_INACTIVE_SIDEBAR_CATEGORIES_TXT', 'Inaktive Kategorien in der Seitenleiste einklappen');
define('CONFIGURATION_SUCCESS_MESSAGE', 'Ihre Einstellungen wurden registriert');
define('DATE_TIME_TRANSLATIONS_FOR_LISTS_HELPER', 'Setzt die PHP <code class=language-php">Locale::setDefault</code> für die automatische Übersetzung von PHP-Daten');
define('DATE_TIME_TRANSLATIONS_FOR_LISTS_TXT', 'Datum/Uhrzeit-Übersetzung für Admin-Listen');
define('DATETIMEPICKERS_LANG_HELPER', 'Die verfügbaren Sprachen befinden sich in <span class="badge text-bg-light">class/phpformbuilder/plugins/pickadate/lib/compressed/translations/</span>');
define('DATETIMEPICKERS_LANG_TXT', 'Datum & Uhrzeitauswahl Sprache');
define('DATETIMEPICKERS_MATERIAL_LANG_HELPER', 'Die verfügbaren Sprachen befinden sich in <span class="badge text-bg-light">class\phpformbuilder\plugins\material-datepicker\dist\i18n</span>');
define('DEBUGGING', 'Fehlersuche');
define('DEBUG_SETTINGS_TXT', 'Anzeige der Datenbankfehler');
define('DEBUG_SETTINGS_HELPER', 'Wählen Sie "Ja", um die Details anzuzeigen, wenn eine Datenbankabfrage auf einen Fehler trifft.');
define('DEBUG_DB_QUERIES_SETTINGS_TXT', 'Simulieren und debuggen');
define('DEBUG_DB_QUERIES_SETTINGS_HELPER', 'Wenn aktiviert, werden alle Abfragen zum Einfügen/Aktualisieren/Löschen simuliert (NICHT ausgeführt), und die Details aller Datenbankabfragen werden auf dem Bildschirm angezeigt.');
define('DEFAULT_BUTTONS_CLASS_HELPER', 'Bootstrap CSS-Klasse für die sekundären Schaltflächen des Admin-Panels');
define('DEFAULT_BUTTONS_CLASS_TXT', 'Standard-Schaltflächenklasse');
define('DEFAULT_TABLE_HEADING_CLASS_HELPER', 'Bootstrap-CSS-Klasse für die Tabellenüberschriften des Admin-Panels');
define('DEFAULT_TABLE_HEADING_CLASS_TXT', 'Standardhintergrund für Tabellenüberschriften');
define('ENABLE_FILTERS_TXT', 'Filter einschalten');
define('ENABLE_STYLE_SWITCHING_TXT', 'Aktivieren Sie die Möglichkeit, Stile über das Admin-Dashboard zu ändern');
define('ENABLE_STYLE_SWITCHING_HELPER', 'Wenn aktiviert, kann jeder Benutzer sein eigenes Theme und die Farben der Navigationsleiste wählen.<br>Die Einstellungen werden im Browser gespeichert und haben keinen Einfluss auf die anderen Benutzer');
define('FORMVALIDATION_JAVASCRIPT_LANG_TXT', 'Live (JavaScript) Formularvalidierungssprache');
define('FORMVALIDATION_JAVASCRIPT_LANG_HELPER', 'Die verfügbaren Sprachen befinden sich in <span class="badge text-bg-light">class/phpformbuilder/plugins/formvalidation/js/locales</span>');
define('FORMVALIDATION_PHP_LANG_TXT', 'Serverseitige (PHP) Formularüberprüfungssprache');
define('FORMVALIDATION_PHP_LANG_HELPER', '<a href="https://www.phpformbuilder.pro/documentation/class-doc.php#php-validation-multilanguage" target="_blank">https://www.phpformbuilder.pro/documentation/class-doc.php#php-validation-multilanguage <i class="fas fa-up-right-from-square append"></i></a>');
define('LANGUAGE_OTHER_HELPER', 'Geben Sie den ISO-Code Ihrer Sprache ein und erstellen Sie Ihre Übersetzungsdatei in <span class="badge text-bg-light">admin\i18n\</span>');
define('LANGUAGE_OTHER_TXT', 'Geben Sie Ihre Sprache ein');
define('LANGUAGE_SETTINGS_TXT', 'Spracheinstellungen');
define('LANGUAGE_TXT', 'Sprache');
define('LOCK_THE_GENERATOR_HELPER', 'Bei true müssen Sie Ihre E-Mail & Ihren Kaufcode eingeben, um auf die Generator URL zuzugreifen');
define('LOCK_THE_GENERATOR_TXT', 'Den Generator sperren');
define('NAVBAR_STYLE_TXT', 'Style der Navigationsleiste');
define('NO_LOCALE', '<p class="alert alert-warning">Aktivieren Sie <a href="https://www.php.net/manual/en/book.intl.php" target="_blank">PHP Internationalization Functions</a>, wenn Sie die automatische Übersetzung von Datum & Uhrzeit in den Admin-Listen wünschen.</p>');
define('ON_FILTER_BUTTON_CLICK_TXT', 'Beim Klicken auf die Schaltfläche "Filter"');
define('ON_SELECT_TXT', 'Sobald ein Filter in der Dropdown-Liste ausgewählt wird');
define('ON_THE_LEFT', 'Auf der linken Seite');
define('ON_THE_RIGHT', 'Auf der rechten Seite');
define('PROJECT', 'Projekt');
define('SECURITY', 'Sicherheit');
define('SIDEBAR_STYLE_TXT', 'Seitenleistenstyle');
define('SITE_NAME_HELPER', 'In der Kopfzeile der Verwaltung angezeigter Name');
define('SITE_NAME_TXT', 'Name der Website');
define('STYLES', 'Formatvorlagen');
define('USER_INTERFACE', 'Benutzeroberfläche');
define('USERS_PASSWORD_CONSTRAINT_HELPER', '<a href="https://www.phpformbuilder.pro/documentation/jquery-plugins.php#passfield-example">Passwortmuster werden hier erklärt</a>');
define('USERS_PASSWORD_CONSTRAINT_TXT', 'Passwortbeschränkung für neue Benutzerkonten');
