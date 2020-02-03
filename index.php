<?php
    //dico
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\r\n", $string);

$nbMot = count($dico);

echo "Il y a $nbMot mots dans le dictionnaire !<br>";
$nbMot15Caract = 0;
$nbMotW = 0;
$motQ = 0;
for($i = 0; $i < $nbMot; $i++){
    if(strlen($dico[$i]) == 15){
        $nbMot15Caract++;
    }
    if(strpbrk($dico[$i], "w")){
        $nbMotW++;
    }

    if(substr($dico[$i], -1, 1) == "q"){
        $motQ++;
    }
}

echo "Il y a $nbMot15Caract mots ayant 15 caractères dans le dictionnaire !<br>";
echo "Il y a $nbMotW mots ayant le caractère w dans le dictionnaire !<br>";
echo "Il y a " . $motQ . " mots qui finissent par la lettre « Q »" . "<br>";

//film
$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];

foreach ($top as $key => $value){
    if($key < 10){
        echo $key+1 ." : ".$value['im:name']['label']."<br>";
    }
}

//classement film de gravity
foreach ($top as $key => $value){
    $film = $value['im:name']['label'];
    if($film == "Gravity"){
        echo "<br>".$film." est classé ".$key."è !";
    }
}
//réalisateur The LEGO Movie
foreach ($top as $key => $value){
    $film = $value['im:name']['label'];
    $artist = $value['im:artist']['label'];
    if($film == "The LEGO Movie"){
        echo "<br><br> Le réalisateur de ".$film." est ".$artist." !<br>";
    }
}
//film avant  2000
$vieuxFilm = 0;
foreach ($top as $key => $value){
    $dateFilm = $value['im:releaseDate']['label'];
    if($dateFilm < 2000){
        $vieuxFilm++;
    }
}
echo "Il y a $vieuxFilm de film paru avant 2000 ! <br>";

// film le plus vieux et le plus récent
foreach ($top as $key => $value){
    $filmYoungOld[$value ['im:name'] ['label']] = substr($value ['im:releaseDate']['label'], 0, 10) . "<br>";
}
foreach ($filmYoungOld as $key => $value){
    if ($value == max($filmYoungOld)){
        echo  "Nom du film le plus récent : " . $key . ", date de Sortie : " . max($filmYoungOld) . "<br>";
    }
    if ($value == min($filmYoungOld)){
        echo "Nom du film le plus vieux : " . $key . ", date de Sortie : " . min($filmYoungOld)."<br>" ;
    }
}

//catégorie la plus représentée
foreach ($top as $key => $value){
    $array[] = $value['category']['attributes']['label'];

    $arrayCount = array_count_values($array);
}
foreach ($arrayCount as $key => $value){
    if($value == max($arrayCount)){
        echo $key."<br>";
    }
}
//réalisateur le plus présent
foreach ($top as $key => $value){
    $director[] = $value['im:artist']['label'];
    $arrayCount = array_count_values($director);
}

foreach ($arrayCount as $key => $value){
    if ($value == max($arrayCount)){
        echo $key."<br>";
    }
}
// top 10 itunes achat
$num = 0;
foreach ($top as $key => $value){
    if($key < 10){
        $num += $value['im:price']['attributes']['amount'];
    }
}
echo "Le prix du top 10 acheté est : $num <br>";

// top 10 itunes louer
$numLocate = 0;
foreach ($top as $key => $value){
    if($key < 10){
        $numLocate += $value['im:rentalPrice']['attributes']['amount'];
    }
}
echo "Le prix du top 10 itunes louer est : $numLocate<br>";


//mois avec le plus de sortie de film
foreach ($top as $key => $value){
    $array = explode (" ", $value['im:releaseDate']['attributes']['label']);//explode = "explose" une string de plusieurs mots à chaques espaces " " pour en faire un array.
    $mois[] = $array[0];
    $arrayCount = array_count_values($mois);
}
foreach ($arrayCount as $key => $value){
    if ($value == max($arrayCount)){
        echo "Le mois avec le plus de sortie est : " . $key . " : " . $value . " sorties" . "<br>";
    }
}

//top 10 best film budget limité
foreach ($top as $key => $value){
    $film = $value['im:name']['label'];
    $prix = $value['im:price']['attributes']['amount'];
    if($prix < 8 && $film < 10){
        echo "Les meilleurs films à prix limité sont : $film à $prix <br>";
    }
}