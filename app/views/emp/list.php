<?php include '../app/views/layout/header.php'; ?>
<main>
    <h1>Employee List</h1>
    <section>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Employee Salary</th>
                <th>Employee Department</th>
                <th>  </th>
                
            </tr>
            <?php foreach ($data['result'] as $item) : ?>
            <tr>
                <td><?php echo $item['empID']; ?></td>
                <td><?php echo $item['empCode']; ?></td>
                <td><?php echo $item['empName']; ?></td>
                <td><?php echo $item['empSalary']; ?></td>
                <td><?php echo $item['deptName']; ?></td>
                <td> <a href="/emp/delete/<?php echo $item['empID']; ?>"><button>Delete</button></a> </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a href="/emp/index">Add</a>
    </section>
</main>
<?php include '../app/views/layout/footer.php'; ?>