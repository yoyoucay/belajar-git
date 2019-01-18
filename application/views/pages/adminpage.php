<H2>Ini adalah admin Page ! </H2>
<H3>Halo <?php echo $nickname?>!</H3>
<body>
<?php echo form_open('auth/search_akun') ?>
		<input type="text" name="keyword" placeholder="search">
		<input type="submit" name="search_submit" value="Cari">
        <a href="<?php echo site_url('auth/administrator');?>"> RESET </a>
<?php echo form_close() ?>

    <table border="1">
        <tr>
            <th>No</th>
            <th>Username Account</th>
            <th>Full Name User</th>
            <th>Email</th>
            <th>Action </th>
        </tr>
    <?php $nomor = 1; ?>
    <?php foreach ($account as $account_item) { ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $account_item['username']; ?></td>
            <td><?php echo $account_item['full_name']; ?></td>
            <td><?php echo $account_item['email']; ?></td>
            <td><a href="<?php echo site_url('user/settings_admin/'.$account_item['id']);?>">Edit</a> | <a href="<?php echo site_url('user/delete_akun/'.$account_item['id']);?>">Delete</a></td>
        </tr>
    <?php } ?>

    </table>
</body>
<a href="http://localhost/project/mobileweb/logout">Logout !</a>