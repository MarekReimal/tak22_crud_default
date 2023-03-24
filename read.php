<?php
$res = false;
if (isset($_POST['submit'])) { // kontroll kas otsingu nuppu on submititud
    $phrase = $_POST['phrase'];
    $sql = 'SELECT * FROM simple WHERE name LIKE "%' . $phrase . '%"'; // % tähendas et võib olla suvaline täht
    $res = $kl->dbGetArray($sql);
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
            <h3 class="text-center">Read - Search for a user by name</h3>
            <form action="read" method="POST" class="mb-2"> <!-- on vorm vormilt loetakse info ja loetakse vastav info DB-st-->
                <div class="row mb-2">
                    <label for="phrase" class="col-sm-2 form-label mt-2">Search phrase</label>
                    <div class="col">
                        <input type="text" name="phrase" value="<?php if (isset($_POST['phrase'])) {
                                                                    echo $_POST['phrase'];
                                                                } ?>" id="phrase" onclick="clearField();" class="form-control" required placeholder="Name">
                    </div>
                    <div class="col-2">
                        <input type="submit" name="submit" value="Search result" class="btn btn-primary form-control">
                    </div>
                </div>
            </form>

            <?php
            if ($res !== false) { // tabel joonistatakse ainult siis kui vormilt on andmed võtta
            ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Salary</th>
                            <th>Height</th>
                            <th>Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $val) {
                        ?>
                            <tr>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $val['birth']; ?></td>
                                <td><?php echo $val['salary']; ?></td>
                                <td><?php echo $val['height']; ?></td>
                                <td><?php echo $val['added']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            <?php
            }
            ?>


        </div>

        <div class="col-sm-2"></div>
    </div>
</div>
<script>
    // JavaScript function
    function clearField() {
        document.getElementById('phrase').value = ""; // funktsioon mis kustutab lahtri tühjaks, see kutsutakse välja üleval pool
    }
</script>