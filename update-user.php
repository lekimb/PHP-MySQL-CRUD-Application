<?php
require 'config.php';

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $user, $password, $options);

        $userArray = [
          "id"        => $_POST['id'],
          "firstName" => $_POST['firstName'],
          "lastName"  => $_POST['lastName'],
          "email"     => $_POST['email'],
          "age"       => $_POST['age']
        ];

        $table = "users";
        $sql = "UPDATE $table 
                SET id = :id, 
                    firstName = :firstName, 
                    lastName = :lastName, 
                    email = :email, 
                    age = :age 
                WHERE id = :id";

        // Prepare and execute passing $user array to bind values
        $statement = $connection->prepare($sql);
        $success = $statement->execute($userArray);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
    
    
if (isset($_GET['id'])) {
    try {
        $connection = new PDO($dsn, $user, $password, $options);
        
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch();
        
    } catch (Exception $ex) {
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($success)) { echo '<p class="success">User successfully updated</p>'; } ?>

<h2>Update user</h2>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']?>"  readonly>
    <label for="firstName">First Name</label>
    <input type="text" name="firstName" value="<?php echo $user['firstName']?>">
    <label for="lastName">Last Name</label>
    <input type="text" name="lastName" value="<?php echo $user['lastName']?>">
    <label for="email">Email</label>
    <input type="text" name="email" value="<?php echo $user['email']?>">
    <label for="age">Age</label>
    <input type="text" name="age" value="<?php echo $user['age']?>"> 
    <input type="submit" name="submit" value="Submit">
</form>
</br>
<a href="update.php">Back</a>

<?php require "templates/footer.php"; ?>

