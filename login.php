<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // check if user logged in
    if (isset($_SESSION['admin_is_in'])) {
        header('Location: categories.php');
    }
    require_once 'database/mysql.php';
    $db = new DB();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // store data
        $email = $_POST['email'];
        $pass  = $_POST['password'];

        // check if empty
        if (! empty($email) || ! empty($pass)) {
            // check in database
            if ($db->isAdmin($email, $pass)) {
                // add new session
                $_SESSION['admin_is_in'] = true;
                header('Location: categories.php');
            } $error = 'البريد الإلكتروني او كلمة السر غير صحيحين';
        } else {
            $error = 'يجب كتابة البريد الإلكتروني وكلمة السر';
        }
    }
    $page_title = 'تسجيل الدخول';
    require_once 'layout/header.php';
    ?>
<div class="login">
    <form action="" method="post">
        <h5>تسجيل الدخول</h5>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label for="mail">البريد الإلكتروني</label>
            <input type="email" name="email" id="mail" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass">كلمة السر</label>
            <input type="password" name="password" id="pass" class="form-control">
        </div>
        <button type="submit" class="btn-custom">تسجيل الدخول</button>
    </form>
</div>
<?php
    require_once 'layout/footer.php';
