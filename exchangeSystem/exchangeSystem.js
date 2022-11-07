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
  let tio = 10;
  let fem = 5;
  let två = 2;
  let ett = 1;
  /*
  let myt = [10, 5, 2, 1];
  */
  let antalSedlar =0;
    while(rest!=0)
    {
      if (rest >= tusen) {
        antalSedlar =parseInt(rest / tusen);
        console.log(antalSedlar + "*"+ " 1000 SEK" +'<br>');
        rest = parseInt(rest % tusen);
        //document.getElementById("demo3").innerHTML +=rest+'<br>';
        document.getElementById("demo").innerHTML += antalSedlar+ "*" + '<img src="https://www.riksbank.se/imagevault/publishedmedia/44j91vowc7wepjl8i0ta/1000-kronossedel-specimen-fram.png" alt="1000" class="responsive">' +'<br>';
        console.log("Ja för 1000")
      } else {
        console.log("Nej för 1000");
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

    if (rest >= twoHundra) { 
      antalSedlar = parseInt(rest / twoHundra);
      console.log(antalSedlar + "*"+ " 200 SEK" +'<br>');
      rest = parseInt(rest % twoHundra);   
      //document.getElementById("demo3").innerHTML +=rest+'<br>'; 
      document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/6foaq9pcbovijbxk6e6v/200-kronorssedel-specimen-fram.png" alt="200" class="responsive">' +'<br>';
      console.log("Ja för 200")
    } else {
      console.log("Nej för 200");
   }

    if (rest >= Hundra) {
      antalSedlar =parseInt(rest / Hundra);
      console.log(antalSedlar + "*"+ " 100 SEK" +'<br>');
      rest = parseInt(rest % Hundra);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/20fynfeyu26c2x0ynb2f/100-kronorssedel-specimen-fram.png" alt="100" class="responsive">' +'<br>';
      console.log("Ja för 100")
    } else {
      console.log("Nej för 100");
   }

    if (rest >= femti) {
      antalSedlar =parseInt(rest / femti);
      console.log(antalSedlar + "*"+ " 50 SEK" +'<br>');
      rest = parseInt(rest % femti);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/1eu7d6q8stpey9freucv/50-kronorssedel_navigation_specimen_fram.png" alt="50" class="responsive">' +'<br>';
      console.log("Ja för 50")
    } else {
      console.log("Nej för 50");
   }

    if (rest >= tjugo) {
      antalSedlar =parseInt(rest / tjugo);
      console.log(antalSedlar + "*"+ " 20 SEK" +'<br>');
      rest = parseInt(rest % tjugo);
      document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/mn56pkot86uuhd93a2kq/20_kronorssedel_navigation_specimen_fram.png" alt="20" class="responsive">' +'<br>';
      //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "20 SEK"+'<br>';
      console.log("Ja för 20")
    } else {
      console.log("Nej för 20");
   }

   if (rest >= tio) {
    antalSedlar =parseInt(rest / tio);
    console.log(antalSedlar + "*"+ " 10 SEK" +'<br>');
    rest = parseInt(rest % tio);
    document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/sse5eiu1eq7ukfnntkb8/10-krona__fram-_och_baksida.png" alt="10" class="responsive">' +'<br>';
    //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "10 SEK"+'<br>';
    console.log("Ja för 10")
  } else {
    console.log("Nej för 10");
 }

 if (rest >= fem) {
  antalSedlar =parseInt(rest / fem);
  console.log(antalSedlar + "*"+ " 5 SEK" +'<br>');
  rest = parseInt(rest % fem);
  document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/54mbw53mh4vpm822sbzl/5-krona__fram-_och_baksida.png" alt="5" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "5 SEK"+'<br>';
  console.log("Ja för 5")
} else {
  console.log("Nej för 5");
}

if (rest >= två) {
  antalSedlar =parseInt(rest / två);
  console.log(antalSedlar + "*"+ " 2 SEK" +'<br>');
  rest = parseInt(rest % två);
  document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/7aisb34xcspk0q2ti2bw/2-krona__fram-_och_baksida.png" alt="2" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "2 SEK"+'<br>';
  console.log("Ja för 2")
} else {
  console.log("Nej för 2");
}

if (rest >= ett) {
  antalSedlar =parseInt(rest / ett);
  console.log(antalSedlar + "*"+ " 1 SEK" +'<br>');
  rest = parseInt(rest % ett);
  document.getElementById("demo").innerHTML += antalSedlar+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/60qzl6z9ztnktu3txbp6/1-krona__fram-_och_baksida.png" alt="1" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += antalSedlar+'*'+ "1 SEK"+'<br>';
  console.log("Ja för 1")
} else {
  console.log("Nej för 1");
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