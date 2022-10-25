<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Report</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('public/assets/bootstrap/bootstrap_5.2.1.min.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/ico">

        <style type="text/css">
            #table1 {
                width: 40%;
            }

            h4 {
                font-size: 30px; 
                color: #191970; 
                font-family: Times new roman; 
                font-weight: bold;
            }

            h3 {
                text-align: center;
                font-size: 25px; 
                color: #191970; 
                font-family: Times new roman; 
                font-weight: bold;
            }

            .table2 {
                
                padding-left: 10px;
                padding-right: 10px;
                font-size: 15px;
                width: 100%;
            }

            @media print {
                .btn, #back{
                    display: none;
                }
            }

            label {
                font-weight: normal;
            }

            .lab {
                float: right;
                padding-right: 10px;
            }

        </style>
        <script type="text/javascript">
            function print_1(){
                window.print();
                window.location = "{{ url()->previous() }}";
            }
            
        </script>
    </head>
    <div id="back"><a href="{{ url()->previous() }}">Back</a></div>
    <body id="breaker">
        <center><img src="{{ asset('public/assets/images/logo_logo2.png') }}"></center>
        <center><h4>HONDA HANDS MOTORS</h4></center>
        
        @switch($key)
            @case('income')
            <!--Income Statement Print View-->
                {{-- <table border="0" align="center" class ="table2">
                    <?php 
                        //FROM
                            $from_month = $_SESSION['from_month'];
                            $from_year = $_SESSION['from_year'];

                            if($from_month == "January"){
                                $f = $from_year - 1;
                                $from1 = date("$f-12-31");
                                $from2 = date("$from_year-01-01");
                                $from3 = date("$from_year-01-02");
                                $from4 = date("$from_year-01-03");
                            }
                            elseif($from_month == "February"){
                                $from1 = date("$from_year-01-31");
                                $from2 = date("$from_year-02-01");
                                $from3 = date("$from_year-02-02");
                                $from4 = date("$from_year-02-03");
                            }
                            elseif($from_month == "March"){
                                $from1 = date("$from_year-02-28");
                                $from2 = date("$from_year-03-01");
                                $from3 = date("$from_year-03-02");
                                $from4 = date("$from_year-03-03");
                            }
                            elseif($from_month == "April"){
                                $from1 = date("$from_year-03-31");
                                $from2 = date("$from_year-04-01");
                                $from3 = date("$from_year-04-02");
                                $from4 = date("$from_year-04-03");
                            }
                            elseif($from_month == "May"){
                                $from1 = date("$from_year-04-30");
                                $from2 = date("$from_year-05-01");
                                $from3 = date("$from_year-05-02");
                                $from4 = date("$from_year-05-03");
                            }
                            elseif($from_month == "June"){
                                $from1 = date("$from_year-05-31");
                                $from2 = date("$from_year-06-01");
                                $from3 = date("$from_year-06-02");
                                $from4 = date("$from_year-06-03");
                            }
                            elseif($from_month == "July"){
                                $from1 = date("$from_year-06-30");
                                $from2 = date("$from_year-07-01");
                                $from3 = date("$from_year-07-02");
                                $from4 = date("$from_year-07-03");
                            }
                            elseif($from_month == "August"){
                                $from1 = date("$from_year-07-31");
                                $from2 = date("$from_year-08-01");
                                $from3 = date("$from_year-08-02");
                                $from4 = date("$from_year-08-03");
                            }
                            elseif($from_month == "September"){
                                $from1 = date("$from_year-08-31");
                                $from2 = date("$from_year-09-01");
                                $from3 = date("$from_year-09-02");
                                $from4 = date("$from_year-09-03");
                            }
                            elseif($from_month == "October"){
                                $from1 = date("$from_year-09-30");
                                $from2 = date("$from_year-10-01");
                                $from3 = date("$from_year-10-02");
                                $from4 = date("$from_year-10-03");
                            }
                            elseif($from_month == "November"){
                                $from1 = date("$from_year-10-31");
                                $from2 = date("$from_year-11-01");
                                $from3 = date("$from_year-11-02");
                                $from4 = date("$from_year-11-03");
                            }
                            else{
                                $from1 = date("$from_year-11-30");
                                $from2 = date("$from_year-12-01");
                                $from3 = date("$from_year-12-02");
                                $from4 = date("$from_year-12-03");
                            }

                        //TO
                            $to_month = $_SESSION['to_month'];
                            $to_year = $_SESSION['to_year'];

                            if($to_month == "January"){
                                $to1 = date("$to_year-01-31");
                                $to2 = date("$to_year-02-01");
                                $to3 = date("$to_year-02-02");
                                $to4 = date("$to_year-02-03");
                            }
                            elseif($to_month == "February"){
                                $to1 = date("$to_year-02-28");
                                $to2 = date("$to_year-03-01");
                                $to3 = date("$to_year-03-02");
                                $to4 = date("$to_year-03-03");
                            }
                            elseif($to_month == "March"){
                                $to1 = date("$to_year-03-31");
                                $to2 = date("$to_year-04-01");
                                $to3 = date("$to_year-04-02");
                                $to4 = date("$to_year-04-03");
                            }
                            elseif($to_month == "April"){
                                $to1 = date("$to_year-04-30");
                                $to2 = date("$to_year-05-01");
                                $to3 = date("$to_year-05-02");
                                $to4 = date("$to_year-05-03");
                            }
                            elseif($to_month == "May"){
                                $to1 = date("$to_year-05-31");
                                $to2 = date("$to_year-06-01");
                                $to3 = date("$to_year-06-02");
                                $to4 = date("$to_year-06-03");
                            }
                            elseif($to_month == "June"){
                                $to1 = date("$to_year-06-30");
                                $to2 = date("$to_year-07-01");
                                $to3 = date("$to_year-07-02");
                                $to4 = date("$to_year-07-03");
                            }
                            elseif($to_month == "July"){
                                $to1 = date("$to_year-07-31");
                                $to2 = date("$to_year-08-01");
                                $to3 = date("$to_year-08-02");
                                $to4 = date("$to_year-08-03");
                            }
                            elseif($to_month == "August"){
                                $to1 = date("$to_year-08-31");
                                $to2 = date("$to_year-09-01");
                                $to3 = date("$to_year-09-02");
                                $to4 = date("$to_year-09-03");
                            }
                            elseif($to_month == "September"){
                                $to1 = date("$to_year-09-30");
                                $to2 = date("$to_year-10-01");
                                $to3 = date("$to_year-10-02");
                                $to4 = date("$to_year-10-03");
                            }
                            elseif($to_month == "October"){
                                $to1 = date("$to_year-10-31");
                                $to2 = date("$to_year-11-01");
                                $to3 = date("$to_year-11-02");
                                $to4 = date("$to_year-11-03");
                            }
                            elseif($to_month == "November"){
                                $to1 = date("$to_year-11-30");
                                $to2 = date("$to_year-12-01");
                                $to3 = date("$to_year-12-02");
                                $to4 = date("$to_year-12-03");
                            }
                            else{
                                $t = $to_year + 1;
                                $to1 = date("$to_year-12-31");
                                $to2 = date("$t-01-01");
                                $to3 = date("$t-01-02");
                                $to4 = date("$t-01-03");
                            }
                        

                        //Sales Totals.................
                            $qry="SELECT SUM(amount) AS amount_paid FROM item_episode WHERE item_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $total_sales = $view_all_query_row['amount_paid'];

                                        $i +=1;
                                        
                                    }
                                    
                                }

                                $qry="SELECT SUM(paid) AS amount FROM trans_episode WHERE item_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $total_cash = $view_all_query_row['amount'];

                                        $i +=1;
                                        
                                    }
                                    
                                }

                                $sales_debt = $total_sales - $total_cash;

                                $qry="SELECT SUM(amount) AS amount FROM returned_item WHERE item_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $total_return = $view_all_query_row['amount'];

                                        $i +=1;
                                        
                                    }
                                    
                                }

                                $net_sales = ($total_sales - $sales_debt) - $total_return;

                            //Services Totals.......................

                                $qry="SELECT SUM(ser_charge) AS amount FROM service_episode WHERE ser_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $service_total = $view_all_query_row['amount'];

                                        $i +=1;
                                        
                                    }
                                    
                                }

                                $qry="SELECT SUM(amount_paid) AS amount FROM service_episode WHERE ser_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $service_cash = $view_all_query_row['amount'];

                                        $i +=1;
                                        
                                    }
                                    
                                }

                                $service_debt = $service_total - $service_cash;

                                $net_labour = $service_total - $service_debt;


                            //Rent Totals
                            $qry="SELECT SUM(amount) AS amount FROM rents_episode WHERE re_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $rent_total = $view_all_query_row['amount'];

                                        $i +=1;
                                        
                                    }
                                    
                                } 

                            //Total Income
                                $total_income = $net_sales + $net_labour + $rent_total;

                            //Opening Stock
                                $open_stock=mysqli_query($conn, "SELECT SUM(stock*price) AS open_stock  FROM monthly_stock WHERE (mdate = '$from1' OR mdate = '$from2' OR mdate = '$from3' OR mdate = '$from4')"); 
                                $open_stock = mysqli_fetch_assoc($open_stock);
                                $open_stock =  $open_stock['open_stock'];

                            //Closing Stock
                                $close_stock=mysqli_query($conn, "SELECT SUM(stock*price) AS close_stock  FROM monthly_stock WHERE (mdate = '$to1' OR mdate = '$to2' OR mdate = '$to3' OR mdate = '$to4')"); 
                                $close_stock = mysqli_fetch_assoc($close_stock);
                                $close_stock =  $close_stock['close_stock'];

                            //Cariage Inwards
                                $qry=mysqli_query($conn, "SELECT SUM(amount) AS cariage_total  FROM expenditures WHERE exp_date BETWEEN '$from2' AND '$to1' AND active = 'Yes' AND portfolio = 'Cariage Inwards'"); 
                                $results = mysqli_fetch_assoc($qry);
                                $cariage_total =  $results['cariage_total'];

                            //Add Purchases
                                $qry=mysqli_query($conn, "SELECT SUM(paid) AS purchase_paid  FROM supply_received WHERE sup_date BETWEEN '$from2' AND '$to1'"); 
                                $results = mysqli_fetch_assoc($qry);
                                $purchase_paid =  $results['purchase_paid'];

                                $qry="SELECT DISTINCT supp_no, amount FROM supply_received WHERE sup_date BETWEEN '$from2' AND '$to1'";
                                $i = 1;
                                $purchase_amount = 0;
                                if ($view_all_query_run = mysqli_query($conn, $qry)){
                                    while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                        $purchase = $view_all_query_row['amount'];

                                        $purchase_amount += $purchase;

                                        $i +=1;
                                        
                                    }
                                    
                                } 

                                $purchase_owe = $purchase_amount - $purchase_paid;

                                $net_purchase = $purchase_paid + $cariage_total;

                            //Goods Available for Sales
                                $goods_available = $net_purchase + $open_stock;

                            //Cost of Goods
                                $goods_cost = $goods_available - $close_stock;

                            //Gross Profit
                                $gross_profit = $total_income - $goods_cost;
                                if($gross_profit >= 0) {
                                    $gross = number_format($gross_profit,2);
                                }
                                else {
                                    $gross = -1 * $gross_profit;
                                    $gross = "(".number_format($gross,2).")";
                                }                                               

                            
                            echo "<h3>INCOME STATEMENT ACCOUNTS FROM <br>".date("d/m/Y", strtotime($from2))." TO ".date("d/m/Y", strtotime($to1));

                            echo '<thead>
                                <tr style="border-bottom: 3px solid;">
                                    <th width="40%"></th>
                                    <th width="20%" style="text-align: right;">Amount (GH&#x20B5;)</th>
                                    <th width="20%" style="text-align: right;">Amount (GH&#x20B5;)</th>
                                    <th width="20%" style="text-align: right;">Amount (GH&#x20B5;)</th>
                                </tr>
                            </thead>
                            <tbody>';
                                echo    "<tr style='border-bottom: 1px solid;'>
                                            <th colspan='4'>Revenue</th>              
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Total Sales</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($total_sales,2)."</td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Sales (In debt)</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>(".number_format($sales_debt,2).")</td>              
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Total Returnables</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>(".number_format($total_return,2).")</td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid; font-weight: bold'>
                                            <td style='padding-left: 20px;'>Total Sales</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($net_sales,2)."</td>
                                        </tr>
                                        <tr style='border-bottom: 1px solid; font-weight: bold'>
                                            <td style='padding-left: 20px;'>Rent Receivables</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($rent_total,2)."</td>              
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Labour</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($service_total,2)."</td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Labour (In debt)</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>(".number_format($service_debt,2).")</td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid; font-weight: bold'>
                                            <td style='padding-left: 20px;'>Total Labour</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($net_labour,2)."</td>
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px; color: red;'>Total Income</th>
                                            <td></td>
                                            <td></td>
                                            <th style='text-align: right; color: red;'>".number_format($total_income,2)."</th>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th colspan='4'>Cost of Sales</th>              
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Opening Stocks</td>
                                            <td></td>
                                            <td style='text-align: right;'>".number_format($open_stock,2)."</td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Total Add Purchases</td>
                                            <td style='text-align: right;'>".number_format($purchase_amount,2)."</td>
                                            <td></td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Owing Purchases</td>
                                            <td style='text-align: right;'>(".number_format($purchase_owe,2).")</td>
                                            <td></td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px;'>Add Purchases</th>
                                            <th style='text-align: right;'>".number_format($purchase_paid,2)."</th>
                                            <td></td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Cariage Inwards</td>
                                            <td style='text-align: right'>".number_format($cariage_total,2)."</td>
                                            <td></td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px;'>Net Purchases</th>
                                            <td></td>
                                            <th style='text-align: right;'>".number_format($net_purchase,2)."</th>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px;'>Cost of Goods Available for Sales</th>
                                            <td></td>
                                            <th style='text-align: right'>".number_format($goods_available,2)."</th>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Less Closing Stocks</td>
                                            <td></td>
                                            <td style='text-align: right'>(".number_format($close_stock,2).")</td>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'>Cost of Goods Sold</td>
                                            <td></td>
                                            <td></td>
                                            <td style='text-align: right'>(".number_format($goods_cost,2).")</td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px; color: red;'>Gross Profit</th>
                                            <td></td>
                                            <td></td>
                                            <th style='text-align: right; color: red;'>$gross</th>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <th colspan='4'>Expenses</th>              
                                        </tr>";
                                        $qry="SELECT portfolio, amount FROM expenditures WHERE exp_date BETWEEN '$from2' AND '$to1' AND active = 'Yes' AND portfolio <> 'Cariage Inwards'";
                                            $i = 1;
                                            $expenses_total = 0;
                                            if ($view_all_query_run = mysqli_query($conn, $qry)){
                                                while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                                    $portfolio = $view_all_query_row['portfolio'];
                                                    $expenses = $view_all_query_row['amount'];

                                                    $expenses_total += $expenses;

                                                    echo "<tr style='border-bottom: 1px solid;'>
                                                        <td style='padding-left: 20px;'>$portfolio</td>
                                                        <td></td>
                                                        <td style='text-align: right'>".number_format($expenses,2)."</td>
                                                        <td></td>               
                                                    </tr>";

                                                    $i +=1;
                                                    
                                                }
                                                
                                            }

                                        echo "<tr style='border-bottom: 1px solid;'>
                                            <th style='padding-left: 20px;'>Total Expenses</th>
                                            <td></td>
                                            <th style='text-align: right'>".number_format($expenses_total,2)."</th>
                                            <td></td>               
                                        </tr>
                                        <tr style='border-bottom: 1px solid;'>
                                            <td style='padding-left: 20px;'></td>
                                            <td></td>
                                            <td></td> 
                                            <td style='text-align: right'>(".number_format($expenses_total,2).")</td>            
                                        </tr>";

                            $net_profit = $gross_profit - $expenses_total;
                            if($net_profit >= 0) {
                                $net_profit = number_format($net_profit,2);
                            }
                            else {
                                $net_profit = -1 * $net_profit;
                                $net_profit = "(".number_format($net_profit,2).")";
                            }
                            echo "</tbody>
                            <tfoot>
                                <tr style='border-bottom: 2px solid; border-top: 2px solid;'> 
                                    <th colspan='3' style='text-align: center; color: red;'>Net Profit (Loss)</th>
                                    <th style='text-align: right; color: red;'>$net_profit</th>
                                </tr>
                            </tfoot>";

                    ?>                                   
                </table> --}}
                @break

            @case('ServicesAccounts')
                <!--Accounts Print View--> 
                <table border="0" align="center" class ="table2">
                    @php 
                        $charge_total = $results['total_charges'];
                        $amount_paid = $results['total_amount_paid'];
                        
                        $debt = $charge_total - $amount_paid;

                        $balance = $charge_total - $debt;                        
                    @endphp

                    @if($dates['from'] == $dates['to'])
                        <h3>SERVICES ACCOUNTS FOR {{ formatDate($dates['from']) }}</h3>
                    @else 
                        <h3>SERVICES ACCOUNTS FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th width="50%"></th>
                            <th width="25%" style="text-align: right; padding-right: 30px">Amount (GH&#x20B5;)</th>
                            <th width="25%" style="text-align: right;">Balance (GH&#x20B5;)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Total Charges</td>
                            <td style='text-align: right; padding-right: 30px'>{{ formatCedisAmount($charge_total,2) }}</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Charges (In debt)</td>
                            <td style='text-align: right; padding-right: 30px'>({{ formatCedisAmount($debt,2) }})</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td></td>
                            <td></td>
                            <td style='text-align: right'>
                                @if($balance >= 0)
                                    {{ formatCedisAmount($balance) }}
                                @else 
                                    ({{ formatCedisAmount(-1 * $balance) }})
                                @endif   
                            </td>               
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;'>
                            <th colspan='3' style='text-align: center;'><br></th>
                        </tr>
                    </tfoot>
                </table>
                
                @break

            @case('PettyCash')
                <!--Petty Cash Print View-->
                <table border="0" align="center" class ="table2">

                    @if($dates['from'] == $dates['to']) 
                        <h3>PETTY CASH ON {{ formatDate($dates['from']) }}</h3>
                    @else 
                        <h3>PETTY CASH FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif
                    <thead class="tab">
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th class="tab">#</th>
                            <th class="tab">Date</th>
                            <th class="tab">Details</th>
                            <th class="tab">Portfolio</th>
                            <th class="tab" style='text-align: right;'>Amount</th>
                        </tr>
                    </thead>
                    <tbody class="tab">
                        @foreach ($results['expenditures'] as $key => $expenses)
                            <tr style='border-bottom: 1px solid;' class='tab'>
                                <td class='tab'>{{ ++$key }}</td>
                                <td class='tab'>{{ formatDate($expenses->exp_date) }}</td>
                                <td class='tab'>{{ $expenses->details }}</td>
                                <td class='tab'>{{ $expenses->portfolio }}</td>
                                <td class='tab' align='right'>{{ formatCedisAmount($expenses->amount) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;' class='tab'>
                            <th colspan='4' style='text-align: center;'>Total</th>
                            <th id='tab1' style='text-align: right;'>{{ formatCedisAmount($results['total_expenses']) }}</th>
                        </tr>
                    </tfoot>                                 
                </table>
                <br>
                <table border="0" align="center" class ="table2">
                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th>#</th>
                            <th>Portfolio</th>
                            <th style='text-align: right'>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results['portfolio_totals'] as $key => $portfolio)
                            <tr style='border-bottom: 1px solid;'>
                                <td>{{ ++$key }}</td>
                                <td style='text-align: left; padding-left: 10px'>{{ $portfolio->portfolio }}</td>
                                <td align='right'>{{ formatCedisAmount($portfolio->amount) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 3px solid;'>
                            <th colspan='2' style='text-align: center;'>Total</th>
                            <th style='text-align: right'>{{ formatCedisAmount($results['portfolio_totals_sum']) }}</th>
                        </tr>
                        <tr><td><br></td></tr>
                    </tfoot>                                  
                </table>
                
                @break

            @case('CashBook')
                <!--Cash Book Print View-->
                <table border="1" align="center" class ="table2">
                    @php
                        $total_cash = $results['total_service'] + $results['total_stores'] + $results['total_rent'];

                        $expenses = $results['total_expenses'];

                        if($total_cash > $expenses) {
                            $balance_cf = $total_cash - $expenses;
                            $balance_bf = 0;

                            $total = $total_cash;
                        } else {
                            $balance_bf = $expenses - $total_cash;
                            $balance_cf = 0;

                            $total = $expenses;
                        }
                    @endphp

                    @if($dates['from'] == $dates['to']) {
                        <h3>CASH BOOK ACCOUNTS FOR {{ formatDate($dates['from']) }}</h3>
                    @else
                        <h3>CASH BOOK ACCOUNTS FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th width="50%" style="text-align: center;">Income</th>
                            <th width="50%" style="text-align: center;">Expenditure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: 1px solid;'>
                            <td>
                                <label>Cash</label>
                                <label class='lab'>{{ formatCedisAmount($total_cash) }}</label></td>
                            <td>
                                <label>Expenses</label>
                                <label class='lab'>{{ formatCedisAmount($expenses) }}</label>
                            </td>              
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td></td>
                            <td>
                                <label>Balance c/f</label>
                                <label class='lab'>{{ formatCedisAmount($balance_cf) }}</label>
                            </td>              
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;'>
                            <th>
                                <label><b>Total</b></label>
                                <label class='lab'><b>{{ formatCedisAmount($total) }}</b></label>
                            </th>
                            <th>
                                <label><b>Total</b></label>
                                <label class='lab'><b>{{ formatCedisAmount($total) }}</b></label>
                            </th>
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td>
                                <label>Balance b/d</label>
                                <label class='lab'>{{ formatCedisAmount($balance_bf) }}</label>
                            </td>
                            <td></td>              
                        </tr>
                    </tfoot>      
                </table>
                
                @break

            @case('MainLabour')
                <!--Main Labour Print View-->
                <table border="0" align="center" class ="table2">
                                           
                    @if($dates['from'] == $dates['to'])
                        <h3>MAIN LABOUR ACCOUNTS FOR {{ formatDate($dates['from']) }}</h3>
                    @else
                        <h3>MAIN LABOUR ACCOUNTS FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th width="50%"></th>
                            <th width="25%" style='text-align: right; padding-right: 30px'>Amount</th>
                            <th width="25%" style='text-align: right;'>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Total Income</td>
                            <td style='text-align: right; padding-right: 30px'>{{ formatCedisAmount($results['total_service']) }}</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Total Expenses</td>
                            <td style='text-align: right; padding-right: 30px'>{{ formatCedisAmount($results['total_expenses']) }}</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td></td>
                            <td></td>
                            <td style='text-align: right'>
                                @if(($balance = $results['total_service'] - $results['total_expenses']) >= 0)
                                    {{ formatCedisAmount($balance) }}
                                @else 
                                    ({{ formatCedisAmount(-1 * $balance) }})
                                @endif 
                            </td>               
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;'>
                            <th colspan='3' style='text-align: center;'><br></th>
                        </tr>
                    </tfoot>
                </table>
                
                @break

            @case('RentAccount')
                <!--Rent Print View-->
                <table border="0" align="center" class ="table2">

                    @if($dates['from'] == $dates['to'])
                        <h3>RENTS RECEIVED ON {{ formatDate($dates['from']) }}</h3>
                    @else 
                        <h3>RENTS RECEIVED FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    <thead class="tab">
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th width="5%" class="tab">#</th>
                            <th width="15%" class="tab">Date</th>
                            <th width="15%" class="tab">Month</th>
                            <th width="40%" class="tab">Master</th>
                            <th width="20%" class="tab">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="tab">

                        @foreach ($results['rent'] as $key => $rent)
                            <tr style='border-bottom: 1px solid;' class='tab'>
                                <td class='tab'>{{ ++$key }}</td>
                                <td class='tab'>{{ $rent->rent_date }}</td>
                                <td class='tab'>{{ $rent->month_year }}</td>
                                <td class='tab'>{{ $rent->staff->name }}</td>
                                <td class='tab'>{{ $rent->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;' class='tab'>
                            <th colspan='4' style='text-align: center;'>Total</th>
                            <th id='tab1'>{{ formatCedisAmount($results['total_rent']) }}</th>
                        </tr>
                    </tfoot>
                </table>
                
                @break
            
            @case('LabourIncome')
                <!--Labour Income Print View-->
                <table border="0" align="center" class ="table2">
                    
                    @if($dates['from'] == $dates['to'])
                        <h3>LABOUR INCOME FOR {{ formatDate($dates['from']) }}</h3>
                    @else
                        <h3>LABOUR INCOME FROM <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    <thead class="tab">
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th class="tab">#</th>
                            <th class="tab">Date</th>
                            <th class="tab">Car Reg. No.</th>
                            <th class="tab">Master</th>
                            <th class="tab">Fault</th>
                            <th class="tab" style='text-align: right'>Charge</th>
                            <th class="tab" style='text-align: right'>Amount</th>
                        </tr>
                    </thead>
                    <tbody class="tab">
                        @foreach ($results['services'] as $key => $services)
                            <tr style='border-bottom: 1px solid;' class='tab'>
                                <td class='tab'>{{ ++$key }}</td>
                                <td class='tab'>{{ formatDate($services->service_date) }}</td>
                                <td class='tab'>{{ $services->customer->car_no }}</td>
                                <td class='tab'>{{ $services->engineer }}</td>
                                <td class='tab'>{{ $services->fault }}</td>
                                <td class='tab' style='text-align: right'>{{ formatCedisAmount($services->ser_charge) }}</td>
                                <td class='tab' style='text-align: right'>{{ formatCedisAmount($services->amount_paid) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;' class='tab'>
                            <th colspan='5' style='text-align: center;'>Total</th>
                            <th id='tab1' style='text-align: right'>{{ formatCedisAmount($results['services_charge']) }}</th>
                            <th id='tab1' style='text-align: right'>{{ formatCedisAmount($results['services_total']) }}</th>
                        </tr>
                        <tr style='border-bottom: 1px solid;' class='tab'>
                            <td colspan='6' style='text-align: left;'>Debt</td>
                            <td id='tab1' style='text-align: right'>{{ formatCedisAmount($results['services_charge'] - $results['services_total']) }}</td>
                        </tr>
                    </tfoot>                                  
                </table>
                <br>
                <table border="0" align="center" class ="table2"> 
                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th>#</th>
                            <th>Master</th>
                            <th style='text-align: right'>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results['services_engineer'] as $key => $engineer)
                            <tr style='border-bottom: 1px solid;'>
                                <td>{{ ++$key }}</td>
                                <td style='text-align: left; padding-left: 10px'>{{ $engineer->engineer }}</td>
                                <td align='right'>{{ formatCedisAmount($engineer->amount_paid) }}</td>
                            </tr> 
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 3px solid;'>
                            <th colspan='2' style='text-align: center;'>Total</th>
                            <th style='text-align: right'>{{ formatCedisAmount($results['services_total']) }}</th>
                        </tr>
                        <tr><td><br></td></tr>
                    </tfoot>                                  
                </table>
                
                @break

            @case('StoresAccounts')
                <!--Stores Account Print View-->
                <table border="0" align="center" class ="table2">
                    @if($dates['from'] == $dates['to'])
                        <h3>STORES ACCOUNTS FOR {{ formatDate($dates['from']) }}</h3>
                    @else
                        <h3>STORES ACCOUNTS FOR <br>{{ formatDate($dates['from']) }} TO {{ formatDate($dates['to']) }}</h3>
                    @endif

                    @php
                       $debt = $results['total_stores_sales'] - $results['total_amount_received'];

                        $balance = ($results['total_stores_sales'] - $debt) - $results['total_amount_returned_items'];
                    @endphp  
                           
                    <thead>
                        <tr style="border-bottom: 3px solid;">
                            <th width="50%"></th>
                            <th width="25%" style="text-align: right; padding-right: 30px">Amount</th>
                            <th width="25%" style="text-align: right">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Total Sales</td>
                            <td style='text-align: right; padding-right: 30px'>{{ formatCedisAmount($results['total_stores_sales']) }}</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Sales (In debt)</td>
                            <td style='text-align: right; padding-right: 30px'>({{ formatCedisAmount($debt) }})</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td></td>
                            <td></td>
                            <td style='text-align: right'>{{ formatCedisAmount($results['total_stores_sales'] - $debt) }}</td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td>Total Returnables</td>
                            <td style='text-align: right; padding-right: 30px'>({{ formatCedisAmount($results['total_amount_returned_items']) }})</td>
                            <td></td>               
                        </tr>
                        <tr style='border-bottom: 1px solid;'>
                            <td></td>
                            <td></td>
                            <td style='text-align: right'>
                                @if($balance >= 0)
                                    {{ formatCedisAmount($balance) }}
                                @else 
                                    ({{ formatCedisAmount(-1 * $balance) }})
                                @endif  
                            </td>               
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style='border-bottom: 2px solid;'>
                            <th colspan='3' style='text-align: center;'><br></th>
                        </tr>
                    </tfoot>
                </table>
                
                @break

            @case('Supplies')
                <!--Supplier Account Print View-->
                {{-- <table border="0" align="center" class ="table2" style="width: 90%;">
                    <?php 
                        $fr_date = $_SESSION['fr_date'];
                        $to_date = $_SESSION['to_date'];  
                                        
                        $dt = date("d/m/Y", strtotime($fr_date));
                        $dt1 = date("d/m/Y", strtotime($to_date));

                        if($fr_date == $to_date) {
                            echo "<h3>SUPPLIES ACCOUNT ON $dt</h3>";
                        } else {
                            echo "<h3>SUPPLIES ACCOUNT FROM <br>$dt TO $dt1</h3>";
                        }

                        echo '<thead class="tab">
                            <tr style="border-bottom: 3px solid;" class="tab">
                                <th width="5%" class="tab">#</th>
                                <th width="25%" class="tab">Supplier</th>
                                <th width="30%" class="tab">Item</th>
                                <th width="10%" class="tab">Amount</th>
                                <th width="10%" class="tab">Paid</th>
                                <th width="10%" class="tab">Receipt</th>
                                <th width="10%" class="tab">Date</th>
                            </tr>
                        </thead>
                        <tbody class="tab">';
                        $total_paid = 0;
                        $qry="SELECT sup_name, item, amount, paid, receipt_no, sup_date FROM supplier, items, supply_received WHERE supplier.supID = supply_received.supID AND items.itemID = supply_received.itemID AND sup_date BETWEEN '$fr_date' AND '$to_date' ORDER BY sup_date DESC";
                            $i = 1;
                            if ($view_all_query_run = mysqli_query($conn, $qry)){
                                while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                    $sup_name = $view_all_query_row['sup_name'];
                                    $item = $view_all_query_row['item'];
                                    $amount = $view_all_query_row['amount'];
                                    $paid = $view_all_query_row['paid'];
                                    $receipt_no = $view_all_query_row['receipt_no'];
                                    $sup_date = $view_all_query_row['sup_date'];

                                    $total_paid += $paid;

                                    $sup_date = date("d/m/Y", strtotime($sup_date));

                                        echo    "<tr style='border-bottom: 1px solid;' class='tab'>
                                                    <td class='tab'>$i</td>
                                                    <td class='tab'>$sup_name</td>
                                                    <td class='tab'>$item</td>
                                                    <td class='tab'>$amount</td>
                                                    <td class='tab'>$paid</td>
                                                    <td class='tab'>$receipt_no</td>
                                                    <td class='tab'>$sup_date</td>
                                                </tr>";

                                    $i +=1;
                                    
                                }
                                
                            }

                            $total_amount = 0;
                            $qry="SELECT DISTINCT supp_no, amount FROM supply_received WHERE sup_date BETWEEN '$fr_date' AND '$to_date'";
                            $i = 1;
                            if ($view_all_query_run = mysqli_query($conn, $qry)){
                                while ($view_all_query_row = mysqli_fetch_assoc($view_all_query_run)){
                                    $amount_t = $view_all_query_row['amount'];
                                    
                                    $total_amount += $amount_t;

                                    $i +=1;
                                    
                                }
                                
                            }


                        echo "</tbody>
                        <tfoot>
                            <tr style='border-bottom: 2px solid;' class='tab'>
                                <th colspan='3' style='text-align: center;'>Total</th>
                                <th id='tab1'>".number_format($total_amount,2)."</th>
                                <th id='tab2'></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr style='border-bottom: 2px solid;' class='tab'>
                                <th colspan='3' style='text-align: center;'>Total Paid</th>
                                <th id='tab1'></th>
                                <th id='tab2'>".number_format($total_paid,2)."</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr style='border-bottom: 2px solid;' class='tab'>
                                <th colspan='4' style='text-align: center;'>Balance Owing</th>
                                <th id='tab1'>".number_format($total_amount - $total_paid,2)."</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>";
                    ?>
                </table> --}}
                
                @break

            @case('Debtors')

                {{-- {{ dd($results) }} --}}
                <table border="1" align="center" class ="table2">
                    <thead>
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th>#</th>
                            <th>Date</th>
                            <th>Car #</th>
                            <th>Customer Name</th>
                            <th>Engineer Name</th>
                            <th>Charge</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $balance_total = 0;
                        @endphp
                        @foreach ($results['debtors'] as $key => $debtor)
                            <tr style='border-bottom: 1px solid;' class='tab'>
                                <td>{{ ++$key }}</td>
                                <td>{{ formatDate($debtor->service_date) }}</td>
                                <td>{{$debtor->car_no }}</td>
                                <td>{{ $debtor->customer->customer_name }}</td>
                                <td>{{ $debtor->engineer }}</td>
                                <td>{{ formatCedisAmount($debtor->ser_charge) }}</td>
                                <td>{{ formatCedisAmount($debtor->amount_paid) }}</td>
                                <td>{{ formatCedisAmount($balance = $debtor->ser_charge - $debtor->amount_paid) }}</td>
                            </tr>
                            @php
                                $balance_total += $balance;
                            @endphp
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th colspan="7">Total</th>
                            <th>{{ formatCedisAmount($balance_total) }}</th>
                        </tr>
                    </tfoot>
                </table>
                
                @break

            @case('Car_info')

                {{-- {{ dd($results) }} --}}
                <table border="1" align="center" class ="table2">
                    <thead>
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th>#</th>
                            <th>Date</th>
                            <th>Car #</th>
                            <th>Customer Name</th>
                            <th>Engineer Name</th>
                            <th>Charge</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $balance_total = 0;
                        @endphp
                        @foreach ($results['cars'] as $key => $debtor)
                            <tr style='border-bottom: 1px solid;' class='tab'>
                                <td>{{ ++$key }}</td>
                                <td>{{ formatDate($debtor->service_date) }}</td>
                                <td>{{ $debtor->car_no }}</td>
                                <td>{{ $debtor->customer->customer_name }}</td>
                                <td>{{ $debtor->engineer }}</td>
                                <td>{{ formatCedisAmount($debtor->ser_charge) }}</td>
                                <td>{{ formatCedisAmount($debtor->amount_paid) }}</td>
                                <td>{{ formatCedisAmount($balance = $debtor->ser_charge - $debtor->amount_paid) }}</td>
                            </tr>
                            @php
                                $balance_total += $balance;
                            @endphp
                        @endforeach
                        
                    </tbody>
                    <tfoot>
                        <tr style="border-bottom: 3px solid;" class="tab">
                            <th colspan="7">Total</th>
                            <th>{{ formatCedisAmount($balance_total) }}</th>
                        </tr>
                    </tfoot>
                </table>
                
                @break
        
            @default
                
        @endswitch
    
        <button class="btn btn-primary mt-2" style="float: right; margin-right: 100px;" onclick = "print_1()">Print</button>
        <br>
    </body>
</html>
