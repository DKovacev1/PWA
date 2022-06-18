<!DOCTYPE html>
<html>

    <head>

        <title>Registracija</title>
        <meta charset="UTF-8"/>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="author" content="Damjan Kovačev">
        <meta name="description" content="">        

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        
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



            <div calss="container">
                <div class="row login ">
                    <div class="col paddingForm">
                                
                        <form method="post" action="">

                            <h2 class="center padding50-0">REGISTRACIJA</h2>

                            <div class='form-group'>
                                            <label for='title' class='col-form-label'>Korisničko ime:</label>
                                                <div class='form-field'>
                                                    <input type='text' name='ime' id='ime' class='form-control' >
                                                </div>
                                                <span class="error" id="imeSpan"></span>
                            </div>

                           
                            

                            <div class='form-group'>
                                            <label for='lozinka' class='col-form-label'>Lozinka:</label>
                                                <div class='form-field'>
                                                    <input type='password' name='lozinka' id='lozinka' class='form-control' >
                                                </div>
                                                <span class="error" id="lozinkaSpan"></span>
                            </div>

                            <div class='form-group'>
                                            <label for='lozinka2' class='col-form-label'>Ponovljena lozinka:</label>
                                                <div class='form-field'>
                                                    <input type='password' name='lozinka2' id='lozinka2' class='form-control' >
                                                </div>
                                                <span class="error" id="lozinkaSpan2"></span>
                            </div><br>


                            <?php 
                                
                                $imePostoji = false;

                    
                                if(isset($_POST['gumb'])){

                                    if(isset($_POST['ime']) && isset($_POST['lozinka'])){
    
                                        #echo "<script>alert('AAAAAAAAAAAAAAAAA');</script>";
                                    
                                        $ime = $_POST['ime'];
                                        $lozinka = $_POST['lozinka'];

                                        $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                                            if($conn){

                                                $stmt = $conn->prepare("SELECT * FROM korisnici
                                                                    WHERE ime = ?");

                                                $stmt->bind_param("s", $ime);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if($row = $result->fetch_assoc()){

                                                    $imePostoji = true;

                                                    echo "<p class=\"error center\">Korisnički račun s ovim imenom već postoji!</p>";

                                                }


                                            }

                                        mysqli_close($conn);
                                    }
                                }
                            
                            
                            ?>

                            <?php 
                            
                                
                                if(!$imePostoji){

                                    if(isset($_POST['gumb'])){

                                        if(isset($_POST['ime']) && isset($_POST['lozinka'])){



                                            $ime = $_POST['ime'];
                                            $lozinka = password_hash($_POST['lozinka'], CRYPT_BLOWFISH);

                                            $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                                                if($conn){

                                                    $stmt = $conn->prepare("INSERT INTO korisnici(ime, lozinka)
                                                                            VALUES(?,?);");

                                                    $stmt->bind_param("ss", $ime, $lozinka);
                                                    $stmt->execute();
                                                                        

                                                }

                                            mysqli_close($conn);

                                        }
                                    }
                                }
            
                            ?>


                            <div class="center">
                                <button type='submit' id='gumb' name='gumb' class="btn btn-primary btn-lg">Registriraj se</button>
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

            //IME
            var poljeIme = document.getElementById("ime");
            var ime = document.getElementById("ime").value;

            if (ime.length < 5 ) {
                slanje_forme = false;
                poljeIme.style.border = "2px solid red";
                poljeIme.classList.add("a");

                document.getElementById("imeSpan").innerHTML = "Ime mora biti biti dulje od 5 znakova!";
            }
            else{
                document.getElementById("imeSpan").innerHTML = "";
                poljeIme.style.border = "";
                poljeIme.classList.remove("a");
            }


            //LOZINKA
            var poljeLozinka = document.getElementById("lozinka");
            var lozinka = document.getElementById("lozinka").value;

            if (lozinka.length < 5 ) {
                slanje_forme = false;
                poljeLozinka.style.border = "2px solid red";
                poljeLozinka.classList.add("a");

                document.getElementById("lozinkaSpan").innerHTML = "Lozinka mora biti dulja od 5 znakova!";
            }
            else{
                document.getElementById("lozinkaSpan").innerHTML = "";
                poljeLozinka.style.border = "";
                poljeLozinka.classList.remove("a");
            }

        

            //LOZINKA2
            var poljeLozinka2 = document.getElementById("lozinka2");
            var lozinka2 = document.getElementById("lozinka2").value;

            if (lozinka2.length < 5 ) {
                slanje_forme = false;
                poljeLozinka2.style.border = "2px solid red";
                poljeLozinka2.classList.add("a");

                document.getElementById("lozinkaSpan2").innerHTML = "Ponovljena lozinka mora biti dulja od 5 znakova!";
            }
            else{
                document.getElementById("lozinkaSpan2").innerHTML = "";
                poljeLozinka2.style.border = "";
                poljeLozinka2.classList.remove("a");
            }


            //LOZINKA = LOZINKA2 ?

            if (lozinka != lozinka2 ) {
                slanje_forme = false;

                poljeLozinka.style.border = "2px solid red";
                poljeLozinka.classList.add("a");
                poljeLozinka2.style.border = "2px solid red";
                poljeLozinka2.classList.add("a");

                document.getElementById("lozinkaSpan2").innerHTML = "Lozinke moraju biti iste!";
            }
            else{

                document.getElementById("lozinkaSpan").innerHTML = "";
                poljeLozinka.style.border = "";
                poljeLozinka.classList.remove("a");
                document.getElementById("lozinkaSpan2").innerHTML = "";
                poljeLozinka2.style.border = "";
                poljeLozinka2.classList.remove("a");
            }


            //SLANJE FORME
            if (slanje_forme != true) {
                event.preventDefault();
            }

        }

    </script>

</html>
