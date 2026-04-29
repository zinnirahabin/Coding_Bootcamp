<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Astro v5.13.2" />
    <title>Sign Up Coding Bootcamp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="assets/css/sign_in.css" rel="stylesheet" />
    <style>
      .signup_btn {
        background-color: #c1121f;
        color: white;
        border: none;
        border-radius: 8px;
        width: 530px;
        height: 40px;
        cursor: pointer;
        margin: 10px auto 0 auto;
      }
      .signup_btn:hover { background-color: #79141b; }
    </style>
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signup w-100 m-auto">
      <form id="signupForm" action="signup_process.php" method="POST">
        <img class="mb-4 d-block mx-auto" src="assets/img/uniten_logo.png" alt="UNITEN Logo" width="175" height="124" />
        <h1 class="h3 mb-3 fw-normal text-center">Sign Up</h1>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required />
          <label for="full_name">Full Name</label>
        </div>

        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
          <label for="email">Email</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required />
          <label for="phone">Phone Number</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
          <label for="username">Username</label>
        </div>

        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
          <label for="password">Password</label>
        </div>

        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required />
          <label for="confirm_password">Confirm Password</label>
        </div>

        <div class="mb-3">
          <label for="user_type" class="form-label">User Type</label>
          <select class="form-select" name="user_type" id="user_type" required>
            <option value="student" selected>Student</option>
            <option value="instructor">Instructor</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <button class="signup_btn" type="submit">Sign Up</button>

        <p class="text-center mt-3">
          Already have an account? <a href="login.php">Login here</a>
        </p>
      </form>
    </main>
  </body>
</html>
