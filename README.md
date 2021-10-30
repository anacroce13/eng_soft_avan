# Controle de Resíduos Simples 
### Projeto em PHP de resolução de exercícios de tópicos avançados de Engenharia de Software, CCT UDESC

O objetivo deste projeto é demonstrar o uso de padrões de projeto no desenvolvimento de software.

**_Padrões designados para mim_**: 
 * Abstract Factory
 * Adapter
 * Command

**_Escopo_**: Informações que precisam ser mantidas pela empresa (*Contract Garbage*) de controle de resíduos, que cuida do lixo e da eliminação de resíduos para terceiros. A coluna **Volume** representa toneladas de resíduos.

Aterro Sanitário | Proprietário do Caminhão | Tipo de Resíduo | Volume | Devedor
---------------- | ------------------------ | --------------- | ------ | -------
Brusque | Sergio | Lixo | 10 | Conti
Canoinhas | Hector | Construção | 14 | Omar
Brusque | Davi | Lixo | 14 | Jose
Brusque | Sergio | Estrume | 22 | Conti
Blumenau | Diego | Detergentes | 15 | Marcos
Canoinhas | Olivia | Lixo | 17 | Conti

**_Objetivo_**: Desenvolver um software que possa armazenar esses dados e emitir relatórios que são de interesse da empresa.
* _Relatório 1_: Lista de todos os resíduos despejados na área de Canoinhas.
* _Relatório 2_: Volume total de lixo despejado na área de Brusque.
* _Relatório 3_: Todo o resíduo pago por Conti classificado por tipo e pela área aterrada.

## Como organizei o fluxo de trabalho
### Sequência de Atividades para desenvolvimento desta aplicação:
1. Analisar as entidades à partir do conjunto de dados apresentado. 
   * Por ter mais facilidade com SQL, iniciei montando um banco de dados em **mysql**, cujo backup se encontra na raíz deste repositório.
   * Criei um novo banco de dados nomeado `bd_ctrlresiduos`, com o _collation_ `utf8_general_ci`.
   * Desta forma, montei as seguintes tabelas e campos:
     * aterro
     	* id, `INT(11)`, `PK`, `AI`
     	* nome, `VARCHAR(100)`
     * caminhao
     	* id, `INT(11)`, `PK`, `AI`
     	* proprietario, `VARCHAR(100)`
     * movimentacao
     	* id, `INT(11)`, `PK`, `AI`
     	* aterro_id, `FK`
     	* caminhao_id, `FK`
     	* devedor_id, `FK`
     	* tipo_residuo_id, `FK`
     	* volume, `FLOAT(9,2)`
     * devedor
     	* id, `INT(11)`, `PK`, `AI` 
     	* nome, `VARCHAR(100)`
     * tipo_residuo
        * id, `INT(11)`, `PK`, `AI`
        * nome, `VARCHAR(50)`
   * Mesmo sabendo que o escopo poderia ser simplificado em uma _única_ tabela, não segui este caminho para que seja possível adicionar mais atributos às entidades e evitar repetições de informações cadastrais.

2. Montar as instruções SQL das consultas previstas dos relatórios solicitados.
   * Priorizei essa etapa por conhecer melhor a linguagem SQL. Os CRUDs foram abordados mais adiante. 
   * _Relatório 1_:
      ```sql
      SELECT a.nome AS 'Aterro Sanitário',
             c.proprietario AS 'Proprietário do Caminhão',
             t.nome AS 'Tipo de Resíduo',
             ROUND(m.volume,0) AS 'Volume',
             d.nome AS 'Devedor'
      FROM aterro a, caminhao c, movimentacao m, devedor d, tipo_residuo t
      WHERE m.aterro_id = a.id
        AND m.caminhao_id = c.id
        AND m.devedor_id = d.id
        AND m.tipo_residuo_id = t.id
        AND a.id = 2 
        /* AND a.nome = 'Canoinhas' */ -- Outra forma de escrever a condição acima.
      ```
   * _Relatório 2_:
     ```sql
      SELECT a.nome AS 'Aterro Sanitário',
             ROUND(SUM(m.volume),0) AS 'Volume total'
      FROM aterro a, movimentacao m
      WHERE m.aterro_id = a.id
        AND a.id = 1
      GROUP BY a.nome
        /* AND a.nome = 'Brusque' */ -- Outra forma de escrever a condição acima.
      ```
   * _Relatório 3_:
     ```sql
     SELECT t.nome AS 'Tipo de Resíduo',
     		a.nome AS 'Aterro Sanitário',
            ROUND(SUM(m.volume),0) AS 'Volume total'
      FROM aterro a, caminhao c, movimentacao m, devedor d, tipo_residuo t
      WHERE m.aterro_id = a.id
        AND m.devedor_id = d.id
        AND m.tipo_residuo_id = t.id
        AND d.id = 1
        /* AND d.nome = 'Conti' */ -- Outra forma de escrever a condição acima.
      GROUP BY t.nome,
     		   a.nome'
      ```

3. Montar a estrutura de pastas da aplicação.
   * Eu quis inicialmente utilizar uma estrutura de RESTful APIs nesta aplicação PHP pelas seguintes razões:
     * Um layout, mesmo utilizando frameworks como o ***Bootstrap***, consomem muito tempo em detalhes de _UI_.
     * Não gostaria de desenvolver um layout sem que esteja minimamente responsivo ou adequado à possível continuidade de estudos.
     * APIs podem ser testadas de forma facilitada com uma conta gratuita no [Postman](https://www.postman.com/). 
   * Desta forma, a seguinte estrutura foi definida:
   - api
     - aterro
       - read.php
     - caminhao
       - read.php
     - devedor
       - read.php
     - movimentacao
       - read.php
     - tiporesiduo
       - read.php
   - classes
     - Aterro.php
     - Caminhao.php
     - Devedor.php
     - Movimentacao.php
     - TipoResiduo.php
   - config
     - bancodados.php

4. Criar um arquivo PHP de conexão com o banco de dados.
   * Mesmo tendo sido recomendado por colegas que conhecem melhor sobre `<?php ?>`, não adotei _Singleton_ na conexão com o banco de dados pelas seguintes razões:
     * Não foi um padrão de projeto designado para mim.
     * Acredito que a utilização do `PDO::` e da sua respectiva função `__construct()`, além de adequada para este tipo de projeto e banco de dados, instancia adequadamente as conexões e trata razoavelmente _loops_, ociosidade e demais situações.

5. Criar as classes e seus respectivos métodos em PHP.
   * As classes foram devidamente criadas com os métodos de CRUD e suas respectivas operações em banco de dados.
   

### Pendências: 

5. Criar as classes e seus respectivos métodos em PHP.
   * Avaliar se a classe de Movimentação necessita de tratamento, ou se isto deve ser colocado no escopo das APIs.

6. Montar as APIs que acionam os métodos e retornam dados em JSON.
   * Avaliar se o uso do `PDOStatement::fetchAll` atende às necessidades de junção de tabelas (depende de manter ou não as atuais propriedades da classe).
   * Avaliar a implementação de como fazer os relatórios na API, criando uma espécie de parâmetro adicional na requisição correspondente ao código do relatório. Avaliar a necessidade de criar uma `class Relatorio{}`. 

7. Implementar os padrões de projeto designados.

8. ***BÔNUS:*** Criar um layout para a aplicação.