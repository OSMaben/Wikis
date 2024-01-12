

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
                        <a href="/profile" class="nav-link link-body-emphasis ">
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
                        <a href="/addTag" class="nav-link link-body-emphasis active text-white">
                            <i class="bi bi-tags"></i>
                            Tags
                        </a>
                    </li>
                    <li>
                        <a href="/categories" class="nav-link link-body-emphasis">
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
            <?php if($_SESSION['role'] == 'Admin') {?>
            <h2 class="my-5"> Add Tag</h2>
                <form method="POST">
                    <label for="exampleDataList" class="form-label">Insert Your Tag</label>
                    <input class="form-control editTagName" list="datalistOptions" name="tag" id="exampleDataList" placeholder="Add Tag">
                    <input type="hidden" class="form-control editTag" list="datalistOptions" name="edit" id="exampleDataListEdit" placeholder=" Tag">
                    <button class="btn btn-primary my-3" type="submit" name="submit" value="add">Add Tag</button>
                    <button class="btn btn-success my-3" type="submit" name="submit" value="edit">edit Tag</button>

                </form>
            <?php }?>
            <?php if($_SESSION['role'] == 'Reader'){?>
                <form method="POST">
                    <label for="exampleDataList" class="form-label">Search Tag</label>
                    <input class="form-control" list="datalistOptions" name="tag" id="exampleDataList" placeholder="Type to search">
                </form>
            <?php }?>

            <h2 class="sub-header my-5">Tags</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tag Name</th>
                        <?php if($_SESSION['role'] == 'Admin') {?>
                            <th>Action</th>
                        <?php }?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tags as $tag): ?>

                        <tr style="cursor: pointer">
                            <td><?= $tag['TagID']?></td>
                            <td class="tagName"><?= $tag['TagName']?></td>
                            <?php if($_SESSION['role'] == 'Admin') {?>
                                <td><a href="/deleteTag?id=<?=$tag['TagID']?>" class="btn btn-danger" ><i class="bi bi-trash3"></i></a></td>
                            <?php }?>

                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

<script>

    let editTag = document.querySelector('.editTag');
    let editTagName = document.querySelector('.editTagName');
    let tableTr = document.querySelectorAll('tbody tr');

    tableTr.forEach((tr) =>{
        tr.addEventListener('click', function ()
        {
            console.log(tr);
            editTag.value = tr.querySelector('td').textContent;
            editTagName.value = tr.querySelector('.tagName').textContent;
        })
    })


</script>