<html>
<head>
    <title>TOKEN CIELO</title>
</head>
<body>
<h2>TOKEN CIELO</h2>
<h4>Documentação 3DS Cielo</h4>
<p>https://github.com/DeveloperCielo/developercielo.github.io/blob/docs/_i18n/pt/_posts/3ds/integracao-javascript.md</p>
<button onclick="getTokenCielo()">Receber token</button>
<p id="messageTextResponse"></p>
<script type="text/javascript">
    function getTokenCielo(){
        var url = "https://mpi.braspag.com.br"
        var authorization = btoa('3d60f342-9728-47bd-9295-556a7e16e67f:CnsSGyo9IKUWiUw+v4Q1WcHwYdH2VGiyQYV2Jz0gs14=');

        var data = {
            "EstablishmentCode":"1106093345",
            "MerchantName": "PENHA DE SOUZA JAMARI",
            // "MCC": "5733"
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
                console.log(data);
                if(!data.error){
                    document.getElementById("messageTextResponse").innerText = data.access_token;
                }else{
                    document.getElementById("messageTextResponse").innerText = data.error_description;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }
    getTokenCielo()
</script>
</body>
</html>
