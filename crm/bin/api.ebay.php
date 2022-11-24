<?php

class Ebay {

    private
        $access_token,
        $scadenza_token = 0,
        $dbConn;

    public function __construct($dbConn) {

        $this->dbConn = $dbConn;
        $this->checkScadenza();

    }

    private function checkScadenza() {

        if(strlen($this->access_token) > 0)
            if ($this->scadenza_token > time()) return 1;

        $querySql = "SELECT ea_scadenza, ea_valore FROM ea_ebay_api WHERE ea_nome = 'access_token' ";
        $result = $this->dbConn->query($querySql);
        list($ea_scadenza, $ea_valore) = $result->fetch_array();
        $result->close();

        if($ea_scadenza > time()) {

            $this->access_token = $ea_valore;
            $this->scadenza_token = $ea_scadenza;
            return 1;

        }

        return $this->generatetoken();

    }

    public function generatetoken() {

        $code = isset($_GET['code']) ? $_GET['code'] : "";

        if(strlen($code) == 0) {

            $_SESSION['return_link'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $login_link = getEbayInfo("login_link", $this->dbConn);
            echo "<meta http-equiv='refresh' content='0;URL=$login_link'>";
            exit;

        }

        $client_id = getEbayInfo("client_id", $this->dbConn);
        $client_secret = getEbayInfo("client_secret", $this->dbConn);
        $ru_name = getEbayInfo("ru_name", $this->dbConn);

        $credenzial = base64_encode("$client_id:$client_secret");
        $body = "grant_type=authorization_code&code=$code&redirect_uri=$ru_name";

        $risposta = callAPI('POST', "https://api.ebay.com/identity/v1/oauth2/token", $body,
            array(
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic $credenzial"
            ));

        $response = json_decode($risposta, true);

        $access_token = $response['access_token'];
        $access_token_expires_in = time() + $response['expires_in'];

        $refresh_token = $response['refresh_token'];
        $refresh_token_expires_in = time() + $response['refresh_token_expires_in'];

        $querySql = "UPDATE ea_ebay_api SET ea_valore = '$access_token', ea_scadenza = '$access_token_expires_in' WHERE ea_nome = 'access_token' ";
        $result = $this->dbConn->query($querySql);

        $querySql = "UPDATE ea_ebay_api SET ea_valore = '$refresh_token', ea_scadenza = '$refresh_token_expires_in' WHERE ea_nome = 'refresh_token' ";
        $result = $this->dbConn->query($querySql);

        $this->access_token = $access_token;
        return 1;

    }

    public function addLocation($addressLine1, $addressLine2, $city, $stateOrProvince, $postalCode, $country = "IT") {

        $this->checkScadenza();

        $json = '
        {
            "location": {
                "address": {
                    "addressLine1": "'.$addressLine1.'",
                    "addressLine2": "'.$addressLine2.'",
                    "city": "'.$city.'",
                    "stateOrProvince": "'.$stateOrProvince.'",
                    "postalCode": "'.$postalCode.'",
                    "country": "'.$country.'"
                }
            },
            "locationInstructions": "Il prodotto viene inviato da qui.",
            "name": "Negozio",
            "merchantLocationStatus": "ENABLED",
            "locationTypes": ["STORE"]
        }';

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json",
            "Content-Language:it-IT",
        );

        $chiamata = "https://api.ebay.com/sell/inventory/v1/location/LOC01";
        $result = callAPI('POST', $chiamata, $json, $header);

        if($result == "204") return 1;
        else {

            $this->addEbayLog($chiamata, $json, $result);
            return 0;

        }

    }

