@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="d-flex justify-content-start pl-3 animate__animated animate__zoomIn animate__delay-1s"
                            style="color: whitesmoke">
                            Seja bem vind{{ (session('customer.gender') === 'Masculino') ? 'o' : 'a' }}
                            <span class="pl-1" style="letter-spacing: 1px">{{ explode(' ', session('customer.full_name'))[0] }}</span>!
                        </h5>
                    </div>
                </div>

                <div class="container">
                    <div class="row mt-3 mb-5">
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <a href="{{route('central.contract')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <h3>Contrato</h3>
                                    <p>Visualize as informações do contrato, como endereço, plano e dados pessoais.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{route('central.payment')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <h3>Pagamento</h3>
                                    <p>Pague suas faturas usando PIX, PICPAY, CRÉDITO, baixe a 2ª via ou copie o código de barras.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{route('central.payments')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-file-download"></i>
                                    </div>
                                    <h3>Comprovantes</h3>
                                    <p>Acompanhe suas faturas pagas, visualize ou baixe
                                        a 2ª via de seus comprovantes.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{route('central.invoices')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <h3>Notas Fiscais</h3>
                                    <p>Acompanhe suas notas fiscais emitidas conforme as mensalidades pagas.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{route('central.support')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-life-ring"></i>
                                    </div>
                                    <h3>Suporte</h3>
                                    <p>Acompanhe seus atendimentos ou abra um novo para falar com o
                                        suporte técnico.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="{{route('central.traffic.average')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <h3>Gráficos</h3>
                                    <p>Acompanhe o consumo de internet acordo com o período
                                        desejado.</p>
                                </div>
                            </a>
                        </div>
                        @if(session()->has('customer') && session('customer.status') === 'W')
                        <div class="col-lg-3 col-md-6 col-sm-6">

                            <a href="{{route('central.connection')}}">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-network-wired"></i>
                                    </div>
                                    <h3>Conexão</h3>
                                    <p>Acompanhe o status de sua conexão e o consumo de internet em tempo real.</p>
                                </div>
                            </a>

                        </div>
                        @endif
                        @if(session('customer.status') === 'B' && \App\Services\Validations::isRelease(session('customer.dt_trust')))
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <a href="#" id="{{session('customer.id')}}" onclick="releaseCustomer(this.id)">
                                <div class="service_box animate__animated animate__fadeIn">
                                    <div class="service_icon">
                                        <i class="fas fa-unlock-alt"></i>
                                    </div>
                                    <h3>Desbloqueio</h3>
                                    <p>Desbloqueie seu cadastro por até 24h, a fim de
                                        regularizar os débitos.</p>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="terms-modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" style="z-index: 99999 !important;">
            <div class="modal-content">
                <div class="modal-header" style="border: 0">
                    <h6 class="modal-title font-weight-bold" style="color: #002046;">Windx - Termos de Uso e
                        Privacidade</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-windx-80">
                    <div class="text-terms mt-md-3 pl-3 pr-3">
                        <p>As determinações abaixo representam um contrato entre você e a WINDX
                            TELECOMUNICAÇÕES, e ao acessar o site ou cadastrar-se, você concorda, sem
                            restrições, em aceitar seus Termos e Condições de Uso, uma vez que estas disposições
                            norteiam nossa política de privacidade e regras de utilização.</p>
                        <h4>1. Regras de Utilização</h4>
                        <p>O Usuário obriga-se a utilizar o Site respeitando e observando estes Termos e Condições de
                            Uso, bem como a legislação vigente, os costumes e a ordem pública.</p>
                        <ol class="alpha">
                            <li>Desta forma, o Usuário concorda que não poderá:</li>
                            <ol class="roman">
                                <li>Lesar direitos de terceiros, independentemente de sua natureza, em qualquer momento,
                                    inclusive no decorrer do uso do Site;
                                </li>
                                <li>Executar atos que limitem ou impeçam o acesso e a utilização do Site, em condições
                                    adequadas, pelos demais Usuários;
                                </li>
                                <li>Acessar ilicitamente o Site ou sistemas informáticos de terceiros relacionados ao
                                    Site
                                    ou à&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;sob qualquer meio ou forma;
                                </li>
                                <li>Difundir programas ou vírus informáticos suscetíveis de causar danos de qualquer
                                    natureza, inclusive em equipamentos e sistemas da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;ou
                                    de
                                    terceiros;
                                </li>
                                <li>Utilizar mecanismos diversos daqueles expressamente habilitados ou recomendados no
                                    Site,
                                    para obtenção de informações, conteúdos e serviços;
                                </li>
                                <li>Realizar qualquer ato que, de alguma forma, possa implicar em eventual prejuízo ou
                                    dano
                                    à&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;ou aos demais Usuários;
                                </li>
                                <li>Acessar áreas de programação do Site, base de dados ou qualquer outro conjunto de
                                    informações que escape às áreas públicas ou restritas do mesmo;&nbsp;
                                </li>
                                <li>Realizar ou permitir engenharia reversa, traduzir, modificar, alterar a linguagem,
                                    compilar, decompilar, modificar, reproduzir, alugar, sublocar, divulgar, transmitir,
                                    distribuir, usar ou, de outra maneira, dispor do Site ou das ferramentas e
                                    funcionalidades nele disponibilizadas sob qualquer meio ou forma, inclusive de modo
                                    a
                                    violar direitos à&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;(inclusive em relação à
                                    Propriedade
                                    Intelectual
                                    deste) e/ou de terceiros;
                                </li>
                                <li>Praticar ou participar de qualquer ato que constitua violação de qualquer direito
                                    da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;(inclusive em relação à Propriedade Intelectual
                                    deste) ou
                                    de
                                    terceiros, ou ainda de qualquer lei aplicável; ou mesmo agir sob qualquer meio, de
                                    forma
                                    a contribuir com tal violação;&nbsp;
                                </li>
                                <li>Interferir na segurança ou cometer algum uso indevido contra o Site ou qualquer
                                    recurso do sistema, rede ou serviço conectado ou que possa ser acessado por meio do
                                    Site, devendo acessá-lo apenas para fins lícitos e autorizados;&nbsp;
                                </li>
                                <li>Utilizar o domínio da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;para criar links ou atalhos a
                                    serem
                                    disponibilizados em e-mails não solicitados (spam) ou em websites de terceiros ou do
                                    próprio Usuário ou, ainda, para realizar qualquer tipo de ação que possa vir a
                                    prejudicar a&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;ou terceiros;
                                </li>
                                <li>Utilizar aplicativos automatizados de coleta e seleção de dados para realizar
                                    operações massificadas ou para quaisquer finalidades ou, ainda, para coletar e
                                    transferir quaisquer dados que possam ser extraídos do Site para fins não permitidos
                                    ou
                                    ilícitos;
                                </li>
                                <li>Utilizar as ferramentas e funcionalidades do Site para difundir mensagens não
                                    relacionadas com o Site ou com as finalidades deste, incluindo mensagens de cunho
                                    racista, étnico, político, religioso, cultural ou depreciativo, difamatório e/ou
                                    calunioso de qualquer pessoa ou grupo social;
                                </li>
                                <li>Criar um Usuário falso ou prestar informações falsas no cadastro;
                                </li>
                                <li>Acessar ao Site por meio de ferramentas automáticas (robôs,&nbsp;spiders, dentre
                                    outras);
                                </li>
                                <li>Utilizar a&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;como veículo de publicidade, sem que
                                    tenha havido
                                    a
                                    contratação deste serviço específico.
                                </li>
                            </ol>
                            <li>O Usuário concorda em indenizar, defender e isentar a&nbsp;WINDX
                                TELECOMUNICAÇÕES&nbsp;de qualquer
                                reclamação, notificação, intimação ou ação judicial ou extrajudicial, ou ainda de
                                qualquer
                                responsabilidade, dano, custo ou despesa decorrente de qualquer violação e/ou infração
                                cometida pelo Usuário ou qualquer pessoa agindo em seu nome, com seu consentimento ou
                                tolerância, em relação ao Site (no que tange a qualquer disposição destes Termos e
                                Condições
                                de Uso), inclusive eventual pessoa que tenha obtido os dados do Usuário relacionados a
                                sua
                                eventual Conta de Acesso ou a sua navegação.
                            </li>
                            <li>O Usuário é responsável por todo o conteúdo que eventualmente
                                disponibilizar neste Site. Qualquer dano causado pelo conteúdo publicado será de sua
                                exclusiva responsabilidade. Toda e qualquer publicação deve estar atenta a legislação
                                brasileira, em especial à Constituição da República e ao Código Civil.
                            </li>
                            <li>É dever do Usuário denunciar, no local adequado, qualquer conteúdo que
                                se enquadre dentre as condutas vedadas.
                            </li>
                            <li>Ao aceitar estes Termos, o Usuário concede licença mundial, não
                                exclusiva, transferível, sublicenciável e livre de royalties para a utilização,
                                pela&nbsp;WINDX
                                TELECOMUNICAÇÕES, de qualquer conteúdo publicado. Este compartilhamento de conteúdo se
                                dará
                                de forma espontânea e jamais será objeto de remuneração. Por sua vez, os conteúdos
                                compartilhados devem estar de acordo com as regras destes Termos de Uso.
                            </li>
                        </ol>

                        <h4>2. Políticas de Privacidade</h4>
                        <p>Para a WINDX TELECOMUNICAÇÕES, sua privacidade é muito importante. Nossa política de
                            privacidade foi criada para garantir que seus dados pessoais sejam preservados, conforme
                            regramento abaixo:</p>
                        <ol class="roman">
                            <li>As informações pessoais dos clientes cadastrados no site&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;serão
                                coletadas, transportadas e armazenadas de forma confidencial e segura, garantindo a
                                privacidade dos clientes do serviço. A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;garante a
                                integridade
                                desses dados;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;se compromete a não compartilhar, enviar, vender,
                                publicar
                                ou liberar o acesso aos dados de seus clientes, a menos que obrigada por ações legais,
                                judiciais ou governamentais, com fins de fiscalização e manutenção da lei, ou a menos
                                que haja a expressa autorização do cliente;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;pode se valer do endereço IP ou de configurações
                                anônimas do
                                computador do cliente, como informações sobre o modelo do browser utilizado, para fins
                                estritos de correção de defeitos e problemas ou para a melhoria dos serviços prestados,
                                sem compartilhar essas informações com terceiros;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;somente enviará e-mails para os seus clientes
                                mediante a
                                concordância expressa dos mesmos. Este serviço pode ser cancelado a qualquer momento,
                                conforme a vontade do cliente;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;pode exibir ou incluir links para sites de terceiros,
                                e não se
                                responsabiliza por quaisquer consequências decorrentes do acesso aos mesmos;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;pode exibir links patrocinados e/ou de publicidade,
                                não se
                                responsabilizando pelo conteúdo e pelas consequências decorrentes do acesso a estes
                                links;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;pode se valer de dados dos clientes para fins
                                estatísticos.
                                Porém, esses dados nunca serão usados individualmente ou de qualquer outra forma em que
                                possam identificar unicamente um cliente do serviço. Estes dados somente serão usados de
                                maneira agregada, a fim de gerar estatísticas e relatórios internos de uso dos serviços;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;não se responsabiliza por quaisquer opiniões pessoais
                                manifestadas pelos clientes em canais públicos disponibilizados pela&nbsp;WINDX
                                TELECOMUNICAÇÕES. Estas opiniões são de única e exclusiva responsabilidade do cliente
                                que as postar, e a&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;tomará as medidas cabíveis para a
                                identificação pessoal dos clientes caso seja necessário, em caso de eventuais prejuízos
                                ou danos causados à&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;ou a terceiros;
                            </li>
                            <li>Ressaltamos a importância do seu eventual nome de cliente e senha no sistema&nbsp;WINDX
                                TELECOMUNICAÇÕES. São a única forma de acesso ao site, portanto aconselhamos que os
                                mantenha em local seguro e troque sua senha periodicamente. Aconselhamos, também, a
                                sempre encerrar sua sessão no sistema de forma segura;
                            </li>
                            <li>Para dirimir quaisquer dúvidas em relação à política de privacidade ou qualquer outro
                                assunto, disponibilizamos nosso canal de contato com a equipe&nbsp;WINDX
                                TELECOMUNICAÇÕES.
                                Para nós, é muito gratificante responder às suas dúvidas.
                            </li>
                        </ol>

                        <h4>3. Propriedade Intelectual</h4>
                        <ol class="alpha">
                            <li>O Usuário não está autorizado a utilizar, sob qualquer forma ou pretexto, as Marcas,
                                suas reproduções parciais ou integrais ou ainda suas imitações, independentemente da
                                destinação de tal uso, exceto quando autorizado pela&nbsp;WINDX TELECOMUNICAÇÕES.
                            </li>
                            <li>O Usuário compromete-se a não contestar a validade de qualquer Marca ou sinal distintivo
                                depositado ou registrado pela&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;ou por qualquer empresa
                                vinculada,
                                sob qualquer forma, no Brasil ou no exterior.
                            </li>
                            <li>O Usuário compromete-se a abster-se do uso de qualquer das Marcas e suas variações
                                (incluindo erros de ortografia ou variações fonéticas) como nome de domínio ou parte de
                                nome de domínio ou nome de empresa, de qualquer tipo ou natureza, sob qualquer meio ou
                                forma, inclusive por meio da criação de nomes de domínio ou e-mails.
                            </li>
                            <li>Todas as outras marcas, nomes de produtos, ou nomes de companhias que aparecem no Site
                                são de propriedade exclusiva de seus respectivos titulares.&nbsp;
                            </li>
                            <li>Todo o conteúdo do Site - incluindo o nome de domínio, programas, bases de dados,
                                arquivos, textos, fotos, layouts, cabeçalhos e demais elementos - foi criado,
                                desenvolvido ou cedido à&nbsp;WINDX TELECOMUNICAÇÕES, sendo de propriedade desta ou a
                                este
                                licenciado e encontra-se protegido pelas leis brasileiras e tratados internacionais que
                                versam sobre direitos de propriedade intelectual.&nbsp;
                            </li>
                            <li>Ao acessar o Site, o Usuário compromete-se a respeitar a existência e extensão dos
                                direitos de Propriedade Intelectual da&nbsp;WINDX TELECOMUNICAÇÕES,&nbsp;bem como de
                                todos os
                                terceiros eventualmente utilizados/disponibilizados, a qualquer título, neste Site.
                            </li>
                            <li>O acesso ao Site e a sua regular utilização pelo Usuário não lhe confere qualquer
                                direito ou prerrogativa sobre Propriedade Intelectual, Marca e/ou outro conteúdo nele
                                inserido.
                            </li>
                            <li>É vedada a utilização, exploração, imitação, reprodução, integral ou parcial, de
                                qualquer conteúdo sem a autorização prévia e por escrito da&nbsp;WINDX TELECOMUNICAÇÕES.
                                Sendo igualmente vedada a criação de qualquer obra derivadas de qualquer Propriedade
                                Intelectual da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;sem a autorização do mesmo, de forma
                                prévia e por
                                escrito.&nbsp;
                            </li>
                            <li>É expressamente proibido ao Usuário reproduzir, distribuir, modificar, exibir e criar
                                trabalhos derivados ou qualquer outra forma de utilização de toda Propriedade
                                Intelectual ou qualquer conteúdo deste Site, bem como dos materiais nele veiculados.
                            </li>
                            <li>O Usuário que violar as proibições contidas na legislação sobre propriedade intelectual
                                e nestes Termos e Condições de Uso será responsabilizado, civil e criminalmente, pelas
                                infrações cometidas. Portanto, o Usuário assume toda e qualquer responsabilidade pela
                                utilização indevida.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;não concede nenhuma autorização relacionada ao
                                conteúdo do Site
                                para qualquer fim.
                            </li>
                            <li>As fotos e imagens eventualmente utilizadas no Site podem não refletir seu tamanho
                                original ou situação atual do cenário reproduzido, sendo meramente ilustrativas.
                            </li>
                            <li>Ao enviar qualquer conteúdo ao Site, o Usuário retém a titularidade de seus direitos
                                sobre dito conteúdo (textos, vídeos, imagens, áudio, entre outros), cedendo à&nbsp;WINDX
                                TELECOMUNICAÇÕES&nbsp;uma licença de caráter gratuito, irrevogável, mundial e não
                                exclusiva,
                                para a reprodução, modificação, tradução e exibição, sob qualquer meio ou forma,
                                inclusive através do Site, declarando, ainda, ser titular de todos os direitos e deveres
                                relacionados ao referido conteúdo.
                            </li>
                        </ol>
                        <h4>4. Informações técnicas</h4>
                        <ol class="alpha">
                            <li>Parte dos serviços exige que sejam utilizados cookies. Cookies são
                                pequenas quantidades de dados armazenados pelo seu browser no seu computador. Os cookies
                                podem armazenar informações sobre sua visita ao Site. A maioria dos navegadores é
                                inicialmente configurada para aceitar cookies. No entanto, é possível reconfigurar seu
                                navegador para recusar cookies ou para solicitar previamente uma confirmação. Ao
                                rejeitar os
                                cookies, nem todas as funcionalidades do Site estarão disponíveis.
                            </li>
                            <li>O que são cookies?<p>Como é prática comum em quase todos os sites profissionais, este
                                    site usa cookies, que são
                                    pequenos arquivos baixados no seu computador, para melhorar sua experiência. Esta
                                    página
                                    descreve quais informações eles coletam, como as usamos e por que às vezes
                                    precisamos
                                    armazenar esses cookies. Também compartilharemos como você pode impedir que esses
                                    cookies
                                    sejam armazenados, no entanto, isso pode fazer o downgrade ou 'quebrar' certos
                                    elementos da
                                    funcionalidade do site.</p>
                            </li>
                            <li>Como usamos os cookies?<p>Utilizamos cookies por vários motivos, detalhados abaixo.
                                    Infelizmente, na maioria dos casos,
                                    não existem opções padrão do setor para desativar os cookies sem desativar
                                    completamente a
                                    funcionalidade e os recursos que eles adicionam a este site. É recomendável que você
                                    deixe
                                    todos os cookies se não tiver certeza se precisa ou não deles, caso sejam usados
                                    ​​para
                                    fornecer um serviço que você usa.</p>
                            </li>
                            <li>Desativar cookies:<p>Você pode impedir a configuração de cookies ajustando as
                                    configurações do seu navegador
                                    (consulte a Ajuda do navegador para saber como fazer isso). Esteja ciente de que a
                                    desativação de cookies afetará a funcionalidade deste e de muitos outros sites que
                                    você
                                    visita. A desativação de cookies geralmente resultará na desativação de determinadas
                                    funcionalidades e recursos deste site. Portanto, é recomendável que você não
                                    desative os
                                    cookies</p>
                            </li>
                            <li>Cookies que definimos:
                                <ol class="disc">
                                    <li>Cookies relacionados à conta<p>Você pode impedir a configuração de cookies
                                            ajustando as
                                            configurações do seu navegador
                                            (consulte a Ajuda do navegador para saber como fazer isso). Esteja ciente de
                                            que a
                                            desativação de cookies afetará a funcionalidade deste e de muitos outros
                                            sites que
                                            você
                                            visita. A desativação de cookies geralmente resultará na desativação de
                                            determinadas
                                            funcionalidades e recursos deste site. Portanto, é recomendável que você não
                                            desative os
                                            cookies</p></li>
                                    <li>Cookies relacionados ao login<p>Utilizamos cookies quando você está logado, para
                                            que
                                            possamos lembrar dessa ação. Isso evita que você precise fazer login sempre
                                            que
                                            visitar uma nova página. Esses cookies são normalmente removidos ou limpos
                                            quando
                                            você efetua logout para garantir que você possa acessar apenas a recursos e
                                            áreas
                                            restritas ao efetuar login.</p></li>
                                    <li>Cookies relacionados a boletins por e-mail<p>Este site oferece serviços de
                                            assinatura de
                                            boletim informativo ou e-mail e os cookies podem ser usados ​​para lembrar
                                            se você
                                            já está registrado e se deve mostrar determinadas notificações válidas
                                            apenas para
                                            usuários inscritos / não inscritos.</p></li>
                                    <li>Pedidos processando cookies relacionados<p>Este site oferece facilidades de
                                            comércio
                                            eletrônico ou pagamento e alguns cookies são essenciais para garantir que
                                            seu pedido
                                            seja lembrado entre as páginas, para que possamos processá-lo
                                            adequadamente.</p>
                                    </li>
                                    <li>Cookies relacionados a pesquisas<p>Periodicamente, oferecemos pesquisas e
                                            questionários
                                            para fornecer informações interessantes, ferramentas úteis ou para entender
                                            nossa
                                            base de usuários com mais precisão. Essas pesquisas podem usar cookies para
                                            lembrar
                                            quem já participou numa pesquisa ou para fornecer resultados precisos após a
                                            alteração das páginas.</p></li>
                                    <li>Cookies relacionados a formulários<p>Quando você envia dados por meio de um
                                            formulário
                                            como os encontrados nas páginas de contacto ou nos formulários de
                                            comentários, os
                                            cookies podem ser configurados para lembrar os detalhes do usuário para
                                            correspondência futura.</p></li>
                                    <li>Cookies de preferências do site<p>Para proporcionar uma ótima experiência neste
                                            site,
                                            fornecemos a funcionalidade para definir suas preferências de como esse site
                                            é
                                            executado quando você o usa. Para lembrar suas preferências, precisamos
                                            definir
                                            cookies para que essas informações possam ser chamadas sempre que você
                                            interagir com
                                            uma página for afetada por suas preferências.</p></li>

                                </ol>
                            </li>
                            <li>Cookies de Terceiros<p>Em alguns casos especiais, também usamos cookies fornecidos por
                                    terceiros confiáveis. A seção a seguir detalha quais cookies de terceiros você pode
                                    encontrar através deste site.</p>
                                <ol class="disc">
                                    <li>Este site usa o Google Analytics, que é uma das soluções de análise mais
                                        difundidas
                                        e confiáveis ​​da Web, para nos ajudar a entender como você usa o site e como
                                        podemos melhorar sua experiência. Esses cookies podem rastrear itens como quanto
                                        tempo você gasta no site e as páginas visitadas, para que possamos continuar
                                        produzindo conteúdo atraente.
                                    </li>
                                </ol>
                            </li>
                            <li>Para mais informações sobre cookies do Google Analytics, consulte a página oficial do
                                Google
                                Analytics.
                                <ol class="disc">
                                    <li>As análises de terceiros são usadas para rastrear e medir o uso deste site, para
                                        que
                                        possamos continuar produzindo conteúdo atrativo. Esses cookies podem rastrear
                                        itens como
                                        o tempo que você passa no site ou as páginas visitadas, o que nos ajuda a
                                        entender como
                                        podemos melhorar o site para você.
                                    </li>
                                    <li>Periodicamente, testamos novos recursos e fazemos alterações subtis na maneira
                                        como o
                                        site se apresenta. Quando ainda estamos testando novos recursos, esses cookies
                                        podem ser
                                        usados ​​para garantir que você receba uma experiência consistente enquanto
                                        estiver no
                                        site, enquanto entendemos quais otimizações os nossos usuários mais apreciam.
                                    </li>
                                    <li>À medida que vendemos produtos, é importante entendermos as estatísticas sobre
                                        quantos
                                        visitantes de nosso site realmente compram e, portanto, esse é o tipo de dados
                                        que esses
                                        cookies rastrearão. Isso é importante para você, pois significa que podemos
                                        fazer
                                        previsões de negócios com precisão que nos permitem analizar nossos custos de
                                        publicidade e produtos para garantir o melhor preço possível.
                                    </li>
                                </ol>
                            </li>
                            <li>Você tem o direito de a qualquer momento receber e corrigir, adicionar
                                ou apagar informações sobre seus dados pessoais armazenados. Nossos contatos podem ser
                                encontrados no Site.
                            </li>
                        </ol>
                        <h4>5. Garantias</h4>
                        <ol class="alpha">
                            <li>Apesar dos melhores esforços da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;no sentido de fornecer
                                informações precisas, atualizadas, corretas e completas, o Site poderá conter erros
                                técnicos, inconsistências ou erros tipográficos.
                            </li>
                            <li>O Site, seu conteúdo, suas funcionalidades e ferramentas são disponibilizados pela&nbsp;WINDX
                                TELECOMUNICAÇÕES&nbsp;tal qual fornecidos, sem qualquer garantia, expressa ou implícita,
                                quanto aos seguintes itens: (i) atendimento, pelo Site ou por seu conteúdo, das
                                expectativas dos Usuários; (ii) continuidade do acesso ao Site ou a seu conteúdo; (iii)
                                adequação da qualidade do Site ou de seu conteúdo para um determinado fim; e (iv)
                                correção de defeitos, erros ou falhas no Site ou em seu conteúdo.&nbsp;
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;se reserva o direito de, unilateralmente, modificar
                                este Site,
                                a qualquer momento e sem aviso prévio, bem como sua configuração, apresentação, desenho,
                                conteúdo, funcionalidades, ferramentas e/ou qualquer outro elemento do Site, inclusive o
                                seu cancelamento.&nbsp;
                            </li>
                        </ol>
                        <h4>6. Responsabilidades</h4>
                        <ol class="alpha">
                            <li>O Usuário é o único responsável pela utilização do Site, de suas
                                ferramentas e funcionalidades. Em nenhuma hipótese, a&nbsp;WINDX TELECOMUNICAÇÕES, seus
                                diretores, representantes, agentes, empregados, sócios, parceiros e/ou prestadores de
                                serviço serão responsabilizados por qualquer dano emergente, indireto, punitivo ou
                                expiatório, lucros cessantes ou outros prejuízos monetários relacionados a qualquer
                                reclamação, ação judicial ou outro procedimento tomado em relação à utilização do Site,
                                seu
                                conteúdo, funcionalidades e/ou ferramentas.
                            </li>
                            <li>Notadamente, fica excluída a responsabilidade da&nbsp;WINDX
                                TELECOMUNICAÇÕES&nbsp;sobre as seguintes circunstâncias, entre outras: (i) danos e
                                prejuízos que
                                o Usuário possa experimentar pela indisponibilidade ou funcionamento parcial do Site
                                e/ou de
                                todos ou alguns de seus serviços, informações, conteúdos, funcionalidade e/ou
                                ferramentas,
                                bem como pela incorreção ou inexatidão de qualquer destes elementos; (ii) danos e
                                prejuízos
                                que o Usuário possa experimentar em Sites de internet acessíveis por links incluídos no
                                Site; (iii) danos e prejuízos que o Usuário possa experimentar em decorrência do uso do
                                Site
                                em desconformidade com estes Termos e Condições de Uso ou com as Políticas; (iv) danos e
                                prejuízos que o Usuário possa experimentar em decorrência do uso do Site em
                                desconformidade
                                com a lei, com os costumes ou com a ordem pública; (v) danos e prejuízos que o Usuário
                                possa
                                experimentar em decorrência de falhas no Site, inclusive decorrentes de falhas no
                                sistema,
                                no servidor ou na conexão de rede, ou ainda de interações maliciosas como vírus,
                                softwares
                                que possam danificar o equipamento ou acessar informações do equipamento do Usuário.
                            </li>
                        </ol>
                        <h4>7. Links para outros websites</h4>
                        <ol class="alpha">
                            <li>Este Site pode conter links para Sites de terceiros, os quais são
                                inseridos apenas para conveniência do Usuário. A inclusão de tais links não implica
                                qualquer
                                vínculo, monitoramento e/ou responsabilidade da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;sobre
                                estes Sites,
                                seus respectivos conteúdos e/ou titulares. O acesso aos Sites vinculados a tais links
                                não é
                                regido por esses Termos e Condições de Uso e não se encontra protegido por estas
                                Políticas.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;recomenda que o Usuário consulte os termos e
                                condições de uso estabelecidos por cada Site vinculado aos links inseridos.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;não será responsável, direta ou indiretamente,
                                por qualquer dano e/ou prejuízo causado ou relacionado à utilização de qualquer
                                informação,
                                conteúdo, bens e/ou serviços disponibilizados no Site ou em qualquer Site de terceiros
                                acessado por meio dos links disponibilizados.
                            </li>
                        </ol>
                        <h4>8. Aplicações de Internet ou vírus de computador</h4>
                        <ol class="alpha">
                            <li>Em virtude de dificuldades técnicas, aplicações de Internet ou problemas
                                de transmissão, é possível a ocorrência de cópias inexatas ou incompletas das
                                informações
                                contidas no Site. Vírus de computador ou outros programas danosos também poderão ser
                                baixados inadvertidamente do Site.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;não será responsável por qualquer aplicação,
                                vírus de computador e/ou arquivos danosos, invasivos, ou programas que possam prejudicar
                                e
                                afetar a utilização do computador ou outro bem dos Usuários devido ao acesso, utilização
                                ou
                                navegação neste Site, ou ainda pelo download de qualquer material nele contido, sendo
                                recomendada a instalação de aplicativos antivírus ou protetores adequados.
                            </li>
                        </ol>
                        <h4>9. Modificações e Rescisão</h4>
                        <ol class="alpha">
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;poderá, a seu exclusivo critério, bloquear,
                                restringir, desabilitar ou impedir o acesso de qualquer Usuário ao Site, total ou
                                parcialmente, sem qualquer aviso prévio, sempre que for detectada uma conduta inadequada
                                do
                                Usuário, sem prejuízo das medidas administrativas, extrajudiciais e judiciais que julgar
                                convenientes.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;poderá unilateralmente revisar, aprimorar,
                                modificar e/ou atualizar, a qualquer momento, qualquer cláusula ou disposição contida
                                nestes
                                Termos e Condições de Uso. Reserva-se, ainda, o direito de suspender e/ou cancelar, de
                                forma
                                unilateral e a qualquer momento, o acesso ao Site ou a algumas de suas partes ou a
                                alguns de
                                seus recursos, sem necessidade de aviso prévio.
                            </li>
                            <li>Este Site não possui garantia de continuidade, podendo ser extinto sem
                                representar qualquer direito adquirido ao Usuário.
                            </li>
                            <li>O uso continuado após a mudança no Termo de uso será considerado como
                                uma aceitação do mesmo. Se você não concordar ou não estiver satisfeito com as mudanças
                                no
                                Termo de uso, deverá cancelar sua conta.&nbsp;Esta rescisão não eximirá, no entanto, o
                                Usuário de
                                cumprir com todas as obrigações assumidas sob as versões precedentes das Políticas e dos
                                Termos e Condições de Uso.&nbsp;&nbsp;Dessa forma, o Usuário concorda que periodicamente
                                deve
                                verificar as eventuais modificações do Termo de Uso, disponibilizadas no próprio
                                aplicativo,
                                e ler as eventuais mensagens que a&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;enviar em relação ao
                                citado Termo
                                de Uso.
                            </li>
                            <li>Os desenvolvedores da&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;trabalham para oferecer ao
                                Usuário um sistema seguro, interativo e atrativo. Desta forma, poderão haver inclusões
                                e/ou
                                remoções de funcionalidades do aplicativo ou a criação de novos limites aos serviços, o
                                que
                                poderá modificar a forma de interação com o Usuário.&nbsp;
                            </li>
                            <li>Possível a ocorrência de situações em que o Serviço precisará ser
                                interrompido, incluindo, mas não se limitando, à manutenção ou atualizações programadas,
                                reparos de emergência, ou em razão de falhas de ligações de telecomunicações e/ou
                                equipamentos.
                            </li>
                        </ol>
                        <h4>10. Disposições Gerais</h4>
                        <ol class="alpha">
                            <li>Todos os eventuais serviços onerosos serão dispostos em um contrato, em
                                formato digital.
                            </li>
                            <li>A&nbsp;WINDX TELECOMUNICAÇÕES&nbsp;poderá unilateralmente revisar, aprimorar,
                                modificar e/ou atualizar, a qualquer momento, qualquer cláusula ou disposição contida
                                nestes
                                Termos e Condições de Uso. Reserva-se, ainda, o direito de suspender e/ou cancelar, de
                                forma
                                unilateral e a qualquer momento, o acesso ao Site ou a algumas de suas partes ou a
                                alguns de
                                seus recursos, sem necessidade de aviso prévio.
                            </li>
                            <li>Nas atualizações e informações repassadas através do Site, deverá sempre
                                ser considerado o horário oficial de Brasília, inclusive nos períodos de horário de
                                verão.
                            </li>
                            <li>Nas atualizações e informações repassadas através do Site, deverá sempre
                                ser considerado o horário oficial de Brasília, inclusive nos períodos de horário de
                                verão.
                            </li>
                            <li>Caso haja dificuldade em fazer valer ou cumprir qualquer cláusula ou
                                condição contida nestes Termos e Condições de Uso ou nas Políticas, tal fato não
                                configurará
                                desistência, tolerância ou novação dessa cláusula ou condição destes Termos ou de
                                qualquer
                                Política. Se alguma cláusula ou condição contida nestes Termos e Condições de Uso ou nas
                                Políticas for declarada inexequível, no todo ou parcialmente, tal inexequibilidade não
                                afetará as demais cláusulas dos Termos e Condições de Uso e das Políticas. Neste caso,
                                serão
                                efetivadas as adaptações necessárias para que reflitam, da forma mais próxima possível,
                                os
                                termos da provisão declarada inexequível.
                            </li>
                            <li>Nenhuma das Partes será responsabilizada perante a outra quando o
                                descumprimento ou o cumprimento extemporâneo de uma obrigação prevista nas Políticas ou
                                nestes Termos e Condições de Uso for causado por casos fortuitos ou eventos de força
                                maior,
                                enquanto perduraram as suas consequências.
                            </li>
                        </ol>
                        <h4>11. Foro e Competência</h4>
                        <p>A presente relação será regida pela Legislação Brasileira. Ainda, as partes elegem o foro da
                            Comarca de Marataízes / ES, para dirimir quaisquer controvérsias oriundas da utilização do
                            presente Site, com renúncia expressa de qualquer outro, por mais privilegiado que seja ou
                            venha a ser.</p>
                    </div>
                </div>
                <div class="modal-footer" style="border: 0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="acceptTerms()">Aceitar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/home.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script>
        var navItems = document.querySelectorAll(".bottom-nav-item");

        navItems.forEach(function (e, i) {
            e.addEventListener("click", function (e) {
                navItems.forEach(function (e2, i2) {
                    e2.classList.remove("active");
                });
                this.classList.add("active");
            });
        });
    </script>
@endsection
