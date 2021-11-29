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
            Om en struktur, tex Persondetaljer, kan innehålla ett eller flera objekt 
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
            Nedan är svaret från SoapClient uppvisat i HTML för att ge en
            översikt över hur strukturen i svaret ser ut. Rubriker som saknar värden
            kan finnas i svaret, men är inte med i detta svar.</p>";

    visaSvarsposter($svar);
    visaOverstigerMax($svar);
    visaUndantag($svar);
    visaUUID($svar);

    echo "</section>";
}


function visaSvarsposter($svar)
{
    $svarsposter = $svar["PersonsokningSvarspost"];
    if (isset($svarsposter)) {
        echo "<section id='svarsposter'><h1>PersonsokningSvarsposter</h1>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($svarsposter)) {
            visaSvarspost($svarsposter);
        } else {
            foreach ($svarsposter as $svarspost) {
                visaSvarspost($svarspost);
            }
        }

        echo "</section>";
    }
}

function visaSvarspost($svarsPost)
{
    echo "<header class='listheader'>PersonsokningSvarspost</header>";
    echo "<div>";
    echo "<header>PersonId-&gt;IdNummer</header>" . $svarsPost->PersonId->IdNummer . "<br/>";
    echo "<header>PersonId-&gt;Typ</header>" . $svarsPost->PersonId->Typ . "<br/>";
    echo "<header>SenasteAndringSPAR</header>" . $svarsPost->SenasteAndringSPAR . "<br/>";
    echo "<header>Sekretessmarkering</header>" . $svarsPost->Sekretessmarkering->_ . "<br/>";
    echo "<header>Sekretessmarkering-&gt;sattAvSPAR</header>" . $svarsPost->Sekretessmarkering->sattAvSPAR . "<br/>";
    echo "<header>SekretessDatum</header>" . $svarsPost->SekretessDatum . "<br/>";
    echo "<header>SkyddadFolkbokforing</header>" . $svarsPost->SkyddadFolkbokforing . "<br/>";
    echo "<header>SkyddadFolkbokforingDatum</header>" . $svarsPost->SkyddadFolkbokforingDatum . "<br/>";
    echo "<header>InkomstAr</header>" . $svarsPost->InkomstAr . "<br/>";
    echo "<header>SummeradInkomst</header>" . $svarsPost->SummeradInkomst;

    visaNamn($svarsPost);
    visaPersondetaljer($svarsPost);
    visaFolkbokforing($svarsPost);
    visaFolkbokforingsadress($svarsPost);
    visaSarskildPostadress($svarsPost);
    visaUtlandsadress($svarsPost);
    visaKontaktadress($svarsPost);
    visaRelation($svarsPost);
    visaFastighet($svarsPost);

    echo "</div>";
}

function visaNamn($svarsPost)
{
    $namn = $svarsPost->Namn;
    if (isset($namn)) {
        echo "<header class='listheader'>Namn</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($namn)) {
            visaNamnPost($namn);
        } else {
            foreach ($namn as $n) {
                visaNamnPost($n);
            }
        }
    }
}

function visaNamnPost($namn)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $namn->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $namn->DatumTill . "<br/>";

    echo "<header>Fornamn</header>" . $namn->Fornamn . "<br/>";
    echo "<header>Mellannamn</header>" . $namn->Mellannamn . "<br/>";
    echo "<header>Efternamn</header>" . $namn->Efternamn . "<br/>";
    echo "<header>Aviseringsnamn</header>" . $namn->Aviseringsnamn . "<br/>";
    echo "<header>Tilltalsnamn</header>" . $namn->Tilltalsnamn . "<br/>";

    echo "</div>";
}

function visaPersondetaljer($svarsPost)
{
    $persondetaljer = $svarsPost->Persondetaljer;
    if (isset($persondetaljer)) {
        echo "<header class='listheader'>Persondetaljer</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($persondetaljer)) {
            visaPersondetaljerPost($persondetaljer);
        } else {
            foreach ($persondetaljer as $pd) {
                visaPersondetaljerPost($pd);
            }
        }
    }
}

