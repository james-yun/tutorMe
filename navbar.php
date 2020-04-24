<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="homepage.php">TutorMe</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="request.php">Request a Tutor! <span class="sr-only">(current)</span></a>
      </li>

      <?php if (isset($_SESSION['student_id'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
            <?php echo '@'.$_SESSION['student_id'] ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="#">My Appointments</a>
            <a class="dropdown-item" href="#">My Requests</a>
            <a class="dropdown-item" href="logout.php">Log out</a>
          </div>
        </li>
      <?php else: ?>
        <li class="nav-item active">
          <a class="nav-link" href="login.php">Log in</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="signup.php">Sign up</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>