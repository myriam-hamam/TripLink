<?php
include("connection.php");

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password === $confirm) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Account created successfully!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('⚠️ This email is already registered!');</script>";
        }
    } else {
        echo "<script>alert('❌ Passwords do not match!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | TripLink</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background: radial-gradient(circle at 20% 30%, #001f3f, #003366, #001a33);
      display: flex; justify-content: center; align-items: center;
      height: 100vh; margin: 0; color: #fff;
      background-size: 200% 200%;
      animation: bgShift 15s ease-in-out infinite;
    }
    @keyframes bgShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .signup-container {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.2);
      backdrop-filter: blur(15px);
      padding: 40px;
      border-radius: 20px;
      width: 350px;
      box-shadow: 0 0 30px rgba(0,255,255,0.3);
      text-align: center;
      animation: fadeIn 1.5s ease-in-out;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }
    h2 { color: #00e0ff; text-shadow: 0 0 25px #00e0ff; }
    input {
      width: 100%; padding: 12px; margin: 10px 0;
      border: none; border-radius: 10px;
      background: rgba(255,255,255,0.15);
      color: #fff; font-size: 14px; outline: none;
      transition: 0.3s;
    }
    input:focus { box-shadow: 0 0 15px #00ffff; }
    button {
      width: 100%; padding: 12px; margin-top: 10px;
      background: linear-gradient(90deg, #00ffff, #007bff);
      border: none; border-radius: 10px;
      color: #000; font-weight: 600; cursor: pointer;
      box-shadow: 0 0 25px rgba(0,255,255,0.4);
      transition: 0.3s;
    }
    button:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 0 35px rgba(0,255,255,0.7);
    }
    a {
      display: block; margin-top: 15px; color: #00e0ff;
      text-decoration: none; transition: 0.3s;
    }
    a:hover { color: #fff; }
  </style>
</head>
<body>
  <form class="signup-container" method="POST">
    <h2>✨ Create an Account ✨</h2>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit" name="signup">Sign Up</button>
    <a href="login.php">Already have an account? Login</a>
  </form>
</body>
</html>
