<?php
/**
 * @file
 * @author jarrod.swift
 */
namespace FlexibleORMTests\Mock;
/**
 * Description of Source
 *
 * @author jarrodswift
 */
class Source  extends \ORM\SDB\ORMModelSDB {
    const ENFORCE_READ_CONSISTENCY = true;
    
    public $description;
    public $tags;
}
