<div class="container-fluid h-100">
    <div class="post-box d-flex justify-content-center" style="height: 100vh">
        <div>
            <div class="container">

                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="category" placeholder="category" id="balise">
                    <input type="hidden" name="tags" placeholder="tags" id="tags">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?= $wikiContent['Title']?>" placeholder="Wiki Title " name="title" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Wiki Image</label>
                        <input class="form-control" name="image" type="file" id="formFile">
                    </div>

                    <div class="input-group mb-3 select-box">
                        <label for="basic-url" class="form-label">Wiki Category</label>

                        <div class="select-option">
                            <input type="text" placeholder="Select" id="soValue" readonly>
                        </div>
                        <div class="content">
                            <div class="search">
                                <input type="text" id="optionSearch" placeholder="Search Your Tag">
                            </div>
                            <ul class="options">
                                <?php foreach ($data as $dt): ?>
                                    <li class='chihaja' data-category-id="<?php echo $dt['CategoryID']; ?>"><?php echo $dt['CategoryName']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="input-group mb-3 select-box">
                        <div class="select-btn">
                            <span class="btn-text">Select Tags</span>
                        </div>
                        <ul class="list-items">
                            <?php foreach ($tags as $tag): ?>
                                <li class="item " >
                            <span class="checkbox">
                                <i class="bi bi-check check-icon"></i>
                            </span>
                                    <span class="item-text checked"><?= $tag['TagName']?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="mb-3">
                      <textarea name="content" >
                          <?= $wikiContent['Content']?>;
                      </textarea>
                    </div>
                    <button class="btn btn-primary " style="font-family: Nunito, sans-serif; box-shadow: 0px 5px 30px rgba(65, 84, 241, 0.4)">
                        // Submit
                    </button>
                </form>


            </div>
        </div>
    </div>
</div>