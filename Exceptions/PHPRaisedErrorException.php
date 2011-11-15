<?php
/**
 * @file
 * @author jarrod.swift
 */
namespace ORM\Exceptions;

/**
 * Parent class for all of ErrorHandler's exceptions
 *
 * @see ErrorHandler
 */
class PHPRaisedErrorException extends \RuntimeException {
    public function setFile( $file ) {
        $this->file = $file;
    }
    
    public function setLine( $line ) {
        $this->line = $line;
    }
}
