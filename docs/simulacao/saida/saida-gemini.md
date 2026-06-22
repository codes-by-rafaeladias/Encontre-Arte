Olá! Como um parceiro de testes de software, preparei este material para guiar nossa avaliação exploratória. Vamos olhar para o sistema não apenas pelas regras de negócio, mas pela real experiência de quem vai usá-lo.

Como o marketplace foca na **divulgação e conexão** (sem transações financeiras nativas), a usabilidade e a clareza na comunicação externa são os pontos críticos que precisamos validar.

---

## Etapa 1 – Geração de Personas

### Personas do Tipo: Artesão

#### 1. Dona Tereza (A Artesã Tradicional)

* **Nome:** Tereza Maria dos Santos
* **Faixa Etária:** 64 anos
* **Ocupação:** Rendeira de bilro e líder de associação comunitária.
* **Objetivos:** Dar visibilidade nacional ao trabalho das mulheres da sua comunidade e receber contatos de lojistas de grandes centros urbanos.
* **Necessidades Principais:** Uma vitrine digital simples para expor os caminhos de mesa e xales, e uma forma direta para que os clientes vejam seu WhatsApp ou Instagram.
* **Dificuldades/Expectativas:** Tem receio de interfaces complexas. Costuma errar digitações e precisa de textos grandes e botões visíveis. Espera que o aplicativo "fale a língua dela".
* **Nível de Familiaridade:** Baixo.

#### 2. Lucas (O Designer Upcycling)

* **Nome:** Lucas Schimidt
* **Faixa Etária:** 28 anos
* **Ocupação:** Designer industrial focado em mobiliário sustentável com madeira de demolição.
* **Objetivos:** Destacar o valor ecológico e artístico de suas peças exclusivas, atraindo um público de nicho disposto a pagar o valor justo por artefatos premium.
* **Necessidades:** Filtragem refinada por matéria-prima, espaço para contar a história do produto (storytelling) e métricas claras para entender se seu público-alvo está sendo alcançado.
* **Dificuldades/Expectativas:** Muito exigente com a estética do app. Espera um painel de desempenho moderno, ágil e integração fluida para compartilhar seus produtos em suas próprias redes sociais.
* **Nível de Familiaridade:** Alto.

#### 3. Clara (A Ceramista Hobbyista em Transição)

* **Nome:** Clara Mendes
* **Faixa Etária:** 41 anos
* **Ocupação:** Assistente administrativa que produz cerâmica utilitária nos finais de semana.
* **Objetivos:** Validar a aceitação de suas peças no mercado para decidir se pode transformar o hobby em sua profissão principal.
* **Necessidades:** Entender quais produtos geram mais interesse (favoritos/seguidores) e receber feedbacks/avaliações construtivas dos clientes para aprimorar sua técnica.
* **Dificuldades/Expectativas:** Tempo escasso. Precisa de um sistema de cadastro de produtos que seja extremamente rápido e inteligente (sugestões de tags), preferencialmente feito pelo celular.
* **Nível de Familiaridade:** Médio.

---

### Personas do Tipo: Cliente

#### 4. Mariana (A Noiva Consciente)

* **Nome:** Mariana Albuquerque
* **Faixa Etária:** 31 anos
* **Ocupação:** Arquiteta e urbanista.
* **Objetivos:** Encontrar lembranças de casamento e itens de decoração feitos à mão por artesãos locais do seu próprio estado para valorizar a cultura regional no seu evento.
* **Necessidades:** Filtros geográficos precisos (estado/cidade) e busca avançada combinando técnica artesanal (ex: cerâmica) e categoria (ex: decoração).
* **Dificuldades/Expectativas:** Busca otimização de tempo. Espera salvar dezenas de referências rapidamente e organizá-las para decidir depois quais artesãos contactar.
* **Nível de Familiaridade:** Alto.

#### 5. Seu Alberto (O Entusiasta de Cultura Popular)

* **Nome:** Alberto Goldstein
* **Faixa Etária:** 55 anos
* **Ocupação:** Professor universitário de História aposentado.
* **Objetivos:** Descobrir e apoiar novos talentos do artesanato tradicional brasileiro (como escultura em argila e xilogravura), colecionando peças únicas.
* **Necessidades:** Conhecer a história por trás do artesão e ter um canal de comunicação direta com ele para encomendar peças personalizadas.
* **Dificuldades/Expectativas:** Prefere o uso no computador (desktop). Detesta fluxos de cadastro longos que exigem validações complexas ou redes sociais para logar.
* **Nível de Familiaridade:** Médio.

#### 6. Camila (A Consumidora Geração Z Eco-friendly)

