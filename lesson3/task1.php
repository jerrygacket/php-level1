<?php
$a = -1;
while ($a <= 100) {
  $a++;
  echo ($a%3 == 0 ? $a.PHP_EOL : '');
}
