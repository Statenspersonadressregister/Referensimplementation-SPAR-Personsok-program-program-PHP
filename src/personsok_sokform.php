<script> // Javascriptfunktioner för att rensa alla sökfält och sedan fylla i testexempel.

    function rensaAllaSokFalt() {
        nollstallAllaVarden(document.getElementById('personid').children);
        nollstallAllaVarden(document.getElementById('namnsok').children);
    }

    function nollstallAllaVarden(elementlist) {
        for (var i = 0; i < elementlist.length; i++) {
            if (elementlist[i].tagName === "LABEL") {
                elementlist[i].children[0].value = "";
            }
        }
    }

    function giltigtPersonId() {
        rensaAllaSokFalt();
        document.getElementsByName("idnummer")[0].value = "198111309285";
    }

    function skapaSoapFel() {
        rensaAllaSokFalt();
        document.getElementsByName("idnummer")[0].value = "000000000000";
    }

    function fonetiskSokning() {
        rensaAllaSokFalt();
        document.getElementsByName("fonetisksokning")[0].value = "JA";
        document.getElementsByName("namnsokargument")[0].value = "mikael efter*";
    }

    function forMangaTraffar() {
        rensaAllaSokFalt();
        document.getElementsByName("fonetisksokning")[0].value = "JA";
        document.getElementsByName("namnsokargument")[0].value = "efternamn*";
    }

    function skapaUndantag() {
        rensaAllaSokFalt();
        document.getElementsByName("namnsokargument")[0].value = "a*";
    }

    function ingenTraff() {
        rensaAllaSokFalt();
        document.getElementsByName("fonetisksokning")[0].value = "NEJ";
        document.getElementsByName("namnsokargument")[0].value = "dethärnamnetfinnsinteispar";
    }
</script>


<section id="sokning">
    <h1>Sökning</h1>
    <p class='hjalptext'>
        Sökningar kan antingen vara på ID-nummer eller på Namn/adress sökparametrar. Se dokumentation under Teknisk info på
        <a href="https://statenspersonadressregister.se/">SPAR:s hemsida</a>.
    </p>

    <section id="exempel">
        <h1>Ladda in värden för olika exempel</h1>
        <input type="button" value="ID-nummer sök" onclick="giltigtPersonId()"/>
        <input type="button" value="Namn/adress sök" onclick="fonetiskSokning()"/>
        <input type="button" value="Inga träffar" onclick="ingenTraff()"/>
        <input type="button" value="För många träffar" onclick="forMangaTraffar()"/>
        <input type="button" value="Undantag" onclick="skapaUndantag()"/>
        <input type="button" value="SOAP-fel" onclick="skapaSoapFel()"/>
    </section>

    <form method='post' name='form_sokning'>
        <section id="kommunikation">
            <h1>Kommunikationsparametrar för SOAP-anropet</h1>
            <label for="k1"> URL till tjänst</label>
            <input id="k1" name="url" type="text" value="https://test-personsok.statenspersonadressregister.se/2021.1/"/>

            <label for="k2">Klientcertifikat (PEM)
                <input id="k2" name="certifikat" type="text" value="resurser/Kommun_A.pem"/>
            </label>

            <label for="k3">Rootcertifikat/CA (PEM)
                <input id="k3" name="ca" type="text" value="resurser/DigiCert.pem"/>
            </label>
        </section>

        <section id="identifiering">
            <h1>Identifieringsinformation</h1>

            <label for="i1">KundNrLeveransMottagare
                <input id="i1" name="kundnrleveransmottagare" type="text" value="500243"/>
            </label>

            <label for="i2">KundNrSlutkund
                <input id="i2" name="kundnrslutkund" type="text" value="500243"/>
            </label>

            <label for="i4">SlutAnvandarId
                <input id="i4" name="slutanvandarid" type="text" value="Anställd X på avdelning B (Referensimplementation 2021.1 - PHP)"/>
            </label>

            <label for="i5">SlutAnvandarUtokadBehorighet
                <input id="i5" name="slutanvandarutokadbehorighet1" type="text" value=""/>
            </label>

            <label for="i6">SlutAnvandarUtokadBehorighet
                <input id="i6" name="slutanvandarutokadbehorighet2" type="text" value=""/>
            </label>

            <label for="i7">SlutAnvandarUtokadBehorighet
                <input id="i7" name="slutanvandarutokadbehorighet3" type="text" value=""/>
            </label>

            <label for="i8">SlutAnvandarUtokadBehorighet
                <input id="i8" name="slutanvandarutokadbehorighet4" type="text" value=""/>
            </label>

            <label for="u1">Uppdrags-ID
                <input id="u1" name="uppdragsid" type="text" value="637"/>
            </label>
        </section>

        <section id="personid">
            <h1>ID-nummer sök</h1>

            <label for="p1">ID-nummer
                <input id="p1" name="idnummer" type="text" value="198111309285"/>
            </label>

            <input name="sokning_personid" type="submit" value="Sök">
        </section>

        <section id="namnsok">
            <h1>Namn/adress sök</h1>

            <label for="n1">FonetiskSokning
                <input id="n1" name="fonetisksokning" type="text" value=""/>
            </label>

            <label for="n3">NamnSokArgument
                <input id="n3" name="namnsokargument" type="text" value=""/>
            </label>

            <label for="n4">FornamnSokArgument
                <input id="n4" name="fornamnsokargument" type="text" value=""/>
            </label>

            <label for="n5">MellanEfternamnSokArgument
                <input id="n5" name="mellanefternamnsokargument" type="text" value=""/>
            </label>

            <label for="n6">Kon
                <input id="n6" name="kon" type="text" value=""/>
            </label>

            <label for="n7">Fodelsetid
                <input id="n7" name="fodelsetid" type="text" value=""/>
            </label>

            <label for="n8">FodelsetidFran
                <input id="n8" name="fodelsetidfran" type="text" value=""/>
            </label>

            <label for="n9">FodelsetidTill
                <input id="n9" name="fodelsetidtill" type="text" value=""/>
            </label>

            <label for="n10">UtdelningsadressSokArgument
                <input id="n10" name="utdelningsadresssokargument" type="text" value=""/>
            </label>

            <label for="n11">PostortSokArgument
                <input id="n11" name="postortsokargument" type="text" value=""/>
            </label>

            <label for="n12">PostNr
                <input id="n12" name="postnr" type="text" value=""/>
            </label>

            <label for="n13">PostNrFran
                <input id="n13" name="postnrfran" type="text" value=""/>
            </label>

            <label for="n14">PostNrTill
                <input id="n14" name="postnrtill" type="text" value=""/>
            </label>

            <label for="n15">LanKod
                <input id="n15" name="lankod" type="text" value=""/>
            </label>

            <label for="n16">KommunKod
                <input id="n16" name="kommunkod" type="text" value=""/>
            </label>

            <label for="n18">DistriktKod
                <input id="n18" name="distriktkod" type="text" value=""/>
            </label>

            <label for="n19">DistriktKodFrom
                <input id="n19" name="distriktkodfrom" type="text" value=""/>
            </label>

            <label for="n20">DistriktKodTom
                <input id="n20" name="distriktkodtom" type="text" value=""/>
            </label>

            <input name="sokning_namn" type="submit" value="Sök">
        </section>
    </form>
</section>