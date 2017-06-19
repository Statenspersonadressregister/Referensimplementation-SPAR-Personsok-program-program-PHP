<?php

function visaSvar($svar)
{
    visaInternStruktur($svar);
    visaOmvandlatTillHtml($svar);
}

function visaInternStruktur($svar)
{
    echo "<section><h1>Svarsstruktur från SoapClient</h1>";
    echo "<p class='hjalptext'>
            Nedan är SoapClients omvandling från XML-svaret till PHP minnesstruktur.</p> 
          <p class='hjalptext'>  
            Om en struktur, tex PersonDetaljer, kan innehålla ett eller flera objekt 
            så ger SoapClient ett <em>object</em> om det är ett objekt och en
            <em>array</em> om det är flera objekt. Se källkoden för exempel.</p>";

    echo "<pre>";
    print_r($svar);
    echo "</pre></section>";
}

function visaOmvandlatTillHtml($svar)
{
    echo "<section id='svar'><h1>Hur svaret kan tolkas</h1>";
    echo "<p class='hjalptext'>
            Nedan är en svaret från SoapClient uppvisat i HTML för att ge en
            översikt över hur strukturen i svaret ser ut. Rubriker som saknar värden
            kan finnas i svaret, men är inte med i detta svar.</p>";

    visaOverstiger($svar);
    visaUndantagLista($svar);
    visaSvarsPostLista($svar);

    echo "</section>";
}


function visaOverstiger($svar)
{
    $overstiger = $svar["OverstigerMaxAntalSvarsposter"];
    if (isset($overstiger)) {
        echo "Överstiger max antal sökträffar, " . $overstiger->AntalPoster . " av maximalt " . $overstiger->MaxAntalSvarsPoster . ".";
    }
}

function visaUndantag($undantag)
{
    echo "<div>";
    echo "<header>Kod</header>" . $undantag->Kod . "<br/>";
    echo "<header>Beskrivning</header>" . $undantag->Beskrivning;
    echo "</div>";
}

function visaUndantagLista($svar)
{
    $undantag = $svar["Undantag"];
    if (isset($undantag)) {
        echo "<section id='undantag'><h1>Undantag</h1>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($undantag)) {
            visaUndantag($undantag);
        } else {
            foreach ($undantag as $u) {
                visaUndantag($u);
            }
        }

        echo "</section>";
    }
}

function visaSvarsPostLista($svar)
{
    $svarsPoster = $svar["PersonsokningSvarsPost"];
    if (isset($svarsPoster)) {
        echo "<section id='svarsposter'><h1>PersonsokningSvarsPost</h1>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($svarsPoster)) {
            visaSvarspost($svarsPoster);
        } else {
            foreach ($svarsPoster as $svarsPost) {
                visaSvarspost($svarsPost);
            }
        }

        echo "</section>";
    }
}

function visaSvarspost($svarsPost)
{
    echo "<div>";
    echo "<header>PersonId-&gt;FysiskPersonId</header>" . $svarsPost->PersonId->FysiskPersonId . "<br/>";
    echo "<header>SenasteAndringSPAR</header>" . $svarsPost->SenasteAndringSPAR . "<br/>";
    echo "<header>Sekretessmarkering</header>" . $svarsPost->Sekretessmarkering . "<br/>";
    echo "<header>SekretessAndringsdatum</header>" . $svarsPost->SekretessAndringsdatum . "<br/>";
    echo "<header>Beskattningsar</header>" . $svarsPost->Beskattningsar . "<br/>";
    echo "<header>SummeradInkomst</header>" . $svarsPost->SummeradInkomst;

    visaPersonDetaljer($svarsPost);
    visaRelationer($svarsPost);
    visaFastigheter($svarsPost);
    visaFolkbokforingsAdresser($svarsPost);
    visaSarskildPostadresser($svarsPost);
    visaUtlandAdresser($svarsPost);

    echo "</div>";
}

