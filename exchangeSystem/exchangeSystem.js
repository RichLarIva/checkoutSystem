let purschase = document.getElementById("purchase").value;
let cash = document.getElementById("cashPayment").value;
if(cash>1000)
{
  text = "Input is over cash limit";
}
else
{
  text = "Input is ok";
}

function getAmount (purchase,cashPayment)
{
  purchase = document.getElementById("purchase").value;
  cash = document.getElementById("cashPayment").value;
  let rest = cash-purchase;
  let tusen = 1000;
let femHundra = 500;
let twoHundra = 200;
let Hundra =100;
let femti= 50;
let tjugo =20;
let myt = Number[10,5,2,1];
while(rest!=0)
{
if(rest > 1000)
{
  rest = rest % 1000; 
  restOfModulo = parseInt(rest % 1000);
  console.log(restOfModulo);
}

else if(rest >= femHundra)
{
  rest = rest % femHundra; 
  restOfModulo = parseInt(rest % femHundra);
}

else if(rest >= twoHundra)
{
  rest = rest % twoHundra; 
  restOfModulo = parseInt(rest % twoHundra);
}

else if(rest >= Hundra)
{
  rest = rest % Hundra; 
  restOfModulo = parseInt(rest % Hundra);
}

else if(rest >= femti)
{
  rest = rest % femti; 
  restOfModulo = parseInt(rest % femti);
}

else if(rest >= tjugo)
{
  rest = rest % tjugo; 
  restOfModulo = parseInt(rest % tjugo);
}
else if(rest >= myt)
{
  rest = rest % myt; 
  restOfModulo = parseInt(rest % myt);
}


document.getElementById("demo3").innerText = rest;
document.getElementById("demo3").innerText = restOfModulo;
}
}