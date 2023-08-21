<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application - Card View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            padding: 2px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        .card h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .card p {
            margin: 5px 0;
        }

        .card p strong {
            font-weight: bold;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            color: #fff;
        }

        .action-buttons a.edit {
            background-color: #007bff;
        }

        .action-buttons a.delete {
            background-color: #dc3545;
        }

        .action-buttons a:hover {
            opacity: 0.8;
        }

        .add-form {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            margin-top: 20px;
            max-width: 400px; /* Add a fixed width */
            margin-left: auto; /* Center the form horizontally */
            margin-right: auto; /* Center the form horizontally */
        }

        .add-form label {
            display: block;
            margin-bottom: 5px;
        }

        .add-form input,
        .add-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .add-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .add-form input[type="submit"]:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php
        include("connection.php");
        $query = "SELECT * FROM details";
        $result = mysqli_query($con, $query);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query1 = "SELECT * FROM details WHERE id = $id";
            $result1 = mysqli_query($con, $query1);
            $row1 = mysqli_fetch_assoc($result1);
        }
    ?>

    <h1>TODO LIST</h1>
    <div class="card-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        ?>
            <div class="card">
                <h2><?php echo $row['title']; ?></h2>
                <p><?php echo $row['description']; ?></p>
                <p><strong>Due Date:</strong> <?php echo $row['duedate']; ?></p>
                <p><strong>Priority:</strong> <?php echo $row['priority']; ?></p>
                <div class="action-buttons">
                    <a class="edit" href="index.php?id=<?php echo $id ?>">Edit</a>
                    <a class="delete" href="memberaction.php?id=<?php echo $id; ?>&action=delete">Remove</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="add-form">
        <h1>Add TODO Details</h1>
        <form action="memberaction.php" method="POST">
            <input type="hidden" name="id" value='<?php if (isset($_GET['id'])) {echo $row1['id'];} ?>'>
            <label for="title">Title:</label>
            <input type="text" name="title" value='<?php if (isset($_GET['id'])) {echo $row1['title'];} ?>' required>
            <label for="description">Description:</label>
            <input type="text" name="description" value='<?php if (isset($_GET['id'])) {echo $row1['description'];} ?>' required>
            <label for="duedate">Due Date:</label>
            <input type="date" name="duedate" value='<?php if (isset($_GET['id'])) {echo $row1['duedate'];} ?>' required>
            <label for="priority">Priority:</label>
            <select name="priority" required>
                <option value="High" <?php if (isset($_GET['id']) && $row1['priority'] == 'High') {echo 'selected';} ?>>High</option>
                <option value="Medium" <?php if (isset($_GET['id']) && $row1['priority'] == 'Medium') {echo 'selected';} ?>>Medium</option>
                <option value="Low" <?php if (isset($_GET['id']) && $row1['priority'] == 'Low') {echo 'selected';} ?>>Low</option>
            </select>
            <input type="submit" name="<?php if (isset($_GET['id'])) {echo "update";} else {echo "add";} ?>"
               value="<?php if (isset($_GET['id'])) {echo "Update";} else {echo "Add";} ?>">
        </form>
    </div>
</body>
</html>
