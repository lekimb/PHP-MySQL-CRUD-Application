<?php
    require "config.php";
    
    if(isset($_POST['submit'])) {
        try {
            // Connect to database
            $connection = new PDO($dsn, $user, $password, $options);
            // Prepare SQL statement
            $table = "users";
            $sql = "INSERT INTO $table (firstName, lastName, email, age) "
                    . "VALUES (:firstName, :lastName, :email, :age);";
            $statement = $connection->prepare($sql);
            // Store submited fields in array $newUser
            $newUser = array(
                "firstName" => $_POST['firstName'],
                "lastName"  => $_POST['lastName'],
                "email"     => $_POST['email'],
                "age"       => $_POST['age']
            );
            // Execute SQL statement passing array $newUser as the argument
            $success = $statement->execute($newUser);            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }        
?>

<?php require 'templates/header.php'; ?>

<?php if (isset($success)) { echo '<p class="success">User successfully added</p>'; } ?>
            
<h2>Create new user</h2>
<form method="post">
    <label for="firstName">First Name</label>
    <input type="text" name="firstName">
    <label for="lastName">Last Name</label>
    <input type="text" name="lastName">
    <label for="email">Email</label>
    <input type="text" name="email">
    <label for="age">Age</label>
    <input type="text" name="age">
    <input type="submit" name="submit" value="Submit">
</form>
</br>
<a href="index.php">Back</a>

<?php require 'templates/footer.php'; ?>
