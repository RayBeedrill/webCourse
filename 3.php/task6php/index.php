<?php
/*
 *
 * index.php need to create objects get or give data and get results
 *
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


include('config.php');
include('lib/interfaces/iBand.php');
include('lib/interfaces/iMusician.php');
include('lib/interfaces/iInstrument.php');
include('lib/classes/Band.php');
include('lib/classes/Instrument.php');
include('lib/classes/Musician.php');


$guitar = new Instrument("guitar","stringed");
$basGuitar = new Instrument("bas-guitar","stringed");
$piano = new Instrument("piano","keyboards");
$drums = new Instrument("drums","drums");

$axlRose = new Musician("Axl Rose","leader");
$slash = new Musician("Slash","Solo guitarist");
$duffMcKagan = new Musician("Duff McKagan","Bas guitarist");
$dizzyReed = new Musician("Dizzy Reed","Piano");
$richardFortus = new Musician("Richard Fortus","Rhythm guitar");
$frankFerrer = new Musician("Frank Ferrer","Drums");

$axlRose->addInstrument($guitar);
$axlRose->addInstrument($piano);
$slash->addInstrument($guitar);
$duffMcKagan->addInstrument($basGuitar);
$dizzyReed->addInstrument($piano);
$richardFortus->addInstrument($guitar);
$frankFerrer->addInstrument($drums);

$gunsNroses = new Band("Guns 'N' roses","Rock 'n' Roll");

$gunsNroses->addMusician($axlRose);
$gunsNroses->addMusician($slash);
$gunsNroses->addMusician($duffMcKagan);
$gunsNroses->addMusician($dizzyReed);
$gunsNroses->addMusician($richardFortus);
$gunsNroses->addMusician($frankFerrer);



$daveKushner = new Musician("Dave Kushner","Rhythm guitarist");
$mattSorum = new Musician("Matt Sorum","Drum");

$daveKushner->addInstrument($guitar);
$mattSorum->addInstrument($drums);

$velvetRevolver = new Band("VELVET REVOLVER", "Hard Rock");

$velvetRevolver->addMusician($slash);
$velvetRevolver->addMusician($duffMcKagan);
$velvetRevolver->addMusician($daveKushner);
$velvetRevolver->addMusician($mattSorum);

$gunsInfo = $gunsNroses->getGroupInfo();
$revolverInfo = $velvetRevolver->getGroupInfo();


include('template/index.php');
