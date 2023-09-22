<?php

function skickaFraga()
{
    // Skapa en array med argument, börja med identifieringsinformation
    $argument = array("Identifieringsinformation" => createIdentifieringsInformation());

    // Fyll på argument-array med själva frågan, antingen namnsök eller sökning på personid.
    if (isset($_POST['sokning_personid'])) {
        $argument += array("PersonsokningFraga" => createFragaPersonId());
    } else if (isset($_POST['sokning_namn'])) {
        $argument += array("PersonsokningFraga" => createFragaNamnsok());
    }

    $client = skapaSoapClient();
    return (array) $client->PersonSok($argument);
}

function skapaSoapClient()
{
    $sslOptions = array(
        'local_cert' => $_POST['certifikat'],
        'verify_peer' => true,
        'cafile' => $_POST['ca'],
        'CN_match' => 'test-personsok.statenspersonadressregister.se');

    $streamcontext = stream_context_create(
        array('ssl' => $sslOptions));

    $options = array(
        'location' => $_POST['url'],
        'stream_context' => $streamcontext);

    // För att SoapClient ska läsa in filen korrekt från disk behövs en file:// länk
    $wsdl = 'file://' . dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resurser/personsok-2021.1.wsdl';

    return new SoapClient($wsdl, $options);
}

function createFragaPersonId()
{
    return array("IdNummer" => $_POST['idnummer']);
}

function createIdentifieringsInformation()
{
    $identifieringsInformation = array(
        "KundNrLeveransMottagare" => $_POST['kundnrleveransmottagare'],
        "KundNrSlutkund" => $_POST['kundnrslutkund'],
        "SlutAnvandarId" => $_POST['slutanvandarid'],
        "SlutAnvandarUtokadBehorighet" => populeraSlutanvandarBehorigheter()
    );

    if (!empty($_POST["uppdragsid"])) {
        $identifieringsInformation += array("UppdragId" => $_POST["uppdragsid"]);
    }

    return $identifieringsInformation;
}


function populeraSlutanvandarBehorigheter()
{
    $slutanvandarutokadbehorighet = array();

    if (!empty($_POST['slutanvandarutokadbehorighet1'])) {
        array_push($slutanvandarutokadbehorighet, $_POST['slutanvandarutokadbehorighet1']);
    }
    if (!empty($_POST['slutanvandarutokadbehorighet2'])) {
        array_push($slutanvandarutokadbehorighet, $_POST['slutanvandarutokadbehorighet2']);
    }
    if (!empty($_POST['slutanvandarutokadbehorighet3'])) {
        array_push($slutanvandarutokadbehorighet, $_POST['slutanvandarutokadbehorighet3']);
    }
    if (!empty($_POST['slutanvandarutokadbehorighet4'])) {
        array_push($slutanvandarutokadbehorighet, $_POST['slutanvandarutokadbehorighet4']);
    }

    return $slutanvandarutokadbehorighet;
}

function createFragaNamnsok()
{
    $sok = array();
    if (!empty($_POST['fonetisksokning'])) $sok += array("FonetiskSokning" => $_POST['fonetisksokning']);
    if (!empty($_POST['namnsokargument'])) $sok += array("NamnSokArgument" => $_POST['namnsokargument']);
    if (!empty($_POST['fornamnsokargument'])) $sok += array("FornamnSokArgument" => $_POST['fornamnsokargument']);
    if (!empty($_POST['mellanefternamnsokargument'])) $sok += array("MellanEfternamnSokArgument" => $_POST['mellanefternamnsokargument']);
    if (!empty($_POST['kon'])) $sok += array("Kon" => $_POST['kon']);
    if (!empty($_POST['fodelsetid'])) $sok += array("Fodelsetid" => $_POST['fodelsetid']);
    if (!empty($_POST['fodelsetidfran'])) $sok += array("FodelsetidFran" => $_POST['fodelsetidfran']);
    if (!empty($_POST['fodelsetidtill'])) $sok += array("FodelsetidTill" => $_POST['fodelsetidtill']);
    if (!empty($_POST['utdelningsadresssokargument'])) $sok += array("UtdelningsadressSokArgument" => $_POST['utdelningsadresssokargument']);
    if (!empty($_POST['postortsokargument'])) $sok += array("PostortSokArgument" => $_POST['postortsokargument']);
    if (!empty($_POST['postnr'])) $sok += array("PostNr" => $_POST['postnr']);
    if (!empty($_POST['postnrfran'])) $sok += array("PostNrFran" => $_POST['postnrfran']);
    if (!empty($_POST['postnrtill'])) $sok += array("PostNrTill" => $_POST['postnrtill']);
    if (!empty($_POST['lankod'])) $sok += array("LanKod" => $_POST['lankod']);
    if (!empty($_POST['kommunkod'])) $sok += array("KommunKod" => $_POST['kommunkod']);
    if (!empty($_POST['distriktkod'])) $sok += array("DistriktKod" => $_POST['distriktkod']);
    if (!empty($_POST['distriktkodfrom'])) $sok += array("DistriktKodFrom" => $_POST['distriktkodfrom']);
    if (!empty($_POST['distriktkodtom'])) $sok += array("DistriktKodTom" => $_POST['distriktkodtom']);

    return $sok;
}

