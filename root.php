<?php

$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];

function autenticaUsuario($usuario, $senha) {
                  
    // Na variavel data eu crio um array de chave -> valor com os parametros que eu peguei
    $data = array("usuario" => $usuario, "senha" => $senha); 

    // Como a api espera um json, eu vo converter o array em json usando a função nativa do php json_encode                                                                   
    $data_string = json_encode($data);   

    // Pra fazer a chamada eu vou usar o curl, então eu crio uma variavel que no caso chamei de ch e inicializei o curl com o comando php curl_init passando a rota da api.
    $ch = curl_init('http://api.fecap.br:8090/AuthRM');  

    // dai eu vou setando as configurações da chamada usando a funcao curl_setopt passando o ch (que é meu curl inicializado) e setando o que precisa ser setado
    // CURLOPT_CUSTOMREQUEST é pra definir qual tipo de chamada, eu quero POST então eu configuro.

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    
    //  CURLOPT_POSTFIELDS é pra dizer o que eu quero no corpo, então vo passar o meu data_string que é o meu json de usuário e senha  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);       
     
    // CURLOPT_RETURNTRANSFER essa opção é pra que na resposta ele me responda em string de texto entao eu configuro true, verdadeiro                                                           
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    
    // CURLOPT_HTTPHEADER é pra definir o cabeçalho da chamada avisando a API do outro lado o que tem nela, então eu aviso que é um json e aviso o tamanho do conteudo em caracteres, que contei com a função do php strlen da variavel que tem o corpo que é a data_string                                                    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
    );                                       
    // aqui eu uso curl_exec pra executar o curl inicializado, depois de configurar todos os parametros e guardo o resultado na variavel retorno
    $retorno = curl_exec($ch);                                                            
    // dai eu uso o curl_getinfo de CURLINFO_HTTP_CODE pra pegar o código de resposta pra poder ver e tratar o que o servidor da api respondeu
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
     // o nosso resultado vem em texto mas é em formato JSON, entao converto ele pra array pra manipular melhor dentro do php usando a função json_decode (que é o inverso de json_encode usado la em cima)
    $result = json_decode($retorno);

     //na resposta eu sei que eu tenho token usuário e nome só não lembro se vai estar dentro de data. vale a pena printar com print_r a variavel result pra poder extrair direito aqui pras variaveis.

    //aqui eu trato o http code que a gente pegou ali em cima de resposta, se a api responde 401 quando usuário e senha ta errado eu trato o retorno, se for 200 é pq tava certo então devolvo sucesso e o usuário logado
        if($httpcode == 401) {
        echo "<script>
        alert('Usúario ou senha inválidos!');
        window.location.href='index.php';
        </script>";
            
      
  
        } else if($httpcode == 200) {
        echo "Login válido, usuario: ". $usuario ."<br><br>";
                $token   =    $result->token;
                $usuario =    $result->usuario;
                $nome    =    $result->nome;    

                echo "Token: $token<br>";
                echo "Usuário: $usuario<br>";
                echo "Nome: $nome<br>";
        }
        }

        autenticaUsuario($usuario, $senha);
        







