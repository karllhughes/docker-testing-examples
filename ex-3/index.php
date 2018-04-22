<?php

/**
 * DB connection constants
 */
const DB_HOST = 'database';
const DB_USER = 'root';
const DB_PASS = '';
const DB_DATABASE = 'test';
const DB_TABLE = 'test_table';

function getLink(): mysqli
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

    if (mysqli_connect_errno()) {
        throw new Exception("Connection failed: %s\n" . mysqli_connect_error());
    }

    return $link;
}

/**
 * Function to be tested
 *
 * Creates a table with JSON fields, a feature only available in MySQL 5.7+.
 */
function createTableWithJsonFields(): bool
{
    $link = getLink();

    mysqli_select_db($link, DB_DATABASE);

    $createTableQuery = 'CREATE TABLE IF NOT EXISTS '.DB_TABLE.' (id INT, json_field JSON);';

    if (!$result = mysqli_query($link, $createTableQuery)) {
        throw new Exception("Table could not be created.");
    }

    mysqli_close($link);

    return $result;
}

/**
 * Gets the schema for our newly created table.
 */
function getSchema(): array
{
    $link = getLink();

    $createTableQuery = 'DESCRIBE '.DB_DATABASE.'.'.DB_TABLE.';';

    if (!$result = mysqli_query($link, $createTableQuery)) {
        throw new Exception("Table could not be created.");
    }

    mysqli_close($link);

    return $result->fetch_all();
}

/**
 * PHPUnit test code
 *
 * This ensures that the database connection is made and the table is created.
 */

use PHPUnit\Framework\TestCase;

class CreateJsonFieldTest extends TestCase
{
    function testItConnectsAndCreatesTableWithJsonField()
    {
        $result = createTableWithJsonFields();
        $newTable = getSchema();

        $this->assertTrue($result);
        $this->assertEquals('int(11)', $newTable[0][1]);
        $this->assertEquals('json', $newTable[1][1]);
    }
}
