<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Quem somos</title>
    <link rel="stylesheet" href="assets/css/about_us.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>

    <div class="intro-section">
        <div class="intro-container">
            <aside class="sidebar">
                <div class="sidebar-content">
                    <h3>Sumário</h3>
                    <ul>
                        <li><a href="#apresentacao">Apresentação</a></li>
                        <li><a href="#historia">História</a></li>
                        <li><a href="#regulamentacao">Regulamentação</a></li>
                        <li><a href="#atividades">Realização de atividades</a></li>
                    </ul>
                </div>
            </aside>

            <main class="text-container">
                <h1 id="apresentacao">Seja bem-vindo à FCD:</h1>
                <h3 id="apresentacao">Apresentação:</h3>
                <p>
                    A Fraternidade Cristã de Pessoas com Deficiência – FCD CHAPECÓ/SC, 
                    foi criada neste município em 25 de abril de 1981. 
                    É uma entidade social não governamental e sem fins lucrativos.
                </p>
                <p>
                    Tem como foco principal a luta pela defesa e garantia dos direitos das pessoas com deficiência. 
                    A principal diretriz é a participação das pessoas com deficiência e suas famílias por meio de 
                    ações organizadas na entidade e em outros espaços sociais e comunitários, para prática de cidadania 
                    ativa e consciente de seus direitos e deveres.
                </p>
                <p>
                    Tem como missão, lutar pela defesa dos direitos das pessoas com deficiência, igualdade de oportunidades e 
                    acessibilidade nas políticas públicas e sociais.
                </p>
                <p>
                    Objetiva contribuir para que a pessoa com deficiência e sua família tenha acesso às diferentes políticas 
                    públicas e sociais, por meio de ações com e em prol do segmento, em parceria com entidades afins e 
                    instituições públicas e privadas.
                </p>
                <p>
                    A atuação do movimento FCD busca o despertar da consciência crítica nas 
                    pessoas com deficiência em prol de sua cidadania, na defesa e garantia de seus direitos de forma coletiva.
                    Se mantém através do trabalho voluntário e com recursos vindos de doações físicas e jurídicas, 
                    parcerias com outras instituições, empresas, universidades e comunidade, termo de convênio com a 
                    Prefeitura Municipal de Chapecó e projetos sociais.
                </p>

                <h3 id="historia">História:</h3>

                <p>
                    A base histórica da FCD teve início em 1945, na França, como um movimento social com iniciativa do padre 
                    Monsenhor Henri François, como resposta concreta à situação de vida dos doentes e deficientes que se 
                    encontravam marginalizados. 
                </p>
                <p>
                    Com o passar do tempo o movimento foi se disseminando internacionalmente 
                    chegando na América do Sul. A FCD chegou no Brasil em 1972, inicialmente em São Leopoldo- RS, fundada 
                    pelo padre jesuíta Vicente Mazip e, posteriormente, espalhando-se em outras regiões do país.
                </p>
                <p>
                    Formaram-se núcleos independentes em vários estados e municípios do Brasil, onde as próprias 
                    pessoas com deficiência assumem sua direção e se encarregam de sua difusão.
                </p>
                <p>
                    Em 1981, um grupo de pessoas com deficiência fundou o núcleo da FCD Chapecó que, 
                    com o tempo conseguiu se organizar e construir a sede própria através de projetos sociais e 
                    parcerias físicas e jurídicas.
                </p>

                <h3 id="regulamentacao">Regulamentação:</h3>

                <p>
                    A FCD Chapecó possui Estatuto Social, CNPJ, Inscrição no CMAS, 
                    Lei de Utilidade Pública Municipal e Estadual estando regulamentada e atuando 
                    como OSC-Organização da Sociedade Civil. 
                </p>
                <p>
                    Tem como público participante pessoas com deficiência, 
                    familiares e outros colaboradores ou voluntários da comunidade, constituindo um quadro social 
                    de 116 pessoas cadastradas, sendo 26 colaboradores voluntários.  
                </p>
                <p>
                    A coordenação da FCD é de competência 
                    de uma equipe eleita a cada 3 anos composta por pessoas com deficiência de forma voluntária e gratuita.
                    A FCD também conta com uma equipe técnica (pedagogo, assistente social, palestrantes), 
                    bem como assessoria jurídica externa. Para custear as despesas da entidade, além de doações que recebe, 
                    são realizadas ações entre amigos, promoções beneficentes, parcerias, projetos e convênios.
                </p>

                <h3 id="atividades">Realização de atividades:</h3>

                <p>
                    A Entidade desenvolve suas atividades nas segundas, quartas e quintas feiras em horário 
                    comercial, e no 3º domingo de cada mês.
                </p>
                <p>
                    As atividades são realizadas através de orientações 
                    coletivas internas (palestras, rodas de conversa, encontros de formação, assembleias), 
                    orientações externas (palestras e rodas de conversa) em escolas, CRAS, Universidades e outros 
                    espaços da comunidade com temas referentes às lutas, direitos e inclusão das 
                    pessoas com deficiência), oficinas de artesanato, costura e informática básica, 
                    visitas domiciliares, e espaço de convivência.
                </p>
                <p>
                    No aspecto da participação externa ou 
                    articulação social a entidade está presente no 
                    Conselho Municipal dos Direitos da Pessoa com Deficiência – COMDE, e no 
                    Conselho Municipal de Assistência Social – CMAS. 
                </p>
                <p>
                    Possui em seu quadro pessoal um profissional de Serviço Social que atua no acompanhamento, 
                    apoio, orientações individuais e coletivas, visitas domiciliares e encaminhamento para a 
                    rede socioassistencial do município.
                </p>

            </main>
            <aside class="image-container">
                <img src="assets/images/logoFCD.jpeg" alt="Logo da FCD">
                <img src="assets/images/img_fcd_3.jpeg" alt="Nossos alunos">
                <img src="assets/images/img_fcd_2.jpeg" alt="Gincana">
                <img src="assets/images/img_fcd_1.jpeg" alt="Nossos alunos">
                <img src="assets/images/img_fcd_4.jpeg" alt="Nossos alunos">
                <img src="assets/images/img_fcd_5.jpeg" alt="Nosso espaço">
            </aside>
        </div>
    </div>

    <?php include 'templates/footer.php'; ?>

</body>
</html>