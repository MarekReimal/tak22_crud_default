<?php
if (isset($_POST['submit'])) { // kontroll kas vajutati submit lehel update_by_id
    $kl->show($_POST);
    // vaja kätte saada andmed mis vormilt võeti
    $name = $_POST['name']; // vormilt info kätte saamine, post muutujaga välja nimega, name on sama mis all pool vormil
    $birth = $kl->getVar('birth'); // siin on kasutusel klassi kl meetod getvar, mis peaks võtma vormilt andme nagu eelmine käsk
    $salary = $kl->getVar('salary');
    $height = $kl->getVar('height');
    $id = $kl->getVar('sid');
    // kui nimi on tühi siis paneb vaikimisi nimi
    if (strlen(trim($name)) == 0) { // trim lõikab tühiku, et ei saaks sisestada tühikut nimeks
        $name = 'UNKNOWN';
    }
    // kontrollib salary
    if (empty($salary)) {
        $salary = "NULL"; // peavad olem "", sisestab väärtuse null
    }
    if (empty($height)) {
        $height = "NULL";
    } // sulgudes veeru nimed mida soovime täita, id paneb DB ise, nimed peavad kokku minema veeru nimedega DB-s
    $sql = 'UPDATE simple SET
                name = ' . $kl->dbFix($name) . ',
                birth = ' . $kl->dbFix($birth) . ',
                salary = ' . ($salary) . ',
                height = ' . ($height) . ',
                added = added
                WHERE id = ' . $id;

    if ($kl->dbQuery($sql)) {
        $success = true; // kui andmete edastus õnnestus
        $_POST = array(); // tühjendab POST
    } else {
        $success = false;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-2"></div>

        <div class="col-sm-8">
            <h3 class="text-center">Update - Click the edit icon to edit the person</h3>
            <?php

            if (isset($success) and $success) { // kui muutuja on olemas ja success on true siis onkorras, annab teate kas muudeti
            ?>
                <p class="text-success">Kirje on muudetud tabelis</p>
            <?php
            } elseif (isset($success) and !$success) {
            ?>
                <p class="text-success">Midagi läks valesti kirje muutmisel</p>
            <?php
            }

            // tabeli loomine
            $sql = 'SELECT * FROM simple ORDER BY added DESC';
            $res = $kl->dbGetArray($sql);
            if ($res != false) {
                // joonista tabel
            ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Birth</th>
                            <th>Salary</th>
                            <th>Height</th>
                            <th>Added</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $val) {
                        ?>
                            <tr>
                                <td><?php echo ($key + 1); ?></td>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $kl->dbDateToEstDate($val['birth']); ?></td>
                                <td><?php echo $val['salary']; ?></td>
                                <td><?php echo $val['height']; ?></td>
                                <td><?php echo $kl->dbDateToEstDateClock($val['added']); ?></td>
                                <!-- lisab viimases veerus kustutamise ikooni-->
                                <td class="text-center"> <!--Action ikoonid tulevad index failist rida java script tylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-fre-->
                                    <a href="update_by_id/<?php echo $val['id']; ?>"><i class="fa-solid fa-pen-to-square text-warning"></i></a> <!--href osas link ei tohi tühikut olla-->
                                </td>
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