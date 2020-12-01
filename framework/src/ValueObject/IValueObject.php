<?php
declare(strict_types = 1);
namespace Framework\ValueObject;

interface IValueObject
{
    /**
     * Compare two IValueObject and tells whether they can be considered equal
     *
     * @param  IValueObject $object
     * @return bool
     */
    public function equals(IValueObject $object):bool;

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString():string;
}