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

class DatabaseSeededTest extends TestCase
{
    function testItConnectsToSeededDatabase()
    {
        $result = getSchema();

        $this->assertEquals('id', $result[0][0]);
        $this->assertEquals('int(11)', $result[0][1]);
        $this->assertEquals('name', $result[1][0]);
        $this->assertEquals('varchar(240)', $result[1][1]);
    }
}