    public function addMetodoPagamento($payaplEmail, $marketplaceId = "EBAY_IT") {

        $this->checkScadenza();

        $json = '
        {
          "categoryTypes": [
            {
              "name": "ALL_EXCLUDING_MOTORS_VEHICLES",
              "default": true
            }
          ],
          "name": "default payment policy",
          "description": "Standard payment policy, PP & CC payments",
          "marketplaceId": "'.$marketplaceId.'",
          "immediatePay": false,
          "paymentMethods": [
            {
              "paymentMethodType": "PAYPAL",
              "recipientAccountReference": {
                "referenceId": "'.$payaplEmail.'",
                "referenceType": "PAYPAL_EMAIL"
              }
            }
          ]
        }';

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json"
        );

        $chiamata = "https://api.ebay.com/sell/account/v1/payment_policy";
        $result = callAPI('POST', $chiamata, $json, $header);
        $response = json_decode($result, true);

        $paymentPolicyId = $response['paymentPolicyId'];

        if(strlen($paymentPolicyId) > 0) {

            $this->setEbayInfo("paymentPolicyId", $paymentPolicyId);
            return 1;

        } else {

            $this->addEbayLog($chiamata, $json, $result);
            return 0;

        }

    }

    public function addSpedizione($shippingCarrierCode = "PosteItaliane", $shippingServiceCode = "IT_ExpressCourier", $marketplaceId = "EBAY_IT") {

        $this->checkScadenza();

        $json = '
        {
          "categoryTypes": [
            {
              "name": "ALL_EXCLUDING_MOTORS_VEHICLES"
            }
          ],
          "marketplaceId": "'.$marketplaceId.'",
          "name": "Standard",
          "handlingTime": { 
            "unit" : "DAY",
            "value" : "1"
          },
          "shippingOptions": [
            {
              "costType": "FLAT_RATE",
              "optionType": "DOMESTIC",
              "shippingServices": [
                {
                  "buyerResponsibleForShipping": "false",
                  "freeShipping": "true",
                  "shippingCarrierCode": "'.$shippingCarrierCode.'",
                  "shippingServiceCode": "'.$shippingServiceCode.'"
                }
              ]
            }
          ]
        }';

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json"
        );

        $chiamata = "https://api.ebay.com/sell/account/v1/fulfillment_policy";
        $result = callAPI('POST', $chiamata, $json, $header);
        $response = json_decode($result, true);

        $fulfillmentPolicyId = $response['fulfillmentPolicyId'];

        if(strlen($fulfillmentPolicyId) > 0) {

            $this->setEbayInfo("fulfillmentPolicyId", $fulfillmentPolicyId);
            return 1;

        } else {

            $this->addEbayLog($chiamata, $json, $result);
            return 0;

        }

    }

    public function addRestituzioni($marketplaceId = "EBAY_IT") {

        $this->checkScadenza();

        $json = '
        {
          "name": "minimal return policy, IT marketplace",
          "marketplaceId": "'.$marketplaceId.'",
          "refundMethod": "MONEY_BACK",
          "returnsAccepted": true,
          "returnShippingCostPayer": "BUYER",
          "returnPeriod": {
            "value": 30,
            "unit": "DAY"
          }
        }';

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json"
        );

        $chiamata = "https://api.ebay.com/sell/account/v1/return_policy";
        $result = callAPI('POST', $chiamata, $json, $header);
        $response = json_decode($result, true);

        $returnPolicyId = $response['returnPolicyId'];

        if(strlen($returnPolicyId) > 0) {

            $this->setEbayInfo("returnPolicyId", $returnPolicyId);
            return 1;

        } else {

            $this->addEbayLog($chiamata, $json, $result);
            return 0;

        }

    }

    public function addItem($sku, $title, $quantity, $condition, $aspects = array(), $images = array()) {

        $this->checkScadenza();

        $aspects_join = "";
        foreach ($aspects as $k => $v) $aspects_join .= '"'.$k.'": ["'.$v.'"],';
        $aspects_join = rtrim($aspects_join, ",");

        $images = '"'.join('","', $images).'"';

        $json = '{
            "product": {
                "title": "'.$title.'",
                "aspects": { '.$aspects_join.' },
                "description": "Descrizione inutilizzata",
                "upc": ["NA"],
                "ean" : ["NA"],
                "imageUrls": [ '.$images.' ]
            },
            "condition": "'.$condition.'",
            "availability": {
                "pickupAtLocationAvailability" : [
                    {
                        "availabilityType" : "IN_STOCK",
                        "fulfillmentTime" : 
                            {
                            "unit" : "HOUR",
                            "value" : "1"
                            },
                        "merchantLocationKey" : "LOC01",
                        "quantity" : "'.$quantity.'"
                    }
                ],
                "shipToLocationAvailability": {
                    "quantity": '.$quantity.'
                }
            }
        }';

        /*
        "packageWeightAndSize": {
                "dimensions": {
                    "height": 5,
                    "length": 10,
                    "width": 15,
                    "unit": "INCH"
                },
                "packageType": "MAILING_BOX",
                "weight": {
                    "value": 2,
                    "unit": "POUND"
                }
            },
         */

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json",
            "Content-Language:it-IT",
        );

        $chiamata = "https://api.ebay.com/sell/inventory/v1/inventory_item/$sku";
        $result = callAPI('PUT', $chiamata, $json, $header);

        if($result == "204") return 1;
        else {

            $this->addEbayLog($chiamata, $json, $result);
            return 1; //warning

        }

    }

    public function addOffer($sku, $description, $quantity, $price, $categoryId = "36631", $currency = "EUR", $marketplaceId = "EBAY_IT") {

        $this->checkScadenza();

        $fulfillmentPolicyId = $this->getEbayInfo("fulfillmentPolicyId");
        $paymentPolicyId = $this->getEbayInfo("paymentPolicyId");
        $returnPolicyId = $this->getEbayInfo("returnPolicyId");

        $json = '
        {
           "sku": "'.$sku.'",
           "marketplaceId": "'.$marketplaceId.'",
           "format": "FIXED_PRICE",
           "availableQuantity": '.$quantity.',
           "categoryId": "'.$categoryId.'",
           "listingDescription": "'.$description.'",
           "listingPolicies": {
              "fulfillmentPolicyId": "'.$fulfillmentPolicyId.'",
              "paymentPolicyId": "'.$paymentPolicyId.'",
              "returnPolicyId": "'.$returnPolicyId.'"
           },
           "pricingSummary": {
              "price": {
                 "currency": "'.$currency.'",
                 "value": "'.$price.'"
              }
           },
           "quantityLimitPerBuyer": '.$quantity.',
           "merchantLocationKey": "LOC01"
        }';

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json",
            "Content-Language:it-IT",
        );

        $chiamata = "https://api.ebay.com/sell/inventory/v1/offer";
        $result = callAPI('POST', $chiamata, $json, $header);
        $response = json_decode($result, true);

        $offerId = strlen($response['offerId']) > 0 ? $response['offerId'] : $response['errors'][0]['parameters'][0]['value'];

        if(strlen($offerId) > 0 && $offerId != $sku) {

            $this->addOfferta($sku, $offerId);
            return $offerId;

        } else {

            $this->addEbayLog($chiamata, $json, $result);
            return 0;

        }

    }

    public function publishOffer($sku, $offerId) {

        $this->checkScadenza();

        $access_token = $this->access_token;

        $header = array(
            "Authorization:Bearer $access_token",
            "Accept:application/json",
            "Content-Type:application/json"
        );

        $chiamata = "https://api.ebay.com/sell/inventory/v1/offer/$offerId/publish";
        $result = callAPI('POST', $chiamata, " ", $header);
        $response = json_decode($result, true);

        $listingId = strlen($response['listingId']) > 0 ? $response['listingId'] : "";

        if(strlen($listingId) > 0) {

            $this->addOfferta($sku, $offerId, $listingId, strtotime("+30 days"));
            return 1;

        } else {

            $this->addEbayLog($chiamata, "", $result);
            return 0;

        }

    }


    //============

    public function setEbayInfo($info_name, $value) {

        $querySql = "SELECT COUNT(ea_id) FROM ea_ebay_api WHERE ea_nome = '$info_name' ";
        $result = $this->dbConn->query($querySql);
        $count = $result->fetch_array()[0];

        if($count > 0) $querySql = "UPDATE ea_ebay_api SET ea_valore = '$value' WHERE ea_nome = '$info_name' ";
        else $querySql = "INSERT INTO ea_ebay_api (ea_nome, ea_valore) VALUES ('$info_name', '$value') ";
        $result = $this->dbConn->query($querySql);

        return $result;

    }

    public function getEbayInfo($info_name) {

        return getEbayInfo($info_name, $this->dbConn);

    }

    public function addOfferta($prodotto, $offerta, $listing_id = "", $scadenza = "0") {

        return addOfferta($prodotto, $offerta, $this->dbConn, $listing_id, $scadenza);

    }

    public function addEbayLog($el_chiamata, $el_parametri, $el_errore) {

        $el_timestamp = time();

        $querySql = "INSERT INTO el_ebay_log (el_chiamata, el_parametri, el_errore, el_timestamp) VALUES ('$el_chiamata', '$el_parametri', '$el_errore', '$el_timestamp')";
        $result = $this->dbConn->query($querySql);

        return $result;

    }

    public function getOfferte($sku) {

        $querySql = "SELECT COUNT(eo_id) FROM eo_ebay_offerte WHERE eo_prodotto = '$sku' ";
        $result = $this->dbConn->query($querySql);
        $check = $result->fetch_array()[0];
        $result->close();

        return $check;

    }

    public function getOfferteScadute($sku) {

        $querySql = "SELECT COUNT(eo_id) FROM eo_ebay_offerte WHERE eo_prodotto = '$sku' AND eo_scadenza < UNIX_TIMESTAMP() ";
        $result = $this->dbConn->query($querySql);
        $check = $result->fetch_array()[0];
        $result->close();

        return $check;

    }


}