function visaPersondetaljerPost($pdt)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $pdt->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $pdt->DatumTill . "<br/>";

    echo "<header>Sekretessmarkering</header>" . $pdt->Sekretessmarkering->_ . "<br/>";
    echo "<header>Sekretessmarkering-&gt;sattAvSPAR</header>" . $pdt->Sekretessmarkering->sattAvSPAR . "<br/>";
    echo "<header>SkyddadFolkbokforing</header>" . $pdt->SkyddadFolkbokforing . "<br/>";

    echo "<header>AvregistreringsorsakKod</header>" . $pdt->AvregistreringsorsakKod . "<br/>";
    echo "<header>Avregistreringsdatum</header>" . $pdt->Avregistreringsdatum . "<br/>";
    echo "<header>Avlidendatum</header>" . $pdt->Avlidendatum . "<br/>";
    echo "<header>AntraffadDodDatum</header>" . $pdt->AntraffadDodDatum . "<br/>";

    echo "<header>Fodelsedatum</header>" . $pdt->Fodelsedatum . "<br/>";
    echo "<header>FodelselanKod</header>" . $pdt->FodelselanKod . "<br/>";
    echo "<header>Fodelseforsamling</header>" . $pdt->Fodelseforsamling . "<br/>";

    echo "<header>Kon</header>" . $pdt->Kon . "<br/>";;
    echo "<header>SvenskMedborgare</header>" . $pdt->SvenskMedborgare . "<br/>";;

    echo "<header>SnStatus</header>" . $pdt->SnStatus . "<br/>";
    echo "<header>SnTilldelningsdatum</header>" . $pdt->SnTilldelningsdatum . "<br/>";
    echo "<header>SnPreliminartVilandeforklaringsdatum</header>" . $pdt->SnPreliminartVilandeforklaringsdatum . "<br/>";
    echo "<header>SnFornyelsedatum</header>" . $pdt->SnFornyelsedatum . "<br/>";
    echo "<header>SnVilandeorsak</header>" . $pdt->SnVilandeorsak . "<br/>";
    echo "<header>SnVilandeforklaringsdatum</header>" . $pdt->SnVilandeforklaringsdatum . "<br/>";
    echo "<header>SnAvlidendatum</header>" . $pdt->SnAvlidendatum . "<br/>";

    visaHanvisningar($pdt);

    echo "</div>";
}

function visaHanvisningar($persondetalj)
{
    $hanvisningar = $persondetalj->Hanvisning;
    if (isset($hanvisningar)) {
        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($hanvisningar)) {
            visaHanvisning($hanvisningar);
        } else {
            foreach ($hanvisningar as $hnv) {
                visaHanvisning($hnv);
            }
        }
    }
}

function visaHanvisning($hnv)
{
    if (isset($hnv)) {
        echo "<header>Hanvisning-&gt;IdNummer</header>" . $hnv->IdNummer . "<br/>";
        echo "<header>Hanvisning-&gt;Typ</header>" . $hnv->Typ . "<br/>";
    }
}

function visaFolkbokforing($svarsPost)
{
    $folkbokforing = $svarsPost->Folkbokforing;
    if (isset($folkbokforing)) {
        echo "<header class='listheader'>Folkbokforing</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($folkbokforing)) {
            visaFolkbokforingPost($folkbokforing);
        } else {
            foreach ($folkbokforing as $a) {
                visaFolkbokforingPost($a);
            }
        }
    }
}

function visaFolkbokforingPost($folkbokforing)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $folkbokforing->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $folkbokforing->DatumTill . "<br/>";
    echo "<header>FolkbokfordLanKod</header>" . $folkbokforing->FolkbokfordLanKod . "<br/>";
    echo "<header>FolkbokfordKommunKod</header>" . $folkbokforing->FolkbokfordKommunKod . "<br/>";
    echo "<header>Hemvist</header>" . $folkbokforing->Hemvist . "<br/>";
    echo "<header>Folkbokforingsdatum</header>" . $folkbokforing->Folkbokforingsdatum . "<br/>";
    echo "<header>DistriktKod</header>" . $folkbokforing->DistriktKod . "<br/>";
    echo "</div>";
}

