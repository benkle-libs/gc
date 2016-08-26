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
 * Interface GeneratorInterface
 * Classes implementing this interface can be used to generate sequences of all kinds.
 * @package Benkle\IGC\Generators\Interfaces
 */
interface GeneratorInterface
{
    /**
     * Generate a single value.
     * @return mixed
     */
    public function getOne();

    /**
     * Generate a single unique value.
     * @return mixed
     */
    public function getOneUnique();

    /**
     * Get an iterator to generate a fixed number of values.
     * @param int $count
     * @return mixed
     */
    public function getMany(int $count);

    /**
     * Get an iterator to generate a fixed number of unique values.
     * @param int $count
     * @return mixed
     */
    public function getManyUnique(int $count);

    /**
     * Set the helper class which handles the checks for uniqueness.
     * @param UniquenessProviderIterface $provider
     * @return $this
     */
    public function setUniquenessProvider(UniquenessProviderIterface $provider);

    /**
     * Get the helper class which handles the checks for uniqueness.
     * @return UniquenessProviderIterface
     */
    public function getUniquenessProvider();

}
