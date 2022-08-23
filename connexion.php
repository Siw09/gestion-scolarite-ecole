







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Gestion de scolarité</title>


    <!-- Google Font: Source Sans Pro 
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/css/adminlte.min.css">
</head>
<body>
  <div class="container ">
      <div class="row  m-5 p-5 ">
      
          <div class=" col-3 col-md-2 col-sm-1"> </div>
          <div class="centre col-12 col-md-8 col-sm-10 card card-outline card-success card">

          <div class="card-header text-center">

            <a href="#" class="h1"><b>Ges</b>Scolarité</a>

            </div>
          <p class="login-box-msg">Se connecter</p>

            <form>
                <div class="col-sm-12 mb-3">

                    <label for="inscription-email">

                        Email ou nom d'utilisateur:

                        <span class="text-danger">(*)</span>

                    </label>

                    <div class="input-group mb-3">

                        <input type="text" name="email-nom-utilisateur" id="inscription-email" class="form-control" placeholder="Veuillez entrer votre address email ou votre nom d'utilisateur" value="" required="">

                        <div class="input-group-append">

                            <div class="input-group-text bg-light">

                                <span class="fas fa-envelope"></span>

                            </div>

                        </div>

                    </div>

                    <span class="text-danger">

                        
                    </span>

                </div>

                <div class="col-sm-12 mb-3">

                    <label for="inscription-mot-passe">

                        Mot de passe:

                        <span class="text-danger">(*)</span>

                    </label>

                    <div class="input-group mb-3">

                        <input type="password" name="mot-passe" id="inscription-mot-passe" class="form-control" placeholder="Veuillez entrer votre mot de passe" value="" required="">

                        <div class="input-group-append">

                            <div class="input-group-text bg-light" >

                                <span class="fas  fa-key"></span>

                            </div>

                        </div>

                    </div>

                    <span class="text-danger">

                        
                    </span>

                </div>
                <div >
                <div class="container ">
                  <div class="row  ">

                    <div class="col-lg-7 "></div>
              
                    <div class="col-lg-5 sm-12">  <button type="submit" class="btn btn-success btn-block">Submit</button>  </div>
                    </div>
                  <div class="  pb-3  ">
                  <a href="inscription.php" class="text-center m-3  mb-5 ">S'inscrire</a>

                  </div>
                </div>
              </form>

          </div>
          <div class=" col-3 col-md-2 col-sm-1"> </div>
      </div>
  </div>
    
</body>
</html>