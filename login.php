<?php
session_start();
include 'connection.php'; // make sure this file connects to your DB

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Check if the user exists
  $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
      $_SESSION['user_id'] = $id;
      $_SESSION['username'] = $username;
      header("Location: menu.php");
      exit;
    } else {
      $error = "❌ Incorrect password.";
    }
  } else {
    $error = "❌ No account found with that email.";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | TripLink</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: radial-gradient(circle at 20% 30%, #001f3f, #003366, #001a33);
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: #fff;
      animation: bgShift 15s ease-in-out infinite;
      background-size: 200% 200%;
    }

    @keyframes bgShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      background: rgba(255, 255, 255, 0.08);
      padding: 50px;
      border-radius: 20px;
      box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
      backdrop-filter: blur(15px);
      width: 350px;
      text-align: center;
      animation: fadeIn 1.2s ease-in-out;
    }

    h1 {
      font-size: 2.2em;
      font-weight: 800;
      color: #00e0ff;
      margin-bottom: 25px;
      text-shadow: 0 0 25px #00e0ff;
    }

    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 10px;
      border: none;
      outline: none;
      font-size: 1em;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    input::placeholder {
      color: #cce6ff;
    }

    button {
      background: linear-gradient(135deg, #00ffff, #007bff);
      border: none;
      padding: 12px 25px;
      border-radius: 12px;
      color: #000;
      font-weight: 700;
      font-size: 1em;
      margin-top: 15px;
      cursor: pointer;
      transition: 0.3s;
      width: 100%;
    }

    button:hover {
      background: linear-gradient(135deg, #007bff, #00ffff);
      box-shadow: 0 0 25px rgba(0,255,255,0.7);
      transform: translateY(-3px);
    }

    p {
      margin-top: 15px;
      color: #cce6ff;
    }

    a {
      color: #00ffff;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-shadow: 0 0 15px #00ffff;
    }

    .error {
      color: #ff6666;
      margin-bottom: 10px;
      font-weight: 600;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🔐 Login to TripLink</h1>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" placeholder="Enter your password" required>
      <button type="submit">Login</button>
    </form>

    <p>Don’t have an account? <a href="signup.php">Sign up</a></p>
    <p><a href="menu.php">⬅️ Back to Home</a></p>
  </div>
</body>
</html>
