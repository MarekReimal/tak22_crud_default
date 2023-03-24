<div class="container">
    <div class="row">
        <!-- First col empty LEFT -->
        <div class="col-sm-2"></div>
        
        <div class="col-sm-8">
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-2">Home page - Browse table data</h3>                    
                    <?php
                    include 'pagination.php'; // lehtede küljendamine
                    //$sql = 'SELECT * FROM simple ORDER BY added DESC'; // päring mis tehakse DB
                    $sql = 'SELECT * FROM simple ORDER BY added DESC LIMIT ' . $start . ', ' . MAXPERPAGE; // päring mis tehakse DB väljund on piiratud nelja kirjega, vastavalt valitud küljendus numbrile
                    $res = $kl->dbGetArray($sql); // $kl on klass vt mysqli fail, dbGetArray on meetod, andme baasist saadud tulemus võetakse muutujasse $res
                    if($res !== false) {
                        //$kl->show($res); // kuvab DB sisu mustalt
                        
                        // tabeli loomine, väljad on siin
                        //[id] => 21
                        //[name] => Shaun the Sheep
                        //[birth] => 2007-03-05
                        //[salary] => 9999
                        //[height] => 0.60
                        //[added] => 2023-03-14 12:52:37
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($res as $key=>$val) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($start + $key+1); ?></td>
                                        <td><?php echo $val['name']; ?></td>
                                        <td><?php echo $kl->dbDateToEstDate($val['birth']); ?></td>
                                        <td><?php echo $val['salary']; ?></td>
                                        <td><?php echo $val['height']; ?></td>
                                        <td><?php echo $kl->dbDateToEstDateClock($val['added']); ?></td>
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
            </div>
        </div>
        
        <!-- Last col empty RIGHT -->
        <div class="col-sm-2"></div>
    </div>
</div>