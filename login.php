<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: manage.php');
    exit();
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        try {
            // Connect to database
            $db = new PDO('sqlite:account.db');

            // Prepare SQL statement to retrieve account record
            $stmt = $db->prepare('SELECT * FROM account WHERE username = ? AND password = ?');
            $stmt->execute([$username, $password]);

            // Check if account record exists
            $account = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($account) {
                // Store username and admin status in session
                $_SESSION['username'] = $account['username'];
                $_SESSION['permission'] = $account['permission'];
                $_SESSION['fullname'] = $account['fullname'];

                // Redirect to manage.php
                header('Location: manage.php');
                exit();
            } else {
                // Log failed login attempt
                $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;

                $error = 'Invalid username or password.';

                // Display number of failed login attempts (if any)
                if ($_SESSION['login_attempts'] > 1) {
                    $error .= ' (' . $_SESSION['login_attempts'] . ' attempts)';
                }
            }
        } catch (PDOException $e) {
            $error = 'Connection failed: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
    <table>
        <th colspan="2">Login Form</th>
        <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" id="username" name="username"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" id="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td align="right"> <button><a href="index.php">back</a> </button><button type="submit">submit</button> </td>
        </tr>
    </table>
</form>
</body>
</html>