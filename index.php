<?php
session_start();

if (isset($_POST['Submit'])){
    // form-handling code
    $capacity = $_POST['capacity'];
    $usage = $_POST['usage'];
    $studentID = "22053119";
    $name = "Ngui Weily";
    
    try {
        // database initialization code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webjti";
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // prepare sql and bind parameters
        $stmt = $db->prepare("SELECT train_id, journey_code, capacity, usage_rate FROM train_info WHERE capacity >= :capacity AND usage_rate < :usage");
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':usage', $usage);
        $stmt->execute();
        $results = $stmt->fetchAll();
        
        if ($results) {
            // results display code
            echo "Student ID: " . $studentID . "<br>";
            echo "Name: " . $name . "<br>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Train ID</th>";
            echo "<th>Journey Code</th>";
            echo "<th>Capacity</th>";
            echo "<th>Usage Rate</th>";
            echo "</tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row["train_id"] . "</td>";
                echo "<td>" . $row["journey_code"] . "</td>";
                echo "<td>" . $row["capacity"] . "</td>";
                echo "<td>" . $row["usage_rate"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<br>";
            echo('<a href="index.php">Go back to search page</a>');
        } else {
            echo "No results found.";
            echo "<br>";
            echo('<a href="index.php">Go back to search page</a>');
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $db = null;
} else {
?>

<form method="POST" action="#" >
    <label>Capacity:</label>
    <input type="number" name="capacity" required>
    <br>
    <label>Usage:</label>
    <input type="number" name="


<?php
session_start();

if (isset($_POST['Submit'])){
    try {
        $max_capacity = $_POST['max_capacity'];
        $usage_rate = $_POST['usage_rate'];

        $student_id = "22053119";
        $student_name = "Ngui Weily";
        
        $host = "localhost";
        $dbname = "webjti";
        $username = "root";
        $password = "";
        
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "SELECT train_id, journey_code, capacity, usage_rate FROM train_info WHERE capacity >= :max_capacity AND usage_rate < :usage_rate";
        $statement = $db->prepare($query);
        $statement->bindValue(':max_capacity', $max_capacity);
        $statement->bindValue(':usage_rate', $usage_rate);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>" . $student_id . " " . $student_name . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Train ID</th><th>Journey code</th><th>Maximum passenger capacity</th><th>Current usage rate</th></tr>";
        foreach ($results as $row) {
            echo "<tr><td>" . $row['train_id'] . "</td><td>" . $row['journey_code'] . "</td><td>" . $row['capacity'] . "</td><td>" . $row['usage_rate'] . "</td></tr>";
        }
        echo "</table>";
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    $db = null;

    echo('<br><a href="index.php">Go back to search page</a>');
}
else
{
?>
<form method="POST" action="#" >
  <h2><?php echo $student_id . " " . $student_name; ?></h2>
  <h3>Search trains:</h3>
  Maximum capacity greater than or equals : <input type="text" name="max_capacity" required><br><br>
  Current usage rate less than : <input type="text" name="usage_rate" required><br><br>
  <input type="submit" name="Submit" value="Submit">
</form>
<?php
}
?>
