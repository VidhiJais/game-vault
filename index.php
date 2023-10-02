<!DOCTYPE html>
<html>
<head>
    <title>Gaming Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(bg.png);
            background-size: cover;
            background-attachment: fixed ;
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

        .signout {
            float: right;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(50, 50, 50, 0.8);
            border-radius: 5px;
            color: white;
            text-align: center;
        }

        
        .game-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .game {
            flex: 0 0 300px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .game img {
            display: block;
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
            margin-bottom: 10px;
        }

        .game h2 {
            font-size: 20px;
            margin: 0;
            text-align: left;
        }

        .game p {
            margin: 5px 0;
            text-align: left;
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
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="add.php">Add Game</a></li>
                <li><a href="delete.php">Delete Game</a></li>
                <li><a href="search.php">Search Game</a></li>
                <li><a href="update.php">Update Game</a></li>
                <li class="signout"><a href="signout.php">Sign Out</a></li>
            </ul>
        </nav>

    <div class="container">
        <h1><center>Welcome to Gaming Library</center></h1>
        <div class="game-container">
        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "gaming_library");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetching games from the database
        $sql = "SELECT * FROM games";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Displaying games
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="game">';
                echo '<img src="assets/' . $row['image'] . '">';
                echo '<h2>' . $row['title'] . '</h2>';
                echo '<p>' . $row['description'] . '</p>';
                echo '<p class="release-date">Release Date: ' . $row['release_date'] . '</p>';
                echo '<p class="rating">Rating: ' . $row['rating'] . '</p>';
                echo '<p class="mode">Mode: ' . $row['mode'] . '</p>';
                echo '</div>';
            }
        } else {
            echo "No games found.";
        }

        mysqli_close($conn);
        ?>
    </div>
    </div>
</body>
</html>
