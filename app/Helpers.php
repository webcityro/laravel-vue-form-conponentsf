<?php

if (!function_exists('isEmpty')) {
	function isEmpty($value) {
		return empty($value) && !is_numeric($value);
	}
}

if (!function_exists('isNotEmpty')) {
	function isNotEmpty($value) {
		return !isEmpty($value);
	}
}
