<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1>List of User</h1>
        <?php echo form_open('users/all_delete'); ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                    <td><input type="checkbox" name="user_ids[]" value="<?php echo $user["id"]; ?>"></th>
                    <th scope="row"><?php echo $user["id"]; ?></th>
                    <td><?php echo $user["first_name"]; ?></td>
                    <td><?php echo $user["last_name"]; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm"><a href="<?php echo site_url("users/view/$user[id]"); ?>">View</a></button>
                        <button class="btn btn-outline-primary btn-sm"><a href="<?php echo site_url("users/update/$user[id]"); ?>">Edit</a></button>
                        <button class="btn btn-sm"><a onclick="return confirm('Are you sure to delete this user?')" href="<?php echo site_url("users/delete/$user[id]"); ?>">Delete</a></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
          	</tbody>
        </table>
        <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure to delete all selected user?')">Delete</button>
        <?php echo form_close(); ?>
    </div>
</main>
