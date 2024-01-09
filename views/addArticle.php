<div class="container-fluid h-100">
    <div class="post-box d-flex justify-content-center" style="height: 100vh">
       <div>
           <div class="container">

              <form method="POST">
                  <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Wiki Title " aria-label="Username" aria-describedby="basic-addon1">
                  </div>
                  <div class="mb-3">
                      <label for="basic-url" class="form-label">Wiki Image</label>
                      <input class="form-control" type="file" id="formFile">
                  </div>

                  <div class="input-group mb-3 select-box">
                      <label for="basic-url" class="form-label">Wiki tags</label>

                      <div class="select-option">
                          <input type="text" placeholder="Select" id="soValue" readonly>
                      </div>
                      <div class="content">
                          <div class="search">
                              <input type="text" id="optionSearch" placeholder="Search Your Tag">
                          </div>
                          <ul class="options">
                              <li>Web Development</li>
                              <li>Web Design</li>
                              <li>Marketing</li>
                              <li>SEO</li>
                              <li>JavaScript</li>
                              <li>HTML5</li>
                          </ul>
                      </div>
                  </div>

                  <div class="input-group mb-3 select-box">
                      <div class="select-btn">
                          <span class="btn-text">Select Category</span>
                      </div>
                      <ul class="list-items">
                          <li class="item">
                            <span class="checkbox">
                                <i class="bi bi-check check-icon"></i>
                            </span>
                              <span class="item-text">HTML & CSS</span>
                          </li>
                          <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                              <span class="item-text">Bootstrap</span>
                          </li>
                          <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                              <span class="item-text">JavaScript</span>
                          </li>
                          <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                              <span class="item-text">Node.Js</span>
                          </li>
                          <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                              <span class="item-text">React JS</span>
                          </li>
                          <li class="item">
                            <span class="checkbox">
                                <i class="fa-solid fa-check check-icon"></i>
                            </span>
                              <span class="item-text">Mango DB</span>
                          </li>
                      </ul>
                  </div>
                  <div class="mb-3">
                      <textarea>
                      </textarea>
                  </div>
                  <button class="btn btn-primary " style="font-family: Nunito, sans-serif; box-shadow: 0px 5px 30px rgba(65, 84, 241, 0.4)">
                      // Submit To Review
                  </button>
              </form>

           </div>
       </div>
    </div>
</div>