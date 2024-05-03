
<!-- resources/views/errors/404.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-image: url('https://dmanbd.com/images/404.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: red;
        }

        footer {
            margin-top: auto;
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            color: black;
        }
        a{
            text-decoration: none;
            color: white;
        }
        header{
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
    <!-- Add your stylesheets, scripts, or other head content here -->
</head>
<body>
<header>
    <h1>404 - Not Found</h1><br><br><br><br><br>
    <h4><p>Sorry, the page you are looking for could not be found.</p></h4>
    <a href="/">Click here to Go back to the home page</a>
</header>
<div class="container">


</div>

<footer>
    Developed by <span><a href="https://www.facebook.com/jarir.in.ruet.cse/" style="color:blue;">3C Studio</a></span>
</footer>

</body>
</html>
