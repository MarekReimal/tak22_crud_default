<!--  -->
<?php
// sõltuvalt mitmendal lehel oleme näidatakse õigeid kirjeid, seda tuvastab aadressirealt saadud numbriga
// vaja teada kui palju on kirjeid, lugeda kirjed sql
$sql = 'SELECT COUNT(*) AS total FROM simple'; // tulemus on üks number
$res = $kl->dbGetArray($sql); // käivitab päringu andmebaasis, see meetod on ainult SELECT jaoks
$totalRows = $res[0]['total']; // üleval määratud AS alias on hea, et saab veeru nime ja saab andme kätte, väljund N: 15
//aadressi realt teeb selgeks lehe numbri, URL'i järgi
    if($totalRows > 0) {
        if(isset($req[1])) { //reg on tükeldamise tulemusel saadud lehe number vt setting fail
            $page = $req[1];  // võtab lehe numbri muutujasse

        } else {
            $page = 1;
        }

    } else {
        $page = 1;
    }
    $pageCount = ceil($totalRows / MAXPERPAGE); // ceil on ümardamine
if (empty($page) || $page < 1 || $page > $pageCount) {
    $page = 1; // kui kasutaja sopredab siis pannakse esimesele lehele tagasi
}
// muutujad mis lähevad sql lausesse ja määrab mitmendast kirjest mitmendani näidata

$nextStart = $page * MAXPERPAGE; // MAXPERPAGE on konstant vt settings fail,  define('MAXPERPAGE', 4);
$start = $nextStart - MAXPERPAGE; // $start sisaldab mitmendast kirjest 
echo $page; // abi rida ekraanil näitamiseks
//echo $start;



?>
<nav aria-label="Page navigation">
    <ul class="pagination pagination-color justify-content-center">
        <li class="page-item">
            <a class="page-link <?php echo ($page == 1) ? 'disabled' : null; ?>" href="homepage/<?php echo (($page - 1) == 0) ? '1' : ($page -1 ); ?>" aria-label="Previous"> <!-- vasak noole nupp, 
                                                ?php echo ($page == 1) ? 'disabled' : null; ?> teeb noole nupu halliks kui oled 1. lehe peal-->
                <span aria-hidden="true">&laquo;</span> <!--&laquo on nooled nupu peal -->
            </a>
        </li>
        <?php 
        for($x = 0; $x < $pageCount; $x++) { // loendab mitu lehte on, mitu nuppu on vaja teha vastavalt sellele kui paju on andmeid ja mitu rida lehel kuvatakse
            ?>
            <li class="page-item">
                <a class="page-link <?php echo (($x + 1) == $page) ? 'active' : null; ?>" href="homepage/<?php echo ($x+1); ?>"><?php echo ($x+1); ?></a> <!--et number oleks klikitav listkse href osa, homepage on faili nimi -->
            </li> <!--s ($x + 1) == $page kui x+1 == page st et kui oled sellel lehel siis värvib nupu -->
            <!--echo (($x + 1) == $page) ? 'active' : null peale küsimärki on ifi tõene osa 'active' ja false osa on null, koolon : on else tähis-->
            <?php
        }
        ?>
        <li class="page-item">
            <a class="page-link <?php echo ($page >= $pageCount) ? 'disabled' : null; ?>" href="homepage/<?php echo (($page + 1) > $pageCount) ? $pageCount : $page +1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
