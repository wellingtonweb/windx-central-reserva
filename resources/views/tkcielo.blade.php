<html>
<head>
    <title>{{$header}}</title>
    <script type="text/javascript">
        function sendOrder() {
            bpmpi_authenticate();
        }
    </script>
</head>
<body>
<div>
    <h2>{{$header}}</h2>

    <input type="hidden" name="authEnabled" class="bpmpi_auth" value="true" />
    <input
        type="hidden"
        name="authEnabledNotifyonly"
        class="bpmpi_auth_notifyonly"
        value="true"
    />
    <input
        type="text"
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
            value="123456"
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
            value="1000"
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
            value="5200000000001096"
        />
    </div>
    <div>
        <label>Expiration date:</label>
        <input
            type="text"
            size="50"
            name="expMonth"
            class="bpmpi_cardexpirationmonth"
            value="01"
        />
        <input
            type="text"
            size="50"
            name="expYear"
            class="bpmpi_cardexpirationyear"
            value="2025"
        />
    </div>
    <div>
        <label>Card Alias:</label>
        <input
            type="text"
            size="50"
            class="bpmpi_cardalias"
            value="cartaodoguilherme"
        />
    </div>
    <div>
        <label>Default:</label>
        <input type="text" size="50" class="bpmpi_default_card" value="true" />
    </div>
    <div>
        <label>Recurring End Date:</label>
        <input
            type="text"
            size="50"
            class="bpmpi_recurring_enddate"
            value="2025-01-16"
        />
    </div>
    <div>
        <label>Recurring Frequency:</label>
        <select class="bpmpi_recurring_frequency">
            <option value="1">Monthly</option>
            <option value="2">Bimonthly</option>
            <option value="3">Quarterly</option>
            <option value="4">FourMonths</option>
            <option value="6">SemiAnnual</option>
            <option value="12">Annual</option>
        </select>
    </div>
    <div>
        <label>Recurring Original Purchase Date:</label>
        <input
            type="text"
            size="50"
            class="bpmpi_recurring_originalpurchasedate"
            value="2023-12-26T15:30:50"
        />
    </div>
    <fieldset style="width: 0">
        <legend>Gift Card</legend>
        <div>
            <label>Amount:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_giftcard_amount"
                value="1000"
            />
            <!-- em centavos -->
        </div>
        <div>
            <label>Currency:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_giftcard_currency"
                value="BRL"
            />
        </div>
    </fieldset>
    <!-- dados de cobrança -->
    <fieldset style="width: 0">
        <legend>Billing Address</legend>
        <div>
            <label>Customer ID (CPF/CNPJ):</label>
            <input
                type="text"
                size="14"
                class="bpmpi_billto_customerid"
                value="02580681400"
            />
        </div>
        <div>
            <label>New Customer:</label>
            <select name="newCustomer" class="bpmpi_merchant_newcustomer">
                <option value="credit" selected="selected">true</option>
                <option value="debit">false</option>
            </select>
        </div>
        <div>
            <label>Name:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_contactname"
                value="Carolina Sueli das Neves"
            />
        </div>
        <div>
            <label>Phone number:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_phonenumber"
                value="49988354908"
            />
        </div>
        <div>
            <label>E-mail:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_billto_email"
                value="carolina_sueli_dasneves@temp.com.br"
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
    <!-- dados de entrega (obs: se o "bpmpi_shipto_sameasbillto" for "true" não é necessário enviar os dados de entrega) -->
{{--    <fieldset style="width: 0">--}}
{{--        <legend>Delivery Address</legend>--}}
{{--        <div>--}}
{{--            <label>Same as billing address:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_sameasbillto"--}}
{{--                value="false"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Recipient:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_name"--}}
{{--                value="Destinatario de Teste"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Phone number:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_phonenumber"--}}
{{--                value="552122326381"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>E-mail:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_email"--}}
{{--                value="destinatario@teste.com.br"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Street 1:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_street1"--}}
{{--                value="Rua do Carmo 64"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Street 2:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_street2"--}}
{{--                value="2º andar Centro"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>City:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_city"--}}
{{--                value="Rio de Janeiro"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>State:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_shipto_state" value="RJ" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Country:</label>--}}
{{--            <input type="text" size="2" class="bpmpi_shipto_country" value="BR" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Zipcode:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_zipcode"--}}
{{--                value="20011020"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Shipping Method:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_shippingmethod"--}}
{{--                value="lowcost"--}}
{{--            />--}}
{{--            <!-- ver domínio no manual -->--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Last usage date:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_shipto_lastusagedate"--}}
{{--                value="2018-09-06"--}}
{{--            />--}}
{{--        </div>--}}
{{--    </fieldset>--}}
    <!-- dados do device (coleção) -->
    <fieldset style="width: 0">
        <legend>Device</legend>
        <div>
            <label>Ip address:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_device_ipaddress"
                value="200.155.265.12"
            />
        </div>
        <div>
            <label>Channel:</label>
            <input
                type="text"
                size="7"
                class="bpmpi_device_channel"
                value="Browser"
            />
        </div>
{{--        <div>--}}
{{--            <label>Fingerprint:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_device_1_fingerprint"--}}
{{--                value="04003hQUMXGB0poNf94lis1ztuLYRFk+zJ17aP79a9O8mWOBmEnKs6ziAo94ggAtBvKEN6/FI8Vv2QMAyHLnc295s0Nn8akZzRJtHwsEilYx"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Provider:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_device_1_provider"--}}
{{--                value="cardinal"--}}
{{--            />--}}
{{--            <!-- ver domínio no manual -->--}}
{{--        </div>--}}
    </fieldset>
{{--    <!-- dados do carrinho (coleção) -->--}}
{{--    <table border="1">--}}
{{--        <caption>--}}
{{--            Cart--}}
{{--        </caption>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Item</th>--}}
{{--            <th>Description</th>--}}
{{--            <th>Sku</th>--}}
{{--            <th>Quantity</th>--}}
{{--            <th>Unit Price</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_1_name"--}}
{{--                    value="ostarine mk-2866"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_1_description"--}}
{{--                    value="Estimula o aumento da massa muscular e da força"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_1_sku"--}}
{{--                    value="10000000000234"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input type="text" class="bpmpi_cart_1_quantity" value="2" />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input type="text" class="bpmpi_cart_1_unitprice" value="450" />--}}
{{--                <!-- em centavos -->--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_2_name"--}}
{{--                    value="ostarine mk-2867"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_2_description"--}}
{{--                    value="Estimula mais aumento da massa muscular e da força"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_cart_2_sku"--}}
{{--                    value="10000000000235"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input type="text" class="bpmpi_cart_2_quantity" value="3" />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input type="text" class="bpmpi_cart_2_unitprice" value="550" />--}}
{{--                <!-- em centavos -->--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <!-- dados de aérea (coleção de trechos) -->--}}
{{--    <table border="1">--}}
{{--        <caption>--}}
{{--            Travel legs--}}
{{--        </caption>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Carrier</th>--}}
{{--            <th>Departure Date</th>--}}
{{--            <th>Origin</th>--}}
{{--            <th>Destination</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}

{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_1_carrier"--}}
{{--                    value="G3"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_1_departuredate"--}}
{{--                    value="2018-09-21"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_1_origin"--}}
{{--                    value="SDC"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_1_destination"--}}
{{--                    value="GIG"--}}
{{--                />--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_2_carrier"--}}
{{--                    value="G3"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_2_departuredate"--}}
{{--                    value="2018-09-22"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_2_origin"--}}
{{--                    value="GIG"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_travelleg_2_destination"--}}
{{--                    value="SDC"--}}
{{--                />--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <!-- dados de passageiros (coleção) -->--}}
{{--    <table border="1">--}}
{{--        <caption>--}}
{{--            Passengers--}}
{{--        </caption>--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Name</th>--}}
{{--            <th>Ticket Price</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}

{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_passenger_1_name"--}}
{{--                    value="Chuck Norris"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_passenger_1_ticketprice"--}}
{{--                    value="450"--}}
{{--                />--}}
{{--                <!-- em centavos -->--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_passenger_2_name"--}}
{{--                    value="Charles Bronson"--}}
{{--                />--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                <input--}}
{{--                    type="text"--}}
{{--                    class="bpmpi_airline_passenger_2_ticketprice"--}}
{{--                    value="550"--}}
{{--                />--}}
{{--                <!-- em centavos -->--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <!-- dados de aérea complementares -->--}}
{{--    <fieldset style="width: 0">--}}
{{--        <legend>Airline Aditional Data</legend>--}}
{{--        <div>--}}
{{--            <label>Number of passengers:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_airline_numberofpassengers"--}}
{{--                value="2"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Passport Country:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_airline_billto_passportcountry"--}}
{{--                value="BR"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Passport Number:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_airline_billto_passportnumber"--}}
{{--                value="4849494984911"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>MDD1:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_mdd1" value="mdd1" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>MDD2:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_mdd2" value="mdd2" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>MDD3:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_mdd3" value="mdd3" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>MDD4:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_mdd4" value="mdd4" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>MDD5:</label>--}}
{{--            <input type="text" size="50" class="bpmpi_mdd5" value="mdd5" />--}}
{{--        </div>--}}
{{--    </fieldset>--}}
    <!-- dados do pedido -->
    <fieldset style="width: 0">
        <legend>Order</legend>
        <div>
            <label>Transaction Mode:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_transaction_mode"
                value="S"
            />
        </div>
        <div>
            <label>Merchant URL:</label>
            <input
                type="text"
                size="50"
                class="bpmpi_merchant_url"
                value="https://www.windx.com.br"
            />
        </div>
{{--        <div>--}}
{{--            <label>Recurrence:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_recurrence"--}}
{{--                value="false"--}}
{{--            />--}}
{{--        </div>--}}
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
{{--        <div>--}}
{{--            <label>Last 24 hours count:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_countlast24hours"--}}
{{--                value="1"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Last 6 month count:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_countlast6months"--}}
{{--                value="8"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Last year count:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_countlast1year"--}}
{{--                value="55"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Card attempts on last 24 hours:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_cardattemptslast24hours"--}}
{{--                value="3"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Marketing optin:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_marketingoptin"--}}
{{--                value="false"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Marketing source:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_order_marketingsource"--}}
{{--                value="mercadolivre"--}}
{{--            />--}}
{{--        </div>--}}
    </fieldset>
    <!-- dados do usuário/conta -->

{{--    <fieldset style="width: 0">--}}
{{--        <legend>User account</legend>--}}
{{--        <div>--}}
{{--            <label>Guest:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_guest"--}}
{{--                value="true"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Created date:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_createddate"--}}
{{--                value="2023-12-25"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Changed date:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_changeddate"--}}
{{--                value="2022-12-01"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Password changed date:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_passwordchangeddate"--}}
{{--                value="2022-12-01"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Authentication method:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_authenticationmethod"--}}
{{--                value="02"--}}
{{--            />--}}
{{--            <!-- ver domínio no manual -->--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Authentication protocol:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_authenticationprotocol"--}}
{{--                value="oauth"--}}
{{--            />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label>Authentication timetamp:</label>--}}
{{--            <input--}}
{{--                type="text"--}}
{{--                size="50"--}}
{{--                class="bpmpi_useraccount_authenticationtimestamp"--}}
{{--                value="201809061510"--}}
{{--            />--}}
{{--        </div>--}}
{{--    </fieldset>--}}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/BP.Mpi.3ds20.min.js') }}"></script>
<script type="text/javascript">
    var env = getQueryString("env");
    document.getElementsByClassName("bpmpi_ordernumber")[0].value = generateOrderNumber();
    // document.getElementsByClassName("bpmpi_ordernumber")[0].value = Math.floor(Math.random() * 65536);

    // var url = "https://mpisandbox.braspag.com.br"
    // var authorization = btoa('dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e:D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag=');
    // console.log(`Basic ${authorization}`)
    //
    var url = "https://mpi.braspag.com.br"
    // var authorization = btoa('3d60f342-9728-47bd-9295-556a7e16e67f:CnsSGyo9IKUWiUw+v4Q1WcHwYdH2VGiyQYV2Jz0gs14=');
    var authorization = btoa('521ab3e1-b97d-4090-8d2f-3292c36ea26e:JeR2HoUjq4oyjOC3/nZAlZkkFKdmNP26p50swKzdRVY=');
    var merchantData = {
        "EstablishmentCode":"1106093345",
        // "MerchantName": "WIDX",
        "MerchantName": "PENHA DE SOUZA JAMARI",
        "MCC": "4816"
    };

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

    (function getTokenCielo(){
        fetch(url+"/v2/auth/token", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Basic ${authorization}`
            },
            body: JSON.stringify(merchantData),
        })
            .then((response) => response.json())
            .then((data) => {
                if(!data.error){
                    // console.log(data);
                    document.getElementsByClassName("bpmpi_accesstoken")[0].value = data.access_token
                    // document.getElementsByClassName("bpmpi_accesstoken").value = data.access_token;

                    // document.getElementById("accessToken").value = data.access_token;
                }else{
                    console.log(data.error_description);
                }
            })
            .catch((error) => {
                console.error(error);
            })
            .finally(() => {
                // alert('Finalizou!')
            });
    })()
    // getTokenCielo()

    //--------------------------------------------

    // var accessToken = async () => {
    //     const settings = {
    //         method: "POST",
    //         headers: {
    //             "Content-Type": "application/json",
    //             "Authorization": 'Basic '+ authorization
    //         },
    //         body: JSON.stringify(merchantData)
    //     };
    //     try {
    //         const fetchResponse = await fetch(`${url}/v2/auth/token`, settings);
    //         const data = await fetchResponse.json();
    //         console.log('Data: ',data);
    //         return data.access_token;
    //     } catch (e) {
    //         return e;
    //     }
    // }



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
                console.log("Deu certo: ", cavv, xid, eci, version, referenceId)
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
            Environment: "PRD",
            // Environment: "SDB",
            // Environment: env ? env : "SDB",
            Debug: true,
        };
    }

    function getQueryString(field) {
        var href = window.location.href;
        var reg = new RegExp("[?&]" + field + "=([^&#]*)", "i");
        var string = reg.exec(href);
        return string ? string[1] : null;
    }

    $(function() {
        $.getJSON("https://api.ipify.org?format=jsonp&callback=?",
            function(json) {
                console.log("Meu IP público é: ", json.ip);
                document.getElementsByClassName("bpmpi_device_ipaddress")[0].value = json.ip
                // document.write("Meu IP público é: ", json.ip);
            }
        );
    });

</script>

{{--<script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>--}}

</html>