function visaPersonDetaljer($svarsPost)
{
    $personDetaljer = $svarsPost->Persondetaljer;
    if (isset($personDetaljer)) {
        echo "<header class='listheader'>Persondetaljer</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($personDetaljer)) {
            visaPersonDetalj($personDetaljer);
        } else {
            foreach ($personDetaljer as $pd) {
                visaPersonDetalj($pd);
            }
        }
    }
}

function visaPersonDetalj($personDetalj)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $personDetalj->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $personDetalj->DatumTill . "<br/>";
    echo "<header>Avregistreringsdatum</header>" . $personDetalj->Avregistreringsdatum . "<br/>";
    echo "<header>AvregistreringsorsakKod</header>" . $personDetalj->AvregistreringsorsakKod . "<br/>";

    echo "<header>Fornamn</header>" . $personDetalj->Fornamn . "<br/>";
    echo "<header>Mellannamn</header>" . $personDetalj->Mellannamn . "<br/>";
    echo "<header>Efternamn</header>" . $personDetalj->Efternamn . "<br/>";
    echo "<header>Aviseringsnamn</header>" . $personDetalj->Aviseringsnamn . "<br/>";
    echo "<header>Tilltalsnamn</header>" . $personDetalj->Tilltalsnamn . "<br/>";

    echo "<header>Fodelseforsamling</header>" . $personDetalj->Fodelseforsamling . "<br/>";
    echo "<header>Fodelsetid</header>" . $personDetalj->Fodelsetid . "<br/>";
    echo "<header>FodelselanKod</header>" . $personDetalj->FodelselanKod . "<br/>";

    echo "<header>HanvisningsPersonNrByttFran</header>" . $personDetalj->HanvisningsPersonNrByttFran . "<br/>";
    echo "<header>HanvisningsPersonNrByttTill</header>" . $personDetalj->HanvisningsPersonNrByttTill . "<br/>";
    echo "<header>Sekretessmarkering</header>" . $personDetalj->Sekretessmarkering . "<br/>";
    echo "<header>Kon</header>" . $personDetalj->Kon;
    echo "</div>";
}

function visaRelationer($svarsPost)
{
    $relationer = $svarsPost->Relation;
    if (isset($relationer)) {
        echo "<header class='listheader'>Relation</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($relationer)) {
            visaRelation($relationer);
        } else {
            foreach ($relationer as $r) {
                visaRelation($r);
            }
        }
    }
}

function visaRelation($relation)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $relation->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $relation->DatumTill . "<br/>";
    echo "<header>Relationstyp</header>" . $relation->Relationstyp . "<br/>";

    echo "<header>PersonId-&gt;FysiskPersonId</header>" . $relation->PersonId->FysiskPersonId . "<br/>";
    echo "<header>Fodelsetid</header>" . $relation->Fodelsetid . "<br/>";

    echo "<header>Avregistreringsdatum</header>" . $relation->Avregistreringsdatum . "<br/>";
    echo "<header>AvregistreringsorsakKod</header>" . $relation->AvregistreringsorsakKod . "<br/>";

    echo "<header>Fornamn</header>" . $relation->Fornamn . "<br/>";
    echo "<header>Mellannamn</header>" . $relation->Mellannamn . "<br/>";
    echo "<header>Efternamn</header>" . $relation->Efternamn;
    echo "</div>";
}

function visaFastigheter($svarsPost)
{
    $fastigheter = $svarsPost->Fastighet;
    if (isset($fastigheter)) {
        echo "<header class='listheader'>Fastighet</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($fastigheter)) {
            visaFastighet($fastigheter);
        } else {
            foreach ($fastigheter as $f) {
                visaFastighet($f);
            }
        }
    }
}

function visaFastighet($fastighet)
{
    echo "<div>";
    echo "<header>FastighetsKod</header>" . $fastighet->FastighetsKod . "<br/>";
    echo "<header>FastighetKommunKod</header>" . $fastighet->FastighetKommunKod . "<br/>";
    echo "<header>FastighetLanKod</header>" . $fastighet->FastighetLanKod . "<br/>";
    echo "<header>Taxeringsar</header>" . $fastighet->Taxeringsar . "<br/>";
    echo "<header>Taxeringsvarde</header>" . $fastighet->Taxeringsvarde . "<br/>";
    echo "<header>AndelstalTaljare</header>" . $fastighet->AndelstalTaljare . "<br/>";
    echo "<header>AndelstalNamnare</header>" . $fastighet->AndelstalNamnare;
    echo "</div>";
}

