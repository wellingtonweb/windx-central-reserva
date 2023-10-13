<html>
<head>
    <title>Sample</title>
    <script type="text/javascript">
        function sendOrder() {
            bpmpi_authenticate();
        }
    </script>
</head>
<body>
<div>
    <h2>Sample</h2>

    <input type="hidden" name="authEnabled" class="bpmpi_auth" value="true" />
    <input
        type="hidden"
        name="authEnabledNotifyonly"
        class="bpmpi_auth_notifyonly"
        value="true"
    />
    <input
        type="hidden"
        name="accessToken"
        id="accessToken"
        class="bpmpi_accesstoken"
        value=""
    />
    <div>
        <label>Order Number:</label>
        <input
            type="text"
            size="50"
            name="orderNumber"
            class="bpmpi_ordernumber"
            value=""
        />
    </div>
    <div>
        <label>Currency:</label>
        <select name="currency" class="bpmpi_currency">
            <option value="986" selected="selected">BRL</option>
            <option value="840">USD</option>
            <option value="032">ARS</option>
        </select>
    </div>
    <div>
        <label>Amount:</label>
        <input
            type="text"
            size="50"
            name="amount"
            class="bpmpi_totalamount"
            value="1.00"
        />
    </div>
    <div>
        <label>Installments:</label>
        <input
            type="text"
            size="2"
            name="installments"
            class="bpmpi_installments"
            value="1"
        />
    </div>
    <div>
        <label>Payment Method:</label>
        <select name="paymentMethod" class="bpmpi_paymentmethod">
            <option value="credit" selected="selected">Credit</option>
            <option value="debit">Debit</option>
        </select>
    </div>
    <div>
        <label>Card Number:</label>
        <input
            type="text"
            size="50"
            name="cardNumber"
            class="bpmpi_cardnumber"
            value="4000000000001091"
        />
    </div>
    <div>
        <label>Expiration date:</label>
        <input
            type="text"
            size="50"
            name="expMonth"
            class="bpmpi_cardexpirationmonth"
            value="05"
        />
        <input
            type="text"
            size="50"
            name="expYear"
            class="bpmpi_cardexpirationyear"
            value="2027"
        />
    </div>
    <!-- dados de cobrança -->
    <fieldset style="width: 0">
        <legend>Billing Address</legend>

        <div>
            <label>Name:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_name"
                value="Comprador de Teste"
            />
        </div>
        <div>
            <label>Phone number:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_phonenumber"
                value="999225626381"
            />
        </div>
        <div>
            <label>E-mail:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_email"
                value="comprador@teste.com.br"
            />
        </div>
        <div>
            <label>Street 1:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_street1"
                value="Av Marechal Camara 160"
            />
        </div>
        <div>
            <label>Street 2:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_street2"
                value="Sala 934 Centro"
            />
        </div>
        <div>
            <label>City:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_city"
                value="Rio de Janeiro"
            />
        </div>
        <div>
            <label>State:</label>
            <input type="text" size="50" class="bpmpi_billto_state" value="RJ" />
        </div>
        <div>
            <label>Country:</label>
            <input type="text" size="2" class="bpmpi_billto_country" value="BR" />
        </div>
        <div>
            <label>Zipcode:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_zipcode"
                value="20020080"
            />
        </div>
    </fieldset>


    <!-- dados do pedido -->
    <fieldset style="width: 0">
        <legend>Order</legend>

        <div>
            <label>Merchant URL:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_merchant_url"
                value="http://www.loja.com.br"
            />
        </div>

        <div>
            <label>Product code:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_order_productcode"
                value="PHY"
            />
            <!-- ver domínio no manual -->
        </div>
    </fieldset>

    <input
        type="button"
        onclick="sendOrder()"
        value="Send Order"
        id="btnSendOrder"
    />
</div>
</body>

<script type="text/javascript">

</script>
<script type="text/javascript">
    document.getElementsByClassName("bpmpi_ordernumber")[0].value = generateOrderNumber();
    // document.getElementsByClassName("bpmpi_ordernumber")[0].value = Math.floor(Math.random() * 65536);

    function generateOrderNumber() {
        let now = new Date();

        let hash = `${now.getFullYear()}`;
            hash += (now.getMonth() + 1) < 10 ? `0${now.getMonth() + 1}`:`${now.getMonth() + 1}`;
            hash += now.getDate() < 10 ? `0${now.getDate()}`: `${now.getDate()}`;
            hash += now.getHours() < 10 ? `0${now.getHours()}`: `${now.getHours()}`;
            hash += now.getMinutes() < 10 ? `0${now.getMinutes()}`: `${now.getMinutes()}`;
            hash += `${Math.floor(Math.random() * 5000)}`;

        return hash;
    }

    function getTokenCielo(){
        var url = "https://mpisandbox.braspag.com.br"
        var authorization = btoa('dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e:D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag=');

        // var url = "https://mpi.braspag.com.br"
        // var authorization = btoa('3d60f342-9728-47bd-9295-556a7e16e67f:CnsSGyo9IKUWiUw+v4Q1WcHwYdH2VGiyQYV2Jz0gs14=');

        var data = {
            "EstablishmentCode":"1106093345",
            "MerchantName": "PENHA DE SOUZA JAMARI",
            "MCC": "4816"
        };

        fetch(url+"/v2/auth/token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": 'Basic '+ authorization
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                if(!data.error){
                    console.log(data);
                    document.getElementById("accessToken").innerText = data.access_token;
                }else{
                    console.log(data.error_description);
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }
    getTokenCielo()

    var env = getQueryString("env");

    function bpmpi_config() {
        return {
            onReady: function () {
                // Evento indicando quando a inicialização do script terminou.
                document.getElementById("btnSendOrder").disabled = false;
            },
            onSuccess: function (e) {
                // Cartão elegível para autenticação, e portador autenticou com sucesso.
                var cavv = e.Cavv;
                var xid = e.Xid;
                var eci = e.Eci;
                var version = e.Version;
                var referenceId = e.ReferenceId;
            },
            onFailure: function (e) {
                // Cartão elegível para autenticação, porém o portador finalizou com falha.
                var xid = e.Xid;
                var eci = e.Eci;
                var version = e.Version;
                var referenceId = e.ReferenceId;
            },
            onUnenrolled: function (e) {
                // Cartão não elegível para autenticação (não autenticável).
                var xid = e.Xid;
                var eci = e.Eci;
                var version = e.Version;
                var referenceId = e.ReferenceId;
            },
            onDisabled: function () {
                // Loja não requer autenticação do portador (classe "bpmpi_auth" false -> autenticação desabilitada).
            },
            onError: function (e) {
                // Erro no processo de autenticação.
                var xid = e.Xid;
                var eci = e.Eci;
                var returnCode = e.ReturnCode;
                var returnMessage = e.ReturnMessage;
                var referenceId = e.ReferenceId;
            },
            onUnsupportedBrand: function (e) {
                // Bandeira não suportada para autenticação.
                var returnCode = e.ReturnCode;
                var returnMessage = e.ReturnMessage;
            },
            Environment: env ? env : "SDB",
            Debug: true,
        };
    }

    function getQueryString(field) {
        var href = window.location.href;
        var reg = new RegExp("[?&]" + field + "=([^&#]*)", "i");
        var string = reg.exec(href);
        return string ? string[1] : null;
    }
</script>
<script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>
{{--<script src="https://mpi.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>--}}
</html>
