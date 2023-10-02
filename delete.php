<!DOCTYPE html>
<html>
<head>
    <title>Delete Game</title>
    <style>/* assets/style.css */

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(bg.png);
            background-size: cover ;
            background-attachment: fixed;
        }

        .title-bar {
            background-color: darkred;
            padding: 10px;
            text-align: left;
        }

        .title-bar .logo {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .title-bar .logo img {
        display: block;
        width: 100%;
        height: auto;
        border-radius: 50%;
        background-color: transparent;
        transform:scale(2.5);
}

        .title-bar h1 {
            color: white;
            margin: 0;
            display: inline;
            vertical-align: left;
        }


        nav {
            background-color: black;
            overflow: hidden;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
           text-align: center;
        }

        nav ul li {
            display:inline-block;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #333;
        }

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: rgba(50, 50, 50, 0.8);
    border-radius: 5px;
}

h1 {
    text-align: center;
    color: white;
    margin-bottom:20 px;
}

form {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    padding: 8px;
    border: 1px solid #ccc;
}

table td{
    color: white;
}

table th {
    background-color: grey;
    font-weight: bold;
    text-align: left;
}

input[type="checkbox"] {
    margin: 0;
}

input[type="submit"] {
    margin-top: 10px;
    padding: 10px;
    background-color: #6F2232;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
            background-color: #111;
        }

</style>
</head>
<body>
<div class="title-bar">
    <div class="logo">
        <img src="tlogo1.png" alt="Logo">
    </div>
    <h1>Game Vault</h1>
    </div>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add.php">Add Game</a></li>
                <li><a href="delete.php">Delete Game</a></li>
                <li><a href="search.php">Search Game</a></li>
                <li><a href="update.php">Update Game</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Delete Game</h1>
        <form action="" method="POST">
            <?php
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "gaming_library");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch all games
            $sql = "SELECT * FROM games";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Display games in a table with checkboxes and an action column
                echo '<table>';
                echo '<tr><th>Title</th><th>Description</th><th>Release_Date</th><th>Rating</th><th>Mode</th><th>Image</th><th>Action</th></tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['release_date'] . '</td>';
                    echo '<td>' . $row['rating'] . '</td>';
                    echo '<td>' . $row['mode'] . '</td>';
                    echo '<td><img src="assets/' . $row['image'] . '" width="50"></td>'; // New image column
                    echo '<td><input type="checkbox" name="games[]" value="' . $row['id'] . '"></td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "No games found.";
            }

            mysqli_close($conn);
            ?>

            <input type="submit" name="submit" value="Delete Games">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "gaming_library");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_POST['games'])) {
                // Get selected game IDs
                $gameIds = $_POST['games'];

                // Delete selected games from the database
                $sql = "DELETE FROM games WHERE id IN (" . implode(",", $gameIds) . ")";

                if (mysqli_query($conn, $sql)) {
                    echo "Games deleted successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "No games selected.";
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>