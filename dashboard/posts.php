<?php
    session_start();
    if (! isset($_SESSION['admin_is_in'])) {
        header('Location: login.php');
    }
    $page_title = 'كل المقالات';
    require_once  '../database/mysql.php';
    $db = new DB();
    require_once '../layout/header.php';

    // Delete Category
    if ($_GET['id'] && $_GET['action'] === 'delete') {
        if ($db->delete('posts', $_GET['id'])) {
            $success = 'تم حذف المقال';
        } else {
            $error = 'حدث خطأ أثناء حذف المقال';
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
                            <a href="categories.php">
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
                            <a href="../index.php" target="_blank">
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
                    <div class="bg-main h2 mb-3 w-250 text-center p-3">كل المقالات</div>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <!-- Display All Posts -->
                    <table class="table table-bordered">
                        <tr>
                            <th>رقم المقال</th>
                            <th>عنوان المقال</th>
                            <th>كاتب المقال</th>
                            <th>صورة المقال</th>
                            <th>تاريخ المقال</th>
                            <th>الحذف</th>
                        </tr>
                        <?php
                            $posts = $db->get('posts', orderBy: 'post_date', type: 'DESC', limit: 10);
                            $counter = 1;
                            foreach ($posts as $post):
                        ?>
                            <tr>
                                <td><?= $counter++ ?></td>
                                <td><?= $post['post_title'] ?></td>
                                <td><?= $post['post_author'] ?></td>
                                <td>
                                    <img src="../<?= $post['post_image'] ?>" alt="صورة المقال" width="70" height="50">
                                </td>
                                <td><?= $post['post_date'] ?></td>
                                <td>
                                    <a href="posts.php?id=<?= $post['id'] ?>&action=delete" class="btn btn-custom w-250">حذف المقال</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
<?php
    require_once '../layout/footer.php';
