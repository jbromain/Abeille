<?php
    /*
     * Abeille's static config file
     */

    define('lastDbVersion', 20231023);
    $in = "/tmp/AbeilleDeamonInput";
    $resourcePath = realpath(__DIR__.'/../../resources');
    define('wifiLink', '/tmp/zigateWifi'); // For WIFI: Socat output
    define('otaDir', 'tmp/fw_ota'); // OTA FW location relative to Abeille's root

    /* Inter-daemons queues:
       array['<queueName>'] = array("id" => queueId, "max" => maxMsgSize) */
    $abQueues = array();
    $abQueues["xToParser"] = array( "id" => 0x336, "max" => 2048 );
    $abQueues["parserToLQI"] = array( "id" => 0xE1, "max" => 2048 );
    $abQueues["parserToRoutes"] = array( "id" => 0xE2, "max" => 2048 );
    $abQueues["parserToCli"] = array( "id" => 0x2D4, "max" => 1024 );
    $abQueues["parserToCmdAck"] = array( "id" => 0x3E7, "max" => 512 ); // Parser to cmd for 8000/8012/8702 statuses
    $abQueues["xToCmd"] = array( "id" => 0x4BC, "max" => 512 ); // AbeilleCmd inputs
    $abQueues["cmdToMon"] = array( "id" => 0x82, "max" => 512 ); // Messages to zigate (cmd to monitor)
    $abQueues["parserToMon"] = array( "id" => 0x83, "max" => 1024 ); // Messages from zigate (parser to monitor)
    $abQueues["monToCmd"] = array( "id" => 0x84, "max" => 1024 ); // Messages to cmd (addr update)
    $abQueues["parserToAssist"] = array( "id" => 0x8D, "max" => 512 ); // Parser to EQ assistant
    $abQueues["xToAbeille"] = array( "id" => 0x26D, "max" => 1024 ); // All messages to 'Abeille.class'
    $GLOBALS['abQueues'] = $abQueues;

    // Tcharp38 note: WARNING: TOP PRIORITY is 1, not 5
    define('priorityMax',           1);
    define('priorityUserCmd',       1); // Action utiliateur qui doit avoir une sensation de temps réel
    define('priorityNeWokeUp',      2); // Action si un NE est detecté reveillé et qu'on veut essayer de lui parler
    define('priorityInclusion',     3); // Message important car le temps est compté pour identifier certains équipements
    define('priorityInterrogation', 4); // Message pour recuperer des etats, valeurs
    define('priorityLostNE',        5); // Si le NE est en TimeOut il n'est pas prioritaire car il est peut etre off.
    define('priorityMin',           5); // est egale aux max des priorités définies.

    // New priorities model, will be replaced by old one again after code review (KiwiHC16)
    define('PRIO_NORM', priorityInterrogation); // Normal
    define('PRIO_HIGH', priorityMax); // High priority (ex: parser to cmd to react on wakeup)

    define('maxNbOfZigate', 6); // Number of supported zigates
    $GLOBALS['maxNbOfZigate'] = maxNbOfZigate;

    define('maxRetryDefault', 3);

    /* URL to access documentations */
    define('urlProducts', "https://github.com/KiwiHC16/AbeilleDoc/blob/master/docs/products");
    define('urlUserMan', "https://kiwihc16.github.io/AbeilleDoc/");

    /* Developer config file */
    define('dbgFile', __DIR__.'/../../tmp/debug.json');

    /* A bit per daemon */
    define('daemonCmd', 1 << 0);
    define('daemonParser', 1 << 1);
    define('daemonSerialRead1', 1 << 2);
    define('daemonSerialRead2', 1 << 3);
    define('daemonSerialRead3', 1 << 4);
    define('daemonSerialRead4', 1 << 5);
    define('daemonSerialRead5', 1 << 6);
    define('daemonSerialRead6', 1 << 7);
    // define('daemonSerialRead7', 1 << 8);
    // define('daemonSerialRead8', 1 << 9);
    // define('daemonSerialRead9', 1 << 10);
    // define('daemonSerialRead10', 1 << 11);
    define('daemonSocat1', 1 << 12);
    define('daemonSocat2', 1 << 13);
    define('daemonSocat3', 1 << 14);
    define('daemonSocat4', 1 << 15);
    define('daemonSocat5', 1 << 16);
    define('daemonSocat6', 1 << 17);
    // define('daemonSocat7', 1 << 18);
    // define('daemonSocat8', 1 << 19);
    // define('daemonSocat9', 1 << 20);
    // define('daemonSocat10', 1 << 21);
    define('daemonMonitor', 1 << 22);

    define ("daemonStopTimeout", 2000); // 2sec
?>
