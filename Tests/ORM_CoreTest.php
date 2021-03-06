<?php
/**
 * Tests for Configuration class
 * @file
 * @author jarrod.swift
 */
namespace FlexibleORMTests;

use FlexibleORMTests\Mock;
use FlexibleORMTests\Mock\Staff;

require_once dirname(__FILE__) . '/ORMTest.php';

/**
 * Test class for ORM_Core.
 * Generated by PHPUnit on 2011-03-07 at 12:41:46.
 */
class ORM_CoreTest extends ORMTest {

    /**
     * @var Staff $object
     */
    protected $object;

    /**
     * @var array $_initialValues
     */
    private $_initialValues;

    protected function setUp() {
        $this->_initialValues = array(
            'name'  => 'John',
            'age'   => 38,
        );

        $this->object = new Mock\Staff($this->_initialValues);

        foreach ($this->_initialValues as $property => $value ) {
            $this->object->setOriginalValue($property, $value);
        }
    }

    public function testAttributes() {
        $this->assertEquals(array_keys($this->_initialValues), $this->object->attributes() );
    }

    public function testValues() {
        $this->assertEquals($this->_initialValues, $this->object->values() );
    }

    public function testErrorMessages() {
        $this->object->validationError('age', 'must be greater than 100');

        $this->assertEquals(
            array( 'age' => 'must be greater than 100' ),
            $this->object->errorMessages()
        );
    }
    
    public function testErrorMessagesNoErrors() {
        $this->object->validationError('age', 'must be greater than 100');
        $this->object->clearValidationErrors();
        $this->assertEquals(
            array(),
            $this->object->errorMessages()
        );
    }

    public function testErrorMessagesString() {
        $this->object->validationError('age', 'must be less than 100');
        $this->object->validationError('age', 'must be greater than 100');
        $this->object->validationError('name', 'should be Fred');

        $this->assertEquals(
            '\'age\' must be greater than 100, \'name\' should be Fred',
            $this->object->errorMessagesString()
        );
    }

    public function testErrorMessage() {
        $this->object->validationError('age', 'must be greater than 100');

        $this->assertEquals(
            'must be greater than 100',
            $this->object->errorMessage('age')
        );
    }

    public function testChangedFields() {
        $this->object->name = "Fred";

        $this->assertEquals(
            array('name'),
            $this->object->changedFields()
        );
    }

    public function testOriginalValue() {
        $this->object->name = "Fred";

        $this->assertEquals(
            $this->_initialValues['name'],
            $this->object->originalValue( 'name' )
        );
    }

    public function testSetOriginalValue() {
        $this->object->name = "Fred";
        $this->object->setOriginalValue('name', 'Fred');

        $this->assertEquals(array(), $this->object->changedFields() );
    }
    
    public function testTranslateFieldToProperty() {
        $this->assertEquals('doors', Mock\Car::TranslateFieldToProperty('doors'));
        $this->assertEquals('model', Mock\Car::TranslateFieldToProperty('name'));
    }
    
    public function testTranslatePropertyToField() {
        $this->assertEquals('doors', Mock\Car::TranslatePropertyToField('doors'));
        $this->assertEquals('name',  Mock\Car::TranslatePropertyToField('model'));
    }
    
    public function testOriginalValues() {
        $this->assertEquals($this->_initialValues, $this->object->originalValues());
    }
    
    public function testFieldAlias() {
        $this->assertEquals('doors', Mock\Car::FieldAlias('doors'));
    }

    public function testClassPath() {
        $this->assertEquals('FlexibleORMTests\Mock\Car', Mock\Car::FullClassName() );
    }
}
