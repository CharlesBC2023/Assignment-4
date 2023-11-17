<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $pdo = new PDO('sqlite:account.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];

        //these exceptions arent working
        if (empty($username)) {
            throw new Exception("Please enter a username");
        }

        if (empty($password)) {
            throw new Exception("Please enter a password");
        }

        if (empty($fullname)) {
            throw new Exception("Please enter your full name");
        }

        if (empty($dob)) {
            throw new Exception("Please enter your date of birth");
        }

        if (empty($email)) {
            throw new Exception("Please enter your email address");
        }

        if (empty($mobile)) {
            throw new Exception("Please enter your mobile number");
        }

        if (empty($address)) {
            throw new Exception("Please enter your address");
        }

        if (empty($state)) {
            throw new Exception("Please select your state");
        }

        if (empty($city)) {
            throw new Exception("Please enter your city");
        }

        $stmt = $pdo->prepare('INSERT INTO account (username, password, fullname, dob, gender, email, mobile, address, state, city, permission) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)');
        $stmt->execute([$username, $password, $fullname, $dob, $gender, $email, $mobile, $address, $state, $city]);

        //the information doesnt get put into the database after pressing submit
        header('Location: signin.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<form method="post" action="register.php">
    <?php echo $error ?>
<table>
    <tr>
        <th colspan="2">Registration Form</th>
    </tr>
    <tr>
        <td>Username</td>
        <td><input type="text" name="username" id="username" maxlength="50" value="<?php echo $_POST['username'] ?>" ></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" id="password" maxlength="9" value="<?php echo $_POST['password'] ?>"></td>
    </tr>
    <tr>
        <td>Confirm Password</td>
        <td><input type="password" name="confirm_password" id="confirm_password" maxlength="9" value="<?php echo $_POST['confirm_password'] ?>"></td>
    </tr>
    <tr>
        <td>Full Name</td>
        <td><input type="text" name="fullname" id="fullname" maxlength="50" value="<?php echo $_POST['fullname'] ?>"></td>
    </tr>
    <tr>
        <td>Date of Birth</td>
        <td><input type="date" name="dob" id="dob" maxlength="9" value="<?php echo $_POST['dob'] ?>"></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td>
            <input type="radio" name="gender" id="male" value="1"> Male
            <input type="radio" name="gender" id="female" value="2"> Female
            <input type="radio" name="gender" id="other" value="3"> Other
        </td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email" id="email" maxlength="50"></td>
    </tr>
    <tr>
        <td>Mobile</td>
        <td><input type="text" name="mobile" id="mobile" maxlength="50"></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><textarea name="address" id="address" maxlength="200"></textarea></td>
    </tr>
    <tr>
        <td>State</td>
        <td><select name="state">
                <option>Select a State</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select></td>
    </tr>
    <tr>
        <td>City</td>
        <td><input type="text" name="city" id="city" maxlength="50" value="<?php echo $_POST['city'] ?>" ></td>
    </tr>
    <tr>
        <td></td>
        <td align="right"> <button><a href="index.php">back</a> </button><button type="submit">submit</button> </td>
    </tr>
</table>
</form>
</body>
</html>
