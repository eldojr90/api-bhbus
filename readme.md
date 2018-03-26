Instruções

linguagem: php

banco de dados: mysql (dados de criação do schema em /other/bhbus.sql)

endpoints (todos com o método GET):

> cadastro de novo passageiro

	localhost/src/controller/passageiro.php?name=<nome do passageiro>&email=<email do passageiro>&cardId=<id do cartao do passageiro>&password=<senha do passageiro>

	obs.: Será gerado um token para o usuário .


> cadastro de nova linha
	
	localhost/src/controller/linha.php?code=<nr da linha>&org=<origem da linha>&dest=<destino da linha>


> cadastro de novo débito

	localhost/src/controller/debito.php?token=<token do passageiro>&codLin=<nr da linha>&val=<valor da passagem>


> extrato do cartão

	localhost/src/controller/debits.php?token=<token do passageiro>&initialDate=<data inicial formato DD/MM/AAAA>&finalDate=<data final formato DD/MM/AAAA>
	obs.: para verificar extrato da data corrente informe um dia antes na data inicial e um dia depois à data final.








