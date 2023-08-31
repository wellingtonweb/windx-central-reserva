<html>
<head>
    <title>TOKEN CIELO</title>

</head>
<body>
<h2>TOKEN CIELO</h2>
<button onclick="getTokenCielo()">Receber token</button>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>--}}
<script type="text/javascript">


    // const enviroment = "sandbox"
    const enviroment = "production"
    let authorization, url = ""

    function getTokenCielo(){

        if(enviroment === 'production'){
            //Production
            url = "https://mpi.braspag.com.br"
            authorization = "Basic ba78abeb-e530-4cd1-94da-151df1144fb4:LLtQYODFNJ4zLVyvc/VO/xGTGCYeP9WapU0YEn3YiCs="
        }else{
            //Sandbox
            url = "https://mpisandbox.braspag.com.br"
            authorization = "Basic dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e:D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag="
        }

        const data = {
                    "EstablishmentCode":"1106093345",
                    "MerchantName": "PENHA DE SOUZA JAMARI",
                    "MCC": "5733"
                };

        fetch(url+"/v2/auth/token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": authorization
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Success:", data);
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    }


</script>
{{--<script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>--}}
{{--<script src="https://mpi.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>--}}
</body>
</html>