function visaFolkbokforingsadress($svarsPost)
{
    $fba = $svarsPost->Folkbokforingsadress;
    if (isset($fba)) {
        echo "<header class='listheader'>Folkbokforingsadress</header>";
        // Folkbokföringsadress finns bara som SvenskAdress, men vi använder den generella metoden
        // som kan skriva ut såväl Svensk som Internationell adress.
        visaAdresser($fba);
    }
}

function visaSarskildPostadress($svarsPost)
{
    $spa = $svarsPost->SarskildPostadress;
    if (isset($spa)) {
        echo "<header class='listheader'>Särskild postadress</header>";
        // Särskild postadress finns som såväl Svensk som InternationellAdress
        visaAdresser($spa);
    }
}

function visaUtlandsadress($svarsPost)
{
    $ua = $svarsPost->Utlandsadress;
    if (isset($ua)) {
        echo "<header class='listheader'>Utlandsadress</header>";
        // Utlandsadress finns bara som InternationellAdress, men vi använder den generella metoden
        // som kan skriva ut såväl Svensk som Internationell adress.
        visaAdresser($ua);
    }
}

function visaKontaktadress($svarsPost)
{
    $ka = $svarsPost->Kontaktadress;
    if (isset($ka)) {
        echo "<header class='listheader'>Kontaktadress</header>";
        // Kontaktadress finns som såväl Svensk som InternationellAdress
        visaAdresser($ka);
    }
}

function visaAdresser($adresser)
{
    // SoapClient ger ett object om det bara är ett element i svaret
    // och en array om det är flera element i svaret
    if (is_object($adresser)) {
        visaAdressPost($adresser);
    } else {
        foreach ($adresser as $a) {
            visaAdressPost($a);
        }
    }
}

function visaAdressPost($adress)
{
    if (isset($adress->SvenskAdress)) {
        visaSvenskAdress($adress->SvenskAdress);
    }
    if (isset($adress->InternationellAdress)) {
        visaInternationellAdress($adress->InternationellAdress);
    }
}

function visaSvenskAdress($address)
{
    echo "<div>";
    echo "<header class='itemheader'>Svensk adress</header> <br/>";
    echo "<header>DatumFrom</header>" . $address->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $address->DatumTill . "<br/>";
    echo "<header>CareOf</header>" . $address->CareOf . "<br/>";
    echo "<header>Utdelningsadress1</header>" . $address->Utdelningsadress1 . "<br/>";
    echo "<header>Utdelningsadress2</header>" . $address->Utdelningsadress2 . "<br/>";
    echo "<header>PostNr</header>" . $address->PostNr . "<br/>";
    echo "<header>Postort</header>" . $address->Postort;
    echo "</div>";
}

function visaInternationellAdress($address)
{
    echo "<div>";
    echo "<header class='itemheader'>Internationell adress</header> <br/>";
    echo "<header>DatumFrom</header>" . $address->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $address->DatumTill . "<br/>";
    echo "<header>Utdelningsadress1</header>" . $address->Utdelningsadress1 . "<br/>";
    echo "<header>Utdelningsadress2</header>" . $address->Utdelningsadress2 . "<br/>";
    echo "<header>Utdelningsadress3</header>" . $address->Utdelningsadress3 . "<br/>";
    echo "<header>Land</header>" . $address->Land;
    echo "</div>";
}

function visaRelation($svarsPost)
{
    $relationer = $svarsPost->Relation;
    if (isset($relationer)) {
        echo "<header class='listheader'>Relation</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($relationer)) {
            visaRelationPost($relationer);
        } else {
            foreach ($relationer as $r) {
                visaRelationPost($r);
            }
        }
    }
}

function visaRelationPost($relation)
{
    echo "<div>";
    echo "<header>DatumFrom</header>" . $relation->DatumFrom . "<br/>";
    echo "<header>DatumTill</header>" . $relation->DatumTill . "<br/>";
    echo "<header>Relationstyp</header>" . $relation->Relationstyp . "<br/>";

    echo "<header>PersonId-&gt;ID-nummer</header>" . $relation->PersonId->IdNummer . "<br/>";
    echo "<header>Fodelsetid</header>" . $relation->Fodelsetid . "<br/>";

    echo "<header>Avregistreringsdatum</header>" . $relation->Avregistreringsdatum . "<br/>";
    echo "<header>AvregistreringsorsakKod</header>" . $relation->AvregistreringsorsakKod . "<br/>";

    echo "<header>Fornamn</header>" . $relation->Fornamn . "<br/>";
    echo "<header>Mellannamn</header>" . $relation->Mellannamn . "<br/>";
    echo "<header>Efternamn</header>" . $relation->Efternamn;
    echo "</div>";
}

