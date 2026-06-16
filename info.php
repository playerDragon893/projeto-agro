<?php
var_dump(getenv('MYSQLHOST'));
var_dump(getenv('MYSQLPORT'));
var_dump(getenv('MYSQLDATABASE'));
var_dump(getenv('MYSQLUSER'));
echo "<pre>";
print_r(PDO::getAvailableDrivers());
echo "</pre>";

?>