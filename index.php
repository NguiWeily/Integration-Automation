<?php
session_start();

if (isset($_POST['Submit'])){

try {
    
    $db = new PDO('mysql:host=localhost;dbname=webjti', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $capacity = $_POST['capacity'];
    $usage_rate = $_POST['usage_rate'];
    
    $query = "SELECT train_id, journey_code, capacity, usage_rate FROM train_info WHERE capacity >= :capacity AND usage_rate < :usage_rate";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
    $stmt->bindParam(':usage_rate', $usage_rate, PDO::PARAM_INT);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($results){
        echo(‘<h2>22053119 Ngui Weily</h2>);
        echo('<table><tr><th>Train ID</th><th>Journey code</th><th>Maximum passenger capacity</th><th>Current usage rate</th></tr>');
        foreach ($results as $row) {
            echo('<tr>');
            echo('<td>'.$row['train_id'].'</td>');
            echo('<td>'.$row['journey_code'].'</td>');
            echo('<td>'.$row['capacity'].'</td>');
            echo('<td>'.$row['usage_rate'].'</td>');
            echo('</tr>');
        }
        echo('</table>');
	}

}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$db = null;

echo('<a href="index.php">Go back to search page</a>');

}
else
{
?>
<form method="POST" action="#" >
  <h2>22053119 Ngui Weily</h2>
  <h2>Search trains</h2>
  <p>Maximum capacity greater than or equals: <input type="text" name="capacity"></p>
  <p>Current usage rate less than: <input type="text" name="usage_rate"> %</p>
  <input type="submit" name="Submit" value="Submit">
</form>
<?php
}
?>
