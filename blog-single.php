<?php
require('includes/head.php');
require('includes/navbar.php');
$blog_id = $_GET['id'];

$connection = mysqli_connect('localhost', 'root', '', 'company_portfolio');
$sql = "SELECT blogs.id , blogs.title , blogs.body , blogs.image , blogs.created_at , admins.id as admin_id , admins.name FROM `blogs` JOIN admins ON blogs.admin_id = admins.id WHERE  blogs.id = $blog_id";
$query = mysqli_query($connection, $sql);
$blog = mysqli_fetch_assoc($query);

// for comments
$commentsSql = "SELECT comments.comment , comments.created_at , users.name FROM `comments` JOIN users ON comments.user_id = users.id WHERE comments.blog_id = $blog_id ORDER BY comments.created_at ASC";
$commentsQuery = mysqli_query($connection, $commentsSql);
$comments = mysqli_fetch_all($commentsQuery, MYSQLI_ASSOC);
echo "<pre>";
print_r($comments);
echo "</pre>";
?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Blog</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Blog</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single" data-aos="fade-up">

              <div class="entry-img">
              <img src="admin/uploads/blogs/<?= $blog['image'] ?>" alt="" class="img-fluid">

              </div>
              <h2 class="entry-title">
                <a href="blog-single.html">
                  <?= $blog['title'] ?>
                </a>
              </h2>

              <div class="entry-meta">
              <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">
                      <?= $blog['name'] ?>
                  </a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">
                      <?php
                      $date = new DateTime($blog['created_at']);
                  echo date_format($date, 'M d, Y')
                ?>
                  </time></a></li>
                  <!-- <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li> -->
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?= $blog['body'] ?>
                </p>
              </div>
            </article><!-- End blog entry -->

            <div class="blog-comments" data-aos="fade-up">

              <h4 class="comments-count">8 Comments</h4>

              <?php
                foreach($comments as $comment):
              ?>
              <div id="comment-1" class="comment clearfix">
                <!-- <img src="assets/img/comments-1.jpg" class="comment-img  float-left" alt=""> -->
                <h5><a href="">
                    <?= $comment['name'] ?>
                </a> <a href="#" class="reply"><i class="icofont-reply"></i></a></h5>
                <time datetime="2020-01-01">
                  <?php
                      $date = new DateTime($comment['created_at']);
                  echo date_format($date, 'M d, Y')
                ?>
                </time>
                <p>
                  <?= $comment['comment'] ?>
                </p>
              </div><!-- End comment #1 -->
              <?php
                endforeach;
              ?>

              <?php
              
                if(isset($_SESSION['user_id'])):
              ?>
              <div class="reply-form">
                <h4>Leave a Reply</h4>
                <form action="handlers/submitComment.php" method="post">
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                    <input type="hidden" name="blog_id" value=" <?= $blog['id'] ?>">
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
              </div>
              <?php
                else:
              ?>
              <div class="p-5 d-flec justify-content-center align-items-center">
                  <a href="login.php" class="btn btn-success p-2">
                    Please Login...
                  </a>
              </div>
              <?php
                endif;
              ?>


            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar" data-aos="fade-left">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="icofont-search"></i></button>
                </form>

              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="#">General <span>(25)</span></a></li>
                  <li><a href="#">Lifestyle <span>(12)</span></a></li>
                  <li><a href="#">Travel <span>(5)</span></a></li>
                  <li><a href="#">Design <span>(22)</span></a></li>
                  <li><a href="#">Creative <span>(8)</span></a></li>
                  <li><a href="#">Educaion <span>(14)</span></a></li>
                </ul>

              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-1.jpg" alt="">
                  <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-2.jpg" alt="">
                  <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-3.jpg" alt="">
                  <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-4.jpg" alt="">
                  <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/blog-recent-posts-5.jpg" alt="">
                  <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>

              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
require('includes/footer.php');
?>
  