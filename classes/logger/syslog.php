<?php
class Logger_Syslog implements Logger_Adapter {

	function log_error(int $errno, string $errstr, string $file, int $line, string $context): bool {

		switch ($errno) {
		case E_ERROR:
		case E_PARSE:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
			$priority = LOG_ERR;
			break;
		case E_WARNING:
		case E_CORE_WARNING:
		case E_COMPILE_WARNING:
		case E_USER_WARNING:
			$priority = LOG_WARNING;
			break;
		default:
			$priority = LOG_INFO;
		}

		$errname = Logger::ERROR_NAMES[$errno] . " ($errno)";

		syslog($priority, "[tt-rss] $errname ($file:$line) $errstr");

		return true;
	}

}
