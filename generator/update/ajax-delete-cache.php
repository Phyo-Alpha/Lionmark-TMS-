<?php

$cache_file = __DIR__ . '/cache/update-versions.php.cache';
// delete the updater cache
if (file_exists($cache_file)) {
    unlink($cache_file);
}
