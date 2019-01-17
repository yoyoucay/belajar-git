<H2>Ini adalah admin Page ! </H2>
<H3>Halo <?php echo $nickname?>!</H3>
<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Username Account</th>
            <th>Full Name User</th>
            <th>Email</th>
        </tr>
    <?php $nomor = 1; ?>
    <?php foreach ($account as $account_item) { ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $account_item['username']; ?></td>
            <td><?php echo $account_item['full_name']; ?></td>
            <td><?php echo $account_item['email']; ?></td>
        </tr>
    <?php } ?>

    </table>
</body>
<a href="http://localhost/project/mobileweb/logout">Logout !</a>