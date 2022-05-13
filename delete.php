<?php
require 'config.php';

if (isset($_POST['submit'])) {
    try {
        // Connect
        $connection = new PDO($dsn, $user, $password, $options);
        // Get item-to-delete id
        $id = $_POST['submit'];
        // Prepare SQL and bind id value
        $table = "users";
        $sql = "DELETE FROM $table WHERE id = :id;";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id);
        // Execute
        $success = $statement->execute(); 
    } catch (Exception $ex) {
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
    }
}

try {
    // Connect
    $connection = new PDO($dsn, $user, $password, $options);
    // SQL statement
    $table = "users";
    $sql = "SELECT * FROM $table";
    // Prepare and execute
    $statement = $connection->prepare($sql);
    $statement->execute();
    // fetchAll
    $results = $statement->fetchAll();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>

<?php require 'templates/header.php'; ?>

<?php if (isset($success)) { echo "User successfully deleted"; } ?>

    <h2>Delete users</h2>
    <form method="post">
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $user): ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['firstName'] ?></td>
                    <td><?php echo $user['lastName'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['age'] ?></td>
                    <td><button type="submit" name="submit" value="<?php echo $user["id"]; ?>">Delete</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    </br>
    <a href="index.php">Back</a>

<?php require 'templates/footer.php'; ?>

