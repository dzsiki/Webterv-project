<?php
$viccek=["Mi van ha elütnek egy matematikust? Már nem számít.","Hogy lesz a póknak telefonja? Bemegy a sarokba és telefonja...","Hogy hívják a szerelmes kerekeket ? Kerékpár...","Hova ül a tehén a buszon? Legelőre.","Nyuszika ment az erdőben és egyszercsak találkozott a bálnával: -Neked nem a tengerben kéne lenned? -De.","Hogy hívjan a Star Warsban a putri buszmegállót? Legalább Padavan","Miről ismered fel a repülő nyulat? Sas van a hátán.","Hogy lehet megismerni egy kezdő tűzoltót? Elég könnyen.","Tessék egy favicc: reccs.","Boldog Karácsonyt kíván a MÁV! Elnézést a késésért.","Két autó áll egymás mellett? Melyik az irodalmár? A bal lada.","Szópoén! Értik! Nyelvi humor. Rendkívül szellemes.","Miről beszélgetnek a kígyók? A szisztémáról.","Hol tartotta a pénzét Katona József? Bánkban.","Harmónika. Ha nem rmónika.","Mit mond a szegény király? -Apród! Van apród?","Mi a külömbség és a sasmadár? Két lába van, de főleg a jobb."];
$whitespace="                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ";
$string="";
$elso="";
$masodik="";
$random = rand ( 0 , count($viccek)-1 );
$string = $viccek[$random] . $whitespace;
$elso = $random;
while($elso === $random ){
$random = rand ( 0 , count($viccek)-1 );
}
$string = $string . $viccek[$random] . $whitespace;
$masodik = $random;
while($elso === $random || $masodik === $random) {
$random = rand ( 0 , count($viccek)-1 );
}
$string = $string . $viccek[$random];
echo "<header class=\"headeranim\">$string</header>";
?>