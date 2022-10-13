<?php
    session_start();
    if (! isset($_SESSION['admin_is_in'])) {
        header('Location: login.php');
    }
    error_reporting(E_ALL);
    ini_set('error_reporting', 1);
    $page_title = 'لوحة التحكم';
    require_once 'layout/header.php';
    require_once 'database/mysql.php';
    $db = new DB();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // get data form post request and sanitize them
        $post_title = htmlspecialchars($_POST['post_title']);
        $post_category = $_POST['post_category'];
        $post_content = htmlspecialchars($_POST['post_content']);
        $post_author = 'فارس خالد';

        // Post Image
        $image_name = rand(0, 1000) . '-' . $_FILES['post_image']['name'];
        $image_temp = $_FILES['post_image']['tmp_name'];
        $image_extension = strtolower(pathinfo($_FILES['post_image']['name'],PATHINFO_EXTENSION));
        $image_path = 'posts_images' . DIRECTORY_SEPARATOR . $image_name;
        $extensions = ['jpg', 'jpeg', 'gif', 'png'];

        // check if title and content are not empty

        if (! empty($post_title) && ! empty($post_content)) {
            // check the length of the post title
            if (strlen($post_title) <= 200) {
                // check image extension
                if (in_array($image_extension, $extensions)) {
                    move_uploaded_file($image_temp, $image_path);
                    // store post data in database and success message
                    $success = $db->insert('posts',
                        ['post_title', 'post_category', 'post_content', 'post_author', 'post_image'],
                        [$post_title, $post_category, $post_content, $post_author, $image_path]
                    ) ? 'تمت إضافة المقال بنجاح' : null;
                } else {
                    $error = 'امتداد الصورة غير مسموح به';
                }
            } else  {
                $error = 'عنوان المنشور كبير للغاية';
            }
        } else {
            $error = 'عنوان المقال ومحتواه لا يمكن أن يكونوا فارغين';
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
                    <div class="bg-main h2 mb-3 w-250 text-center p-3">مقال جديد</div>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">عنوان المقال</label>
                                <input type="text" name="post_title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="category">التصنيف</label>
                                <select name="post_category" id="category" class="form-control">
                                    <?php
                                    $categories = $db->get('categories');
                                    foreach ($categories as $category): ?>
                                        <option value="<?= $category['category_name'] ?>"><?= $category['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">صورة المقال</label>
                                <input type="file" name="post_image" id="category" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="content">نص المقال</label>
                                <textarea name="post_content" id="content" cols="30" rows="10"
                                          class="form-control" required></textarea>
                            </div>
                            <button class="btn-custom">نشر المقال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
<?php
require_once 'layout/footer.php';