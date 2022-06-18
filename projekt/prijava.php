<!DOCTYPE html>
<html>

    <head>

        <title>Prijava</title>
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

                            <h2 class="center padding50-0">PRIJAVA</h2>

                            <div class='form-group'>
                                            <label for='title' class='col-form-label'>Korisničko ime:</label>
                                                <div class='form-field'>
                                                    <input type='text' name='ime' id='ime' class='form-control' >
                                                </div>
                            </div>

                         


                            <div class='form-group'>
                                            <label for='lozinka' class='col-form-label'>Lozinka:</label>
                                                <div class='form-field'>
                                                    <input type='password' name='lozinka' id='lozinka' class='form-control' >
                                                </div>
                            </div><br>
           
                     

                            <?php 

                            session_start();


                            if(isset($_SESSION['ime']) &&  isset($_SESSION['dozvola']) ){

                                header("Location: administrator.php");
                                die();

                            }
            


                            
                            if(isset($_POST['gumb'])){

                                if(isset($_POST['ime']) && isset($_POST['lozinka'])){


                                    $ime = $_POST['ime'];
                                    $lozinka = $_POST['lozinka'];

                                    $conn = new mysqli("127.0.0.1", "root", "", "bazavijesti");

                                        if($conn){

                                            
                                            #echo "<script>alert('AAAAAAAAAAAAAAAAA');</script>";

                                            $stmt = $conn->prepare("SELECT * FROM korisnici
                                                                WHERE ime = ?");

                                            $stmt->bind_param("s", $ime);
                                            $stmt->execute();
                                            $result = $stmt->get_result();



                                            if($row = $result->fetch_assoc()){

                                               
                                                if( password_verify($lozinka, $row['lozinka']) ) {



                                                    $_SESSION['ime'] = $row['ime'];
                                                    $_SESSION['dozvola'] = $row['dozvola'];


                                                    header("Location: administrator.php");
                                                    die();


                                                }
                                                else{
                                                    
                                                    echo "<p class=\"error center\">Pogrešno korisničko ime ili lozinka!</p>";
                                                    echo " <div class='form-group center padding20'>
                                                            <p>Nemate račun? 
                                                                <a href=\"registracija.php\"> 
                                                                    <button type='button' id='reg' name='reg' class='btn btn-secondary btn-sm'>Registrirajte se</button>
                                                                </a>
                                                            </p>
                                                        </div>";
                                                }


                                            }

                                            else{
                                                echo "<p class=\"error center\">Pogrešno korisničko ime ili lozinka!</p>";
                                                echo " <div class='form-group center padding20'>
                                                            <p>Nemate račun? 
                                                                <a href=\"registracija.php\"> 
                                                                    <button type='button' id='reg' name='reg' class='btn btn-secondary btn-sm'>Registrirajte se</button>
                                                                </a>
                                                            </p>
                                                        </div>";
                                            }

                                        }

                                    mysqli_close($conn);




                                }

                            }
  
                        ?>


                            <div class="center">
                                <button type='submit' id='gumb' name='gumb' class="btn btn-primary btn-lg">Prijavi se</button>
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





</html>