// ============ FUNZIONI ESTERNE API ================

function callAPI($method, $url, $data, $header = array()){

    $curl = curl_init();

    switch ($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    // EXECUTE:
    $result = curl_exec($curl);

    if(!$result){

        $info = curl_getinfo($curl);
        curl_close($curl);
        return $info['http_code'];

    }

    curl_close($curl);
    return $result;
}

function addOfferta($prodotto, $offerta, $dbConn, $listing_id = "", $scadenza = "0") {

    $querySql = "SELECT COUNT(eo_id) FROM eo_ebay_offerte WHERE eo_prodotto = '$prodotto' AND eo_offerta = '$offerta' ";
    $result = $dbConn->query($querySql);
    $check = $result->fetch_array()[0];
    $result->close();

    if($check == 0) {

        $querySql =
            "INSERT INTO eo_ebay_offerte (eo_prodotto, eo_offerta, eo_listing_id, eo_scadenza) ".
            "VALUES ('$prodotto', '$offerta', '$listing_id', '$scadenza') ";

    }
    else {

        $querySql = "UPDATE eo_ebay_offerte SET eo_offerta = '$offerta' ";
        if ($listing_id != "NULL") $querySql .= ", eo_listing_id = '$listing_id' ";
        if ($scadenza != "NULL") $querySql .= ", eo_scadenza = '$scadenza' ";
        $querySql .= " WHERE eo_prodotto = '$prodotto' ";

    }

    $result = $dbConn->query($querySql);
    return $result;

}

function getEbayInfo($info_name, $dbConn) {

    $querySql = "SELECT ea_valore FROM ea_ebay_api WHERE ea_nome = '$info_name' ";
    $result = $dbConn->query($querySql);
    $value = $result->fetch_array()[0];
    $result->close();

    return $value;

}

?>