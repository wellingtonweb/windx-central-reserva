function generatePDF(){
    var element = document.getElementById('printable');
    var opt = {
        margin:       .4,
        filename:     'boleto.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
    // html2pdf(element, opt);
}
