<?php
shell_exec('date >> check_apache_status');
shell_exec('/etc/init.d/apache2 status >> check_apache_status');
?>
