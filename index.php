<?php
    session_start();
    require 'pub-funcs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Butik</title>

</head>
<body onload="document.getElementById('defaultOpen').click();">

    <?php include 'navbar.php'; ?>
    <!-- <style>.hor-navbar{background-color: red; color: white;}</style> -->
    
    <div class="container">

        <div class="tab">
            <button onclick="openTab(event, 'All')" class="tablinks active" id="defaultOpen">All</button> 
            <button onclick="openTab(event, 'Godis')" class="tablinks active" id="defaultOpen">Godis</button>
            <button onclick="openTab(event, 'Chips')" class="tablinks">Chips</button>
            <button onclick="openTab(event, 'Dryck')" class="tablinks">Dryck</button>
            <button onclick="openTab(event, 'Frukt')" class="tablinks">Frukt</button>
            <button onclick="openTab(event, 'Kakor')" class="tablinks">Kakor</button>
        </div>

        <div id="All" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products("all");
                ?>
            </div>
        </div>

        <div id="Godis" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products("candy");
                ?>
            </div>
        </div>

        <div id="Chips" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products("chips");
                ?>
            </div>  
        </div>

        <div id="Dryck" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products("drinks");
                ?>
            </div>    
        </div>

        <div id="Frukt" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products("fruit");
                ?>
            </div>    
        </div>

        <div id="Kakor" class="tabcontent">
            <div class="flex-lager">
                <?php
                    post_products('cookies');

                ?>
            </div>
        </div>

        <script>

            function openTab(evt, category) {
                // Declare all variables
                var i, tabcontent, tablinks;

                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }

                document.getElementById(category).style.display = "block";
                evt.currentTarget.className += " active";
            }

        </script>



    </div>

<?php include "footer.php"; ?>