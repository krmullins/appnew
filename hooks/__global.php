<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function login_ok($memberInfo, &$args) {

		return '';
	}

	function login_failed($attempt, &$args) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$ts = time();
		$details = makeSafe("User login failed. Username: {$attempt['username']}. Password: {$attempt['password']}");
		sql("insert into logs set ip='{$ip}', ts='{$ts}', details='{$details}'",$eo);
	}

	function member_activity($memberInfo, $activity, &$args) {
		switch($activity) {
			case 'pending':
				break;

			case 'automatic':
				break;

			case 'profile':
				break;

			case 'password':
				break;

		}
	}

	function sendmail_handler(&$pm) {

	}

	function child_records_config($childTable, $childLookupField, &$config) {

	}