* **Nome:** Camila Ribeiro
* **Faixa Etária:** 22 anos
* **Ocupação:** Estudante de Biologia.
* **Objetivos:** Consumir moda e acessórios sustentáveis e autênticos, fugindo do *fast fashion*.
* **Necessidades:** Confiança na procedência dos materiais. Ela se baseia fortemente na avaliação e depoimentos de outros usuários antes de seguir um artesão.
* **Dificuldades/Expectativas:** É imediatista. Se o sistema de busca falhar ou o app demorar para carregar os resultados de uma categoria, ela abandona a plataforma.
* **Nível de Familiaridade:** Alto.

---

## Etapa 2 – Criação de Cenários de Utilização

### Cenários: Visão do Artesão

#### Cenário 1: Dona Tereza cadastrando sua primeira renda de bilro

* **Objetivo da Persona:** Expor um "Caminho de Mesa em Renda de Bilro Branca" para receber encomendas de fora de sua cidade.
* **Fluxo Esperado:**
1. Dona Tereza faz o cadastro básico na plataforma.
2. Acessa a área "Gerenciar Produtos" e clica em "Adicionar Novo".
3. Preenche o nome, seleciona a categoria (Cama e Mesa), técnica (Renda de Bilro) e matéria-prima (Fio de Algodão).
4. Sobe uma foto do produto tirada do seu celular e salva o cadastro.


* **Possíveis Dificuldades:** Ela pode se confundir na hora de categorizar a "técnica artesanal" ou a "matéria-prima" se os campos forem caixas de texto aberto (ela pode digitar termos informais locais). A falta de um botão de preço (já que não há venda interna) pode deixá-la confusa sobre como o cliente saberá o valor.
* **Pontos Positivos:** O sistema permite que ela ganhe visibilidade na internet sem precisar gerenciar uma estrutura complexa de e-commerce (frete, estoque, gateway de pagamento).
* **Sugestões de Melhoria (UX):** Substituir campos de texto por listas de seleção (*dropdowns*) pré-configuradas para Técnicas e Matérias-primas. Adicionar um aviso visual claro: *"O cliente entrará em contato direto com você para combinar o preço e a entrega"*.

#### Cenário 2: Lucas analisando o desempenho e usando as sugestões inteligentes

* **Objetivo da Persona:** Avaliar o interesse do público em sua nova linha de bancos de madeira e descobrir como converter visualizações em contatos reais.
* **Fluxo Esperado:**
1. Lucas faz login e acessa o "Painel de Desempenho".
2. Analisa os gráficos de visualizações de seus produtos e o número de vezes que foi favoritado.
3. Rola a tela até a seção "Sugestões Inteligentes do Sistema".
4. O sistema exibe um alerta informando que sua linha de bancos teve alto índice de favoritados, mas poucos cliques no botão de contato, sugerindo atualizar a biografia ou incluir fotos do processo de fabricação.


* **Possíveis Dificuldades:** Se os gráficos de desempenho forem confusos ou não permitirem filtrar por período (ex: última semana), perderão o valor para a estratégia dele.
* **Pontos Positivos:** O recurso de sugestões inteligentes atua como um consultor de negócios para o artesão da economia criativa, gerando valor real mesmo sem a venda direta no app.
* **Sugestões de Melhoria (UX):** Permitir exportar os dados de desempenho em formato simples ou gerar um link de compartilhamento rápido da sua vitrine para o Instagram Stories.

#### Cenário 3: Clara gerenciando avaliações e atualizando produtos

* **Objetivo da Persona:** Verificar as notas que recebeu em seus vasos de cerâmica e ajustar as informações do produto com base no feedback.
* **Fluxo Esperado:**
1. Clara faz login e acessa a aba "Avaliações Recebidas".
2. Lê os comentários dos clientes sobre o acabamento das suas peças.
3. Identifica que muitos elogiam o tamanho, mas sugerem mais opções de cores.
4. Vai em "Gerenciamento de Produtos", edita o anúncio do vaso e adiciona na descrição: *"Aceito encomendas em outras cores"*.


* **Possíveis Dificuldades:** Como o sistema não tem chat interno ou venda, se um cliente deixar uma dúvida na avaliação (ex: *"Vocês fazem em azul?"*), Clara não tem um botão direto para responder publicamente a esse comentário.
* **Pontos Positivos:** O sistema centraliza a percepção do mercado sobre o trabalho dela, servindo como um termômetro de validação de produto.
* **Sugestões de Melhoria (UX):** Implementar a funcionalidade de "Responder Avaliação", permitindo que o artesão interaja publicamente com o comentário do cliente na página do produto.

---

### Cenários: Visão do Cliente

#### Cenário 4: Mariana buscando fornecedores locais para seu casamento

