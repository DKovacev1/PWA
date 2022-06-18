<!DOCTYPE html>
<html>

    <head>

        <title>Unos</title>
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
            
                <div class="container white"> 
                    <div class="row">
                        <div class="col-12"> 


                            <form action="skripta.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title" class="col-form-label">Naslov vijesti</label>
                                    <div class="form-field">
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                    <span id="titleSpan" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="about"  class="col-form-label">Kratki sadržaj vijesti (do 50 znakova)</label>
                                    <div class="form-field">
                                        <textarea name="about" id="smallContent" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <span id="smallContentSpan" class="error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="content" class="col-form-label">Sadržaj vijesti</label>
                                    <div class="form-field">
                                        <textarea name="content" id="content" cols="30" rows="10"class="form-control"></textarea>
                                    </div>
                                    <span id="contentSpan" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="pphoto" class="col-form-label">Slika: </label>
                                        <div class="form-field">
                                            <input type="file" id="photo" accept="image/jpg,image/gif" class="form-control" name="pphoto"/>
                                        </div>
                                        <span id="photoSpan" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="category" class="col-form-label">Kategorija vijesti</label>
                                    <div class="form-field" class="form-label">
                                        <select name="category" id="category" class="form-control">
                                            <option hidden selected value=""></option>
                                            <option value="Ševa">Ševa</option>
                                            <option value="Ostatak ekipe">Ostatak ekipe</option>
                                        </select>
                                    </div>
                                    <span id="categorySpan" class="error"></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Spremiti u arhivu:
                                        <div class="form-field " style='padding-left:20px; padding-bottom: 20px;'>
                                            <input class="form-check-input" type="checkbox" name="archive">
                                        </div>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mb-3" id="gumb" value="Prihvati">Prihvati</button>
                                    <button type="reset" class="btn btn-secondary mb-3" value="Poništi">Poništi</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

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


    <script type = "text/javascript">
        

        document.getElementById("gumb").onclick = function(event) {


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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</html>
