/**
 * Description: Cart for payment of billets
 * Company: Windx Telecomunicações
 * Developer: Wellington Dias Ferreira
 */

class Billet {
    constructor() {
        // this.id = 1
        this.billets = []
        this.totalBillets = document.querySelector(".total-billets");
        this.totalValue = document.querySelector(".total-value");
        this.totalInput = document.querySelector(".inputTotal");
        this.additionInput = document.querySelector(".inputAddition");
        this.discountInput = document.querySelector(".inputDiscount");
        this.slide = document.querySelectorAll('[data-id="slide"]');
    }
    //
    // saveData() {
    //     let billet = this.readData()
    //
    //     if (days === 0){
    //         this.addData(billet);
    //     } else {
    //
    //     }
    //
    //     // let parts = date.split('/')
    //     // let today = new Date()
    //     // let days = 0;
    //     //
    //     // date = new Date(parts[2], parts[1] - 1, parts[0])
    //     //
    //     // if (date >= today) {
    //     //     this.addData(billet);
    //     // } else {
    //     //     let difference = Math.abs(today - date)
    //     //     days = parseInt(difference/(1000 * 3600 * 24))
    //     //
    //     //     console.log(this.calcMulta('69.90'))
    //     //     console.log('Esse são os juros: R$ '+this.calcJuros('69.90', days))
    //     //     // console.log('Esta fatura está atrasada à ' + result + ' dias!')
    //     // }
    //
    //     // if(this.validationDate(date) != 0){
    //     //     console.log(this.validation())
    //     // }else{
    //     //     console.log('Em dia');
    //     // }
    //
    //     // if(this.validation(billet)){
    //     // this.addData(billet);
    //     // }
    //
    //     // console.log(billet);
    //
    //     console.log(days);
    // }

    addData(billet) {
        this.billets.push(billet)
        this.id++;
        let jsonString = JSON.stringify(this.billets);
        document.querySelector("[name='billets']").value = jsonString
        // this.convertJson(this.billets)
        this.displayTotalBillets(this.billets.length)
        this.displayTotalValue()
        this.activeNextBtn()
        console.log(this.billets)
    }

    readData(key, id, reference, val, fees, discount, total) {
        let billet = {}
        let v = parseFloat(val.replace(',', '.'))
        let f = parseFloat(fees.replace(',', '.'))
        let d = parseFloat(discount.replace(',', '.'))
        let t = parseFloat(total.replace(',', '.'))

        // console.log(typeof v, v)
        // console.log(typeof f, f)
        // console.log(typeof d, d)
        // console.log(typeof t, t)

        if (t !== v){
            // let additional = parseFloat(fees).toFixed(2);
            // console.log(additional)
            // let val = parseFloat(value)
            // console.log(val)
            // let total = this.formatValue(val + additional)
            // console.log(total)
            // document.querySelector(".total-value");

            // console.log(v)
            // console.log(f)
            // console.log(d)
            // console.log(t)
            //
            billet.billet_id = id
            billet.value = Number((v).toFixed(2))
            billet.addition = Number((f).toFixed(2))
            billet.discount = Number((d).toFixed(2))
            billet.reference = reference

            // this.totalValue.innerHTML = t.toFixed(2).replace('.', ',')
            // this.displayTotalValue(billet.value, billet.addition)
            // console.log(billet)
            // console.log('Com juros')
            this.paintSelected(key);
            this.activeNextBtn()

        } else {
            billet.billet_id = id
            billet.value = v
            billet.addition = f
            billet.discount = d
            billet.reference = reference

            // this.totalValue.innerHTML = v.toFixed(2).replace('.', ',')
            // this.displayTotalValue(billet.value, billet.addition)
            // console.log('Sem juros')

            this.paintSelected(key);
            this.activeNextBtn()
        }

        return this.addData(billet);
    }

    cancel()
    {
        let billets = this.billets;
        this.billets = []
        this.totalBillets.innerHTML = "0"
        this.totalValue.innerHTML = "0"
        this.activeNextBtn()
        history.go(-1);
        // this.paintRemoveAll()

        // const el = document.getElementsByClassName('sc-product-item')
        // //
        // for (var i = 0; i < billets.length; i++) {
        //     this.paintRemove(i) //remove a borda verde
        //     const el = document.getElementById(i)
        //     el.classList.remove("sc-added-item","sc-added-border")
        // }
        //
        // // const el = document.getElementById('0')
        // // el.classList.remove("sc-added-item","sc-added-border")
        //
        // // alert('Todos os boletos foram removidos com sucesso!')
        // console.log(this.billets)
    }

    removeData(key, reference)
    {
        let billets = this.billets;

        for (var i = 0; i < billets.length; i++) {
            if (billets[i].reference === reference) {
                this.paintRemove(key) //remove a borda verde
                var billet = billets[i]
                var pos = billets.indexOf(billet);
                billets.splice(pos,1)
                console.log(billets)
            }
        }
        this.displayTotalBillets(this.billets.length)
        this.displayTotalValue()
        this.activeNextBtn()
    }

    // refreshDisplay(value, addition)
    // {
    //
    //     // console.log(value + addition)
    //     this.displayTotalBillets(this.billets.length)
    //     this.displayTotalValue()
    //
    //     // let displayVal = parseFloat(this.totalValue.innerHTML.replace(',', '.'))
    //     console.log(displayVal)
    //
    //     // let val = displayVal - value - addition
    //     //
    //     // console.log(displayVal)
    //     // this.totalValue.innerHTML = val
    //
    // }

