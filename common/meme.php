<?php

abstract class MemeType {
  const Egyetem = 0;
  const Magyar = 1;

  public static function toString(int $t)
  {
      switch ($t)
      {
          case MemeType::Egyetem: return "Egyetem meme";
          case MemeType::Magyar: return "Magyar meme";
          default: return "";
      }
  }
}

class Meme {
    private $name;
    private $feltolto;
    private $datum;
    private $votes;
    private $filename;
    private $type;

    public function __construct($name, $feltolto, $filename, $type) {
        $this->name = $name;
        $this->feltolto = $feltolto;
        $this->filename=$filename;
        $this->datum = new DateTime();
        $this->datum->setTimezone(new DateTimeZone("Europe/Budapest")); 
        $this->votes=[];
        $this->type = $type;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getFeltolto() : string {
        return $this->feltolto;
    }

    public function getDatum() : DateTime {
        return $this->datum;
    }

    public function getUpvotes() : int {
      $votes = 0;
      foreach ($this->votes as $vote)
      {
        $votes += $vote;
      }
      return $votes;
    }

    public function getVote(string $user) : int {
      if (!array_key_exists($user, $this->votes)) return 0;
      return $this->votes[$user];
    }

    public function Vote(string $user, int $up) {
      if ($up >= -1 && $up <= 1)
        $this->votes[$user] = $up;
    }

    public function getType() : int {
      return $this->type;
    }

    public function getFilename() : string {
        return $this->filename;
    }
}

function Memes($file_nev) {
    $memes = [];                  

    $file = fopen($file_nev, "r");   

    while (($sor = fgets($file)) !== FALSE) { 
      $meme = unserialize($sor);  
      $memes[] = $meme;            
    }

    fclose($file);
    return $memes;               
  }

  function Memehozzaad($memes, $file_nev) {
    $file = fopen($file_nev, "w");   

    foreach($memes as $meme) {   
      $serialized_meme = serialize($meme);     
      fwrite($file, $serialized_meme . "\n");  
    }

    fclose($file);
  }

  function renderMemes(int $type)
  {
    $memes = Memes("common/memek.txt");
    foreach ($memes as $m)
    {
        if ($m->getType() === $type)
        {
    ?>
        <article class="meme">
            <h1 class="cim"><?php echo $m->getName(); ?></h1>
            <h2 class="feltolto"><?php echo $m->getFeltolto(); ?></h2>
            <h2 class="datum"><?php echo $m->getDatum()->format('Y-m-d H:i'); ?></h2>
            <div class="vote">
              <form method="POST">
                <input type="hidden" name="id" value="<?php echo $m->getFilename(); ?>">
                <input class="upvote<?php if (isset($_SESSION["user"]) && $m->getVote($_SESSION["user"]->getName()) === 1) echo " active"; ?>" type="submit" name="vote" value="up">
                <div class="votes"><?php echo $m->getUpvotes(); ?></div>
                <input class="downvote<?php if (isset($_SESSION["user"]) && $m->getVote($_SESSION["user"]->getName()) === -1) echo " active"; ?>" type="submit" name="vote" value="down">
              </form>
            </div>   
            <img src="<?php echo $m->getFilename(); ?>" alt="kep">
        </article>
    <?php
        }
    }
  }

  if (isset($_SESSION["user"]))
  {
      if (isset($_POST["vote"]))
      {
          $vote = $_POST["vote"] === "up" ? 1 : -1;
          $memes = Memes("common/memek.txt");
          foreach ($memes as $m) {
              if ($m->getFilename() === $_POST["id"])
              {
                  if ($m->getVote($_SESSION["user"]->getName()) === $vote) $m->Vote($_SESSION["user"]->getName(), 0);
                  else $m->Vote($_SESSION["user"]->getName(), $vote);
                  Memehozzaad($memes, "common/memek.txt");
                  break;
              }
          }
      }
  }

?>