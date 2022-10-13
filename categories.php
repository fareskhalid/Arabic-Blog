<?php
    session_start();
    if (! isset($_SESSION['admin_is_in'])) {
        header('Location: login.php');
    }
    $page_title = 'لوحة التحكم';
    require_once 'layout/header.php';
    require_once 'database/mysql.php';
    $db = new DB();

    // Insert new Category
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_name = htmlspecialchars($_POST['category']);
        // check if the category not empty
        if (! empty($category_name) && strlen($category_name) <= 20) {
            // check if the category exists
            $select_query = $db->con->prepare('SELECT * FROM categories WHERE category_name = :name');
            $select_query->bindParam('name', $category_name);
            $count = $select_query->columnCount();
            if ($count < 1) {
                $insert_query = $db->con->prepare('INSERT INTO categories (category_name) VALUES (?)');
                $success = $insert_query->execute([$category_name]) ? 'تم إضافة التنصيف بنجاح' : '';
            } else {
                $error = 'هذا التصنيف موجود بالفعل';
            }
        } else {
            $error = 'خطأ في اسم التصنيف: يجب ان تكتب اسماً صحيحاً';
        }
    }

    // Delete Category
    if ($_GET['id'] && $_GET['action'] === 'delete') {
        if ($db->delete('categories', $_GET['id'])) {
            $success = 'تم حذف التصنيف';
        } else {
            $error = 'حدث خطأ أثناء حذف التصنيف';
        }
    }
    ?>
<!-- Start Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4>لوحة التحكم</h4>
                <ul>
                    <li>
                        <a href="">
                            <span><i class="fa-solid fa-tags"></i></span>
                            <span>التصنيفات</span>
                        </a>
                    </li>
                    <li class="" data-toggle="collapse" data-target="#menu">
                        <a href="#">
                            <span><i class="fa-solid fa-tags"></i></span>
                            <span>المقالات</span>
                        </a>
                    </li>
                    <ul class="collapse" id="menu">
                        <li>
                            <a href="new-post.php">
                                <span><i class=""></i></span>
                                <span>مقال جديد</span>
                            </a>
                        </li>
                        <li>
                            <a href="posts.php">
                                <span></span>
                                <span>كل المقالات</span>
                            </a>
                        </li>
                    </ul>
                    <li>
                        <a href="index.php" target="_blank">
                            <span><i class="fa-solid fa-tags"></i></span>
                            <span>عرض الموقع</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <span><i class="fa-solid fa-tags"></i></span>
                            <span>تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10" id="main-area">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>
                <div class="add-category">
                    <form method="post">
                        <div class="form-group">
                            <label for="category">تصنيف جديد</label>
                            <input type="text" name="category" class="form-control" id="category">
                        </div>
                        <button class="form-control btn-custom" name="add">إضافة</button>
                    </form>
                </div>
                <!-- Display Categories -->
                <div class="categories-display mt-5">
                    <table class="table table-bordered">
                        <tr>
                            <th>رقم الفئة</th>
                            <th>اسم الفئة</th>
                            <th>تاريخ الإضافة</th>
                            <th>الحذف</th>
                        </tr>
                        <?php
                            $categories = $db->get('categories',orderBy: 'category_date', type: 'DESC', limit: 5);
                            $counter = 1;
                            foreach ($categories as $category):?>
                                <tr>
                                    <td><?= $counter++ ?></td>
                                    <td><?= $category['category_name'] ?></td>
                                    <td><?= $category['category_date'] ?></td>
                                    <td>
                                        <a href="categories.php?id=<?= $category['id'] ?>&action=delete" class="btn btn-custom w-250">حذف التصنيف</a>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php
    require_once 'layout/footer.php';