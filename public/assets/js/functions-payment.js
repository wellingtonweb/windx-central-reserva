function genInvoicePdf(id_btn, payment){
    let container = $('#container-invoice');
    console.log(id_btn)
    renderInvoice(id_btn)
    container.removeClass('d-none');
    html2canvas(document.querySelector("#container-invoice"))
        .then(canvas => {
            var imgData = canvas.toDataURL('image/jpeg');
            // var doc = new jsPDF('p','mm','a4');
            var doc = new jsPDF('p','mm',[210, 297]);
            doc.addImage(imgData, 'jpeg', 2, 2);
            doc.save('boleto.pdf');
        });
    container.addClass('d-none');
};

function renderInvoice(id_btn){
    const invoice = JSON.parse($(`#${id_btn}`).attr('data-invoice'));
    $('.i-numero-banco').html('| '+invoice.NumeroBanco+'-0 |');
    $('.i-local-pagamento').html(invoice.LocalPagamento);
    $('.i-vencimento').html(convertDateTime(invoice.Vencimento));
    $('.i-id-empresa').html(checkFavored(invoice.Id_Empresa));
    $('.i-cod-cedente').html(invoice.CodigoCedente);
    $('.i-data-emissao').html(convertDateTime(invoice.Data_Emissao));
    $('.i-data-processamento').html(dateNow());
    $('.i-nosso-numero').html(invoice.NossoNumero);
    $('.i-valor').html((invoice.Valor).toFixed(2).toString().replace(".",","));
    $('.i-nome').html(invoice.Nome);
    $('.i-cpf-cgc').html(invoice.CpfCgc);
    $('.i-endereco').html(invoice.Endereco+', '+invoice.Bairro+', '+invoice.Cidade+'-'+invoice.UF+'('+invoice.CEP+')');
    $('.i-seu-numero').html(invoice.SeuNumero);
    $('.i-linha-digitavel').html(invoice.LinhaDigitavel);
    JsBarcode(".i-barcode", invoice.CodigoBarras, {
        format: "ITF",
        lineColor: "#000000",
        width: 2,
        height: 90,
        marginTop: -15,
        fontSize: 40,
        displayValue: false
    });
}
