<?php
function dbConnect() {
    // We start with declaration and initialize some variables
    $dbhost		= "localhost";
    $dbname		= "db_portfolio_se";
    $dbuser		= "Sami_K2";
    $dbpass		= "Sami_K2";
    $charset    = 'utf8mb4';

    // Building connection string
    $conn = "mysql:host=" . $dbhost . "; dbname=" . $dbname . ";charset=". $charset;

    // Define options for PDO connection
    $options = [ 
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,	// give an error in case of an issue
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   	// get a row indexed by column name
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    // Here we're gonna try to execute some code
    try {
        $pdo = new PDO($conn, $dbuser, $dbpass, $options); // create connection
        return $pdo; // give it back to the place where it's been called
    } // end of try
    catch (\PDOException $e) {
        // only when the above goes wrong
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    } // end of catch
}

// Define $pdo globally so that it can be accessed in other functions
$pdo = dbConnect();

function getData($p_sSql, $p_aData = "") {
    // execute a query on the MySQL server
    // $p_sSQL contains the MySQL query string
    // $p_aData contains an array with query parameters

    global $pdo; // use the globally defined $pdo

    $stmt = $pdo->prepare($p_sSql); // prepare the query
    if (is_array($p_aData)) {		    
        $stmt->execute($p_aData);	 // add the data and execute the query
    } else {
        $stmt->execute();			 // execute without data
    }
    
    $result = $stmt->fetchAll(); // fetch the result
    return $result; // return the query result
}

// Use this if you need JSON
function jsonParse($p_sValue) {
    if (is_array($p_sValue)) {
        return json_encode($p_sValue);
    }
    if (is_string($p_sValue)) {
        return json_decode($p_sValue);
    }
}
?>
