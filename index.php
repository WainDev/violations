<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/main.css" />
    <title>Нарушениям нет</title>
  </head>
  <body>


    <?php
        session_start();
        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            $buttonText = "Выйти";
            $buttonLink = "/logout.php"; 
        } else {
            $buttonText = "Войти";
            $buttonLink = "/login.php";
        }
        ?><?php
        session_start(); 
        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
            $buttonText = "Выйти";
            $buttonLink = "/logout.php"; 
        } else {
            $buttonText = "Войти";
            $buttonLink = "/login.php";
        }
   ?>


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверяем, авторизован ли пользователь
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        // Получаем данные из формы
        $input1 = $_POST['input1'] ?? '';
        $input2 = $_POST['input2'] ?? '';
        $description = $_POST['description'] ?? '';

        // Получаем ID авторизованного пользователя
        $userId = $_SESSION['user_id']; // Предполагается, что у вас есть переменная $_SESSION['user_id'], содержащая ID пользователя

        // Подготавливаем SQL запрос для вставки данных в базу данных
        $sql = "INSERT INTO Application (Number, Number_Region, Description, IdUser) VALUES (:input1, :input2, :description, :user_id)";
        $stmt = $db->prepare($sql);

        // Биндим значения параметров
        $stmt->bindParam(':input1', $input1);
        $stmt->bindParam(':input2', $input2);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $userId);

        // Выполняем запрос
        if ($stmt->execute()) {
            // Данные успешно добавлены в базу данных
            echo "Данные успешно отправлены!";
        } else {
            // Ошибка при выполнении запроса
            echo "Произошла ошибка при отправке данных.";
        }
    } else {
        // Пользователь не авторизован, отправка данных не разрешена
        echo "Для отправки данных необходимо авторизоваться.";
    }
}
?>


    <div class="container_header">
      <header class="header">
        
        <div class="logo">
          <img src="/assets/image/logo.svg" alt="logo" />
          <h1 class="logo__title">Нарушениям.Нет!</h1>
        </div>
        <nav class="nav">
        <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
            <a href="#" class="link">Мои заявления</a>
        <?php endif; ?>
        <a href="<?php echo $buttonLink ?>" class="link"><?php echo $buttonText ?></a>
        </nav>
      </header>
    </div>
    <div class="container">
      <main class="main">
        <div class="left_block">
          <h6 class="number_title">Гос номер</h6>
          <div class="inputs">
            <input 
            type="text"
            placeholder="a000aa"
            id="input1"
            class="input" />
            <input 
            type="text" 
            class="input"
            id="input2"
            placeholder="777" />
          </div>
          <textarea
            class="input_bottom"
            id="description" 
            placeholder="Введите описание нарушения :"
          ></textarea>
          <button  id="submitBtn" class="button">Отправить</button>
        </div>

        <div class="modal" id="authModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Авторизация/Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Пожалуйста, авторизуйтесь или зарегистрируйтесь, чтобы продолжить.</p>
                <!-- Вставьте здесь форму авторизации или регистрации -->
              </div>
              <div class="modal-footer">
                <button type="button" id="button_modal" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <a href="/login.php" class="btn btn-primary">Авторизоваться</a>
              </div>
            </div>
          </div>
        </div>

        
        <div class="right_block">
          <h1 class="title">Оформление заявления</h1>
          <div class="text_block">
            <h4 class="block_title">
              Введите Гос.Номер и опишите нарушение, которое вы заметили
            </h4>
            <p class="block_print">
              По вашим данным мы проверим, совершил ли водитель правонарушение
            </p>
          </div>
          <div class="block_info">
            <div class="block">
              <img src="/assets/image/gerb.png" alt="" />
              <p class="block_titles">
                Федеральное Казначейство России (ГИС ГМП)
              </p>
            </div>
            <div class="block">
              <img src="/assets/image/gerb2.png" alt="" />
              <p class="block_titles">Сайт ГИБДД</p>
            </div>
            <div class="block">
              <img src="/assets/image/gerb3.png" alt="" />
              <p class="block_titles">База ФССП</p>
            </div>
          </div>
        </div>
      </main>
    </div>

    <div class="container_footer">
      <footer class="footer">
        <div class="logo">
          <img src="/assets/image/logo_white.svg" alt="logo" />
          <h1 class="footer_title">Нарушениям.Нет!</h1>
        </div>
        <h6 class="footer_print">© 2017-2023</h6>
      </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                var authenticated = <?php echo isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true ? 'true' : 'false'; ?>;
                
                if (!authenticated) {
                    $('#authModal').modal('show');
                } else {
                    console.log('Форма отправлена!');
                }

                if (!isAuthenticated) {
                    alert('Для отправки формы необходимо авторизоваться.');
                    return;
                }
            });

            $('#button_modal').click(function() {
                // Закрываем модальное окно
                $('#authModal').modal('hide');
            });
        });
    </script>

  </body>
</html>
