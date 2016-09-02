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
use Benkle\IGC\Generators\Interfaces\UniquenessProviderIterface;

/**
 * Class GeneratorIterator
 * This class "iterates" over a generator,  providing nonunique values.
 * @package Benkle\IGC\Generators\Iterators
 */
class GeneratorIterator implements \Iterator
{
    /** @var int */
    private $size = 0;
    /** @var  GeneratorInterface */
    private $generator;
    /** @var  int */
    private $currentPos = -1;
    /** @var  mixed */
    private $currentValue;

    /**
     * UniqueGeneratorIterator constructor.
     * @param GeneratorInterface $generator
     * @param UniquenessProviderIterface $uniquenessProvider
     * @param int $size
     */
    public function __construct(GeneratorInterface $generator, $size)
    {
        $this->generator = $generator;
        $this->size = $size;
    }

    /**
     * @return GeneratorInterface
     */
    public function getGenerator(): GeneratorInterface
    {
        return $this->generator;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->currentValue;
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->currentPos++;
        if ($this->valid()) {
            $this->currentValue = $this->advance();
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->currentPos;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->currentPos < $this->size;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->currentValue = $this->advance();
        $this->currentPos = 0;
    }

    /**
     * Advance by generating a new value.
     * @return mixed
     */
    protected function advance()
    {
        return $this->getGenerator()->getOne();
    }
}
