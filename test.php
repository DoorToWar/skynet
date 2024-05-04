<?php

require_once 'C:\OSPanel\domains\skynet\index.php';
use PHPUnit\Framework\TestCase;

class BracketDeleterTest extends TestCase
{
    public function testSimpleString()
    {
        $deleter = new BracketDeleter("Простая проверка (удаления).");
        $deleter->process();
        $this->assertEquals("Простая проверка .", $deleter->getResult());
    }

    public function testNestedBrackets()
    {
        $deleter = new BracketDeleter("Проверка {вложенных [скобок]}.");
        $deleter->process();
        $this->assertEquals("Проверка .", $deleter->getResult());
    }

    public function testUnbalancedBrackets()
    {
        $deleter = new BracketDeleter("Проверка одинарных (скобок");
        $deleter->process();
        $this->assertEquals("Проверка одинарных (скобок", $deleter->getResult());
    }

    public function testEmptyBrackets()
    {
        $deleter = new BracketDeleter("[]{}<>()");
        $deleter->process();
        $this->assertEquals("", $deleter->getResult());
    }

    public function testRussianString()
    {
        $deleter = new BracketDeleter("Привет [попугайчик] [ кошка <мир> ] (собака) дом");
        $deleter->process();
        $this->assertEquals("Привет   дом", $deleter->getResult());
    }
}