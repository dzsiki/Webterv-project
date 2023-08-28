<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Főoldal</title>
    <link rel="icon" href="img/icon.jpg"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fooldal.css">
</head>
<body>
<?php include_once "common/header.php";
include_once "common/menu.php"; 
menu("index"); ?>
    <aside id="rroll">
        <video style="width: 100%;" controls autoplay muted loop>
            <source src="img/rickroll.mp4 " type="video/mp4"/>
            Never gonna give you up!
          </video>
    </aside>
    <main>
        <section id="memebemutato">
            <table id="fotabla">
                <caption class="felkover focim"> A Mémek Csodálatos Világa</caption>
                <tr>
                <th class="fokep" id="magyarmemek"><img src="img/magyarmemek.png" alt="magyarmemek" title="A Magyar mémek"/></th>
                <th class="fokep" id="egyetememek"><img src="img/egyetemmemek.png" alt="egyetemmemek" title="Az Egyetem mémek"/></th>
                </tr>
                <tr>
                    <td class="felkover" headers="magyarmemek">A magyar nyelv szépségeit kiaknázó, a sok sok vicces magyar embert, politikát kifigurázó, a magyar szokásokat bemutató rendkívül humoros formátum.</td>
                    <td class="felkover" headers="egyetememek">Ha ki vagy a vizsgáktól vagy csak szimplán az egyetemtől ilyen mémek mindig feldophatják a napod.</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="fokep felkover" headers="magyarmemek"><img src="img/orosz.png" alt="Orosz" title="De szép a magyar nyelv"/></td>
                    <td class="fokep felkover" headers="egyetememek"><img src="img/vizsga.png" alt="Vizsga" title="Mindannyian imádjuk a vizsgaidőszakot &lt;3"/></td>
                </tr>
                <tr>
                    <td class="felkover" headers="magyarmemek">A magyar egy igazán érdekes nyelv. Amilyen szép, néha olyan agyafurt is. Lehetne egyszerű és logikus is, de hát akkor nem lenne az az igazi magyar nyelv amit oly sokan szeretünk és beszélünk.</td>
                    <td class="felkover" headers="egyetememek">Mindenki legszebb és legjobban szeretett időszaka a vizsgaidőszak, ilyenkor végre mindenki kiadhatja a magában lapuló okosságot és elkápráztathatja a tanárokat a minimum pont kettes tudásával.</td>
                </tr>
            </table>
        </section>
        <section id="velemeny">
            <h1 class="focim">Ezt mondták rólunk</h1>
            <div class="comment-container">
                <div class="comment">
                    <h2>Vélemény #1</h2>
                    <blockquote>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    </blockquote>
                </div>
                <div class="comment">
                    <h2>Vélemény #2</h2>
                    <blockquote>
                        Reprehenderit voluptas libero ratione ex provident eius, totam amet placeat!
                    </blockquote>
                </div>
                <div class="comment">
                    <h2>Vélemény #3</h2>
                    <blockquote>
                        Illo esse libero ratione laudantium similique vel tempore repellendus dignissimos expedita maiores.
                    </blockquote>
                </div>
                <div class="comment">
                    <h2>Vélemény #4</h2>
                    <blockquote>
                        Eltöredezettség<wbr/>mentesítőt<wbr/>leníttet<wbr/>hetetlenség<wbr/>telenítőtlen<wbr/>kedhetnétek.
                    </blockquote>
                </div>
            </div>
        </section>
        <section>
            <h1 class="focim">Ingyenes internet teszt:</h1>
            <iframe src="https://www.vanenet.hu/" class="kozepre" height="60"></iframe>
        </section>
        <section>
            <h1 class="focim">Hide the pain Harold ASCII</h1>
            <iframe src="common/harold.html" class="kozepre" height="615" width="500"></iframe>
        </section>
    </main>
    <?php include_once "common/footer.php"; ?>
</body>
</html>
