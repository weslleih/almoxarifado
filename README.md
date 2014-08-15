Almoxarifado
============

Simples controle de estoque, focado nas necessidades básicas de um órgão público federal.

Recursos
------------
- Multiplos usuários com nível hierárquico
  - **Administrador**: administra usuários e faz consulta de estoque
  - **Operador**: gerencia: estoque, grupos, fornecedores e consumidores
  - **Consumidor**: faz consulta de estoque
- Grupos de produtos
- Fornecedores
- Consumidores
- Relatórios
- Log de alterações

Requisitos
------------
### Servidor
- Apache 2.2+
- PHP 5.3+
- MySQL 5.5+

### Cliente
- Internet Explorer 10+
- Mozilla Firefox 4+
- Google Chrome 22+

Instalação
------------
- Baixe a última versão estável [aqui](https://github.com/weslleih/almoxarifado/releases).
- Descompacte no local desejado (indexado pelo Apache)
- Edite o arquivo ``` application/config/database.php ``` nas linhas:
  - ``` $db['default']['username'] = ''; ``` Nome do usuário MySQL
  - ``` $db['default']['password'] = ''; ``` Senha do usuário
  - ``` $db['default']['database'] = ''; ``` Nome do banco de dados
- Execute este [SQL](https://github.com/weslleih/almoxarifado/blob/master/application/installation/database.sql) para terminar a configuração do banco de dados
- Edite o aquivo ``` application/config/config.php ``` na linha:
  - ``` $config['encryption_key'] = ''; ``` Com uma chave de segurança de 32 caracteres (256 bits) que pode ser gerada [aqui](http://randomkeygen.com/)
- Agora basta acessar a url definida nas configurações do Apache.
- Primeiro login:
  - Usuário: **admin**
  - Senha: **123456**

Créditos
------------
- Distribuído sob licença [MIT](https://github.com/weslleih/almoxarifado/blob/master/LICENSE) 
- [CodeIgniter](http://ellislab.com/codeigniter) Copyright (c) 2008 - 2014, EllisLab, Inc.
- [jQuery](https://jquery.org) Copyright 2014 The jQuery Foundation.
- [Bootstrap](http://getbootstrap.com/) Copyright (c) 2011-2014 Twitter, Inc.
- [Numeric](http://www.texotela.co.uk/code/jquery/numeric/) Copyright (c) 2006-2014 Sam Collett
- [Select2](http://ivaynberg.github.io/select2/) Copyright (c) 2012 Igor Vaynberg
- [bootstrap-datepicker](http://www.eyecon.ro/bootstrap-datepicker) Copyright 2012 Stefan Petre
- [Select2 Bootstrap CSS](http://fk.github.io/select2-bootstrap-css/) Copyright 2013 Florian Kissling