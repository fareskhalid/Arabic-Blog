<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once 'database/mysql.php';
    $db = new DB();

    $page_title = 'مدونتي';
    require_once 'layout/header.php';
    require_once 'layout/navbar.php';
?>
<!-- Start Content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php
                    $posts = $db->get('posts', orderBy: 'post_date', type: 'DESC', limit: 5);
                    if ($posts):
                    foreach ($posts as $post):
                ?>
                    <div class="post">
                        <div class="post-image">
                            <a href="post.php?id=<?= $post['id'] ?>">
                                <img src="<?= $post['post_image'] ?>" alt="صورة المقال">
                            </a>
                        </div>
                        <div class="post-title">
                            <h4>
                                <a href="post.php?id=<?= $post['id'] ?>">
                                    <?= $post['post_title'] ?>
                                </a>
                            </h4>
                        </div>
                        <div class="post-details">
                            <p class="post-info">
                                <span><i class="fas fa-user"></i><?= $post['post_author'] ?></span>
                                <span><i class="fa-regular fa-calendar"></i><?= $post['post_date'] ?></span>
                                <span><i class="fa-solid fa-tags"></i><?= $post['post_category'] ?></span>
                            </p>
                            <p class="post-content">
                                <?php
                                    if (strlen($post['post_content']) > 300) {
                                        $post['post_content'] = substr($post['post_content'], 0, 300) . '...';
                                    }
                                    echo $post['post_content'];
                                ?>
                            </p>
                            <a href="post.php?id=<?= $post['id'] ?>">
                                <button class="btn btn-custom">اقرأ المزيد</button>
                            </a>
                        </div>
                    </div>
                    <?php endforeach;
                        else:?>
                        <div class="post">لا يوجد مقالات حالياً</div>
                        <?php endif;?>
            </div>
            <!-- Sidebar -->
            <div class="col-md-3">
                <!-- Start Categories -->
                <div class="categories">
                    <h4>التصنيفات</h4>
                    <ul>
                        <?php
                            $tags = $db->get('categories');
                            foreach ($tags as $tag):
                        ?>
                            <li>
                                <a href="category.php?category_name=<?= $tag['category_name'] ?>">
                                    <span><i class="fa-solid fa-tags"></i></span>
                                    <span><?= $tag['category_name'] ?></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
                <!-- End Categories -->

                <!-- Start Latest Posts -->
                <div class="latest-posts">
                    <h4>أحدث المنشورات</h4>
                    <ul>
                        <?php
                            $posts = $db->get('posts', orderBy: 'post_date', type: 'DESC', limit: 3);
                            foreach ($posts as $post):
                        ?>
                            <li>
                                <a href="post.php?id=<?= $post['id'] ?>">
                                    <span class="img-span">
                                        <img src="<?= $post['post_image'] ?>" alt="صورة المقال">
                                    </span>
                                    <span class="title-span"><?= $post['post_title'] ?></span>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                            <div class="clearfix"></div>
                            <?php endforeach; ?>
                    </ul>
                </div>
                <!-- End Latest Posts -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php
    require_once  'layout/copyright.php';
    require_once 'layout/footer.php';