function visaFastighet($svarsPost)
{
    $fastigheter = $svarsPost->Fastighet;
    if (isset($fastigheter)) {
        echo "<header class='listheader'>Fastighet</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($fastigheter)) {
            visaFastighetPost($fastigheter);
        } else {
            foreach ($fastigheter as $f) {
                visaFastighetPost($f);
            }
        }
    }
}

function visaFastighetPost($fastighet)
{
    echo "<div>";
    echo "<header>FastighetBeteckning</header>" . $fastighet->FastighetBeteckning . "<br/>";
    echo "<header>Taxeringsenhetsnummer</header>" . $fastighet->Taxeringsenhetsnummer . "<br/>";
    echo "<header>FastighetKod</header>" . $fastighet->FastighetKod . "<br/>";
    echo "<header>LanKod</header>" . $fastighet->LanKod . "<br/>";
    echo "<header>KommunKod</header>" . $fastighet->KommunKod . "<br/>";
    echo "<header>Taxeringsar</header>" . $fastighet->Taxeringsar . "<br/>";
    echo "<header>Taxeringsvarde</header>" . $fastighet->Taxeringsvarde;

    visaFastighetsDelar($fastighet);

    echo "</div>";
}

function visaFastighetsDelar($fastighet)
{
    $fastighetsdelar = $fastighet->FastighetDel;
    if (isset($fastighetsdelar)) {
        echo "<header class='listheader'>Fastighetsdelar</header>";

        // SoapClient ger ett object om det bara är ett element i svaret
        // och en array om det är flera element i svaret
        if (is_object($fastighetsdelar)) {
            visaFastighetsDel($fastighetsdelar);
        } else {
            foreach ($fastighetsdelar as $f) {
                visaFastighetsDel($f);
            }
        }
    }
}

function visaFastighetsDel($fastighetsdel)
{
    echo "<div>";
    echo "<header>Taxeringsidentitet</header>" . $fastighetsdel->Taxeringsidentitet . "<br/>";
    echo "<header>FastighetBeteckning</header>" . $fastighetsdel->FastighetBeteckning . "<br/>";
    echo "<header>AndelstalTaljare</header>" . $fastighetsdel->AndelstalTaljare . "<br/>";
    echo "<header>AndelstalNamnare</header>" . $fastighetsdel->AndelstalNamnare . "<br/>";

    echo "</div>";
}


function visaOverstigerMax($svar)
{
    $overstiger = $svar["OverstigerMaxAntalSvarsposter"];
    if (isset($overstiger)) {
        echo "<section id='undantag'><h1>OverstigerMaxAntalSvarsposter</h1>";
        echo "<div>";
        echo "<header>AntalPoster</header>" . $overstiger->AntalPoster . "<br/>";
        echo "<header>Max antal</header>" . $overstiger->MaxAntalSvarsposter . "<br/>";
        echo "</div>";
        echo "</section>";
    }
}

function visaUndantag($svar)
{
    $undantag = $svar["Undantag"];
    if (isset($undantag)) {
        echo "<section id='undantag'><h1>Undantag</h1>";
        echo "<div>";
        echo "<header>Kod</header>" . $undantag->Kod . "<br/>";
        echo "<header>Beskrivning</header>" . $undantag->Beskrivning . "<br/>";
        echo "</div>";
        echo "</section>";
    }
}

function visaUUID($svar)
{
    $uuid = $svar["UUID"];
    if (isset($uuid)) {
        echo "<section id='uuid'><h1>UUID</h1>";
        echo "<div>";
        echo "<header>UUID</header>" . $uuid;
        echo "</div>";
        echo "</section>";
    }
}

