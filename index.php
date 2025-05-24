<?php
// login.php
session_start();

// Load XML users file
$xml = simplexml_load_file("students.xml") or die("Failed to load XML.");

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $validUser = false;

    foreach ($xml->student as $student) {
        if ((string)$student->name === $username && (string)$student->password === $password) {
            $validUser = true;
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            break;
        }
    }

    if ($validUser) {
        header("Location: students.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        :root {
            --green-deep: #537D5D;
            --green-soft: #73946B;
            --green-light: #9EBC8A;
            --cream: #D2D0A0;
            --white: #ffffff;
            --gray-light: #f8f8f8;
            --text-dark: #2f2f2f;
            --text-medium: #555;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, var(--cream), var(--white));
            color: var(--text-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--green-light);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            color: var(--green-deep);
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: var(--green-soft);
            box-shadow: 0 0 0 3px #9ebc8a55;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: var(--green-deep);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: var(--green-soft);
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Full Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>