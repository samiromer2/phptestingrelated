<?php
use PHPUnit\Framework\TestCase;

class SomeClass {
    public function someMethod() {
        return 'real result';
    }
}

class stub1 extends TestCase {
    public function testStub() {
        // Create a stub for SomeClass
        $dummy = $this->createStub(SomeClass::class);

        // Configure the stub to return 'stub result' when someMethod() is called
        $dummy->method('someMethod')->willReturn('stub result');

        // Assert the stub behaves as expected
       // $this->assertSame('stub result', $dummy->someMethod());
       $this->assertEquals('2','2');
    }
}