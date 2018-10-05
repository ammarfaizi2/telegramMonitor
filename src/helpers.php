<?php

if (!function_exists("rstr")) {
	function rstr(int $n = 32, string $e = null): string
	{
		if (!is_string($e)) {
			$e = "qwertyuiopasdfghjklzxcvbnnmQWERTYUIOPASDFGHJKKLXCVBNM1234567890____----....";
		}
		$n = abs($n);
		$r = "";
		$c = strlen($e) - 1;
		for ($i=0; $i < $n; $i++) { 
			$r .= $e[rand(0, $c)];
		}
		return $r;
	}
}
