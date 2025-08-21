<?php
$output = shell_exec('cd /home/tota3005/public_html/totalbali && git pull origin main 2>&1');
echo "<pre>$output</pre>";
