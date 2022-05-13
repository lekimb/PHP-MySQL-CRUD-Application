<?php

require 'config.php';

try {
    $connection = new PDO($dsn, $user, $password, $options);
    
    $table = "users";
    $sql = "SELECT * FROM $table";
    
    $statement = $connection->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>

<?php require 'templates/header.php'; ?>

    <h2>Update users</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Update</th>
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
                <td><a href="update-user.php?id=<?php echo $user['id'] ?>">Update</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </br>
    <a href="index.php">Back</a>
    
<?php require 'templates/footer.php'; ?>