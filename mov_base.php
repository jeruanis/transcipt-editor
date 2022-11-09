<!DOCTYPE>
<html>
<head>
<title>Word Counter and Add textarea</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <link rel="icon" type="image/jpg" href="../../../assets/images/background/favicon.jpg">
   <link rel="stylesheet" href="../../static/css/bootstrap.css">
   <link rel="stylesheet" href="player.css">
   <link rel="stylesheet" href="../../static/js/jquery-ui-1.12.1/jquery-ui.css" ></link>
   <script src="../../static/js/code.jquery.3.5.1.min.js"></script>
   <script src="../../static/js/bootstrap.min.js"></script>
   <script src="../../static/js/jquery-ui-1.12.1/jquery-ui.js"></script>
</head>
<body>

<main id='main_grid' class="bg-class">
  <aside>
    <section>
       <a href="../../">
         <div class="text-center" style="padding:7px;background: radial-gradient(darkcyan, transparent);">
            <h2 class="d-inline-block pr-2" style="color:yellow"><em>Transcript</em></h2>
            <h1 class="d-inline-block" style="color:darkred;font-family:'Ceviche One', cursive;">Editor</h1>
         </div>
       </a>

       <video style='width:inherit;margin:0 auto;' class="embed-responsive embed-responsive-16by9" controlslist="nodownload" id="audioPlayer" class="mt-2">
       </video>
       <input id="seeker" class="w-100" type="range" min="0" max="100" name="">

      <div class="col-md-12 mx-0 px-0 py-2 mx-2">
          <button class="ui button py-2 px-2 border-radius-0" id="toggle" onclick="togglePlay()">
            Play
          </button>
          <button onclick="increase()" class="ui button py-2 px-2 border-radius-0" id='increase'>
            + speed
          </button>
          <button onclick="decrease()" class="ui button py-2 px-2 border-radius-0" id='decrease'>
            - speed
          </button>
          <button onclick="pinp()" class="ui button py-2 px-2 border-radius-0" id="pip">
            pinp
          </button>
          <button  class="ui button py-2 px-2 border-radius-0" id="full-width">
            force full width
          </button>
          <button class="ui button py-2 px-2 border-radius-0 bg-white" id="display_rate">
            player speed: 1.0
          </button>
          <button class="ui button py-2 px-2 border-radius-0">
            <span id="rangeDisplay">0</span><span>&nbsp;/&nbsp;</span><span id="rangeDisplayMax">0</span>
          </button>


      </div>

      <div class="card-body">
          <span id="status" style="display:block">TGN LIFE MEDIA GALLERY</span>
          <span id="descriptionLoc" class="d-block"></span>
      </div>

      <ol class="playlist">
             <?php
             $folder_files = scandir('../../../assets/videos/03_transcripting/');
             foreach($folder_files as $file) {
               if($file =='.' || $file =='..'){
                 //skip
               }else{
                 echo '<li><a href="#"><h6>'.strtoupper(str_replace("_", " ", $file)).'</h6></a></li>';
                 $com_folder = scandir('../../../assets/videos/03_transcripting/'.$file.'/');
                foreach($com_folder as $com){
                  if($com =='.' || $com =='..'){
                     //skip
                  }else{
                    echo '<li><a href="#"><h6>'.str_replace("_", " ", $com).'</h6></a></li>';
                    $com_file_list = scandir('../../../assets/videos/03_transcripting/'.$file.'/'.$com.'/');
                    foreach($com_file_list as $file_list){
                      if($file_list =='.' || $file_list =='..'){
                          //skip
                      }else{
                          $ext=pathinfo($file_list, PATHINFO_EXTENSION);
                          if(!empty($ext)){
                            $text_1 = '<li><a href="../../../assets/videos/03_transcripting/'.$file.'/'.$com.'/'.$file_list.'">';
                            $text_2 = '<div class="p2">'.str_replace("_", " ", basename($file_list, ".".$ext)).'</div></a></li>';
                            echo $text_1 . $text_2;
                           }
                         }
                     }
                   }
                  }
                 }
               }
          echo '</ol>';
          ?>
    </section>
  </aside>

  <aside>
    <?php
      $tareaQty=100;  //set the number of paragraphs to make
      $wordCounter='wordCounter';
      $charCounter='charsCounter';
      $current_counter_used=$charCounter;

    for ($i=1; $i< $tareaQty; $i++) {
        echo '<section id="trans'.$i.'"><b><textarea placeholder="Place your script here, approx. size to 400 character including spaces. Now is using '.$current_counter_used.' as you type." style="font-size:18px" name="textarea" id="transcript'.$i.'" rows="5" cols="80" class="p-3 d-block mb-2 rounded form-control textarea ui-widget-content" contenteditable spellcheck="true" onkeyup="'.$current_counter_used.'('.$i.')"></textarea></b>
        <div class="d-inline-block">
          <span id="show'.$i.'">0</span>
          <button class="btn-secondary rounded m-1 px-2" onClick="charsCounter('.$i.')">Count chars '.$i.'</button>
          <button class="btn-secondary rounded m-1 px-2" onClick="wordsCounter('.$i.')">Count words '.$i.'</button>
          <button class="btn-secondary rounded m-1 px-2" onClick="charsWithoutSpaces('.$i.')">Count chars without spaces'.$i.'</button>
        </div>
        </section><button id="dot'.$i.'" onClick="addSpace('.$i.')">add'.$i.'th </button>';
      }
      echo '<button onClick="showMainArea()">show main text area</button><button class="showMain" id="toMain" onClick="transferWordsToMain()"><- transfer all text to main</button>';

      include('playerjs.php'); //this is needed because of the php variable that needs to be defined.
    ?>

  </aside>
  <aside>
    <textarea placeholder="Place your whole script here" name="" id="transcript_main" rows="5" cols="80" class="showMain p-3 mb-2 rounded form-control" contenteditable spellcheck="true"></textarea>
  </aside>
</main>
