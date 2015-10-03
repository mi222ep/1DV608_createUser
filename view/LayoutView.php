<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace view;

class LayoutView {
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, NavigationView $view, RegistrationView $rv) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Example</title>
  </head>
  <body>
    <h1>Assignment 4</h1>
    <?php
      if ($isLoggedIn) {
        echo "<h2>Logged in</h2>";
      } else {
        if($view->isNewUserSet()){
          $link = $view->getReturnLink();
        }
        else{
          $link = $view->makeLink("Register a new user");
        }
      echo $link;
       echo "<h2>Not logged in</h2>";
    }
  ?>
    <div class="container" >
      <?php
      if($view->isNewUserSet()){
        echo $rv->response();
      }
      else{
        echo $v->response();
      }

        $dtv->show();
      ?>
    </div>

    <div>
      <em>This site uses cookies to improve user experience. By continuing to browse the site you are agreeing to our use of cookies.</em>
    </div>
   </body>
</html>
<?php
  }
  public function renderRegistration(){

  }
  public function renderLogin(){

  }
}
