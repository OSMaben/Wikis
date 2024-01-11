

<div class="container-fluid">
    <div class="row" style="margin-bottom: 33rem;">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">User Name</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">

                    <li>
                        <a href="#" class="nav-link link-body-emphasis ">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){?>

                        <li>
                            <a href="/AdminWikis" class="nav-link link-body-emphasis">
                                <i class="bi bi-book"></i>
                                Wikis
                            </a>
                        </li>
                    <?php }?>
                    <li>
                        <a href="#" class="nav-link link-body-emphasis active text-white">
                            <i class="bi bi-tags"></i>
                            Tags
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link link-body-emphasis">
                            <i class="bi bi-bookmarks"></i>
                            Categories
                        </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>



        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>
            <h1 class="page-header text-white">Dashboard</h1>
            <h2 class="my-5"> Add Tag</h2>

            <form method="POST">
                <label for="exampleDataList" class="form-label">Insert Your Tag</label>
                <input class="form-control" list="datalistOptions" name="tag" id="exampleDataList" placeholder="Add Tag">
                <button class="btn btn-primary my-3" type="submit" name="submit">Add Tag</button>
            </form>

            <h2 class="sub-header">Users</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tag Name</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tags as $tag): ?>

                        <tr>
                            <td><?= $tag['TagID']?></td>
                            <td><?= $tag['TagName']?></td>
                            <td><a href="/deleteTag?id=<?=$tag['TagID']?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