* **Objetivo da Persona:** Encontrar artesãos na sua região (Bahia) que dominem a técnica de trançado em fibra natural para criar os sousplats da festa.
* **Fluxo Esperado:**
1. Mariana se cadastra e faz login no sistema.
2. Na barra de pesquisa de produtos, ela aplica os filtros combinados: Categoria (Utilidades Domésticas) + Técnica (Trançado Fibra) + Localização (Bahia).
3. O sistema retorna os produtos correspondentes. Ela entra no perfil de um artesão promissor e clica em "Seguir Artesão" e adiciona o produto ao "Gerenciamento de Produtos Favoritos".


* **Possíveis Dificuldades:** Se a busca exigir que ela preencha todos os filtros obrigatoriamente, a experiência será frustrante. Além disso, se o filtro de localização for amplo demais (apenas Estado) e não permitir refinar por Município, ela pode encontrar artesãos muito distantes inviabilizando a retirada física.
* **Pontos Positivos:** A combinação poderosa de filtros (técnica + matéria-prima + localização) economiza horas de busca em redes sociais genéricas.
* **Sugestões de Melhoria (UX):** Permitir a criação de "Pastas de Favoritos" (ex: Pasta "Casamento", Pasta "Sala"), simulando a dinâmica do Pinterest, facilitando a organização de projetos decorativos.

#### Cenário 5: Seu Alberto descobrindo um novo mestre da escultura em argila

* **Objetivo da Persona:** Encontrar o perfil completo de um artesão cujo nome ele ouviu em uma matéria jornalística ("Mestre Vitalino Neto") e verificar suas obras.
* **Fluxo Esperado:**
1. Seu Alberto acessa a plataforma via computador e usa a funcionalidade "Pesquisa de Artesãos".
2. Digita o nome do artesão e aplica o filtro de localização para confirmar a identidade.
3. Ao acessar o perfil do artesão, ele visualiza a história do artista e a galeria de produtos cadastrados.
4. Ele decide avaliar positivamente um produto que ele já possuía previamente (comprado em uma feira física no passado).


* **Possíveis Dificuldades:** Como o sistema permite avaliar produtos sem exigir uma compra nativa na plataforma (já que não há módulo de vendas), pode haver o risco de avaliações fakes ou descontextualizadas. Além disso, o fluxo de avaliação precisa ser simples e sem captchas complexos para não afastar o usuário sênior.
* **Pontos Positivos:** A busca direta por artesão (e não só por produto) valoriza a autoria e o fator humano característicos da Economia Criativa.
* **Sugestões de Melhoria (UX):** Para manter a segurança das avaliações sem travar a usabilidade, o sistema poderia exibir uma tag *"O usuário declarou conhecer o trabalho do artesão fora da plataforma"* ao enviar a nota.

#### Cenário 6: Camila buscando um acessório eco-friendly baseado em reputação

* **Objetivo da Persona:** Achar uma bolsa feita de material reciclado que seja altamente recomendada pela comunidade da plataforma.
* **Fluxo Esperado:**
1. Camila faz login no app mobile.
2. Pesquisa pelo termo geral "Bolsa" e filtra por matéria-prima "Tecido Reciclado" ou "Lona".
3. Ordena os resultados por "Mais bem avaliados".
4. Entra no produto topo da lista, lê os comentários e a nota média.
5. Clica no perfil do artesão para ver seus dados de contato externos (Link Tree/WhatsApp) para efetivar a compra fora dali.


* **Possíveis Dificuldades:** Se o sistema não tiver um botão evidente de "Como Comprar/Contatar Artesão", Camila pode achar que o site está quebrado ou abandonado devido à ausência de um botão "Adicionar ao Carrinho".
* **Pontos Positivos:** A ordenação por avaliações acelera o processo de decisão de um público imediatista e exigente com validação social.
* **Sugestões de Melhoria (UX):** Incluir um botão de chamada para ação (*CTA*) de destaque na página do produto escrito: *"Entrar em contato com o Artesão para comprar"*, abrindo uma listagem limpa de links (WhatsApp, Instagram, Telefone).

---

### Próximos Passos para o Nosso Plano de Testes (QA)

Com base nesses cenários, os principais focos do nosso plano de testes exploratórios devem ser:

1. **Testes de Caixa Preta na Busca Avançada:** Garantir que a combinação de múltiplos filtros não quebre a query e retorne resultados vazios incorretamente.
2. **Validação de Negócio (Limitação do Escopo):** Testar se em todas as telas de visualização de produto fica nítido que a plataforma **não** realiza a venda, evitando abertura de chamados de suporte por engano de clientes tentando comprar pelo app.
3. **Acessibilidade (Foco em perfis como Dona Tereza):** Avaliar contrastes, tamanhos de fontes e legibilidade dos fluxos de cadastro de produtos em dispositivos móveis.