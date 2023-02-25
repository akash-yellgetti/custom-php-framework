<?php include '../app/views/layout/header.php'; ?>
<main>
    <h1>Department List</h1>
    <section>
        <table>
            <tr>
                <th>Dept ID</th>
                <th>Dept Name</th>
                
            </tr>
            <?php foreach ($data['result'] as $item) : ?>
            <tr>
                <td><?php echo $item['deptID']; ?></td>
                <td><?php echo $item['deptName']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
</section>
</main>
<?php include '../app/views/layout/footer.php'; ?>