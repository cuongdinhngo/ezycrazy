<?php view('admin.header') ?>
<body id="">
    <?php view('admin.nav') ?>
    <div id="content">
        <div id="content-header">
            <div class="card-body">
                <a href="<?= url('user/create')?>" class="card-link">Create New User</a>
                <a href="<?= url('export-users')?>" class="card-link">Export CSV</a>
                <a href="<?= url('import-users')?>" class="card-link">Import Users</a>
            </div>
        </div>
        <div class="list">
            <table class="table table-hover">
                <thead>
                    <tr class="table-success">
                      <th scope="col">ID</th>
                      <th scope="col">Fullname</th>
                      <th scope="col"></th>
                      <th scope="col">Email</th>
                      <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = "";
                        foreach ($users as $user) {
                            $result .= '<tr>
                                <th scope="row">'.$user["id"].'</th>
                                <td>'.$user["fullname"].'</td>
                                <td><img src="'.$user["thumb"].'"/></td>
                                <td>'.$user["email"].'</td>
                                <td>
                                    <form action="'.url('user/update/'.$user["id"]).'" method="get">
                                        <button type="submit" class="btn btn-outline-success">Update</button>
                                    </form>
                                    <form action="'.url('user/action/'.$user["id"]).'" method="get">
                                        <button type="submit" class="btn btn-outline-success">Delete</button>
                                    </form>
                                </td>
                            </tr>';
                        }
                        echo $result;
                    ?>
                </tbody>
            </table>            
        </div>
    </div>
<?php view('admin.footer') ?>
