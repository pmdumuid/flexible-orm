<?php
/**
 * @file
 * @author jarrod.swift
 */
namespace ORM\Tests\Utilities;
use ORM\Utilities\ErrorHandler;
use ORM\Tests\ORMTest;

require_once dirname(__FILE__) . '/../ORMTest.php';

/**
 * Test class for ErrorHandler.
 * Generated by PHPUnit on 2011-11-15 at 20:55:31.
 */
class ErrorHandlerTest extends ORMTest {

    /**
     * @var ErrorHandler $errorHandler
     */
    protected $errorHandler;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->errorHandler = new ErrorHandler();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        restore_error_handler();
    }

    /**
     * @expectedException \ORM\Exceptions\PHPWarningException
     */
    public function testRegisterErrorHandler() {
        $this->errorHandler->registerErrorHandler();
        trigger_error('Gah, I had an error!', E_USER_WARNING);
    }

    /**
     * @todo Implement testRegisterShutdownHandler().
     */
    public function testRegisterShutdownHandler() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @expectedException \ORM\Exceptions\PHPNoticeException
     */
    public function testHandleErrorNotice() {
        $this->errorHandler->handleError(E_NOTICE, "Test error", __FILE__, __LINE__ );
    }
    
    /**
     * @expectedException \ORM\Exceptions\PHPWarningException
     */
    public function testHandleErrorWarning() {
        $this->errorHandler->handleError(E_WARNING, "Test error", __FILE__, __LINE__ );
    }

    public function testDisplayErrorOfType() {
        error_reporting(E_ALL ^ E_NOTICE);
        
        $this->assertTrue( $this->errorHandler->displayErrorOfType(E_ERROR), "Failed to display E_ERROR");
        $this->assertTrue( $this->errorHandler->displayErrorOfType(E_USER_WARNING), "Failed to display E_USER_WARNING");
        $this->assertFalse( $this->errorHandler->displayErrorOfType(E_NOTICE), "Incorrectly displayed E_NOTICE");
        
        error_reporting(E_ALL);
        $this->assertTrue( $this->errorHandler->displayErrorOfType(E_NOTICE), "Failed to display E_NOTICE");
    }

}
