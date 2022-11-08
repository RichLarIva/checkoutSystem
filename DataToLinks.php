<?php
    require "config.php";

    $sql = "SELECT * FROM product";

    $xmldoc = new DOMDocument();
    $xmldoc->load('links.xml');
    $resu = $conn->query($sql);
    while($res = mysqli_fetch_assoc($resu)){

        $newBarCode = $res['barcode'];
        $newName = $res['name'];
        $root = $xmldoc->firstChild;
        
        $newElement = $xmldoc->createElement('item');
        $root->appendChild($newElement);
        $newElem = $xmldoc->createElement('barcode');
        $newElement->appendChild($newElem);
        $newText = $xmldoc->createTextNode($newBarCode);
        $newElem->appendChild($newText);
        $newEl = $xmldoc->createElement('name');
        $newElem->appendChild($newEl);
        $newTxt = $xmldoc->createTextNode($newName);
        $newEl->appendChild($newTxt);
    }
        $xmldoc->save('links.xml');
    $conn->close();
?>