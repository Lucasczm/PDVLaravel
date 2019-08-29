# PDV Laravel

Sistema PDV feito em laravel para uma loja de roupas.

### Instalação ambiente de desenvolvimento
 - Renomeie o arquivo `.env.sample` para `.env`
 - Use o comando do docker para subir a aplicação junto com o banco de dados MySQL para desenvolvimento: 
 
`$ docker-compose up -d`

 - Executar `sh ./install.sh` , que irá gerar uma chave para sua aplicação, rodar as migration e seeds, dentro do container do "pdv-app" 

#### Logar no sistema 
 - Utilize  o usuário `admin` e a senha `admin`.

#### Arquivo de exemplo
- Logado no sistema, vá até o menu Backup do sistema e importe o arquivo `sample.sql` que contém registros de exemplo.


### Screenshots

Screenshots na pasta `docs/images`

|                                                |                                             |
| ---------------------------------------------- | ------------------------------------------- |
| ![vendas](https://i.imgur.com/vGh9wj0.png)     | ![caixa](https://i.imgur.com/PFqmr77.png)   |
| ![transações](https://i.imgur.com/cSqW5BF.png) | ![estoque](https://i.imgur.com/phDts5N.png) |
| ![cadastro](https://i.imgur.com/4qBqBOD.png)   | ![backup](https://i.imgur.com/0VR9AJM.png)  |