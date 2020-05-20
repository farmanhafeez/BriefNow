<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Page not found</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <style>
        body {
            background-color: rgba(0, 0, 255, 0.062);
        }

        .page-not-found {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .img-container {
            width: 50%;
        }

        @media screen and (max-width: 768px) {
            .img-container {
                width: 70%;
            }
        }

        @media screen and (max-width: 450px) {
            .img-container {
                width: 90%;
            }
        }

        .btn {
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
        }

        ::selection {
            color: blue;
            background-color: rgba(0, 0, 255, 0.062);
        }
    </style>
</head>

<body>

    <!---------- NAVBAR ---------->

    <div class="header" id="header">
        <nav class="navbar fixed-top navbar-light bg-transparent justify-content-center">
            <a class="navbar-brand" href="index.php">
                <img src="img/favicon-32x32.png" class="d-inline-block align-top">
                <img src="../img/favicon-32x32.png" class="d-inline-block align-top">
                <span class="align-top">BriefNow</span>
            </a>
        </nav>
    </div>

    <div class="container page-not-found">
        <div class="img-container">
            <img src="img/404.svg" class="img-fluid">
            <img src="../img/404.svg" class="img-fluid">
        </div>
        <h6 class="text-muted my-4 text-uppercase">We are sorry, but the page you requested was not found</h6>
        <div class="row w-100 justify-content-center">
            <a href="index.php"><button class="btn btn-primary mr-3">GO HOME</button></a>
            <a href="contact.php"><button class="btn btn-outline-primary">CONTACT US</button></a>
        </div>
    </div>

</body>

</html>