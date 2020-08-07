<?php
include_once 'Datenträger.php';
include_once 'CDClass.php';
include_once 'DVDClass.php';
include_once 'MusikrichtungClass.php';
include_once 'ArtistClass.php';
include_once 'AlbumClass.php';

$myAlbum = new AlbumClass($_POST['coverP'], $_POST['richtungP'], $_POST['AnameP'], $_POST['albumNameP']);
$get = $myAlbum->ausleihen();
echo 'das Cover des Albums ähnelt einer/em '.$get[1].' !<br/>';
echo 'Und das bei der Musikrichtung '.$get[3].', das geht doch nicht!<br/>';
echo 'was hat sich  '.$get[2].' wohl dabei gedacht<br/>';
echo 'Selbst der Name ist schon kritisch. '.$get[0].' !<br/>';
?>

<br/>
<a href="aufrufMukke.php">Bring me another!!!</a>

<?php





function rndInfo(){
    $stuff = [
        'Hans',
        'Peter',
        'Rock',
        'Juni',
        'Papier',
        'Genetik',
        'Ziege',
        'Baum',
        'Stein',
        'Haare',
        'Eimer',
        'Löffel',
        'Taste',
        'Gedöns',
        'Kirche',
        'Maus'
        ];
    $m=rand(0,100000);

    echo count($stuff);
    return ($stuff[rand(0, count($stuff))]);
}

for ($i=0; $i<= 200; $i++)
{
    $randomAlbum[$i] = new AlbumClass(rndInfo(), rndInfo(), rndInfo(), rndInfo());
}

echo implode($randomAlbum[7]-> ausleihen());