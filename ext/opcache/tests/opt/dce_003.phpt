--TEST--
DCE 003: Assignment elimination (without FREE)
--INI--
opcache.enable=1
opcache.enable_cli=1
opcache.optimization_level=-1
opcache.opt_debug_level=0x20000
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
function foo($a) {
	$b = $a += 3;
	return $a;
}
?>
--EXPECTF--
$_main: ; (lines=1, args=0, vars=0, tmps=0)
    ; (after optimizer)
    ; %sdce_003.php:1-7
L0:     RETURN int(1)

foo: ; (lines=3, args=1, vars=1, tmps=0)
    ; (after optimizer)
    ; %sdce_003.php:2-5
L0:     CV0($a) = RECV 1
L1:     ASSIGN_ADD CV0($a) int(3)
L2:     RETURN CV0($a)
