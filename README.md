# projeto-teste-imobiliaria

Tecnologias Utilizadas

Linguagens
- PHP 7.4|8.0;
- JavaScript.
- HTML;
- CSS.

Frameworks
- Bootstrap 5;
- JQuery 3;
- FontAwesome.

Template Engine
- Twig Symfony.

DataBase
- Mysql.

Arquitetura
- MVC.

web online
https://imobiliaria.codevila.com.br

Abaixo o modelo do dimensionamento do banco 

<p align="center">
<a href="#"><img src="https://github.com/wesleyvilaseca/projeto-imobiliaria/blob/master/DB/Modelagem%20BD%20Imobiliaria.png" alt="modelo_banco"></a>
</p>

Orientações para subir projeto no seu servidor

No MySQL do seu servidor, crie um baco de dados como o nome que preferir (sujestão: imobiliaria)
e após feito isso, exporte para o seu novo banco de dados o arquivo imobiliaria.sql que se encontrada no diretório ./DB

Concluido essa etapa, no arquivo ./config/config.php informe as credênciais para conexão com o seu banco de dados, como no exemplo abaixo

     - "driver" => "mysql", -> driver de conexão, no nosso caso é mysql
     - "host" => "localhost", -> seu host
     - "port" => "3306", -> sua porta de conexão 
     - "dbname" => "imobiliaria", -> seu banco
     - "username" => "root", -> seu usuário
     - "passwd" => "", -> senha do usuario
