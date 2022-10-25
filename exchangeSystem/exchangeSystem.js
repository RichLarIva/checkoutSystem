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
document.getElementById("demo").innerText = rest;
}

if(rest > tusen)
{
rest % tusen; 
}
document.getElementById("demo3").innerText = rest;
/*
else if (rest>)
{

}

let tusen = 1000;
let femHundra = 500;
let tvåHundra = 200;
let Hundra =100;
let Femti= 50;
let tjugo =20;
let mynt =[10,5,2,1];
let z = x % y;
document.getElementById("demo3").innerText = z;
*/