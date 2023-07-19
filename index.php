<?php
include 'partials/header.php';
?>

<section class="featured">
    <div class="container featured__container">
        <div class="post__thumbnail">
            <img src="" alt="">
        </div>
        <div class="post__info">
            <a href="<?= ROOT_URL ?>category-posts.php" class="category__button">Wild Life</a>
            <h2 class="post__title">
                <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
            </h2>
            <p class="post__body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex fuga dolores repellat dolore doloribus vel maxime autem, alias sunt voluptatibus.
            </p>
            <div class="post__author">
                <div class="post__author-avatar">
                    <img src="./images/profile1.jpg" alt="">
                </div>
                <div class="post__author-info">
                    <h5>By: John Doe</h5>
                    <small>June 10,2022 - 12:03</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End of featured -->

<section class="posts">
    <div class="container posts__container">
        <article class="post">
            <div class="post__thumbnail">
                <img src="" alt="">
            </div>
            <div class="post__info">
                <a href="<?= ROOT_URL ?>category-posts.php" class="category__button">Wild life</a>
                <h3 class="post__title">
                    <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odio architecto esse eaque dolorum reprehenderit!
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/profile1.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: John Doe</h5>
                        <small>June 10,2022 - 12:03</small>
                    </div>
                </div>
            </div>
        </article>

        <article class="post">
            <div class="post__thumbnail">
                <img src="" alt="">
            </div>
            <div class="post__info">
                <a href="<?= ROOT_URL ?>category-posts.php" class="category__button">Wild Life</a>
                <h3 class="post__title">
                    <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odio architecto esse eaque dolorum reprehenderit!
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/profile1.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: John Doe</h5>
                        <small>June 10,2022 - 12:03</small>
                    </div>
                </div>
            </div>
        </article>

        <article class="post">
            <div class="post__thumbnail">
                <img src="" alt="">
            </div>
            <div class="post__info">
                <a href="category-posts.php" class="category__button">Wild Life</a>
                <h3 class="post__title">
                    <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a>
                </h3>
                <p class="post__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odio architecto esse eaque dolorum reprehenderit!
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/profile1.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: John Doe</h5>
                        <small>June 10,2022 - 12:03</small>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!-- End of posts-->

<section class="category__buttons">
    <div class="container category__buttons-container">
        <a href="" class="category__button">Art</a>
        <a href="" class="category__button">Wild Life</a>
        <a href="" class="category__button">Travel</a>
        <a href="" class="category__button">Science & Technology</a>
        <a href="" class="category__button">Food</a>
        <a href="" class="category__button">Music</a>
    </div>
</section>

<!-- End of category buttons -->

<?php
include 'partials/footer.php';
?>