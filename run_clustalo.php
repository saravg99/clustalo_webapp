<?php 


// load global vars and includes
require "globals.inc.php";

/////////////////// GET QUERY DATA //////////////////


// Store input data in $_SESSION to reload initial form if necessary
$_SESSION['queryData'] = $_REQUEST;

//print_r($_SESSION);



//uniprot input, preference over fasta sequence input
if ($_SESSION['queryData']['uniprotQuery']) {
	$_SESSION['queryData']['seqQuery'] = "";
	$ids = preg_split('/\s+/', $_SESSION['queryData']['uniprotQuery']);
	foreach ($ids as $id) {
		//echo $id;
		//echo "<br>";
		$url = "https://www.uniprot.org/uniprot/".$id.".fasta";
		$seq = file_get_contents($url);
		//echo $seq;
		$_SESSION['queryData']['seqQuery'] .= $seq;
		
	}
}


//Sequence input. If uploaded file, this takes preference over fasta sequence and uniprot input
if (($_FILES['seqFile']['tmp_name'])) {
    $_SESSION['queryData']['seqQuery'] = file_get_contents($_FILES['seqFile']['tmp_name']);
}


//echo $_SESSION['queryData']['seqQuery'];

//print_r($_FILES);
//echo "<br>";
//print_r($_SESSION);
//echo "<br>";
//print_r($_REQUEST);



//////////////////////////   RUN CLUSTAL //////////////



// Set temporary file name to a unique value to protect from concurrent runs
$tempFile = $tmpDir . "/" . uniqId('msa');


// Open temporary file and store query FASTA
$ff = fopen($tempFile . ".query.fasta", 'wt');
fwrite($ff, $_SESSION['queryData']['seqQuery']);
fclose($ff);


// execute Clustalo

$cmd = "./clustalo-1.2.4-Ubuntu-x86_64 -i " . $tempFile . ".query.fasta -o " . $tempFile . ".aln." . $_SESSION['queryData']['output'] . " --outfmt=" . $_SESSION['queryData']['output'] ;


// DEBUG print command line
//echo $cmd;

exec($cmd);


///////////////////////// SHOW OUTPUT AND DOWNLOAD OPTION ////////////
// Read results file and print result

$output_file = $tempFile . ".aln." . $_SESSION['queryData']['output'];

$_SESSION['outputfile'] = file_get_contents($output_file);

//header('Content-Type: text/plain');
//echo file_get_contents($output_file);

if ($_SESSION['outputfile'] == "") {
	$_SESSION['outputfile'] = "EMPTY OUTPUT\n\nPlease check that your input data contains at least 2 sequences in FASTA format or 2 valid Uniprot IDs.";
}
	

?>

<?= headerDBW("Alignment results")?>
    </br>
    <form name="downloadform" method="POST" action="download.php">
    	<button type='submit' class="btn btn-secondary", name="download">Download File</button>    
    	<button type='button' class="btn btn-primary" onclick="window.location.href='index.php'">Back</button>
    	<button type='button' class="btn btn-primary" onclick="window.location.href='index.php?new=1'">New Alignment</button>
    </form>

    </br>
    <pre><?= $_SESSION['outputfile'] ?></pre> 
    
    


<?= footerDBW()?>


<?php

// Cleaning temporary files
if (file_exists($tempFile . ".query.fasta")) {
    unlink($tempFile . ".query.fasta");
}
if (file_exists($tempFile . ".aln." . $_SESSION['queryData']['output'])) {
    unlink($tempFile . ".aln." . $_SESSION['queryData']['output']);
}

?>






