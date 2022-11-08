
i = 0;

function addProduct(){

    jQuery('<div>', { id:'productpre'+ i,class: 'productpre'}).appendTo('#productview');

    jQuery('<img>', { id: 'prodpreimg'+ i, class:'prodpreimg', src: 'images/Kexchoklad.jpeg', alt:'e'}).appendTo('#productpre'+ i);

    jQuery('<div>', { id: 'prodinfo'+ i, class:'prodinfo'}).appendTo('#productpre'+ i);

    jQuery('<div>', { id: 'prodname'+ i, class:'prodname'}).appendTo('#prodinfo'+ i);
    
    jQuery('<p>', { id: 'pname'+ i, text: 'Product'}).appendTo('#prodname'+ i);

    jQuery('<div>', { id: 'prodremove'+ i, class:'prodremove'}).appendTo('#prodinfo'+ i);

    jQuery('<button>', {id:'butt'+ i, class: 'fa-solid fa-x'}).appendTo('#prodremove'+ i);

    jQuery('<div>', {id:'prodprice'+ i, class: 'prodprice'}).appendTo('#prodinfo'+ i);

    jQuery('<p>', { id: 'pprice'+ i, text: 'Price'}).appendTo('#prodprice'+ i);

    jQuery('<div>', {id:'prodamount'+ i, class: 'prodamount'}).appendTo('#prodinfo'+ i);

    jQuery('<div>', {id:'amountbtn'+ i, class: 'amountbtn'}).appendTo('#prodamount'+ i);

    jQuery('<button>', {id:'abtn'+ i, class: 'abtn',text:'+'}).appendTo('#amountbtn'+ i);

    jQuery('<div>', {id:'pamount'+ i, class: 'pamount'}).appendTo('#prodamount'+ i);

    jQuery('<p>', { id:'pamountp'+ i, text: '0'}).appendTo('#pamount'+ i);

    jQuery('<div>', {id:'amountbt'+ i, class: 'amountbt'}).appendTo('#prodamount'+ i);

    jQuery('<button>', {id:'abtn'+ i, class: 'abt', text:'-'}).appendTo('#amountbt'+ i);



    i = i + 1;

}