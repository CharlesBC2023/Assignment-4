<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: signin.php');
}

// Check if the logged-in user has admin permission
if ($_SESSION['permission'] == 0) {
    echo "Sorry but this account does not have permission to manage users";
} else {
    try {
        // Open a connection to the database
        $db = new PDO('sqlite:account.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the ID parameter is provided
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Delete the record with the given ID from the account table
            $stmt = $db->prepare('DELETE FROM account WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redirect back to the manage.php page without the ID parameter
            header('Location: manage.php');
        } else {
            // Get all regular accounts from the account table
            $stmt = $db->query('SELECT * FROM account WHERE permission != 1');

            // Display a table with headers and all regular accounts
            echo 'Welcome <strong>' . $_SESSION['fullname'] . '</strong> | <a href="logout.php">Logout</a>';
            echo '<table>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Username</th>';
            echo '<th>Full Name</th>';
            echo '<th>Gender</th>';
            echo '<th>Email</th>';
            echo '<th>Mobile</th>';
            echo '<th>Address</th>';
            echo '<th>State</th>';
            echo '<th>City</th>';
            echo '<th>Delete</th>';
            echo '</tr>';

            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['fullname'] . '</td>';
                echo '<td>' . ($row['gender'] == 'm' ? 'Male' : 'Female') . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['mobile'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['state'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td><a href="manage.php?id=' . $row['id'] . '"><img src="./assets/cross_red.png"></a></td>';
                echo '</tr>';
            }

            // Add a back button to get user back to the home page
            echo '<tr>';
            echo '<td colspan="10" style="text-align: right;"><button><a href="signin.php">Back</a></button></td>';
            echo '</tr>';

            echo '</table>';
        }

        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="index.css">