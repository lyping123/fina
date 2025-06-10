<?php 
include("include/db.php");
if(isset($_GET["action"]) && $_GET["action"] == "lhdn_submit"){
    $id = $_GET['id'];
    echo $qry = "SELECT *,r.s_name AS old_name,r.r_date as newdate,r.createby as newid FROM f_receipt AS r
		LEFT JOIN f_b_c AS bc ON bc.r_id = r.id 
		LEFT JOIN student AS s ON s.id = r.s_id
		WHERE r.id = '".$id."'";
        $sql = mysqli_query($conn,$qry);
        $row = mysqli_fetch_array($sql);
        $num = mysqli_num_rows($sql);

        $select="select * from login where id='".$row["newid"]."'";
        $sttr=mysqli_query($conn,$select);
        $row_n=mysqli_fetch_array($sttr);


    
                        if($row['receipt_type'] == 2){
                            if($row['cash_bill_option'] == 'Debtor PTPK'){
                                $type = 'DP';
                            }elseif($row['cash_bill_option'] == 'Debtor'){
                                $type = 'D';
                            }elseif($row['cash_bill_option'] == 'Internal Exam Fee'){
                                $type = 'I';
                            }elseif($row['cash_bill_option'] == 'Hostel Fee'){
                                $type = 'H';
                            }elseif($row['cash_bill_option'] == 'Tuition Fee'){
                                $type = 'T';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK'){
                                $type = 'TP';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Auto debit'){
                                $type = 'TPA';
                            }elseif($row['cash_bill_option'] == 'Tuition PTPK Seft pay'){
                                $type = 'TPS';
                            }
                            elseif($row['cash_bill_option'] == 'Enrollment Fee'){
                                $type = 'E';
                            }
                            elseif($row['cash_bill_option'] == 'laptop deposit'){
                                $type = 'LD';
                            }

                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = $type.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }else{
                            if($row['r_no'] == ''){
                                $rno_qry = "SELECT count(fr.id) AS r_no FROM f_receipt AS fr WHERE fr.r_status = 'ACTIVE' AND fr.receipt_type = '".$row['receipt_type']."' AND fr.cash_bill_option = '".$row['cash_bill_option']."' AND fr.id BETWEEN 1 AND ".$_GET['id'];
                                $rno_result = mysqli_query($conn, $rno_qry);
                                $rno_row = mysqli_fetch_array($rno_result);
                                $r_no = 10000 + $rno_row['r_no'];
                                $r_no = 'D'.$r_no;
                            }else{
                                $r_no = $row['r_no'];
                            }
                        }

        $select = "SELECT rp_amount,rp_desc  FROM f_receipt_detail WHERE r_id = '".$id."'";
        $result = mysqli_query($conn, $select);
        $row_detail = mysqli_fetch_array($result);
        $rp_amount=600;
        // while( $row_detail = mysqli_fetch_array($result)){
        //      $rp_amount=$row_detail["rp_amount"];
        // }
        
        
        
        $tin="IG56194676000";
        $nric="960526075719";
        
        

        $data = [
            "_D" => "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2",
            "_A" => "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2",
            "_B" => "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2",
            "Invoice" => [
                [
                "ID" => [["_" => $r_no]],
                "IssueDate" => [["_" => date('Y-m-d', strtotime($row['newdate']))]],
                "InvoiceTypeCode" => [["_" => "01", "listVersionID" => "1.0"]],
                "IssueTime" => [["_" => date('H:i:s')]],
                "DocumentCurrencyCode" => [["_" => "MYR"]],

                "AccountingSupplierParty" => [
                    [
                    "Party" => [
                        [
                        "IndustryClassificationCode" => [["_" => "46510", "name" => "Wholesale of computer hardware, software and peripherals"]],   
                        "PartyIdentification" => [
                            ["ID" => [["_" => "C21957338070", "schemeID" => "TIN"]]],
                            ["ID" => [["_" => "201001004598", "schemeID" => "BRN"]]]
                        ],
                        "PartyLegalEntity" => [
                            ["RegistrationName" => [["_" => "synergy central academy sdn bhd"]]]
                        ],
                        "PostalAddress" => [
                            [
                            "CityName" => [["_" => "Bukit mertajam"]],
                            "PostalZone" => [["_" => "14000"]],
                            "CountrySubentityCode" => [["_" => "07"]],
                            "AddressLine" => [
                                ["Line" => [["_" => "No 2, Jalan Perusahaan 1, Taman Perindustrian Bukit Minyak"]]]
                            ],
                            "Country" => [
                                ["IdentificationCode" => [["_" => "MYS"]]]
                            ]
                            ]
                        ],
                        "Contact" => [
                            [
                            "Telephone" => [["_" => "+60124081851"]],
                            "ElectronicMail" => [["_" => "sysynergy@hotmail.com"]]
                            ]
                        ]
                        ]
                    ]
                    ]
                ],

                "AccountingCustomerParty" => [
                    [
                    "Party" => [
                        [
                        "PostalAddress" => [
                            [
                            "CityName" => [["_" => "Bukit mertajam"]],
                            "PostalZone" => [["_" => $row["r_postcode"]]],
                            "CountrySubentityCode" => [["_" => "07"]],
                            "AddressLine" => [
                                ["Line" => [["_" => $row["r_address"]]]]
                            ],
                            "Country" => [
                                ["IdentificationCode" => [["_" => "MYS"]]]
                            ]
                            ]
                        ],
                        "PartyLegalEntity" => [
                            ["RegistrationName" => [["_" => $row["s_name"]]]]
                        ],
                        "PartyIdentification" => [
                            ["ID" => [["_" => $tin, "schemeID" => "TIN"]]],
                            ["ID" => [["_" => $nric, "schemeID" => "NRIC"]]]
                        ],
                        "Contact" => [
                            [
                            "Telephone" => [["_" => "+60".$row["hp_contact"]]],
                            "ElectronicMail" => [["_" => $row["s_email"]]]
                            ]
                        ]
                        ]
                    ]
                    ]
                ],

                "InvoiceLine" => [
                    [
                    "ID" => [["_" => $row["id"]]],
                    "InvoicedQuantity" => [["_" => 1, "unitCode" => "C62"]],
                    "LineExtensionAmount" => [["_" => (float)$rp_amount, "currencyID" => "MYR"]],
                    "Item" => [
                        [
                        "Description" => [["_" => $row_detail["rp_desc"]]],
                        "CommodityClassification" => [
                            ["ItemClassificationCode" => [["_" => "010", "listID" => "CLASS"]]]
                        ]
                        ]
                    ],
                    "Price" => [
                        ["PriceAmount" => [["_" => (float)$rp_amount, "currencyID" => "MYR"]]]
                    ],
                    "ItemPriceExtension"=> "0.00",
                    "TaxTotal" => [
                        [
                        "TaxAmount" => [["_" => 0.00, "currencyID" => "MYR"]],
                        "TaxSubtotal" => [
                            [
                            "TaxableAmount" => [["_" => (float)$rp_amount, "currencyID" => "MYR"]],
                            "TaxAmount" => [["_" => 0.00, "currencyID" => "MYR"]],
                            "TaxCategory" => [
                                [
                                "ID" => [["_" => "E"]],
                                "TaxExemptionReason" => [["_" => "Not subject to tax"]],
                                "TaxScheme" => [
                                    ["ID" => [["_" => "OTH", "schemeID" => "UN/ECE 5153", "schemeAgencyID" => "6"]]]
                                ]
                                ]
                            ]
                            ]
                        ]
                        ]
                    ]
                    ]
                ],

                "LegalMonetaryTotal" => [
                    [
                    "LineExtensionAmount" => [["_" => (float)$rp_amount, "currencyID" => "MYR"]],
                    "TaxExclusiveAmount" => [["_" => (float)$rp_amount, "currencyID" => "MYR"]],
                    "PayableAmount" => [["_" =>(float)$rp_amount, "currencyID" => "MYR"]],
                    "AllowanceTotalAmount" => [["_" => 0, "currencyID" => "MYR"]]
                    ]
                ]
                ]
            ]
            ];


        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        // $json= file_get_contents("invoice1.0.json");

        // print_r($json);

        $base64= base64_encode($json);
        $documentHash = hash("sha256", $json);

        $invoiceId = $data["Invoice"][0]["ID"][0]["_"];
        // echo "Invoice ID: $invoiceId\n";
        $clientId = "bb3401e7-03a3-45bd-a4e2-08eadd92691e";
        $clientSecret = "a7ffeb49-57bc-44fa-a1ea-6a0eda3ef2b6";

        $payload = http_build_query([
            "grant_type" => "client_credentials",
            "client_id" => $clientId,
            "client_secret" => $clientSecret,
            "scope" => "InvoicingAPI"
        ]);

        $ch = curl_init("https://preprod-api.myinvois.hasil.gov.my/connect/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        $response = curl_exec($ch);
        $data = json_decode($response, true);
        // print_r($data);
        curl_close($ch);

        $accessToken = $data["access_token"];

        $payload = [
            "documents" => [
                [
                    "format" => "JSON",
                    "document" => $base64,
                    "documentHash" => $documentHash,
                    "codeNumber" => $invoiceId
                ]
            ]
        ];
        $json_payload = json_encode($payload,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                
        $ch = curl_init("https://preprod-api.myinvois.hasil.gov.my/api/v1.0/documentsubmissions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json",
            "Accept: application/json"
        ]);
       
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo "HTTP Status: $httpCode\n";
        echo "Response: $response\n";



        
       
}

?>