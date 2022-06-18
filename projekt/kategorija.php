<!DOCTYPE html>
<html>

    <head>

        <title>Home</title>
        <meta charset="UTF-8"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="author" content="Damjan Kovačev">
        <meta name="description" content="">        

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> 
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="style.css"/>

        
        
    </head>


    <body>
        
        <header>


                <div class="container white">
                    <div class="row ">
                        <div class="col-12">

                            <div class="stern">
                                

                                <nav>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php 
                                                    include 'navigation.php';
                                                    echo $navigation;
                                                ?>   
                                            </div>
                                        </div>
                                    </div>
                                </nav>


                            </div>
                        </div>
                    </div>
                </div>



                <div class="small-nav">
                    <div class="container white">
                        <div class="row">
                            <div class="col-12">
                                    <?php 
                                        include 'navigation.php';
                                        echo $navigation;
                                    ?>    
                            </div>
                        </div>
                    </div>
                </div>

        </header>




        <?php 

            
            $odabranaKategorija = null;

            if(isset($_GET['kategorija'])){

                $odabranaKategorija = $_GET['kategorija'];
        
                $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");
    
    
                if($conn){
    
                    $stmt = $conn->prepare("SELECT id, naslovVijesti, nazivSlike FROM novosti 
                                            WHERE kategorija = ?
                                            AND arhiva = 0
                                            ORDER BY datumObjave DESC;");

                    $stmt->bind_param("s",  $odabranaKategorija );        
                    $stmt->execute();
                    $result1 = $stmt->get_result();
    
                }
            }
           
        
        ?>



        <main>



            <section>

                <div class="container white">
                    <div class="row">
                        <div class="col-12">
                            <h2>ŠEVA ></h2>
                        </div>
                    </div>
                </div>

                <div class="container white">
                    <div class="row">

                        <?php 


                            while ($row1 = $result1->fetch_assoc()) {

                                echo "<div class='col-lg-4 col-md-6'>";

                                    echo "<a href=\"clanak.php?id=". urlencode($row1['id']) ." \" >";

                                        echo "<div class='image-container' >";
                                            echo "<img class='img-fluid' src='img/" . $row1['nazivSlike'] . "' alt=\"\">";
                                        echo "</div>";  

                                        echo "<h4>" .  $row1['naslovVijesti'] . "</h4>";

                                    echo "</a>";
                                        
                                echo "</div>";

                            }
                            


                        ?>

                    </div>
                </div>

            
            </section>

        
        </main>


        <footer>
            <div class="container white">
                <div class="row">
                    <div class="col-12">
                        <div class="center">
                            <p>©Noćna mora | 2022 | Home</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</html>
