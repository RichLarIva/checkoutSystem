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
  let purchase = Number(document.getElementById("mtottal").textContent);
  console.log(purchase);
  let cash = document.getElementById("cashGet").value;
  let rest = cash - purchase;
  let totalCash = 0;
  document.getElementById("return").innerHTML = rest+" <br>";
    while(rest!=0)
    {
      if (rest >= 1000) {
        totalCash =parseInt(rest / 1000);
        console.log(totalCash + "*"+ " 1000 SEK" +'<br>');
        rest = parseInt(rest % 1000);
        //document.getElementById("demo3").innerHTML +=rest+'<br>';
        document.getElementById("return").innerHTML += totalCash+ "*" + '<img src="https://www.riksbank.se/imagevault/publishedmedia/44j91vowc7wepjl8i0ta/1000-kronossedel-specimen-fram.png" alt="1000" class="responsive">' +'<br>';
        console.log("Ja för 1000")
      } else {
        console.log("Nej för 1000");
     }

    if (rest >= 500) {
      totalCash =parseInt(rest / 500);
      console.log(totalCash + "*"+ " 500 SEK" +'<br>');
      rest = parseInt(rest % 500);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("return").innerHTML += totalCash+ "*" + '<img src="https://www.riksbank.se/imagevault/publishedmedia/38oie489mi4qjbdp7ahc/500-kronorssedel-specimen-fram.png" alt="500" class="responsive">' +'<br>';
      console.log("Ja för 500")
    } else {
      console.log("Nej för 500");
   }

    if (rest >= 200) { 
      totalCash = parseInt(rest / 200);
      console.log(totalCash + "*"+ " 200 SEK" +'<br>');
      rest = parseInt(rest % 200);   
      //document.getElementById("demo3").innerHTML +=rest+'<br>'; 
      document.getElementById("return").innerHTML += totalCash+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/6foaq9pcbovijbxk6e6v/200-kronorssedel-specimen-fram.png" alt="200" class="responsive">' +'<br>';
      console.log("Ja för 200")
    } else {
      console.log("Nej för 200");
   }

    if (rest >= 100) {
      totalCash =parseInt(rest / 100);
      console.log(totalCash + "*"+ " 100 SEK" +'<br>');
      rest = parseInt(rest % 100);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("return").innerHTML += totalCash+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/20fynfeyu26c2x0ynb2f/100-kronorssedel-specimen-fram.png" alt="100" class="responsive">' +'<br>';
      console.log("Ja för 100")
    } else {
      console.log("Nej för 100");
   }

    if (rest >= 50) {
      totalCash =parseInt(rest / 50);
      console.log(totalCash + "*"+ " 50 SEK" +'<br>');
      rest = parseInt(rest % 50);
      //document.getElementById("demo3").innerHTML +=rest+'<br>';
      document.getElementById("return").innerHTML += totalCash+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/1eu7d6q8stpey9freucv/50-kronorssedel_naviga10n_specimen_fram.png" alt="50" class="responsive">' +'<br>';
      console.log("Ja för 50")
    } else {
      console.log("Nej för 50");
   }

    if (rest >= 20) {
      totalCash =parseInt(rest / 20);
      console.log(totalCash + "*"+ " 20 SEK" +'<br>');
      rest = parseInt(rest % 20);
      document.getElementById("return").innerHTML += totalCash+"*"+ '<img src=https://www.riksbank.se/imagevault/publishedmedia/mn56pkot86uuhd93a2kq/20_kronorssedel_naviga10n_specimen_fram.png" alt="20" class="responsive">' +'<br>';
      //document.getElementById("demo").innerHTML += totalCash+'*'+ "20 SEK"+'<br>';
      console.log("Ja för 20")
    } else {
      console.log("Nej för 20");
   }

   if (rest >= 10) {
    totalCash =parseInt(rest / 10);
    console.log(totalCash + "*"+ " 10 SEK" +'<br>');
    rest = parseInt(rest % 10);
    document.getElementById("return").innerHTML += totalCash+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/sse5eiu1eq7ukfnntkb8/10-krona__fram-_och_baksida.png" alt="10" class="responsive">' +'<br>';
    //document.getElementById("demo").innerHTML += totalCash+'*'+ "10 SEK"+'<br>';
    console.log("Ja för 10")
  } else {
    console.log("Nej för 10");
 }

 if (rest >= 5) {
  totalCash =parseInt(rest / 5);
  console.log(totalCash + "*"+ " 5 SEK" +'<br>');
  rest = parseInt(rest % 5);
  document.getElementById("return").innerHTML += totalCash+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/54mbw53mh4vpm822sbzl/5-krona__fram-_och_baksida.png" alt="5" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += totalCash+'*'+ "5 SEK"+'<br>';
  console.log("Ja för 5")
} else {
  console.log("Nej för 5");
}

if (rest >= 2) {
  totalCash =parseInt(rest / 2);
  console.log(totalCash + "*"+ " 2 SEK" +'<br>');
  rest = parseInt(rest % 2);
  document.getElementById("return").innerHTML += totalCash+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/7aisb34xcspk0q2ti2bw/2-krona__fram-_och_baksida.png" alt="2" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += totalCash+'*'+ "2 SEK"+'<br>';
  console.log("Ja för 2")
} else {
  console.log("Nej för 2");
}

if (rest >= 1) {
  totalCash =parseInt(rest / 1);
  console.log(totalCash + "*"+ " 1 SEK" +'<br>');
  rest = parseInt(rest % 1);
  document.getElementById("return").innerHTML += totalCash+"*"+ '<img src="https://www.riksbank.se/imagevault/publishedmedia/60qzl6z9ztnktu3txbp6/1-krona__fram-_och_baksida.png" alt="1" class="responsive">' +'<br>';
  //document.getElementById("demo").innerHTML += totalCash+'*'+ "1 SEK"+'<br>';
  console.log("Ja för 1")
} else {
  console.log("Nej för 1");
}

    if(rest == 0){
      break;
    }
     document.getElementById("return").innerText = rest;
     document.getElementById("return").innerText = totalCash;
  }
}