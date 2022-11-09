<script>

      let vid = document.getElementById("audioPlayer");
      let iframe = document.getElementById("iframe_id");
      let status = document.getElementById("status");
      let display_rate=document.querySelector("#display_rate");
      let fw=document.getElementById('full-width');
      let seekbar = document.getElementById("seeker");

      vid.onplay = () => {
            desc = document.querySelector('.current-song').firstElementChild.innerText;
            var descColor = document.querySelector('#status');
            descColor.style.color = '#219bc3';
            descColor.style.fontWeight = 'bold';

            description = document.querySelector('.current-song').firstElementChild.innerText;
            status.innerHTML = 'Playing : ' + desc.toUpperCase();
            descriptionLoc.innerHTML = description;

        }

      vid.addEventListener('timeupdate', () => {
        seekbar.value = vid.currentTime / vid.duration * seekbar.max;
        document.getElementById("rangeDisplay").innerHTML = parseInt(vid.currentTime  / 60, 10) + ":" + parseInt(vid.currentTime % 60);
        if(isNaN(vid.duration)){
          document.getElementById("rangeDisplayMax").innerHTML="0:0";
        }else{
          document.getElementById("rangeDisplayMax").innerHTML = parseInt(vid.duration / 60, 10) + ":" + parseInt(vid.duration % 60);
        }
      })

      seekbar.addEventListener('change', () => {
        vid.currentTime = vid.duration * seekbar.value / seekbar.max;
      })


      vid.defaultPlaybackRate = 1.0
      const increase = () => {
          // Increasing the playing speed by 1
          vid.playbackRate += 0.2;
          display_rate.innerHTML= 'player speed:'+ vid.playbackRate.toFixed(2)
      }

      const decrease = () => {
          // Decreasing the playing speed by 1
          vid.playbackRate -= 0.05;
          display_rate.innerHTML= 'player speed:'+ vid.playbackRate.toFixed(2)
      }

      const pinp = () => {
         vid.requestPictureInPicture()
      }
      const fullwidth = () => {
         vid.style.width = '100%';
         vid.style.height = 'inherit';
         fw.innerHTML = 'unforce full width';
      }
      const notfullwidth = () => {
        //  vid.style.height = '75%'; disable
         vid.style.width = 'inherit';
         fw.innerHTML = 'force full width';
      }

      const togglePlay = () => {
        var music = document.getElementById("clickPlay");
        var toggle = document.getElementById("toggle");
        if (vid.paused) {
          vid.play();
          toggle.innerHTML = "Pause";
        }else {
          vid.pause();
          toggle.innerHTML ="Play";
        }
      }

      let count = 0;
      $("#full-width").click(function() {
          count++;
          var isEven = function(count) {
              return (count % 2 === 0) ? true : false;
          };
          if (isEven(count) === false) {
              fullwidth()
          } else if (isEven(count) === true) {
              notfullwidth()
          }
      });


 //////////word counter part 1////////    

      class WordCounter {
        constructor(transcriptId, showId) {
          this.trans = transcriptId;
          this.show = showId; 
          this.numWords = 0
          this.numSpaces = 0
          this.varb = document.getElementById(transcriptId).value
        }

        countWords(){
          let text = this.varb.split(' ') //preparation for picking index, here it will count all words index after space
          for (let j=0; j< text.length; j++){
            let currentCharacter = this.varb[j]
            if(text[j] !== ' '){
              this.numWords += 1
            }                     
          }   
        let x = document.getElementById(this.show);
        return x.innerHTML = this.numWords;       
      }

        countChars(){
          for (let j=0; j<this.varb.length; j++){
          let currentCharacter = this.varb[j]
          if(currentCharacter == " " && currentCharacter.indexOf != -1){ //not the last one
            this.numWords += 1 
          }else{
            this.numWords += 1
           }                       
          }   
          let x = document.getElementById(this.show);
          return x.innerHTML = this.numWords;       
        }

       phraseWithoutSpaces(){
          for (let j=0; j<this.varb.length; j++){
          let currentCharacter = this.varb[j]
          if(currentCharacter == " " && currentCharacter.indexOf != -1){ //not the last one
            this.numSpaces += 1
          }
            this.numWords += 1
          }

          let y = this.numWords - this.numSpaces
          let x = document.getElementById(this.show);
          return x.innerHTML = y;                        
        }    
        
    }  //end of class


///////////////////////class caller///////////////////////
    //count chars
    const charsCounter = param => {
      let x = new WordCounter('transcript' + param, 'show' + param)
      let y = x.countChars()
      return y
    }

    //count word
    const wordsCounter = param => {
      let x = new WordCounter('transcript' + param, 'show' + param)
      let y = x.countWords()
      return y
    }

    //count chars without spaced
    const charsWithoutSpaces = param => {
      return new WordCounter('transcript' + param, 'show' + param).phraseWithoutSpaces()
    }

  /////////word counter end ///////  

  ///////space adder /////////
  let tareaQty = '<?php echo $tareaQty; ?>' //need to echo to reach the Client
    const dots = ['dot1', 'dot2']
    const dotList = () => {
        dots.forEach(dot => {
          $('#'+ dot).hide()
          console.log(dot, 'added')
        })
      }

      dotList()  

      $(function(){
        //hide the add space button for first 2 textarea
        for(let i=3; i < parseInt(tareaQty, 10); i++){
          $('#trans'+ i).hide()
        }

        //hide the rest of the dot from 4th to the rest of add space button
        for(let i=4; i < parseInt(tareaQty, 10); i++){
          $('#dot' + i).hide()
        }
        
      })
   
    //toggler for main text area it needs main id and attached toggler class to it.
    const showMainArea = () => {
      let transcript_main = document.getElementById('transcript_main')
      transcript_main.classList.toggle('showMain')
    }
      
    //managing add space button display.
    const addSpace = (param) => {
      $('#trans'+ param).show()
      dots.push('dot'+ param)
      $('#dot' + param).hide()
      $('#dot' + (param+1)).show()
      dotList()  
     }
///////////space added end//////////

</script>
