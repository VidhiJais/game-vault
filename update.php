<!DOCTYPE html>
<html>
<head>
    <title>Update Game</title>
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
    text-color: grey;
    margin-bottom: 20px;
}

input[type="text"],
textarea {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #6F2232;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
    background-color: #1A1A1D;
    color:#fff;
}

select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #6F2232;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 10px;
    background-color: #1A1A1D;
    color:#fff;
}

input[type="file"] {
    
    margin-bottom: 10px;
}

input[type="submit"] {
    padding: 10px;
    width:200px;
    alignment:left;
    font-size: 16px;
    margin-top:10px;
    border: none;
    border-radius: 5px;
    background-color: #6F2232;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #111;
}

input[name="release_date"],
input[name="rating"] {
    border: 1px solid #6F2232;
    font-size: 16px;
    margin-bottom:5px;
    width: 200px;
    border-radius: 5px;
    background-color:  #1A1A1D;
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
        
        <h1>Update Game</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <select name="game_id">
                <option value="">Select a game</option>
                <?php
                // Database connection
                $conn = mysqli_connect("localhost", "root", "", "gaming_library");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch all games
                $sql = "SELECT * FROM games";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                }

                mysqli_close($conn);
                ?>
            </select>
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="date" name="release_date" placeholder="Release_Date" required>
            <input type="decimal" name="rating" placeholder="Rating" required>
            <input type="text" name="mode" placeholder="Mode" required>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Update Game">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "gaming_library");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $gameId = $_POST['game_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $release_date=$_POST['release_date'];
            $rating=$_POST['rating'];
            $mode=$_POST['mode'];

            if (!empty($_FILES['image']['name'])) {
                // File upload
                $targetDir = "assets/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

                // Update game details and image in the database
                $image = basename($_FILES["image"]["name"]);
                $sql = "UPDATE games SET title='$title', description='$description', release_date= '$release_date', rating='$rating', mode='$mode', image='$image' WHERE id='$gameId'";
            } else {
                // Update game details in the database
                $sql = "UPDATE games SET title='$title', description='$description', release_date= '$release_date', rating='$rating', mode='$mode' WHERE id='$gameId'";
            }

            if (mysqli_query($conn, $sql)) {
                echo "Game updated successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
