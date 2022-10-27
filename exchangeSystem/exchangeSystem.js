/*
let text = "";

if (cash > 1000) {
  text = "Input is over cash limit";
} else {
  text = "Input is ok";
}
*/

// let purschase = document.getElementById("purchase").value;
// let cashPayment = document.getElementById("cashPayment").value;

function getAmount() {
  let purchase = document.getElementById("purchase").value;
  let cash = document.getElementById("cashPayment").value;
  let rest = cash - purchase;
  let tusen = 1000;
  let femHundra = 500;
  let twoHundra = 200;
  let Hundra = 100;
  let femti = 50;
  let tjugo = 20;
  let myt = [10, 5, 2, 1];

  let antalSedlar =0;
    while(rest!=0)
    {
      if (rest >= tusen)
       {
        antalSedlar =parseInt(rest / tusen);
        rest = parseInt(rest % tusen);
        console.log(antalSedlar + " * " + " 1000 SEK ");
        rest = parseInt(rest % tusen);
        //document.getElementById("demo3").innerHTML +=rest+'<br>';
        document.getElementById("demo").innerHTML +=antalSedlar+ "* " + " 1000 SEK "+"<br>";
   }

    if (rest >= femHundra) {
      antalSedlar =parseInt(rest / femHundra);
      console.log(antalSedlar + "*"+ " 500 SEK" +'<br>');
      rest = parseInt(rest % femHundra);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("demo").innerHTML += antalSedlar+ "*" + '<img src="https://www.riksbank.se/imagevault/publishedmedia/38oie489mi4qjbdp7ahc/500-kronorssedel-specimen-fram.png" alt="500" class="responsive">' +'<br>';
      console.log("Ja för 500")
    } else {
      console.log("Nej för 500");
   }

/* Gör på de andra
   if (rest >= femHundra) {
    antalSedlar =parseInt(rest / femHundra);
    console.log(antalSedlar + "*"+ " 500 SEK" +'<br>');
    rest = parseInt(rest % femHundra);
    //document.getElementById("demo3").innerHTML +=rest+'<br>';
    document.getElementById("demo").innerHTML += antalSedlar+ "*" + '" alt="" class="responsive">' +'<br>';
    console.log("Ja för X")
  } else {
    console.log("Nej för X");
 }

 */
    if (rest >= twoHundra) { 
      antalSedlar = parseInt(rest / twoHundra);
      console.log(antalSedlar + "*"+ " 200 SEK" +'<br>');
      rest = parseInt(rest % twoHundra);   
      //document.getElementById("demo3").innerHTML +=rest+'<br>'; 
      document.getElementById("demo").innerHTML += antalSedlar+'*'+ " 200 SEK" +'<br>';
    }

    if (rest >= Hundra) {
      antalSedlar =parseInt(rest / Hundra);
      console.log(antalSedlar + "*"+ " 100 SEK" +'<br>');
      rest = parseInt(rest % Hundra);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("demo").innerHTML += antalSedlar+"*"+ " 100 SEK"+'<br>';
    }

    if (rest >= femti) {
      antalSedlar =parseInt(rest / femti);
      console.log(antalSedlar + "*"+ " 50 SEK" +'<br>');
      rest = parseInt(rest % femti);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("demo").innerHTML += antalSedlar+'*'+ " 50 SEK"+'<br>';
    }
    if (rest >= tjugo) {
      antalSedlar =parseInt(rest / tjugo);
      console.log(antalSedlar + "*"+ " 20 SEK" +'<br>');
      rest = parseInt(rest % tjugo);
      document.getElementById("demo").innerHTML += antalSedlar + "*"+ " 20 SEK" +'<br>'
      //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "20 SEK"+'<br>';
    }
    myt.forEach(element => 
      {
      if (rest >= element)
      {
        antalSedlar =parseInt(rest / element);
        console.log(antalSedlar + "*"+ " "+ element+'<br>');
        rest = parseInt(rest % element);
        //document.getElementById("demo3").innerHTML +=rest+'<br>';
        document.getElementById("demo").innerHTML += antalSedlar+"*"+element +'<br>';
      }
    });

    if(rest == 0){
      break;
    }
     document.getElementById("demo").innerText = rest;
     document.getElementById("demo3").innerText = antalSedlar;
  }
}