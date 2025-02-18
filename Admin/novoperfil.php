<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Gestor Estoque</title>

  <!-- Favicons -->
  <link href="img/icon.jpg" rel="icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

  

</head>

<body style="color:#666; background: #eaeaea;">
  <div class="container">
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    
      <form role="form" action="" method="post" enctype="multipart/form-data" id="form_NovoPerfil">
       
      

<div class="col-lg-6" style="margin-left: 25%; margin-top: 5%;">

   <h2 class="form-login-heading">Criar Conta</h2>
  
                       <div class="form-group ">
                              <label class="control-label">Nome</label>                    
                              <input  type="text" lenght="10" placeholder=" " name="nome" id="nome" class="form-control" required="">                     
                        </div>

                        <div class="form-group">

                             <label class="control-label"> Foto do Perfil </label>                           
                              <input type="file"  placeholder=" " name="avatar" id="imgP" id="exampleInputFile" class="file-pos" required="">               
                        </div>

                        <div class="form-group">
                            <label class="control-label">E-mail</label>
                            <input type="text" placeholder=" " name="email" id="email" class="form-control" required="">
                       </div>
                           

                   <div class="row">
              


                          <div class="col-lg-6">
                            <div class="form-group ">
                              <label class="control-label">Telefone</label>
                              <input type="text"  placeholder=" " name="fone" id="fone" class="form-control" required="">
                          </div>
                          </div>

                          <div class="col-lg-6">
                               <div class="form-group">
                              <label class="control-label">CPF</label>
                              <input type="text" placeholder=" " name="cpf" id="cpf" class="form-control" required="">
                          </div>
                          </div>

                          <input type="hidden" name="status" value="0">

                        <div class="col-lg-6">
                            <div class="form-group">
                              <label class="control-label">Digite sua senha</label>
                              <input type="password" placeholder=" " name="senha"  id="senha" id="addr1" class="form-control" required=""> 
<span class="lnr lnr-eye" style="color: #000000; background: none; position: absolute; top: 35px; right: 25px;"></span>
                             
                          </div>

                          </div>


                        



            </div>

 <button class="btn btn-theme " name="botaoPerfil" type="submit"><i class=""></i> Criar</button>
          <hr>
          </form>
<?php
							include_once('conect/conect.php');
						      if (isset($_POST['botaoPerfil'])) {
			$nome = $_POST['nome'];
      $email = $_POST['email'];
      $fone = $_POST['fone'];
      $cpf = $_POST['cpf'];
		    $senha =     trim(strip_tags(base64_encode($_POST['senha'])));
			$status = $_POST['status'];
			$formatosPermitidos = array("png","jpeg","jpg","gif");
			$extensao = pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
			if(in_array($extensao, $formatosPermitidos)):
				//echo "Existe a extenção .{$extensao}";
				$pasta = "img/";
				$temporario = $_FILES['avatar']['tmp_name'];
				$novoNome = uniqid().".{$extensao}";

				if (move_uploaded_file($temporario, $pasta.$novoNome)) {
							$cadastro = "INSERT INTO admin (avatar,nome,fone,email,cpf,senha,status) VALUES (:avatar,:nome,:fone,:email,:cpf,:senha,:status)";

				            try{
                      $result = $conect->prepare($cadastro);
                        $result->bindParam(':avatar',$novoNome,PDO::PARAM_STR);
                        $result->bindParam(':nome',$nome,PDO::PARAM_STR);
                        $result->bindParam(':fone',$fone,PDO::PARAM_STR);
                        $result->bindParam(':email',$email,PDO::PARAM_STR);
                        $result->bindParam(':cpf',$cpf,PDO::PARAM_STR);
				                $result->bindParam(':senha',$senha,PDO::PARAM_STR);			              
				                $result->bindParam(':status',$status,PDO::PARAM_INT);
				                $result->execute();

				                $contar = $result->rowCount();
				                if($contar>0){
				                	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>CADASTRADO COM SUCESSO!</strong> Acesso solicitado ao administrador</div>';
				                	header("Location: index.php");
				                }else{
				                	echo 'Dados não cadastrados!';
				           
				                }
				            }catch(PDOException $e){
				                echo "<b>ERRO DE PDO= </b>".$e->getMessage();
				            }
					//$mensagem = "Upload feito com sucesso!";
				}else{
					$mensagem = "Erro, não foi possivel fazer o upload do arquivo!";
				}
			else:
				echo  "Formato inválido";
			endif;
			//var_dump($_FILES);
		}
						    ?>


</div>
     


    

    
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>


<script type="text/javascript" src="lib/bootstrap/js/jQueryMasked.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/util.validate.js"></script>



    <script>
    jQuery(function($){
      $("#cpf").mask('999.999.999-99');
      $("#fone").mask('(99) 99999-9999');
    });
    </script>


<script>
    let btn = document.querySelector('.lnr-eye');

btn.addEventListener('click', function() {

    let input = document.querySelector('#senha');

    if(input.getAttribute('type') == 'password') {
        input.setAttribute('type', 'text');
    } else {
        input.setAttribute('type', 'password');
    }

});
    
    </script>


<script>
    $(function(){
        $("#form_NovoPerfil").validate({
          rules: {
            nome:{
              required: true
            },
            avatar:{
              required: true
            },
            email:{
              required: true
            },
            fone:{
              required: true
            },
            cpf:{
              required: true,
               cpf:'both'
            },
            senha:{
              required: true
            },
           
          },
          messages: {
            nome: {
              required: "Digite seu nome!"
            },
            avatar: {
              required: "Envio de foto obrigatório!"
            },
            email: {
              required: "Digite seu e-mail!"
            },
            fone: {
              required: "Digite seu telefone!"
            },
            cpf: {
              required: "Digite um CPF válido!",
               cpf:"Por favor digite um CPF válido!"
            },
            senha: {
              required: "Digite sua senha!"
            },
            
          }
        });
    });
    </script>


















</body>

</html>
