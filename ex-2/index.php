<?php

/**
 * DB connection constants
 *
 * Note: Don't hard code these values IRL. Use environmental variables
 */
const DB_HOST = 'database';
const DB_USER = 'root';
const DB_PASS = '';

/**
 * Function to be tested
 *
 * Should connect to a database, retrieve the database version number.
 */
function getMysqlVersion(): string
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

    if (mysqli_connect_errno()) {
        throw new Exception("Connection failed: %s\n" . mysqli_connect_error());
    }

    $version = mysqli_get_server_version($link);

    mysqli_close($link);

    return $version;
}

/**
 * PHPUnit test code
 *
 * This ensures that the database connection is made and the expected
 * version integer is returned.
 */
use PHPUnit\Framework\TestCase;

class GetMysqlVersionTest extends TestCase
{
    function testItConnectsAndReturnsCorrectVersion()
    {
        $result = getMysqlVersion();

        $this->assertStringStartsWith('507', $result);
    }
}
