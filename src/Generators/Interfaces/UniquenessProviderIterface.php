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

namespace Benkle\IGC\Generators\Interfaces;

/**
 * Interface UniquenessProviderIterface
 * Classes implementing this interface can be used as providers for uniqueness checks in generators.
 * @package Benkle\IGC\Generators\Interfaces
 */
interface UniquenessProviderIterface
{
    /**
     * Check if a value already exists.
     * @param mixed $value
     * @return bool
     */
    public function exists($value): bool;

    /**
     * Add a value to the stack of existing values.
     * @param mixed $value
     * @return $this
     */
    public function put($value): UniquenessProviderIterface;

}
