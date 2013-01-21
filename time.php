<?php
$now = new DateTime(date('Y-m-d h:i:s'));
$ref = new DateTime('1991-06-27 05:56:40');
$diff = $now->diff($ref);
print $diff->y;
// print date('Y-m-d h:i:s');