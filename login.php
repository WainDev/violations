<?php
session_start(); // Начинаем сессию

require_once 'config/database.php'; // Подключаем файл с классом для работы с базой данных

// Создаем экземпляр класса Database для соединения с базой данных
$database = new Database();
$db = $database->getConnection();

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем введенные пользователем данные
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Пытаемся аутентифицировать пользователя
    $stmt = $db->prepare("SELECT Email FROM User WHERE Email = :email AND Password = :password");

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Проверяем, есть ли пользователь с указанными учетными данными
    if ($stmt->rowCount() > 0) {
        // Если аутентификация прошла успешно, сохраняем информацию о пользователе в сессии
        $_SESSION['authenticated'] = true;
        // Опционально, можно сохранить другие данные о пользователе в сессии
        // Например: $_SESSION['user_email'] = $email;

        // Перенаправляем пользователя на защищенную страницу
        header('Location: index.php');
        exit();
    } else {
        // Если аутентификация не удалась, отображаем сообщение об ошибке
        $error = "Неверный email или пароль";
    }
}

// Если пользователь уже аутентифицирован, перенаправляем его на защищенную страницу
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
