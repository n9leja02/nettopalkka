<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nettopalkka</title>
</head>
<body>
    <h3>Nettopalkka</h3>
    
    <?php
        $brutto=0;
        $netto=0;
        $ep=0;
        $tyel=0;
        $tvmEur=0;
        $epEur=0;
        $tyelEur=0;
        $tvmEur=0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brutto = $_POST["brutto"];
            $brutto = str_replace(",",".",$brutto);
            $brutto = filter_var($brutto,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

            $ep = $_POST["ennakonp"];
            $ep =  filter_var($ep,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            // $ep = str_replace(",",".",$ep);
            $epEur = $brutto / 100 * $ep;
            $epEur =  filter_var($epEur,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

            $tyel = $_POST["tyel"];
            $tyel =  filter_var($tyel,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            // $tyel = str_replace(",",".",$tyel);
            $tyelEur = $brutto / 100 * $tyel;
            $tyelEur =  filter_var($tyelEur,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

            $tvm = $_POST["tvm"];
            $tvm =  filter_var($tvm,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            // $tvm = str_replace(",",".",$tvm);
            $tvmEur = $brutto / 100 * $tvm ;
            $tvmEur =  filter_var($tvmEur,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            
            $netto = $brutto - $epEur - $tyelEur - $tvmEur;
        }
    ?>

    <form action="<?php print $_SERVER['PHP_SELF']?>" method="post">
        <div>
            <label for="brutto">Bruttopalkka:</label>
            <input name="brutto" id="brutto" type="number" step="any">
        </div>
        <div>
            <label for="ennakonp">Ennakonpidätys-%:</label>
            <input name="ennakonp" id="ennakonp" type="number" step="any" min="0" max="100">
            <?php
            print "% $epEur";
            ?>
        </div>
        <div>
            <label for="tyel">Työeläkemaksu-%:</label>
            <input name="tyel" id="tyel" type="number>" step="any" min="0" max="100">
            <?php
            print "% $tyelEur";
            ?>
        </div>
        <div>
            <label for="tvm">Työttömyysvakuutusmaksu-%:</label>
            <input name="tvm" id="tvm" type="number>" step="any" min="0" max="100">            
            <?php
            print "% $tvmEur";
            ?>
        </div>
        <button>Laske</button>
    </form>

    <?php
        print "<p>$netto</p>"
    ?>

</body>
</html>