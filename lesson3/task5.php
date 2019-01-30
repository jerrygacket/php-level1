<?php

function underLine($str) {
	$words = explode(' ',$str);
	return implode('_',$words);
}

$inputString = 'Широкая электрификация южных губерний даст мощный толчок подъёму сельского хозяйства';
echo underLine($inputString).PHP_EOL;