function visaFolkbokforingsAdresser($svarsPost)
{
    $addresser = $svarsPost->Adresser->Folkbokforingsadress;
    if (isset($addresser)) {
        echo "<header class='listheader'>Adresser-&gt;Folkbokforingsadress</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($addresser)) {
            visaFolkbokforingsAdress($addresser);
        } else {
            foreach ($addresser as $a) {
                visaFolkbokforingsAdress($a);
            }
        }
    }
}

function visaFolkbokforingsAdress($address)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $address->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $address->DatumTill . "<br/>";
    echo "<header>CareOf</header>" . $address->CareOf . "<br/>";
    echo "<header>Utdelningsadress1</header>" . $address->Utdelningsadress1 . "<br/>";
    echo "<header>Utdelningsadress2</header>" . $address->Utdelningsadress2 . "<br/>";
    echo "<header>PostNr</header>" . $address->PostNr . "<br/>";
    echo "<header>Postort</header>" . $address->Postort . "<br/>";
    echo "<header>Folkbokforingsdatum</header>" . $address->Folkbokforingsdatum . "<br/>";
    echo "<header>FolkbokfordForsamlingKod</header>" . $address->FolkbokfordForsamlingKod . "<br/>";
    echo "<header>DistriktKod</header>" . $address->DistriktKod . "<br/>";
    echo "<header>FolkbokfordKommunKod</header>" . $address->FolkbokfordKommunKod . "<br/>";
    echo "<header>FolkbokfordLanKod</header>" . $address->FolkbokfordLanKod;
    echo "</div>";
}

function visaSarskildPostadresser($svarsPost)
{
    $addresser = $svarsPost->Adresser->SarskildPostadress;
    if (isset($addresser)) {
        echo "<header class='listheader'>Adresser-&gt;SarskildPostadress</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($addresser)) {
            visaSarskildPostadress($addresser);
        } else {
            foreach ($addresser as $a) {
                visaSarskildPostadress($a);
            }
        }
    }
}

function visaSarskildPostadress($address)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $address->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $address->DatumTill . "<br/>";
    echo "<header>CareOf</header>" . $address->CareOf . "<br/>";
    echo "<header>Utdelningsadress1</header>" . $address->Utdelningsadress1 . "<br/>";
    echo "<header>Utdelningsadress2</header>" . $address->Utdelningsadress2 . "<br/>";
    echo "<header>PostNr</header>" . $address->PostNr . "<br/>";
    echo "<header>Postort</header>" . $address->Postort;
    echo "</div>";
}

function visaUtlandAdresser($svarsPost)
{
    $addresser = $svarsPost->Adresser->Utlandsadress;
    if (isset($addresser)) {
        echo "<header class='listheader'>Adresser-&gt;Utlandsadress</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($addresser)) {
            visaUtlandAdress($addresser);
        } else {
            foreach ($addresser as $a) {
                visaUtlandAdress($a);
            }
        }
    }
}

function visaUtlandAdress($address)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $address->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $address->DatumTill . "<br/>";
    echo "<header>CareOf</header>" . $address->CareOf . "<br/>";
    echo "<header>Utdelningsadress1</header>" . $address->Utdelningsadress1 . "<br/>";
    echo "<header>Utdelningsadress2</header>" . $address->Utdelningsadress2 . "<br/>";
    echo "<header>Utdelningsadress3</header>" . $address->Utdelningsadress3 . "<br/>";
    echo "<header>PostNr</header>" . $address->PostNr . "<br/>";
    echo "<header>Postort</header>" . $address->Postort . "<br/>";
    echo "<header>Land</header>" . $address->Land;
    echo "</div>";
}

