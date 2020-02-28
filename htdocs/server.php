<?php

print sprintf("<pre>\$_SERVER['DOCUMENT_ROOT'] => %s", $_SERVER['DOCUMENT_ROOT']);
print '<pre>' . print_r($_SERVER, true) . '</pre>';

?>