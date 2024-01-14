
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">We offer modern The Best Articles In the Web</h1>
                <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented Articles spreding out the Knowdedge</h2>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="text-center text-lg-start">
                        <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span>Get Started</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="../assets/img/hero-img.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    </section><!-- End Hero -->





    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" data-aos="fade-up">

            <header class="section-header d-block">

               <div class="blog">
                  <form method="POST">
                      <div class="input-group mb-3">
                          <input type="text" class="form-control" name="input" id="search" placeholder="Type To Search" aria-label="Example text with button addon"  aria-describedby="button-addon1">
                          <button type="submit" name="submit" ><i class="bi bi-search-heart btn btn-outline-secondary"></i></button>
                      </div>
                  </form>
                   <h2>Blog</h2>
                   <p>Recent posts form our Blog</p>
               </div>
                <div class="blog-add">
                    <?php
                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Reader')
                        {
                        echo "
                            <div class='profil'>
                                  <a href='/addArticle' class='btn btn-primary mx-4' style='font-family: Nunito, sans-serif; box-shadow: 0px 5px 30px rgba(65, 84, 241, 0.4)'>
                                    // Add Articles
                                  </a>
                            ";
                        }
                        else
                        {
                            echo " ";
                        }
                    ?>
                </div>
            </header>
            <div class="row">
                <?php foreach ($wikis as $wiki): ?>
                <div class="col-lg-4">
                    <div class="post-box">
                        <div class="post-img"><img src="./assets/img/dataBase/<?= $wiki['image']?>" class="img-fluid" alt=""></div>
                        <span class="post-date"><?= $wiki['PublishedDate']?></span>
                        <h3 class="post-title"><?= $wiki['Title']?></h3>
                        <a href="/blog-single?id=<?= $wiki['wikisID']?>" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php if (!empty($result)): ?>
                    <h3>Search Results:</h3>
                    <div class="search-results">
                        <?php foreach ($result as $searchResult): ?>
                            <div class="search-result">
                                <h2><?php echo $searchResult['Title']; ?></h2>
                                <!-- Display other information about the search result as needed -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section><!-- End Recent Blog Posts Section -->


    <!-- ======= Team Section ======= -->
</main>
