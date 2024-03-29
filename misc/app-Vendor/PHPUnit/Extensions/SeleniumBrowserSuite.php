<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2010-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Selenium
 * @author     Giorgio Sironi <info@giorgiosironi.com>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 1.2.6
 */

/**
 * TestSuite class for a set of tests from a single Testcase Class
 * executed with a particular browser.
 *
 * @package    PHPUnit_Selenium
 * @author     Giorgio Sironi <info@giorgiosironi.com>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: 1.3.1
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 1.2.6
 */
class PHPUnit_Extensions_SeleniumBrowserSuite extends PHPUnit_Framework_TestSuite
{
    /**
     * Overriding the default: Selenium suites are always built from a TestCase class.
     * @var boolean
     */
    protected $testCase = TRUE;

    public function addTestMethod(ReflectionClass $class, ReflectionMethod $method)
    {
        return parent::addTestMethod($class, $method);
    }

    public static function fromClassAndBrowser($className, array $browser)
    {
        $browserSuite = new self();
        if (isset($browser['browserName'])) {
            $name = $browser['browserName'];
        } else if (isset($browser['name'])) {
            $name = $browser['name'];
        } else {
            $name = $browser['browser'];
        }
        $browserSuite->setName($className . ': ' . $name);
        return $browserSuite;
    }

    public function setupSpecificBrowser(array $browser)
    {
        $this->browserOnAllTests($this, $browser);
    }

    private function browserOnAllTests(PHPUnit_Framework_TestSuite $suite, array $browser)
    {
        foreach ($suite->tests() as $test) {
            if ($test instanceof PHPUnit_Framework_TestSuite) {
                $this->browserOnAllTests($test, $browser);
            } else {
                $test->setupSpecificBrowser($browser);
            }
        }
    }
}
