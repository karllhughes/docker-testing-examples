<?php

/**
 * Function to be tested
 *
 * Includes a number of features that require PHP 7.0+, including:
 * - Scalar type hints
 * - Return types
 * - The "spaceship" operator
 *
 */
function sortArrayOfObjects(string $field, array $objects): array
{
    usort($objects, function ($a, $b) use ($field) {
        return $a->{$field} <=> $b->{$field};
    });

    return $objects;
}

/**
 * PHPUnit test code
 *
 * Normally this would be in another file, but we're keeping it simple.
 */
use PHPUnit\Framework\TestCase;

class SortArrayOfObjectsTest extends TestCase
{
    function testItSortsWhenFieldExists()
    {
        $objects = [
            (object) [
                'sort_order' => '2',
                'name' => 'The first shall be last',
            ],
            (object) [
                'sort_order' => '1',
                'name' => 'The last shall be first',
            ],
        ];

        $result = sortArrayOfObjects('sort_order', $objects);

        $this->assertEquals($objects[0], $result[1]);
        $this->assertEquals($objects[1], $result[0]);
    }
}
