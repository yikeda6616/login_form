<?php

$title = 'Login';

include 'header.php';

?>

  <div class="container">
    <form action="action/login.php" method="post">
      <div class="field">
        <div class="control has-icons-left">
          <input class="input" type="text" name="email" placeholder="Email Address">
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
        </div>
      </div>
      <div class="field">
        <div class="control has-icons-left">
          <input class="input" type="text" name="password" placeholder="Password">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button class="button is-link" type="submit">Login</button>
        </div>
      </div>
    </form>
  </div>

<?php

include 'footer.php';
