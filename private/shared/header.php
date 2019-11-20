
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>KCL Chess Club</title>

    <style>
    
        .topContainer{
            width:100%;
        }

        .centeredTitle{
            font-size:50px; 
            font-weight:bold; 
            color:white; 
            position: absolute; 
            left: 50%; top: 20%; 
            transform: translate(-50%, -50%); 
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }

        #chessImage{
            filter: brightness(60%);
        }

        #kclImage{
            position:absolute; 
            left: 0; 
            top: 0; 
            width:150px;
        }

        .nav-link{
            font-weight:bold;
        }

    </style>


  <header>
    <!-- Top Header -->
    <div class="topContainer">
        <img class="image" id="chessImage" src="../Images/chessboard.jpeg" alt="ChessBoard">
        <div class="centeredTitle">KCL Chess Board</div>
        <img class="image" id="kclImage" src="../Images/img_kcl.png">
    </div>

    <!-- NavBar -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-light">
        <!-- NavBar name -->
        <a class="nav-link">Welcome To KCL Chess Club</a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- NavBar expanded options -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home (Current) -->
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- News and Events -->
                <li class="nav-item">
                    <a class="nav-link" href="#">News and Events</a>
                </li>
                <!-- Members Login -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Member Login</a>
                </li>
                <!-- Contact us -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</header>
</head>