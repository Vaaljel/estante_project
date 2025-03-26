
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Entrar | ESTante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            height: 100vh;
            background-color: black;
            color: white;
            width: 350px;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
        }

        .cat-left, .cat-right {
            position: absolute;
            width: 100px;
            opacity: 0.7;
        }

        .cat-left {
            left: -40px;
            bottom: -40px;
        }

        .cat-right {
            right: -40px;
            top: -40px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
        }

        .btn {
            background-color: white, ;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #e0e0e0;
        }

        .no-account {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            margin-top: 10px;
        }

        .recover-password {
            color: white;
            text-decoration: none;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>
<?php
$pagina = 'login';
include 'nav.php';
?> 
    <div class="container">

        
        <svg class="cat-left" viewBox="0 0 100 100">
            <path d="M20,50 Q50,20 80,50 Q50,80 20,50" fill="white"/>
            <circle cx="35" cy="50" r="5" fill="black"/>
            <circle cx="65" cy="50" r="5" fill="black"/>
        </svg>
        <svg class="cat-right" viewBox="0 0 100 100">
            <path d="M20,50 Q50,20 80,50 Q50,80 20,50" fill="white"/>
            <circle cx="35" cy="50" r="5" fill="black"/>
            <circle cx="65" cy="50" r="5" fill="black"/>
        </svg>

        <div class="logo">ESTante</div>
<form action="login.php" method="GET">

        <div class="input-group">
            <label>Utilizador</label>
            <input type="text" name="utilizador" placeholder="Manuel Brito">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="******">
        </div>

        <button class="btn" type="submit">Entrar</button>
        <button class="btn no-account">Não tenho Conta</button>

        <a href="#" class="recover-password">Recuperar Password?</a>
    </form> 
</div>
</body>
</html>