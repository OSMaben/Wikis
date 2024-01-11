
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="/">Home</a></li>
          <li><a href="#">Blog</a></li>
          <li>Blog Single</li>
        </ol>
        <h2>Blog Single</h2>

      </div>
    </section>

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">
        <?php foreach ($singleWiki as $single): ?>

              <div class="entry-img">
                <img src="./assets/img/dataBase/<?= $single['image']?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <h2><?= $single['Title']?></h2>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <span class="text-dark"><?= $single['PublishedDate']?></span></li>
                </ul>
              </div>

              <div class="entry-content">
                    <?= $single['Content']?>

              </div>

              <div class="entry-footer">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li><a href="#">Business</a></li>
                </ul>

                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div>

            </article>

            <div class="blog-author d-flex align-items-center">
              <img src="assets/img/blog/blog-author.jpg" class="rounded-circle float-left" alt="">
              <div>
                <h4>Jane Smith</h4>
                <div class="social-links">
                  <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                </div>
                <p>
                  Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p>
              </div>
            </div>

        

          </div>

          <div class="col-lg-4">

            <div class="sidebar">

        <?php endforeach; ?>


              <h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                    <?php foreach ($singleWiki as $single): ?>
                        <li><a href="#"><?= $single['CategoryName']?></a></li>
                    <?php endforeach; ?>
                </ul>
              </div>
                <h3 class="sidebar-title">Tags</h3>

                <?php
                    if (isset($singleWiki[0]['Tags']) && !empty($singleWiki[0]['Tags'])) {
                        $tagsArray = explode(',', $singleWiki[0]['Tags']);

                        foreach ($tagsArray as $tag) {
                            $tag = trim($tag);
                            echo"  <div class='sidebar-item tags'>
                                <ul>
                                      <li><a href='#'> $tag </a></li>
                                </ul>
                              </div>";
                        }
                    }
                    ?>
            </div>

          </div>

        </div>

      </div>
    </section>
