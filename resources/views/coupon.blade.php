<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Windx Pay - Comprovante de pagamento</title>
</head>
<body>
<div id="conteudo">
    <h3>Olá cliente, este é seu comprovante de pagamento!</h3>

    <p>Comprovante!!!</p>
</div>
<div id="editor"></div>
<button id="btGerarPDF">gerar PDF</button>
<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jspdf.js') }}"></script>
<script>
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    doc.fromHTML($('#conteudo').html(), 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
    });
    doc.save('exemplo-pdf.pdf');
    history.back();
</script>
</body>
</html>
