<?php
	$output = array();
	exec('python clear_emails.py "lean251290@gmail.com"', $output);
	foreach ($output as $value) {
		echo $value.'<BR>';
	}