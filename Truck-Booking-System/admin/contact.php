<?php
session_start();
require('conection.php');
error_reporting(0);
$query = mysqli_query($conn, "select * from user_master");
$usercount = mysqli_num_rows($query);
$query = mysqli_query($conn, "select * from truck_detials");
$truckcount = mysqli_num_rows($query);
$query = mysqli_query($conn, "select * from truck_booking");
$bookingcount = mysqli_num_rows($query);
if (!isset($_SESSION['admin_email'])) {
  header("Location: login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td,
    #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #customers tr:hover {
      background-color: #ddd;
    }

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: black;
      color: white;
    }
  </style>

  <!-- Add jQuery and Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function openPopup(id, name, email, phoneno, subject, message) {
      // Set the values in the modal input fields
      document.getElementById('nameInput').value = name;
      document.getElementById('emailInput').value = email;
      document.getElementById('phonenoInput').value = phoneno;
      document.getElementById('subjectInput').value = subject;
      // document.getElementById('messageInput').value = message;

      // Show the modal
      $('#sendToModal').modal('show');
    }

    function sendEmail() {
      var email = document.getElementById('emailInput').value;
      var subject = document.getElementById('subjectInput').value;
      var message = document.getElementById('messageInput').value;

      // Open the Gmail compose window with pre-filled values
      var mailtoLink = 'mailto:' + email + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(message);
      window.location.href = mailtoLink;
    }
  </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">TBTS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img class="rounded-circle">
            <i class="bi bi-person"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['admin_email']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['admin_email']; ?></h6>
              <!-- <span>Web Designer</span> -->
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="user_profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="AdminLogout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Log Out</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li> -->

            <!-- </ul>End Profile Dropdown Items -->
            <!-- </li>End Profile Nav -->

            <!-- </ul> -->
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="home.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="Reports.php">
          <i class="bi bi-journal-text"></i>
          <span>Reports</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="Transporter.php">
              <i class="bi bi-circle"></i><span>Transporter</span>
            </a>
          </li>
        </ul>

        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="customer.php">
              <i class="bi bi-person"></i><span>customer</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="booking.php">
          <i class="bi bi-card-list"></i>
          <span>Booking</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="contact.php">
          <i class="bi bi-telephone"></i>
          <span>contact us</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="feedback.php">
          <i class="bi bi-envelope"></i>
          <span>feedback</span>
        </a>
      </li><!-- End Login Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <!-- ... (rest of your sidebar code) ... -->

  <main id="main" class="main">

    <!-- ... (rest of your main content) ... -->

    <div class="row">
      <div class="col-md-12 stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Contact Us Customer Details</p>
            <div class="table-responsive">
              <table id="customers">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Send To</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "connection.php";
                  $sql = "SELECT * FROM `contact`";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <tr>
                      <td><?php echo $row['contact_id']; ?></td>
                      <td><?php echo $row['contact_name']; ?></td>
                      <td><?php echo $row['contact_email']; ?></td>
                      <td><?php echo $row['contact_phoneno']; ?></td>
                      <td><?php echo $row['contact_subject']; ?></td>
                      <td><?php echo $row['contact_message']; ?></td>
                      <td>
                        <?php echo "<a href='javascript:void(0);' onclick='openPopup(\"$row[contact_id]\", \"$row[contact_name]\", \"$row[contact_email]\", \"$row[contact_phoneno]\", \"$row[contact_subject]\", \"$row[contact_message]\");' class='link-dark'><span class='material-symbols-outlined'>Send To</span></a>"; ?>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->

  <!-- Bootstrap Modal for Send To -->
  <div class="modal fade" id="sendToModal" tabindex="-1" role="dialog" aria-labelledby="sendToModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendToModalLabel">Send To</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="nameInput">Name:</label>
          <input type="text" id="nameInput" class="form-control" readonly>
          <label for="emailInput">Email:</label>
          <input type="text" id="emailInput" class="form-control" readonly>
          <label for="phonenoInput">Phone Number:</label>
          <input type="text" id="phonenoInput" class="form-control" readonly>
          <label for="subjectInput">Subject:</label>
          <input type="text" id="subjectInput" class="form-control" readonly>
          <label for="messageInput">Message:</label>
          <textarea id="messageInput" class="form-control" rows="4"></textarea> <!-- Use textarea for message -->

          <!-- Button to open Gmail compose window -->
          <button class="btn btn-primary" onclick="sendEmail()">Send Email</button>

          <!-- You can add more content or form elements here -->
        </div>
      </div>
    </div>
  </div>

  <!-- ... (rest of your HTML) ... -->

</body>

</html>