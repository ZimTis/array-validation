<?php
/**
 * Created by PhpStorm.
 * User: ZimTis
 * Date: 06.11.2017
 * Time: 22:17
 */

namespace zimtis\arrayvalidation\test\validationsTest\keyValidationsTest;

use PHPUnit\Framework\TestCase;
use zimtis\arrayvalidation\Properties;
use zimtis\arrayvalidation\validations\keyValidations\StringValidation;

class StringValidationTest extends TestCase
{

    private $baseOption = array();

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->baseOption = array();
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testLengthWithMinLength()
    {
        $this->baseOption[Properties::LENGTH] = 5;
        $this->baseOption[Properties::MIN_LENGTH] = 5;

        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testLengthWithMaxLength()
    {
        $this->baseOption[Properties::LENGTH] = 5;
        $this->baseOption[Properties::MAX_LENGTH] = 5;

        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testLengthWithMaxAndMin()
    {
        $this->baseOption[Properties::LENGTH] = 5;
        $this->baseOption[Properties::MAX_LENGTH] = 5;
        $this->baseOption[Properties::MIN_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testLengthWithoutMinOrMax()
    {
        $this->baseOption[Properties::LENGTH] = 5;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthIsInt()
    {
        $this->baseOption[Properties::MAX_LENGTH] = 5;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMaxLengthNotInt()
    {
        $this->baseOption[Properties::MAX_LENGTH] = '5';
        new StringValidation('name', $this->baseOption);
    }

    public function testMinLengthIsInt()
    {
        $this->baseOption[Properties::MIN_LENGTH] = 5;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMinLengthNotInt()
    {
        $this->baseOption[Properties::MIN_LENGTH] = '5';
        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthBiggerThanMinLength()
    {
        $this->baseOption[Properties::MIN_LENGTH] = 0;
        $this->baseOption[Properties::MAX_LENGTH] = 1;
        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthEqualToMinLength()
    {
        $this->baseOption[Properties::MIN_LENGTH] = 0;
        $this->baseOption[Properties::MAX_LENGTH] = 0;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMaxLengthSmallerThanMinLength()
    {
        $this->baseOption[Properties::MIN_LENGTH] = 1;
        $this->baseOption[Properties::MAX_LENGTH] = 0;
        new StringValidation('name', $this->baseOption);
    }

    public function testLengthIsInt()
    {
        $this->baseOption[Properties::LENGTH] = 5;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testLengthNotInt()
    {
        $this->baseOption[Properties::LENGTH] = '5';
        new StringValidation('name', $this->baseOption);
    }

    public function testTrimmedIsBoolean()
    {
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testTrimmedIsNotBoolean()
    {
        $this->baseOption[Properties::TRIMMED] = 'true';
        new StringValidation('name', $this->baseOption);
    }

    public function testStartsWithIsString()
    {
        $this->baseOption[Properties::START_WIDTH] = 's';
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testStartsWithNotString()
    {
        $this->baseOption[Properties::START_WIDTH] = 5;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testStartsWithViolatesTrim()
    {
        $this->baseOption[Properties::START_WIDTH] = ' s';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    public function testStartsWithNotViolatesTrim()
    {
        $this->baseOption[Properties::START_WIDTH] = 's';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);

        $this->baseOption[Properties::START_WIDTH] = 's ';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    public function testEndsWithIsString()
    {
        $this->baseOption[Properties::END_WITH] = 's';
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testEndWithNotString()
    {
        $this->baseOption[Properties::END_WITH] = 5;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testEndWithViolatesTrim()
    {
        $this->baseOption[Properties::END_WITH] = 's ';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    public function testEndWithNotViolatesTrim()
    {
        $this->baseOption[Properties::END_WITH] = 's';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);

        $this->baseOption[Properties::END_WITH] = ' s';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    public function testEndAndStartWithNotViolatesTrim()
    {
        $this->baseOption[Properties::END_WITH] = ' s';
        $this->baseOption[Properties::START_WIDTH] = 's ';
        $this->baseOption[Properties::TRIMMED] = true;
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testStartWithEmptyString()
    {
        $this->baseOption[Properties::START_WIDTH] = '';
        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testEndWithEmptyString()
    {
        $this->baseOption[Properties::END_WITH] = '';
        new StringValidation('name', $this->baseOption);
    }

    public function testGetMinLength()
    {
        $this->baseOption[Properties::START_WIDTH] = 'd';
        $this->baseOption[Properties::END_WITH] = 'd';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(1, $s->getMinLength());

        $this->baseOption[Properties::START_WIDTH] = ' d';
        $this->baseOption[Properties::END_WITH] = 'd';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(2, $s->getMinLength());

        $this->baseOption[Properties::START_WIDTH] = 'd';
        $this->baseOption[Properties::END_WITH] = ' d';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(3, $s->getMinLength());

        $this->baseOption[Properties::START_WIDTH] = 'dsa';
        $this->baseOption[Properties::END_WITH] = 'd';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(4, $s->getMinLength());

        $this->baseOption[Properties::START_WIDTH] = 'dsa';
        $this->baseOption[Properties::END_WITH] = 'asd';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(3, $s->getMinLength());

        $this->baseOption[Properties::START_WIDTH] = 'dsa';
        $this->baseOption[Properties::END_WITH] = 'asx';

        $s = new StringValidation('name', $this->baseOption);
        $this->assertEquals(4, $s->getMinLength());
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMaxLengthSmallerThanStartWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'dasss';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthEqualToStartWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'dass';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthBiggerThenStartWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'das';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMaxLengthSmallerThanEndWith()
    {
        $this->baseOption[Properties::END_WITH] = 'dasss';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthEqualToEndWith()
    {
        $this->baseOption[Properties::END_WITH] = 'dass';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthBiggerThanEndWith()
    {
        $this->baseOption[Properties::END_WITH] = 'das';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testMaxLengthSmallerThanStartWithAndEndWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'da';
        $this->baseOption[Properties::END_WITH] = 'daa';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthEqualToStartWithAndEndWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'da';
        $this->baseOption[Properties::END_WITH] = 'da';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }

    public function testMaxLengthBiggerThanStartWithAndEndWith()
    {
        $this->baseOption[Properties::START_WIDTH] = 'da';
        $this->baseOption[Properties::END_WITH] = 'd';
        $this->baseOption[Properties::MAX_LENGTH] = 4;

        new StringValidation('name', $this->baseOption);
    }
}
