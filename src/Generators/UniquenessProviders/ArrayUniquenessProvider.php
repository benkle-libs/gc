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

namespace Benkle\IGC\Generators\UniquenessProviders;


use Benkle\IGC\Generators\Interfaces\UniquenessProviderIterface;

/**
 * Class ArrayUniquenessProvider
 * @package Benkle\IGC\Generators\UniquenessProviders
 */
class ArrayUniquenessProvider implements UniquenessProviderIterface
{
    private $storage = [];

    /**
     * Check if a value already exists.
     * @param mixed $value
     * @return bool
     */
    public function exists($value)
    {
        return in_array($value, $this->storage);
    }

    /**
     * Add a value to the stack of existing values.
     * @param mixed $value
     * @return $this
     */
    public function put($value)
    {
        $this->storage[] = $value;
        return $this;
    }
}
