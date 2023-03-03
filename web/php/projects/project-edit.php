<?php

session_start();

if (!isset($_SESSION['username'])) {

    header('Location: loginform-process.php');

    exit();

}

if (!isset($_GET['id'])) {

    header('Location: project-list.php');

    exit();

}

require_once 'dbconnect.php';

$id = $_GET['id'];

$username = $_SESSION['username'];

// Fetch project details

$sql = "SELECT * FROM projects WHERE id = ? AND user = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param('is', $id, $username);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    header('Location: project-list.php');

    exit();

}

$project = $result->fetch_assoc();

// Handle form submission

if (isset($_POST['submit'])) {

    $name = $_POST['name'];

    $description = $_POST['description'];

    $deadline = $_POST['deadline'];

    $sql = "UPDATE projects SET name = ?, description = ?, deadline = ? WHERE id = ? AND user = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('sssis', $name, $description, $deadline, $id, $username);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        header('Location: project-details.php?id=' . $id);

        exit();

    } else {

        $error = 'Error updating project';

    }

}

$title = 'Edit Project - ' . $project['name'];

include 'header.php';

?>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <h1>Edit Project</h1>

            <?php if (isset($error)) { ?>

                <div class="alert alert-danger"><?php echo $error; ?></div>

            <?php } ?>

            <form method="post">

                <div class="form-group">

                    <label for="name">Name</label>

                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $project['name']; ?>" required>

                </div>

                <div class="form-group">

                    <label for="description">Description</label>

                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $project['description']; ?></textarea>

                </div>

                <div class="form-group">

                    <label for="deadline">Deadline</label>

                    <input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $project['deadline']; ?>" required>

                </div>

                <button type="submit" class="btn btn-primary" name="submit">Update</button>

            </form>

        </div>

    </div>

</div>

<?php include 'footer.php'; ?>