    formatValue(value)
    {
        var str = parseFloat(value).toFixed(2)+"";
        str = str.replace(".", ",");
        // str = "R$ "+str;
        return str;
    }

    formatDigits(value)
    {
        var str = parseFloat(value).toFixed(2)+"";
        return str;
    }

    paintSelected(key)
    {
        let el = document.getElementById(key)
        el.classList.add('sc-added-item','sc-added-border');
        let btnIdPrint = document.querySelector('button[name="print-billet-'+key+'"]')
        btnIdPrint.disabled = true
        this.hideBtnAdd(key)
        // this.activeNextBtn()
    }

    hideBtnAdd(key)
    {
        let btnId = document.querySelector('button[name="add-to-cart-'+key+'"]')
        btnId.classList.add('d-none')
        let btnIdRemove = document.querySelector('button[name="remove-from-cart-'+key+'"]')
        btnIdRemove.classList.remove('d-none')

    }

    hideBtnRemove(key)
    {
        let btnId = document.querySelector('button[name="remove-from-cart-'+key+'"]')
        btnId.classList.add('d-none')
        let btnIdPrint = document.querySelector('button[name="print-billet-'+key+'"]')
        btnIdPrint.disabled = false
        let btnIdAdd = document.querySelector('button[name="add-to-cart-'+key+'"]')
        btnIdAdd.classList.remove('d-none')
    }

    // hideBtnRemoveAll()
    // {
    //     let btnId = document.getElementsByClassName('remove-from-cart')
    //     btnId.classList.add('d-none')
    //     let btnIdAdd = document.getElementsByClassName('add-to-cart')
    //     btnIdAdd.classList.remove('d-none')
    // }

    paintRemove(key)
    {
        let el = document.getElementById(key)
        el.classList.remove('sc-added-item','sc-added-border')
        this.hideBtnRemove(key)
    }

    paintRemoveAll()
    {
        // document.getElementById('0').className -= "sc-added-border";

        const el = document.getElementById('0')
        // console.log(el)
        // el.classList.remove('sc-added-border')
        el.classList.remove('sc-added-item','sc-added-border')
        // // this.hideBtnRemoveAll()
    }

    displayTotalBillets(amount)
    {
        this.totalBillets.innerHTML = amount
    }

    displayTotalValue()
    {
        let val = ""
        let billets = this.billets
        let total = billets.reduce(getTotal, 0);
        function getTotal(total, item) {
            return total + (item.value + item.addition);
        }
        val += total
        console.log(val)

        let str = parseFloat(val).toFixed(2) + "";
        str = str.replace(".",",");
        this.totalValue.innerHTML = str
        this.totalInput.value = str

        // this.activeNextBtn(billets)
    }

    activeNextBtn()
    {
        let nextBtn = document.getElementById('submitCart')
        let cancelBtn = document.getElementById('cancelAllBillets')
        // let btnCancel = document.querySelector('button[name="cancel"]')
        if(this.billets.length > 0){
            nextBtn.disabled = false
            cancelBtn.disabled = false
        }else{
            nextBtn.disabled = true
            cancelBtn.disabled = true
        }
    }

    // convertJson(arr)
    // {
    //     let jsonString = JSON.stringify(arr);
    //     document.querySelector("[name='billets']").value = jsonString
    // }

    // verifyDays(date) {
    //     let parts = date.split('/')
    //     let today = new Date()
    //     let days = 0;
    //
    //     date = new Date(parts[2], parts[1] - 1, parts[0])
    //
    //     if (date > today) {
    //         days = 0;
    //         return days
    //     } else {
    //         let difference = Math.abs(today - date)
    //         days = parseInt(difference /(1000 * 3600 * 24))
    //         return days
    //         // console.log('Esta fatura está atrasada à ' + result + ' dias!')
    //     }
    // }
    //
    // validation(billet){
    //     let message = '';
    //     if (this.billets.indexOf(billet) === -1) {
    //         // this.billets.push(billet);
    //         console.log('Nova coleção é : ' + this.billets);
    //     } else if (this.billets.indexOf(billet) > -1) {
    //         console.log('O boleto '+ billet + ' já existe na coleção.');
    //     }
    //
    //     // for(let i = 0; i < this.billets.length; i++){
    //     //     let refBillet = this.billets[i].reference;
    //     //     console.log(refBillet);
    //     // }
    //     //
    //     // if(billet.reference == '') {
    //     //     message += '- Referência inválida!';
    //     // }
    //     //
    //     // if(billet.value == '') {
    //     //     message += '- Valor inválido!';
    //     // }
    //     //
    //     // if(billet.addition == '') {
    //     //     message += '- Valor adicional inválido!';
    //     // }
    //     //
    //     // if(message != '') {
    //     //     alert(message);
    //     //     return false;
    //     // }
    //     //
    //     // return true
    // }
    //
    // calcFine(value){
    //     let result = (value * 2) / 100
    //     return result.toFixed(2)
    // }
    //
    // calcFees(value, days){
    //     let fees = (days * 0.2)
    //     let result = ((value * fees) / 100)
    //     return result.toFixed(2)
    // }

}

var billet = new Billet();
