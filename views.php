<?php include("connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TripLink | View Data</title>

  <style>
    /* === GLOBAL STYLING === */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #001f3f, #0077b6, #00b4d8);
      background-size: 400% 400%;
      animation: bgShift 15s ease infinite;
      margin: 0;
      padding: 0;
      color: #fff;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Background animation */
    @keyframes bgShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* === NAVBAR === */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 60px;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 800;
      color: #00e0ff;
      text-shadow: 0 0 20px #00e0ff;
      cursor: pointer;
      transition: 0.3s;
    }

    .logo:hover {
      transform: scale(1.1);
    }

    .nav-links a {
      color: #fff;
      text-decoration: none;
      margin-left: 25px;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 8px;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      transition: 0.3s;
    }

    .nav-links a:hover {
      background: linear-gradient(90deg, #00ffff, #007bff);
      color: #000;
      box-shadow: 0 0 20px rgba(0,255,255,0.6);
    }

    /* === PAGE TITLE === */
    h2 {
      text-align: center;
      font-size: 3rem;
      color: #00e0ff;
      margin-top: 60px;
      margin-bottom: 20px;
      text-shadow: 0 0 25px #00e0ff;
    }

    /* === TABLE CONTAINER === */
    .table-container {
      width: 90%;
      max-width: 1100px;
      margin: 40px auto;
      background: rgba(255,255,255,0.12);
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
      overflow: hidden;
      backdrop-filter: blur(12px);
      transition: 0.4s;
    }

    .table-container:hover {
      transform: scale(1.02);
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

    /* === TABLE STYLING === */
    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
    }

    th, td {
      padding: 14px;
      text-align: center;
    }

    th {
      background: rgba(0,0,0,0.6);
      color: #00e0ff;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    tr:nth-child(even) {
      background: rgba(255,255,255,0.08);
    }

    tr:hover td {
      background: rgba(0, 224, 255, 0.2);
    }

    /* === FOOTER === */
    footer {
      text-align: center;
      color: #ccc;
      margin-top: 60px;
      padding-bottom: 30px;
      font-size: 0.9rem;
    }

  </style>
</head>

<body>

  <!-- ==== NAVIGATION BAR ==== -->
  <div class="navbar">
    <div class="logo">TripLink</div>
    <div class="nav-links">
      <a href="menu.php">Home</a>
      <a href="aboutus.php">About</a>
      <a href="contact_us.php">Contact</a>
    </div>
  </div>

  <!-- ==== FLIGHTS SECTION ==== -->
  <h2>✈️ Flights</h2>
  <div class="table-container">
    <table>
      <tr>
        <th>ID</th>
        <th>Flight Number</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Departure Date</th>
        <th>Return Date</th>
        <th>Airline</th>
        <th>Price</th>
      </tr>

      <?php
      // Get flight data
      $result = mysqli_query($conn, "SELECT * FROM flights");
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>" . htmlspecialchars($row['id']) . "</td>
            <td>" . htmlspecialchars($row['flight_number']) . "</td>
            <td>" . htmlspecialchars($row['departure_city']) . "</td>
            <td>" . htmlspecialchars($row['arrival_city']) . "</td>
            <td>" . htmlspecialchars($row['departure_date']) . "</td>
            <td>" . htmlspecialchars($row['return_date']) . "</td>
            <td>" . htmlspecialchars($row['airline']) . "</td>
            <td>$" . htmlspecialchars($row['price']) . "</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No flight data available.</td></tr>";
      }
      ?>
    </table>
  </div>

  <!-- ==== HOTELS SECTION ==== -->
  <h2>🏨 Hotels</h2>
  <div class="table-container">
    <table>
      <tr>
        <th>ID</th>
        <th>City</th>
        <th>Hotel Name</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Price/Night</th>
        <th>Rating</th>
      </tr>

      <?php
      // Get hotel data
      $result = mysqli_query($conn, "SELECT * FROM hotels");
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>" . htmlspecialchars($row['id']) . "</td>
            <td>" . htmlspecialchars($row['city']) . "</td>
            <td>" . htmlspecialchars($row['hotel_name']) . "</td>
            <td>" . htmlspecialchars($row['check_in']) . "</td>
            <td>" . htmlspecialchars($row['check_out']) . "</td>
            <td>$" . htmlspecialchars($row['price_per_night']) . "</td>
            <td>" . htmlspecialchars($row['rating']) . "</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No hotel data available.</td></tr>";
      }
      ?>
    </table>
  </div>

  <!-- ==== FOOTER ==== -->
  <footer>
    © 2025 TripLink. All rights reserved.
  </footer>

</body>
</html>
