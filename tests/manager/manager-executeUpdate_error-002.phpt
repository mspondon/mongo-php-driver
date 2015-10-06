--TEST--
MongoDB\Driver\Manager::executeUpdate() write concern error
--SKIPIF--
<?php require __DIR__ . "/../utils/basic-skipif.inc"; ?>
<?php NEEDS("REPLICASET"); CLEANUP(REPLICASET); ?>
--FILE--
<?php
require_once __DIR__ . "/../utils/basic.inc";

$manager = new MongoDB\Driver\Manager(REPLICASET);

$manager->executeInsert(NS, ['x' => 1]);

echo throws(function() use ($manager) {
    $manager->executeUpdate(NS, ['x' => 1], ['$inc' => ['x' => 1]], [], new MongoDB\Driver\WriteConcern(30));
}, 'MongoDB\Driver\Exception\WriteConcernException'), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\WriteConcernException
Not enough data-bearing nodes
===DONE===