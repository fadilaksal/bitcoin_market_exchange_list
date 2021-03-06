<?php
    define('BASE_URL', 'http://localhost/bitcoin_market_exchange_list');

    function getData($url)
    {
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$url);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl_handle, CURLOPT_COOKIEJAR, 'cookies.txt');
        curl_setopt($curl_handle, CURLOPT_COOKIEFILE, 'cookies.txt');
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);

        return $result;
    }

    $tickerSymbol = array("XBTUSD", "XBTSGD", "XBTEUR");

    //ticker ini list marketnya
    $ticker = array();
    foreach ($tickerSymbol as $key) {
        $result = getData("https://api.itbit.com/v1/markets/$key/ticker");
        $ticker[] = json_decode($result);
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Itbit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.css" />
    <meta http-equiv="refresh" content="5">
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">ITBIT</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/idex/">IDEX <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/heat_wallet/">HEAT WALLET</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/idax/">IDAX <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/independentreserve/">Independent Reserve<span class="sr-only"></span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Itbit<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/koinex/">Koinex<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/hotbit/">Hotbit<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/infinity_coin/">InfinityCoin Exchange<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/iquant/">Iquant<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL;?>/isx/">ISX<span class="sr-only"></span></a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover ">
                <caption>List of Tickers</caption>
                <thead class="table-primary">
                    <tr scope="row">
                        <th scope="col">No.</th>
                        <th scope="col">Link</th>
                        <th scope="col">Name</th>
                        <th scope="col">High</th>
                        <th scope="col">Low</th>
                        <th scope="col">Last</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php $i = 1;
                    // loop sejumlah data ticker, simpan variabelnya ke key
                    foreach ($ticker as $key => $value) {
                        if($value == null || !isset($value->pair)){
                            continue;
                        }
                ?>
                    <tr scope="row">
                        <td scope="col"><?php echo $i; ?></td>
                        <td scope="col"><?php echo $value->pair; ?></td>
                        <td scope="col"><?php echo $value->pair; ?></td>
                        <td scope="col"><?php echo number_format((float)$value->highToday, 9); ?></td>
                        <td scope="col"><?php echo number_format((float)$value->lowToday, 9); ?></td>
                        <td scope="col"><?php echo number_format((float)$value->lastPrice, 9); ?></td>
                    </tr>
                    <?php
                    $i++;   
                    }
                ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="assets/js/bootstrap.bundle .js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>