<?php
/**
 * Copyright (c) 2016 Benjamin Kleiner
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of
 * the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


namespace Benkle\IGC\Generators\Iterators;


use Benkle\IGC\Generators\Interfaces\GeneratorInterface;

class GeneratorIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testGetGenerator()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals($generatorMock, $iterator->getGenerator());
    }

    public function testCurrent()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals(null, $iterator->current());
    }

    public function testKey()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals(-1, $iterator->key());
    }

    public function testRewind()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $generatorMock
            ->expects($this->once())
            ->method('getOne')
            ->willReturn('test');
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals(-1, $iterator->key());
        $this->assertEquals(null, $iterator->current());
        $iterator->rewind();
        $this->assertEquals('test', $iterator->current());
        $this->assertEquals(0, $iterator->key());
    }

    public function testNext()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $generatorMock
            ->expects($this->exactly(2))
            ->method('getOne')
            ->will($this->returnCallback(function() {
                static $results = ['test', 'test2'];
                return array_shift($results);
            }));
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals(-1, $iterator->key());
        $this->assertEquals(null, $iterator->current());
        $iterator->rewind();
        $this->assertEquals('test', $iterator->current());
        $this->assertEquals(0, $iterator->key());
        $iterator->next();
        $this->assertEquals('test2', $iterator->current());
        $this->assertEquals(1, $iterator->key());
    }

    public function testValid()
    {
        $generatorMock = $this->createMock(GeneratorInterface::class);
        $generatorMock
            ->expects($this->exactly(2))
            ->method('getOne')
            ->will($this->returnCallback(function() {
                static $results = ['test', 'test2'];
                return array_shift($results);
            }));
        $iterator = new GeneratorIterator($generatorMock, 2);
        $this->assertEquals(-1, $iterator->key());
        $this->assertEquals(null, $iterator->current());
        $this->assertEquals(true, $iterator->valid());
        $iterator->rewind();
        $this->assertEquals('test', $iterator->current());
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals(true, $iterator->valid());
        $iterator->next();
        $this->assertEquals('test2', $iterator->current());
        $this->assertEquals(1, $iterator->key());
        $this->assertEquals(true, $iterator->valid());
        $iterator->next();
        $this->assertEquals(false, $iterator->valid());
    }

}
