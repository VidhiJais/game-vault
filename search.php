<!DOCTYPE html>
<html>
<head>
    <title>Search Game</title>
    <style>
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
            max-width: 700px;
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

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            width:40%;
            font-size: 16px;
            border: 1px solid #6F2232;
            background-color: #1A1A1D;
            color:#fff;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px;
            width:150px;
            alignment: left;
            margin-left: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: #6F2232;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #111;
        }

        .game {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .game img {
            display: block;
            max-width: 200px; /* Set a maximum width for the images */
            height: auto;
            margin-right: 20px;
        }

        .game-info {
            flex-grow: 1;
        }

        .game h2 {
            font-size: 20px;
            margin: 0;
            color: white;
        }

        .game p {
            color:white;
            margin: 0;
        }

        .game .release-date,
        .game .rating,
        .game .mode {
            margin: 5px 0;
            text-align: left;
            font-weight: bold;
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
        <h1>Search Game</h1>
        <form action="" method="POST">
            <input type="text" name="keyword" placeholder="Keyword" required>
            <input type="submit" name="submit" value="Search">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "gaming_library");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $keyword = $_POST['keyword'];

            // Search for games in the database
            $sql = "SELECT * FROM games WHERE title LIKE '%$keyword%'";
            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) > 0) {
                // Displaying search results
                while ($row =mysqli_fetch_assoc($result)) {
                    echo '<div class="game">';
                    echo '<img src="assets/' . $row['image'] . '">';
                    echo '<div class="game-info">';
                    echo '<h2>' . $row['title'] . '</h2>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p class="release-date">Release Date: ' . $row['release_date'] . '</p>';
                    echo '<p class="rating">Rating: ' . $row['rating'] . '</p>';
                    echo '<p class="mode">Mode: ' . $row['mode'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No games found.";
            }

            mysqli_close($conn);
        }
        ?>
    </div>
</body>
</html>
