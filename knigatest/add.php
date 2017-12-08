<?php
 include "link.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Гостевая книга</title>
</head>
  <body>
    <h3>Добавить коментарий</h3> 
<form class="form" method="POST" action="index.php">
<?php
          if(isset($_POST['do_post']))
          {
           $errors = array();
           if($_POST['nickname'] == '')
           {
            $errors[] = 'Введите имя';
           }
           if($_POST['email'] == '')
           {
            $errors[] = 'Введите email';
           }
           if($_POST['text'] == '')
           {
            $errors[] = 'Введите текст комментария';
           }
           if (empty($errors))
           {
               
            //добавить коментарий

           mysqli_query($connection, "INSERT INTO `comments` (`Browser`,`nickname`,`email`,`text`,`pubdate`,`ip`, `homepage`)
            VALUES ('".$_SERVER["HTTP_USER_AGENT"]."', '".$_POST['nickname']."', '".$_POST['email']."', '".$_POST['text']."', NOW(), '".$_SERVER["REMOTE_ADDR"]."', '".$_POST['homepage']."')");
              echo '<span style="color: green; font-wight: bold; margin-bottom: 10px;display: block;">Коментарий успешно добавлен</span>';
           }  else
           {
            //вывести ошибку
            echo '<span style="color: red; font-wight: bold; margin-bottom: 10px;display: block;">'.$errors['0'].'</span>';
           }
          }
      ?>
      <input type="text" name="nickname" class="form__control" placeholder="User name" value="<?php echo $_POST['nickname']; ?>">
<br>
<br>   
      <input type="email" name="email" class="form__control" placeholder="Email" value="<?php echo $_POST['email']; ?>">
      <input type="text" name="homepage" placeholder="homepage">
<br>
<br>
      <textarea class="form__control" name="text" cols="40" rows="10" placeholder="Текст коментария..." ></textarea>
<br>
<br>  
      <input type="submit" name="do post" value="Добавить коментарий" class="form__control">
</form>
</body>
</html>