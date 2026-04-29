<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Astro v5.13.2" />
    <title>Sign In Coding Bootcamp</title>
    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/sign-in/"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/color-modes.js"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="assets/css/sign_in.css" rel="stylesheet" />
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: #0000001a;
        border: solid rgba(0, 0, 0, 0.15);
        border-width: 1px 0;
        box-shadow:
          inset 0 0.5em 1.5em #0000001a,
          inset 0 0.125em 0.5em #00000026;
      }
      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }
      .bi {
        vertical-align: -0.125em;
        fill: currentColor;
      }
      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }
      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }


      .signin_btn {
        background-color: #c1121f;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 300px;
        padding: 0.5rem;
      }

      .signin_btn:hover {
        background-color: #79141b;
      }

    </style>
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">

      <form action="login_process.php" method="POST">
        <img
          class="mb-4 d-block mx-auto"
          src="assets/img/uniten_logo.png"
          alt="UNITEN Logo"
          width="175"
          height="124"
        />

        <div class="form-floating">
            <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Username"
            required
            />
            <label for="username">Username</label>
        </div>

        <div class="form-floating">
            <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
            required
            />
            <label for="password">Password</label>
        </div>

        <button class="signin_btn" type="submit">
            Sign in
        </button>
        <p class="text-center test-gray-600 mt 3">
          Don't have an account?
          <a href="signup.php">
            Get started now!
          </a>
        </p>
    </form>
    </main>
    
  </body>
</html>


