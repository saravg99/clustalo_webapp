

<?php
/*
 * index.php
 * main form
 */
 
 
 // Loading global variables
require "globals.inc.php";


//
// $_SESSION['queryData'] array holds data from previous forms, 
// if empty it should be initialized to avoid warnings, and set defaults
// also a ...?new=1 allows to clean it from the URL.
//

if (isset($_REQUEST['new']) or !isset($_SESSION['queryData'])) {
    $_SESSION['queryData'] = [];
    $_SESSION['outputfile'] = '';
}
// end initialization ===================================================================================
?>

<?= headerDBW("Clustal Omega")?>

<form name="MainForm" action="run_clustalo.php" method="POST" enctype="multipart/form-data">
	<div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Sequence alignment</h4>
                <p>Enter FASTA sequences:</p>

            <div class="form-group">
                <textarea class="form-control" name="seqQuery" rows="4" cols="60" style="width:100%" ><?= $_SESSION['queryData']['seqQuery'] ?></textarea><br>
                OR <br><br>
                <p>Upload FASTA sequence file: </p>
                <input type="file" name="seqFile" value="" width="50" style="width:100%"/> <br>
            </div>
        </div>
    </div>
    
    	<div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Uniprot alignment</h4>
                <p>Enter Uniprot IDs:</p>

            <div class="form-group">
                <textarea class="form-control" name="uniprotQuery" rows="4" cols="60" style="width:100%"><?= $_SESSION['queryData']['uniprotQuery'] ?></textarea>
            </div>
        </div>
    </div>

       <div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Output format</h4>
                <p>Select the desired output format:</p>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="fa" checked> Fasta (default format) 	 
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="clu"> Clustal
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="msf"> MSF
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="phy"> Phylip
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="selex"> Selex
            </div>   
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="st"> Stockholm
            </div>         
            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="vie"> Vienna
            </div>     
            <br>       
        </div>
    </div>



    <div class="row">
        <p>
            <button type='submit' class="btn btn-primary">Submit</button>
            <button type='button' class="btn btn-primary" onclick="window.location.href='index.php?new=1'">New Alignment</button>
        </p>
    </div>
</form>

<?= footerDBW()?>


