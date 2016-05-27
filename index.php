<?php
function werp(){
  for($i=1; $i <=5; $i++){
    $worp = rand(1,6);
    create_image($worp, $i);
    print "<img src=" .$worp.".png>";
    echo "   ";
    $aWorp[$i] = $worp;
  }
    analyse($aWorp);
}

werp();


echo "</br><form action='' method='post'></br><input type='submit' value='gooien'></form>";
if(isset($_POST['submit'])){
  
}

function create_image($worp){
  $im = @imagecreate(200,200) or die("Cannot Initialize new GD image stream");
  $background_color = imagecolorallocate($im,0,0,0); //black
  $dot = imagecolorallocate($im,255,255,255); //white

  if($worp==1 OR $worp==3 OR $worp==5){
    imagefilledellipse($im,100,100,40,40,$dot); //4
  }
  if($worp==2 OR $worp==3){
    imagefilledellipse($im,50,50,40,40,$dot); //1
    imagefilledellipse($im,150,150,40,40,$dot); //7
  }
  if($worp==4 OR $worp==5 OR $worp==6){
    imagefilledellipse($im,50,50,40,40,$dot); //1
    imagefilledellipse($im,150,50,40,40,$dot); //2
    imagefilledellipse($im,50,150,40,40,$dot); //6
    imagefilledellipse($im,150,150,40,40,$dot);//7
  }
  if($worp==6){
    imagefilledellipse($im,50,100,40,40,$dot); //3
    imagefilledellipse($im,150,100,40,40,$dot); //5
  }
  imagepng($im,$worp.".png");
  imagedestroy($im);
}

function analyse($aWorp){
    $aScore = array(0,0,0,0,0,0,0);
    for($i=1; $i <=6; $i++){//outer loop
        for($j=1; $j<6; $j++){//inner loop
            if($aWorp[$j] == $i){
                $aScore[$i]++;
            }
        }
    }
    pokerOrNot($aScore);
    
}

function pokerOrNot($aScore){
    echo "<br>";
    if($aScore[1] == 1 && $aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1){
        echo "You have a large street!";
    } elseif($aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1 && $aScore[6] == 1){
        echo "You have a large street!";
    }
    
    elseif($aScore[1] == 1 && $aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1){
        echo "You have a small street!";
    } elseif($aScore[2] == 1 && $aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1){
        echo "You have a small street!";
    } elseif($aScore[3] == 1 && $aScore[4] == 1 && $aScore[5] == 1 && $aScore[6] == 1){
        echo "You have a small street!";
    }
    rsort($aScore);
    if($aScore[0] == 2){
        if($aScore[1] == 2){
            echo "You have 2 pairs!";
        } else{
            echo "You have 1 pair!";
        }
    } elseif($aScore[0] == 3){
        if($aScore[1] == 2){
            echo "You have a full house!";
        } else{
            echo "You have 3 of a kind!";
        }
    } elseif($aScore[0] == 4){
        echo "You have 4 of a kind!";
    } elseif($aScore[0] == 5){
        echo "You have Yahtzee!";
    }
}
