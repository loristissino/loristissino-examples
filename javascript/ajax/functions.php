<?php

function getValueFromArray($array, $key, $default)
{
	return isset($array[$key]) ? $array[$key] : $default;
}

function getUrlValue($key, $default)
{
	return getValueFromArray($_GET, $key, $default);
}

function getPostValue($key, $default)
{
	return getValueFromArray($_POST, $key, $default);
}
