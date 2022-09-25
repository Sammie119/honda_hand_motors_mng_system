<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Receipt</title>

        <style type="text/css">
            body{
                width: 90%;
                margin-left: 5%;
            }

            table { border-collapse: collapse; }
            th {
                border-top: solid thin; 
                border-bottom: solid thin;
            }

            #main {
                border: solid 1px;
                border-radius: 10px;
            }

            #logo img{
                width: 100px;
                height: 90px;
                float: left;
                margin-left: 20px;	
            }

            #logo1 img{
                width: 100px;
                height: 90px;
                float: right;
                margin-right: 20px;	
            }

            .mov {
                margin: 5px;
                text-transform: uppercase;
            }

            hr {
                border-color: #000;
            }
            button {
            float: right;
            padding: 10px 25px;
    
            font-family: 'Bree Serif', serif;
            font-weight: 200;
            font-size: 18px;
            color: #fff;
            text-shadow: 0px 1px 0 rgba(0,0,0,0.25);
            
            background: #56c2e1;
            border: 1px solid #46b3d3;
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
            cursor: pointer;
            
            box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
            -moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
            -webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
            }

            button:hover{
            background: #3f9db8;
            border: 1px solid rgba(256,256,256,0.75);
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
            -moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
            -webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
            }

            @media print {
                .noprint{
                    visibility: hidden;
                }
            }
        </style>

        <script type="text/javascript">
            function print_1(){
                window.print();
                window.close();
            }
        </script>
    </head>
    <body id="breaker">
        <div id="main">
            <div id="logo"  class="mov"><img src="{{ asset('public/assets/images/honda_logo3.png') }}"/></div>
            <div id="logo1"  class="mov"><img src="{{ asset('public/assets/images/honda_logo3.png') }}"/></div>
            <div>
                <div align="center"><b style="font-size: 32px;">HONDA HAND MOTORS</b><br>
                    <b style="font-size: 17px;">
                        Old Barrier, Ash Bread Road Second Right Lane<br>
                        New Weija, Accra Kasoa High Way<br>
                        Mobile No.: 0244952603 / 0234746771
                    </b>
                </div>
            </div>
        
            <hr class="mov">
                    
            <div class="mov">
                <div><b>Name:</b> {{ $data->customer->customer_name }}</div>
                <div><b>Car Registration No.:</b> {{ $data->customer->car_no }}
                    <div style="float: right;"><b>Contact:</b> {{ $data->customer->customer_contact }} </div>
                </div>
                <div><b>Car Model:</b> {{ $data->customer->car_model }} 
                    <div style="float: right;"><b>Date:</b> {{ date('d M, Y') }} </div>
                </div>
                <div><b>Driver's Name:</b> {{ $data->customer->driver_name }} 
                    <div style="float: right;"><b>Receipt No.:</b> {{ $data->receipt_no }} </div>
                </div> 
            </div>
        
            <hr class="mov">
        
            <div class="mov">
                <div align="center"><u><b>Transactions:</b></u></div>
                @switch($request)
                    @case('service')
                        <div>
                            <table border="0" class="mov">
                                <thead>
                                    <th width="3%">#</th>
                                    <th width="">Fault</th>
                                    <th width="3%">Charge</th>
                                    <th width="20%">Amount Paid</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td STYLE='text-align: left; padding-left: 3px;'>{{ $data->service->fault }}</td>
                                        <td STYLE='text-align: center;'>{{ formatCedisAmount($data->service->ser_charge) }}</td>
                                        <td STYLE='text-align: right; padding-right: 20px;'>{{ formatCedisAmount($data->paid_amount) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="border-top: solid thin; border-bottom: solid thin;">
                                        <td colspan="3" STYLE="text-align: right;">Previous Payment: </td>
                                        <td STYLE='text-align: right; padding-right: 20px;'>{{ formatCedisAmount($data->service->amount_paid - $data->paid_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" STYLE="text-align: right;">Total Amount Paid: </th>
                                        <th STYLE='text-align: right; padding-right: 20px;'>{{ formatCedisAmount($data->service->amount_paid) }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" STYLE="text-align: right;">Amount Balance: </th>
                                        <th STYLE='text-align: right; padding-right: 20px;'>{{ formatCedisAmount($data->service->ser_charge - $data->service->amount_paid) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        @break

                    @case('stores')
                        
                        <h1>Stores Receipt</h1>
                        @break
                
                    @default
                        <h3>No Department Select</h3>
                @endswitch
            </div>
            
            <div align="center"><b>Stay Blessed.......</b></div>
        
        </div>

        <div class="mov noprint">
            <button onClick="print_1()">Print</button>
        </div>
        
        <footer><center>Created and Designed by: <i><b>SAMMAV I.T</b> Services (0248376160 / 0556226864)</i></center></footer>
    </body>

    <script type="text/javascript">
        window.onload=function(){
            document.getElementById("breaker").style.pageBreakAfter="always";
        };
    </script>

</html>
