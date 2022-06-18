<!DOCTYPE html>
<html>

    <head>

        <title>Admin</title>
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



        <main>

            <div class = "container ">
                <div class = "row ">
                    <div class="col-12 center padding50">
                            <h1>Admin panel</h1>
                    </div>
                </div>
            </div>




            
        <?php 

            
            session_start();


            if(isset($_POST['odjava'])){

                #echo "<script>alert(\"AAAAAAAAAAAAA\");</script>";

                unset($_SESSION['ime']);
                unset($_SESSION['dozvola']);
                session_destroy();

                header("Location: prijava.php");
                die();

            }

            if(isset($_SESSION['ime']) &&  isset($_SESSION['dozvola']) ){


                if($_SESSION['dozvola'] != 1){

                    echo "<div class='container white'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='center'>
                                            <p>Bok " . $_SESSION['ime'] . "! Uspješno ste prijavljeni, ali niste administrator.</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    
                        echo "
                        <div class='container white paddingB'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='center'>
                                            <form action=\"\" method=\"POST\">
                                                <button type=\"submit\" name=\"odjava\" class=\"btn btn-secondary\">Odjavi se</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>";
    
    
    
                        echo "
                        <footer>
                            <div class='container white'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='center'>
                                            <p>©Noćna mora | 2022 | Home</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        
                        ";
                }


                else{
                   
                    #citanje podataka iz baze
                    $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");
                    if($conn){

                        $stmt = $conn->prepare("SELECT novosti.* FROM novosti 
                                                WHERE 1 = ?
                                                ORDER BY datumObjave DESC");

                        $uvjet = 1;
                        $stmt->bind_param("s", $uvjet );        
                        $stmt->execute();
                        $result1 = $stmt->get_result();
                    }

                    mysqli_close($conn);




                    #BRISANJE podataka iz baze

                    if(isset($_POST['delete'])){

                        $idToDelete = null;

                        if(isset($_POST['delete-id']))
                            $idToDelete = $_POST['delete-id'];        
                
                        #echo $idToDelete;

                        $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                        if($conn){


                            $stmt = $conn->prepare("DELETE FROM novosti 
                                                    WHERE id = ?");

                            $stmt->bind_param("i", $idToDelete );        
                            $stmt->execute();
                            #$resultDelete = $stmt->get_result();

                            header("Refresh:0");

                        }

                        mysqli_close($conn);
                    }



                    echo "<div class='container white'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='center'>
                                            <p>Uspješno ste prijavljeni kao administrator.</p>
                                    </div>
                                </div>
                            </div>
                        </div>";





                    echo "<div class = 'container padding50-0'>
                    <div class = 'row'>


                    <table class='table table-striped'>

                        <thead>
                            <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>SLIKA</th>
                            <th scope='col'>NASLOV</th>
                            <th scope='col'>PROMJENI</th>
                            <th scope='col'>IZBRIŠI</th>
                            </tr>
                        </thead>

                        <tbody>

                    ";


                    while ($row1 = $result1->fetch_assoc()) {


                        echo "

                                <tr>
                                    <th scope='row'> " . $row1['id'] . "</th>
                                    <td><img src=\"img/". $row1['nazivSlike'] . "\" width=100  ></td>
                                    <td>". $row1['naslovVijesti'] ."</td>

                                    <td>
                                        <form action=\"\" method=\"POST\">
                                            <input type=\"hidden\" name=\"change-id\" value=" .  $row1['id'] . ">
                                            <button type=\"submit\" name=\"change\" class=\"btn btn-primary promjeni\">Promjeni</button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action=\"\" method=\"POST\">
                                            <input type=\"hidden\" name=\"delete-id\" value=" .  $row1['id'] . ">
                                            <button type=\"submit\" name=\"delete\" class=\"btn btn-danger\">Izbriši</button>
                                        </form>
                                    </td>

                                </tr>

                            ";


                    }

                    echo "       <tbody> 
                            </table>
                        </div>
                    </div>";


                    
                    echo "
                    <div class='container white paddingB'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='center'>
                                        <form action=\"\" method=\"POST\">
                                            <button type=\"submit\" name=\"odjava\" class=\"btn btn-secondary\">Odjavi se</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>";



                    echo "
                    <footer>
                        <div class='container white'>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='center'>
                                        <p>©Noćna mora | 2022 | Home</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    
                    ";




                }
            }
            else{
               
                header("Location: prijava.php");
                die();
            }
        ?>


        </main>
    </body>






    <?php

            echo "
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous' referrerpolicy='no-referrer'></script>
                    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
                    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
            ";


        #UPDATE################################################################################################################################






        if(isset($_POST['update'])){

            
            $id2 = null;
            $title2 = null;
            $about2 = null;
            $content2 = null;
            $photo2 = null;
            $category2 = null;
            $archive2 = null;


    

            if( isset($_POST['idToUpdate']) &&  isset($_POST['title'])  && isset($_POST['about']) && isset($_POST['content']) && isset($_POST['category']) ) {
      
                    $id2 = $_POST['idToUpdate'];
                    $title2 = $_POST['title'];
                    $about2 = $_POST['about'];
                    $content2 = $_POST['content'];
                    $category2 = $_POST['category'];

                    
                    if(isset($_FILES['pphoto']) && strcmp($_FILES['pphoto']['name'], "") != 0){

                        #echo "<script>alert(\"AAAAAAAAAAAAA\");</script>";

                        $photo2 = $_FILES['pphoto']['name'];
                        $target = 'img/' .  $photo2; 
                        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target);
                    
                    }
                    else{

                        $photo2 = $_POST['slika'];
                        #echo "<script>alert( ". $photo2 . ");</script>";
                    }
                    

                    if(isset($_POST['archive'])){
                        #echo "POSTAVLJEN";
                        $archive2 = 1;
                    }
                    else{
                        #echo "NIJE POSTAVLJEN";
                        $archive2 = 0;
                    }


                    $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                        if($conn){

                            
                            #echo "<script>alert('AAAAAAAAAAAAAAAAA');</script>";

                            $stmt = $conn->prepare("UPDATE novosti
                                                SET naslovVijesti = ?,
                                                opisVijesti = ?,
                                                sadrzajVijesti = ?,
                                                nazivSlike = ?,
                                                kategorija = ?,
                                                arhiva = ?,
                                                datumObjave = CURDATE()
                                                WHERE id = ?");
        
                            $stmt->bind_param("ssssssi", $title2, $about2, $content2, $photo2, $category2, $archive2, $id2);
                            $stmt->execute();


                            echo "<meta http-equiv=\"refresh\" content=\"0\">";

                        }

                    mysqli_close($conn);
                   
            }
            
            

        }
        ##########################################################################################################################################
    ?>



    <?php 


            





            $id = null;
            $title = null;
            $about = null; 
            $content = null;
            $photo = null;
            $category = null;
            $date = null;

            $rowS = null;
            $idToUpdate;
            
            if(isset($_POST['change-id'])){

                $idToUpdate = $_POST['change-id'];
            
                    #echo "<script>alert(". $idToUpdate .");</script>";

                        $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                        if($conn){
        
                            $stmt = $conn->prepare("SELECT novosti.* FROM novosti 
                                                WHERE id = ?");
        
                            $stmt->bind_param("i", $idToUpdate);
                            $stmt->execute();
                            $result1 = $stmt->get_result();
                            
                            $rowS = $result1->fetch_assoc();
                            
                            if($result1){
                                
                                $id = $rowS['id'];
                                $title = $rowS['naslovVijesti'];
                                $about = $rowS['opisVijesti']; 
                                $content = $rowS['sadrzajVijesti'];
                                $photo = $rowS['nazivSlike'];

                        
                                $category = $rowS['kategorija'];
                                $archive = $rowS['arhiva'];

                            }

                        
                        }

                        mysqli_close($conn);

                #forma


                echo "
                <!-- Modal -->

                <div class='modal fade' id='promjenaId2' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>

                <div class='modal-dialog modal-lg' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Izmjena članka</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
    
                    <form action='' method='POST' enctype=\"multipart/form-data\">

        
                        <div class='modal-body'>

                                    <input type='hidden' name='idToUpdate' value='$id'>
                                    <input type='hidden' name='slika' value='$photo'>

                                    <div class='form-group'>
                                        <label for='title' class='col-form-label'>Naslov vijesti</label>
                                        <div class='form-field'>
                                            <input type='text' name='title' id='title' class='form-control' value=\"". $title ."\">
                                        </div>
                                        <span id='titleSpan' class='error'></span>
                                    </div>
    
                                    <div class='form-group'>
                                        <label for='about' class='col-form-label'>Kratki sadržaj vijesti (do 50 znakova)</label>
                                        <div class='form-field'>
                                            <textarea name='about' id='smallContent' cols='30' rows='10' class='form-control'>" . $about . "</textarea>
                                        </div>
                                        <span id='smallContentSpan' class='error'></span>
                                    </div>
    
                                    <div class='form-group'>
                                        <label for='content' class='col-form-label'>Sadržaj vijesti</label>
                                        <div class='form-field'>
                                            <textarea name='content' id='content' cols='30' rows='10'class='form-control'>" . $content . "</textarea>
                                        </div>
                                        <span id='contentSpan' class='error'></span>
                                    </div>
    
                                    
                                    <div class='form-group'>
                                        <label for='pphoto' class='col-form-label'>Odabrana slika bila je \"" .$photo. "\"<br>
                                        Ukoliko želite drugu sliku, odaberite ju pomocu izbornika ispod.
                                        </label>
                                            <div class='form-field'>
                                                <input type='file' id='photo' accept='image/jpg,image/gif' class='form-control' name='pphoto'/>
                                            </div>
                                            <span id='photoSpan' class='error'></span>
                                    </div>
    
                                    <div class='form-group'>
                                        <label for='category' class='col-form-label'>Kategorija vijesti</label>
                                        <div class='form-field' class='form-label'>
                                            <select name='category' id='category' class='form-control'>
                                               
                                    ";


                                    #select za kategorije

                                    if(strcmp($category ,"Ševa") == 0){
                                        echo "<option selected=\"selected\" value='Ševa'>Ševa</option>";
                                        echo "<option value='Ostatak ekipe'>Ostatak ekipe</option>";
                                    }
                                    else{
                                        echo "<option value='Ševa'>Ševa</option>";
                                        echo "<option selected=\"selected\" value='Ostatak ekipe'>Ostatak ekipe</option>";
                                    }



                                echo "
                                            </select>
                                        </div>
                                        <span id='categorySpan' class='error'></span>
                                    </div>
    
                                    <div class='form-group'>
                                        <label class='col-form-label'>Spremiti u arhivu:
                                            <div class='form-field' style='padding-left:20px;'>";

                                #checkbox

                                if($archive){
                                    echo "<input class='form-check-input' type='checkbox' name='archive' checked>";
                                }
                                    
                                else{
                                    echo "<input class='form-check-input' type='checkbox' name='archive'>";
                                }
                                    
                                
                                echo "
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class='modal-footer'>
                                        <div class='form-group'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Poništi</button>
                                            <button type='submit' id='gumb' name='update' class='btn btn-primary'>Prihvati</button>
                                        </div>
                                </div>


                        </form>
                
                        </div>
                    </div>
                </div>";
 

                echo "<script>
                        $('#promjenaId2').modal('show')
                    </script>";

            }
        
    ?>















    <script type = "text/javascript">
        

        document.getElementById("gumb").onclick = function(event) {


            var slanje_forme = true;

            var slanje_forme = true;

            //NASLOV
            var poljeTitle = document.getElementById("title");
            var title = document.getElementById("title").value;

            if (title.length < 5 || title.length > 30) {

                slanje_forme = false;
                poljeTitle.style.border = "2px solid red";
                poljeTitle.classList.add("a");


                document.getElementById("titleSpan").innerHTML = "Naslov mora biti između 5 i 30 znakova!";
            }
            else{
                document.getElementById("titleSpan").innerHTML = "";
                poljeTitle.style.border = "";
                poljeTitle.classList.remove("a");
            }


            //KRATKI SADRŽAJ
            var poljeSmallContent = document.getElementById("smallContent");
            var smallContent = document.getElementById("smallContent").value;

            if (smallContent.length < 10 || smallContent.length > 100) {

                slanje_forme = false;
                poljeSmallContent.style.border = "2px solid red";
                poljeSmallContent.classList.add("a");

                document.getElementById("smallContentSpan").innerHTML = "Kratki sadržaj mora biti između 10 i 100 znakova!";
            }
            else{
                poljeSmallContent.style.border = "";
                document.getElementById("smallContentSpan").innerHTML = "";
                poljeSmallContent.classList.remove("a");
            }

            //SADRŽAJ
            var poljeContent = document.getElementById("content");
            var content = document.getElementById("content").value;

            if (content.length < 1) {

                slanje_forme = false;
                poljeContent.style.border = "2px solid red";
                poljeContent.classList.add("a");
                document.getElementById("contentSpan").innerHTML = "Sadržaj je obavezan!";
            
            }
            else{
                poljeContent.style.border = "";
                document.getElementById("contentSpan").innerHTML = "";
                poljeContent.classList.remove("a");
            }


            
            //SLIKA
            /*
            var poljePhoto = document.getElementById("photo");
            var photo = document.getElementById("photo").value;

            if (photo.length < 1) {

                slanje_forme = false;
                poljePhoto.style.border = "2px solid red";
                poljePhoto.classList.add("a");
                document.getElementById("photoSpan").innerHTML = "Slika je obavezna!";
            
            }
            else{
                poljePhoto.style.border = "";
                document.getElementById("photoSpan").innerHTML = "";
                poljePhoto.classList.remove("a");
            }
            */


            //KATEGORIJA
            var poljeCategory = document.getElementById("category");
            var category= document.getElementById("category").value;


            if (category.length < 1) {

                slanje_forme = false;
                poljeCategory.style.border = "2px solid red";
                poljeCategory.classList.add("a");
                document.getElementById("categorySpan").innerHTML = "Kategorija je obavezna!";
            
            }
            else{
                poljeCategory.style.border = "";
                document.getElementById("categorySpan").innerHTML = "";
                poljeCategory.classList.remove("a");
            }

            

            //SLANJE FORME
            if (slanje_forme != true) {
                event.preventDefault();
            }

        }



    </script>

</html>
