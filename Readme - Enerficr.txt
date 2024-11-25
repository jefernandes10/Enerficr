Portal Administrativo da Enerficr
Descrição do Projeto
O Portal Administrativo da Enerficr é uma aplicação web projetada para gerenciar as operações administrativas da empresa. Ele inclui funcionalidades como:

Cadastro, listagem e exclusão de clientes.
Geração de faturas de consumo.
Relatórios detalhados de consumo.
Visualização de um dashboard integrado ao Power BI.

Funcionalidades Principais

Gerenciamento de Clientes : Adicione, liste e exclua clientes com facilidade.
Geração de Faturas : Crie faturas de consumo de energia com base nos dados registrados.
Relatórios de Consumo : Visualize e exporte relatórios detalhados.
Dashboard : Painel sonoro integrado com Power BI, fornece insights sobre o desempenho da empresa.


Tecnologias Utilizadas
Frontend : HTML, CSS, JavaScript.
Backend : PHP.
Banco de Dados : MySQL.
Relatórios e Dashboards : Power BI.

Pré-Requisitos
Servidor Web : Apache ou Nginx.
PHP : Versão 7.4 ou superior.
MySQL : Versão 5.7 ou superior.
Navegador atualizado.

Instalação
1. Clonar o Repositório
bater

Copiar código
git clone https://github.com/jefernandes10/enerficr-admin-portal.git
cd enerficr-admin-portal

2. Configurar o Banco de Dados
Crie um banco de dados no MySQL.
Importe o arquivo database.sqllocalizado na pasta /db.
Atualizar as credenciais no arquivo config.php:
php

Copiar código
define('DB_HOST', 'localhost');
define('DB_NAME', 'nome_do_banco');
define('DB_USER', 'usuario');
define('DB_PASS', 'senha');

3. Configurar o Servidor
Coloque os arquivos no diretório público do servidor (por exemplo, /var/www/htmlpara Apache).
-se de que o módulo PHP está ativo no servidor.

4. Instale Dependências (se necessário)
Se você estiver usando ferramentas modernas como npm:

Copiar código
npm install

5. Configurar o Power BI
Acesse a área de configuração do dashboard no Power BI.
Atualize o link de incorporação no arquivo /dashboard.htmlpara apontar para o seu painel específico.