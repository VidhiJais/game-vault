<!DOCTYPE html>
<html>
<head>
    <title>Add Game</title>
    <style>/* assets/style.css */

body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(bg.png);
            background-size: cover ;
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
            max-width: 600px;
            margin: 40px auto;
            padding: 10px;
            background-color: rgba(50, 50, 50, 0.8);
            border-radius: 5px;
        }
h1 {
    text-align: center;
    color: white;
    margin-bottom:20 px;
}

form {
    text-align: center;
    margin-bottom: 20px;
}

form input[type="text"],
form textarea,
form input[type="text"],
form input[type="file"],
form input[type="submit"] {
    margin-top: 5px;
    width:100%;
    font-size: 16px;
    padding: 10px;
    border: 1px solid #6F2232;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: #1A1A1D;
    color: #fff;
}

form input[type="date"],
form input[type="decimal"] {
            margin-top: 5px;
            width: 50%;
            font-size: 16px;
            padding: 10px;
            border: 1px solid #6F2232;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #1A1A1D;
            color: #fff;
        }

form input[type="submit"] {
    padding: 10px;
    width:200px;
    alignment: left;
            margin-top: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
    background-color:#6F2232;
    color: #fff;
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
        <h1>Add Game</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required><br>
            <textarea name="description" placeholder="Description" required></textarea><br>
            <input type="date" name="release_date" placeholder="Release_date" required><br>
            <input type="decimal" name="rating" placeholder="Rating" required><br>
            <input type="text" name="mode" placeholder="Mode" required><br>
            <input type="file" name="image" required><br>
            <input type="submit" name="submit" value="Add Game">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "gaming_library");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // File upload
            $targetDir = "assets/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

            // Insert game details into the database
            $title = $_POST['title'];
            $description = $_POST['description'];
            $release_date=$_POST['release_date'];
            $rating=$_POST['rating'];
            $mode=$_POST['mode'];
            $image = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO games ( title, description, release_date, rating, mode, image) VALUES ('$title', '$description', '$release_date','$rating','$mode','$image')";

            if (mysqli_query($conn, $sql)) {
                echo "Game added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
