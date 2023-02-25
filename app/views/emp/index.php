<?php include '../app/views/layout/header.php'; ?>
<main>
    <h1>Add Employee</h1>
    <form action="/emp/add" method="post" id="add_product_form">
        <label>Department:</label>
        <select name="deptID">
            <option>Select</option>
        <?php foreach ($data['result'] as $item ) : ?>
            <option value="<?php echo $item['deptID']; ?>">
                <?php echo $item['deptName']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        <label>Code:</label>
        <input type="text" name="empCode" />
        <br>

        <label>Name:</label>
        <input type="text" name="empName" />
        <br>

        <label>salary:</label>
        <input type="text" name="empSalary" />
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Save" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href=/emp/list>View Employee List</a>
    </p>

</main>
<?php include '../app/views/layout/footer.php'; ?>