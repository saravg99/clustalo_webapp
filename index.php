
<!-- 
inputs:
	fasta sequences
	uniprot ids
	a file upload 

-->

<?php
/*
 * index.php
 * main form
 */
 
 
 // Loading global variables and DB connection
require "globals.inc.php";


//
// $_SESSION['queryData'] array holds data from previous forms, 
// if empty it should be initialized to avoid warnings, and set defaults
// also a ...?new=1 allows to clean it from the URL.
//

if (isset($_REQUEST['new']) or !isset($_SESSION['queryData'])) {
    $_SESSION['queryData'] = [
        'seqQuery' => '',
        'uniprotQuery' => '',
        'output' => fa
    ];
}
// end initialization ===================================================================================
?>

<?= headerDBW("Clustal Omega")?>

<form name="MainForm" action="run_clustalo.php" method="POST" enctype="multipart/form-data">
	<div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Sequence search</h4>
                <p>Enter FASTA sequences:</p>

            <div class="form-group">
                <textarea class="form-control" name="seqQuery" rows="4" cols="60" style="width:100%"></textarea><br>
                OR <br><br>
                <p>Upload FASTA sequence file: </p>
                <input type="file" name="seqFile" value="" width="50" style="width:100%"/> <br>
            </div>
        </div>
    </div>
    
    	<div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Uniprot search</h4>
                <p>Enter Uniprot IDs:</p>

            <div class="form-group">
                <textarea class="form-control" name="uniprotQuery" rows="4" cols="60" style="width:100%"></textarea>
            </div>
        </div>
    </div>

       <div class="row" style="border-bottom: 1px solid">
        <div class="col-md-6">
                <h4>Output format</h4>
                <p>Select the desired output format:</p>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="output" value="fa" checked> Fasta 	 
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
            <button type='reset' class="btn btn-primary">Reset</button>
            <button type='button' class="btn btn-primary" onclick="window.location.href='index.php?new=1'">New Search</button>
        </p>
    </div>
</form>

<?= footerDBW()?>


