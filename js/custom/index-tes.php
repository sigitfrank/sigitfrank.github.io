<?php
if(isset($_POST['unset'])){
unset($_POST);
header("Location: ".$_SERVER['PHP_SELF']);
exit;
}
echo 
"<script>
document.cookie = 'userIdPost2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'voucherPost2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'totalBayarPost2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'nominalPost2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'idProduct2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'idProduct2Semua=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
document.cookie = 'tempNominalHargaCoret2=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
sessionStorage.removeItem('voucher2');
sessionStorage.removeItem('userId2');
sessionStorage.removeItem('jumlahVoucher2');
</script>";
$subtotal = 0;
?>
<?php
session_start();
$total_price = 0;
$item_details = '';
$item_details2 = '';
$randomid = '1'.date('Ymd').rand(1000,9999);
if(!empty($_SESSION["shopping_cart"]))
{
foreach($_SESSION["shopping_cart"] as $keys => $values)
{


    if(isset($_POST['idProductPost']) && ($_POST['idProductPost'] == $values["product_id"] )){ 
        if(isset($_POST["tempNominalHargaCoretPost"]) && $_POST["tempNominalHargaCoretPost"] !=""){
            $tmp = $_POST["tempNominalHargaCoretPost"]; 
        }
        $products = '<td align="left"><h6 style="text-decoration: line-through;" class="numbers text-left text-danger prices" id="'.$values["product_id"].'">Rp '.number_format($values["product_price"]).'</h6>'.$tmp.'</td>';

        $productsM = '<td align="center" class="col-5"><h6 style="text-decoration: line-through;" class="numbers text-center text-danger pricesM" id="'.$values["product_id"].'M">Rp '.number_format($values["product_price"]).'</h6>'.$tmp.'</td>';
    } else{
        $products ='<td align="left"><h6 class="numbers text-left prices" id='.$values["product_id"].'>Rp '.number_format($values["product_price"]).'</h6></td>';

        $productsM ='<td align="center" class="col-5"><h6 class="numbers text-center pricesM" id="'.$values["product_id"].'M">Rp '.number_format($values["product_price"]).'</h6></td>';
    }

    

$item_details .= '
<tr>
<td width="10%"><img src='.$values["image_thumb"].' alt="" width="100px"></td>
<td class="text-center"> <span class="mt-3"><a style="margin-right:0px!important;"><strong>'.$values["product_name"].'</strong></a></span></td>
<td align="center"><h6>1</h6></td>'.$products.'
<td><button name="delete" class="btn btn-danger btn-xs delete p-2" id="'.$values["product_id"].'-c"><i class="fas fa-trash-alt fa-lg"></i></button></td>
<input class="entryIDD" type="hidden" value="'.$values["product_id"].'">
<td class="nama_product" style="display: none!important;">'.$values["product_name"].'</td>
<td class="no_onder_detail" style="display: none!important;">'.$randomid.''.'</td>
<td class="image_thumb" style="display: none!important;">'.$values["image_thumb"].'</td>
<td class="price_item" style="display: none!important;">'.$values["product_price"].'</td>
<input type="hidden" id="userId" value="{logged_in_member_id}">
</tr>  
';
$item_details2 .= '
<tr class="row align-items-center">
<td class="col-7"> <h6 class="mt-3 text-center"><a style="margin-right:0px!important;"><strong>'.$values["product_name"].'</strong></a></h6></td>'.$productsM.'
<input class="entryIDDM" type="hidden" value="'.$values["product_id"].'">
<td class="nama_product" style="display: none!important;">'.$values["product_name"].'</td>
<td class="no_onder_detail" style="display: none!important;">'.$randomid.''.'</td>
<td class="image_thumb" style="display: none!important;">'.$values["image_thumb"].'</td>
<td class="price_item" style="display: none!important;">'.$values["product_price"].'</td>
<input type="hidden" id="userIdM" value="{logged_in_member_id}">
</tr>  
';
$item_details .= '';
$item_details2 .= '';
$total_price = $total_price + $values["product_price"];
}
$item_details = substr($item_details, 0, -2); 
$item_details2 = substr($item_details2, 0, -2); 
}
?>
{if logged_in}
<?php
if(isset($_POST['submit_delete'])){
$entry_id_delete = $_POST['entry_id_delete'];
ee()->load->library('api');
ee()->legacy_api->instantiate('channel_entries');
ee()->api_channel_entries->delete_entry($entry_id_delete);
header("Refresh:0");
}
require_once('/home/astronaccishop/public_html/midtrans/Midtrans.php');
//Set Your server key
\Midtrans\Config::$serverKey = "Mid-server-_WBGfEt7lZPFkP4xo3rJiyza";
// Uncomment for production environment
\Midtrans\Config::$isProduction = true;
// Enable sanitization
\Midtrans\Config::$isSanitized = true;
// Enable 3D-Secure
\Midtrans\Config::$is3ds = true;
// Required
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Checkout A-Shop</title>
{default-css-elearning}
{desktop-mobile}
<!-- style open custom -->
<style>
.rgba-white-light,
.rgba-white-light:after {
    background-color: rgba(255, 255, 255, 0);
}

.white-skin .primary-color,
.white-skin ul.stepper li.active a .circle,
.white-skin ul.stepper li.completed a .circle,
ul.stepper li.active a .white-skin .circle,
ul.stepper li.completed a .white-skin .circle {
    background-color: #ee3343 !important;
}

.hover {
    color: #f4d32e !important;
}

.product {
    color: #5a5a5a !important
}

p {
    color: #797979 !important;
}

.white-skin .carousel-multi-item .carousel-indicators li,
.white-skin .carousel-multi-item .carousel-indicators li.active,
.white-skin .carousel-multi-item .controls-top>a {
    background-color: #f4d32e !important;
}
</style>
<!-- style close custom -->
</head>

<body class="homepage-v1 hidden-sn white-skin animated">
{header-shop}
<!-- Main Container -->
<div class="container py-3 z-depth-1-half" style="background:#FFF;">
<!-- Section cart -->
<section class="section">
    <!--Modal: Login / Register Form-->
    <div class="row">
        <div class="col-sm-12 col-xl-7">
            <h2>BILLING DETAILS</h2>
            {exp:member:custom_profile_data}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username" class="readonly">Username <strong
                            style="color:#ee3343;">*</strong></label>
                    <input type="text" class="form-control" id="username" value="{logged_in_screen_name}"
                        readonly>
                    <input type="hidden" class="form-control" id="onSuccess" value="success" readonly>
                    <input type="hidden" class="form-control" id="onPending" value="Pending" readonly>
                    <input type="hidden" class="form-control" id="Manual_transaksi" value="Bank_Transfer_Manual"
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="readonly">No Order <strong
                            style="color:#ee3343;">*</strong></label>
                    <input type="text" class="form-control" id="no_onder" value='<?php echo $randomid;?>'
                        readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="readonly">Email <strong style="color:#ee3343;">*</strong></label>
                    <input type="email" class="form-control" id="email" value="{logged_in_email}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="readonly">Phone <strong style="color:#ee3343;">*</strong></label>
                    <input type="phone" class="form-control" id="phone" value="{mobile_phone}" readonly>
                </div>
            </div>
            {/exp:member:custom_profile_data}
            <p id="demo"></p>
            <div class="table-responsive">
                <table class="table product-table d-none d-sm-block">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                $subtotal = 0;
                $item_details_cc = array();
                $item_details_gopay = array();
                $item_details_akulaku = array();
                $item_details_transfer = array();
                $item_details_alfamart = array();
                $item_details_shopeepay = array();
                ?>
                <?php echo $item_details; ?>
                <?php
                    if(!empty($_SESSION["shopping_cart"]))
                    {
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {
                    $item1_details = array(
                        'id' => $values["product_id"],
                        'price' => $values["product_price"],
                        'quantity' => 1,
                        'name' => $values["product_name"]
                    );
                    array_push($item_details_cc, $item1_details);
                    array_push($item_details_gopay, $item1_details);
                    array_push($item_details_akulaku, $item1_details);
                    array_push($item_details_transfer, $item1_details);
                    array_push($item_details_alfamart, $item1_details);
                    array_push($item_details_shopeepay, $item1_details);
                    }
                }
                ?>
                        {exp:channel:entries channel="cart" search:cart_member="{logged_in_member_id}"
                        search:cart_status="open" dynamic="no"}
                        {if no_results}
                        <?php $subtotal = 0; ?>
                        {/if}
                        <?php 
                $subtotal +={cart_price};
                
                ?>
                
                        <tr>
                            <td scope="row">
                                <a href="{site_url}{cart_channel}/detail/{cart_url_title}"><img
                                        src="{cart_thumbnail}" alt="{cart_title}"
                                        class="img-fluid z-depth-0"></a>
                            </td>
                            <td class="image_thumb" style="display: none!important;">{cart_thumbnail}</td>
                            <td class="no_onder_detail" style="display: none!important;"><?php echo $randomid;?>
                            </td>
                            <td>
                                <h5 class="mt-3" style="font-size:14px;">
                                    <a href="{site_url}{cart_channel}/detail/{cart_url_title}"
                                        style="margin-right:0px!important;"><strong>{cart_title}</strong></a>
                                </h5>
                                <a href="{site_url}{cart_channel}">
                                    <p class="text-muted">{cart_category}{entry_id}</p>
                                </a>
                            </td>
                            <td class="nama_product" style="display: none!important;">{cart_title}</td>
                            <td align="center">
                                <h6 class="numbers">1</h6>
                            </td>
                            <td class="nama_product" style="display: none!important;">{cart_title}</td>
                            <td  style="width:21%;">
                                <?php if(isset($_POST['idProductPost']) && ($_POST['idProductPost'] == "{cart_product}" )){ ?>
                                <h6 class="numbers prices text-danger" style="text-decoration: line-through;" id="{cart_product}">Rp {cart_price}</h6>
                                <h6> 
                                    <?php 
                                    if(isset($_POST['tempNominalHargaCoretPost']) && $_POST['tempNominalHargaCoretPost'] !=''){
                                        echo $_POST['tempNominalHargaCoretPost']; 
                                    }
                                    ?> 
                                </h6>
                                <?php 
                                } else{ ?>
                                <h6 class="numbers prices" id="{cart_product}">Rp {cart_price}</h6>
                                <?php
                                }
                                ?>
                            </td>
                            <td class="price_item" style="display: none!important;">{cart_price}</td>
                            <td>
                                <form action="" method="POST">
                                    <input id="entry_id_delete" name="entry_id_delete" type="hidden"
                                        value="{entry_id}">
                                    <input class="entryIDD" type="hidden" value="{cart_product}">
                                    <input type="hidden" name="XID" value="{XID_HASH}" />
                                    <button type="submit" name="submit_delete" class="btn btn-xs btn-danger p-2"
                                        data-toggle="tooltip" data-placement="top" title="Remove item"><i
                                            class="fas fa-trash-alt fa-lg"></i></button>
                                </form>
                            </td>
                        </tr>
                        
                        <?php
                $item1_details = array(
                    'id' => '{entry_id}',
                    'price' => '{cart_price}',
                    'quantity' => 1,
                    'name' => '{cart_title}'
                );
                array_push($item_details_cc, $item1_details);
                array_push($item_details_gopay, $item1_details);
                array_push($item_details_akulaku, $item1_details);
                array_push($item_details_transfer, $item1_details);
                array_push($item_details_alfamart, $item1_details);
                array_push($item_details_shopeepay, $item1_details);
                ?>
                        <!-- /.First row -->
                        {/exp:channel:entries}
                        <tr>
            <td scope="row" class="p-0" style="width:24%;">
            <input type="hidden" id="userId" value="{logged_in_member_id}">
            <input type="text" class="form-control" placeholder=" <?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo $_POST['voucherPost']; } else{ echo "Masukkan Kode"; } ?>" id="voucherD" <?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo 'readonly'; } ?>>
            <div id="errorVoucher" class="invalid-feedback">
                error
            </div>
            </td>
            <td class="p-0" style="width:33%;">
                <button class="btn btn-dark p-2" id="btnVoucherD" <?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo "disabled"; }?> style="font-size: 14px;">Gunakan Kode</button>
                <a href="{site_url}checkout?unset"> 
                    <i class="fa fa-times-circle p-2 text-danger" aria-hidden="true" id="removeVoucher"></i>
                </a>
            </td>
            <td>
                <h5 class="mt-2 font-weight-bold text-center">
                    <strong style="font-size: 14px;">SUBTOTAL</strong>
                </h5>
            </td>
            <td colspan="2">
                <span class="numbers" id="totalD" style="font-size:1rem;">
                    Rp <?= $subtotal+$total_price; ?>
                </span>
            </td>
        </tr>
        <tr <?php if(isset($_POST['nominalPost']) && $_POST['nominalPost'] != ''){ ?> class="d-none" <?php }?>>
            <td scope="row" class="p-0">
            
            </td>
            <td class="p-0">
            
            </td>
            <td>
            <h5 class="mt-3 font-weight-bold text-center" style="font-size:1rem;">
                <strong class="text-danger d-none" id="diskonD">DISKON</strong>
            </h5>
            </td>
            <td colspan="2">
            <h5 class="mt-3 font-weight-bold numbers text-danger d-none" id="diskonValueD"  style="font-size:1rem;">
                -
            </h5>
            </td>
        </tr>
        <tr <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] != ''){ ?> class="d-none" <?php }?>>
            <td scope="row" class="p-0">
            
            </td>
            <td class="p-0">
            
            </td>
            <td>
            <h5 class="mt-3 font-weight-bold text-center">
                <strong id="totalAkhirD" class="d-none"  style="font-size:14px;">TOTAL AKHIR</strong>
            </h5>
            </td>
            <td colspan="2">
            <h5 class="mt-3 font-weight-bold numbers d-none" id="totalAkhirValueD" style="font-size:1rem;">
            -
            </h5>
            </td>
        </tr>
        <?php if(isset($_POST['nominalPost']) && $_POST['nominalPost'] != ''){ ?>
        <tr>
            <td scope="row" class="p-0">
            
            </td>
            <td class="p-0">
            
            </td>
            <td>
            <h5 class="mt-3 font-weight-bold text-center">
                <strong class="text-danger" id="diskonD"  style="font-size:14px;">DISKON</strong>
            </h5>
            </td>
            <td colspan="2">
            <h5 class="mt-3 font-weight-bold numbers text-danger" style="font-size:1rem;" id="diskonValueD">
            Rp <?= $_POST['nominalPost']; ?>
            </h5>
            </td>
        </tr>
        <?php } ?>
        <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] != ''){ ?>
        <tr>
            <td scope="row" class="p-0">
            
            </td>
            <td class="p-0">
            
            </td>
            <td>
            <h5 class="mt-3 font-weight-bold text-center">
                <strong id="totalAkhirD"  style="font-size:14px;">TOTAL AKHIR</strong>
            </h5>
            </td>
            <td colspan="2">
            <h5 class="mt-3 font-weight-bold numbers" id="totalAkhirValueD" style="font-size:1rem;">
            Rp <?= $_POST['totalBayarPost']; ?>
            </h5>
            </td>
        </tr>
        <?php } ?>
                    </tbody>
                    <!-- /.Table body -->
                </table>
            </div>
        </div>
        <div class="col-xl-5 col-sm-12">
            <div class="grey lighten-4 p-3">
                <h3>YOUR ORDER</h3>
                <table class="table table-responsive">
                    <thead class="d-block d-sm-none">
                        <tr class="row p-1">
                            <div class="row">
                                <th class="col-7">PRODUCT</th>
                                <th class="col-5">TOTAL</th>
                            </div>
                        </tr>
                    </thead>
                    <tbody class="d-none d-sm-block">
                        <span id="result-json"></span>
                        <tr class="row">
                            <th class="col-7" scope="col">
                                <h5 class="p-1">TOTAL AKHIR</h5>
                                <strong type="hidden" id="totalBayar" class="d-none"></strong>
                            </th>

                            <?php 
                                if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                                    $subtotal2 = $_POST['totalBayarPost'];
                                } else{
                                    $subtotal2 = $subtotal + $total_price; 
                                }
                            ?>
                            <?php
                            if($subtotal2 <= 0){
                            header('Location: {site_url}admin/order-history-user');
                            exit;
                            }
                            ?>
                            <?php $subtotal3 = number_format($total_price + $subtotal); ?>
                            <input type="hidden" class="form-control" id="total_belanja"
                                value='<?php 
                                if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                                    echo $_POST['totalBayarPost'];
                                } else{
                                    echo $subtotal2; 
                                }
                                ?>' readonly>
                            <th class="col-5 numbers" scope="col" style="font-size:21px;" id="totalBelanja">Rp <?php if($subtotal2 == 0) {echo "0";} else { 
                                
                                if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                                    echo $_POST['totalBayarPost'];
                                } else{
                                    echo $subtotal3; 
                                }
                            }?>
                            </th>
                        </tr>
                        <tr>
                            <th class="col-xl-12" scope="col">*Belum termasuk biaya admin</th>
                        </tr>
                    </tbody>
                    <tbody class="d-block d-sm-none">
                    <?php echo $item_details2; ?>
                            <?php
                                if(!empty($_SESSION["shopping_cart"]))
                                {
                                foreach($_SESSION["shopping_cart"] as $keys => $values)
                                {
                                $item1_details = array(
                                    'id' => $values["product_id"],
                                    'price' => $values["product_price"],
                                    'quantity' => 1,
                                    'name' => $values["product_name"]
                                );
                                array_push($item_details_cc, $item1_details);
                                array_push($item_details_gopay, $item1_details);
                                array_push($item_details_akulaku, $item1_details);
                                array_push($item_details_transfer, $item1_details);
                                array_push($item_details_alfamart, $item1_details);
                                array_push($item_details_shopeepay, $item1_details);
                                }
                            }
                            ?>
                        {exp:channel:entries channel="cart" search:cart_member="{logged_in_member_id}"
                        search:cart_status="open" dynamic="no"}
                        <tr class="row text-center">
                            <th class="col-7">{cart_title}</th>
                            <th class="col-5">
                            <?php if(isset($_POST['idProductPost']) && ($_POST['idProductPost'] == "{cart_product}" )){ ?>
                                <h6 class="numbers pricesM text-danger" style="text-decoration: line-through;" id="{cart_product}">Rp {cart_price}</h6>
                                <h6> 
                                    <?php
                                    if(isset($_POST['tempNominalHargaCoretPost']) && $_POST['tempNominalHargaCoretPost'] !=''){
                                        echo $_POST['tempNominalHargaCoretPost']; 
                                    }
                                    ?> 
                                </h6>
                                <?php 
                                } else{ ?>
                                <h6 class="numbers pricesM" id="{cart_product}M">Rp {cart_price}</h6>
                                <?php
                                }
                                ?>
                            </th>
                            <input class="entryIDDM" type="hidden" value="{cart_product}">
                        </tr>                         
                        <input type="hidden" id="userIdM" value="{logged_in_member_id}">
                        {/exp:channel:entries}
                        <tr class="row text-center">
                                <td class="col-7">
                                <h5 class="font-weight-bold">
                                    <strong style="font-size: 0.9rem;">SUBTOTAL</strong>
                                    <!-- total 2 -->
                                </h5>
                            </td>
                            <td class="col-5">
                                <span class="numbers" id="totalDM"  style="font-size:1rem;">
                                    Rp <?php 
                                        echo $subtotal + $total_price; 
                                    ?>
                                </span>
                            </td>     
                        </tr>
                        <tr class="row text-center">
                            <td class="d-none col-7">
                                <h5 class="mt-3 font-weight-bold text-center">
                                <strong class="text-danger" id="diskonDM" style="font-size: 0.9rem;">DISKON</strong>
                                </h5>
                            </td>
                            <td class="d-none col-5">
                                <h5 class="mt-3 font-weight-bold numbers text-danger" id="diskonValueDM" style="font-size: 0.9rem;">
                                -
                                </h5>
                            </td>
                            <td class="d-none col-7">
                                <h5 class="mt-3 font-weight-bold text-center">
                                    <strong id="totalAkhirDM" style="font-size: 0.9rem;">TOTAL AKHIR</strong>
                                </h5>
                            </td>
                            <td class="d-none col-5">
                                <h5 class="mt-3 font-weight-bold numbers" id="totalAkhirValueDM" style="font-size: 0.9rem;">
                                Rp <?= $_POST['totalBayarPost']; ?>
                                </h5>
                            </td>
                            <?php
                                if(isset($_POST['nominalPost']) && $_POST['nominalPost'] !=''){
                            ?>
                            <td class="col-7">
                                <h5 class="mt-3 font-weight-bold text-center">
                                <strong class="text-danger" id="diskonDM" style="font-size: 0.9rem;">DISKON</strong>
                                </h5>
                            </td>
                            <td class="col-5">
                                <h5 class="mt-3 font-weight-bold numbers text-danger" id="diskonValueDM" style="font-size: 0.9rem;">
                                Rp <?= $_POST['nominalPost']; ?>
                                </h5>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr class="row text-center">
                        <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){ ?>
                            <td class="col-7">
                                <h5 class="mt-3 font-weight-bold text-center" style="font-size: 0.9rem;">
                                    <strong id="totalAkhirDM">TOTAL AKHIR</strong>
                                </h5>
                            </td>
                            <td class="col-5">
                                <h5 class="mt-3 font-weight-bold numbers" id="totalAkhirValueDM" style="font-size: 0.9rem;">
                                Rp <?= $_POST['totalBayarPost']; ?>
                                </h5>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr class="row p-1">
                            <td scope="row" class="pt-4 col-6">
                                <input type="text" class="form-control" placeholder="<?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo $_POST['voucherPost']; } else{ echo "Masukkan Kode"; } ?>" id="voucherDM" <?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo 'readonly'; } ?>>
                                <div id="errorVoucherM" class="invalid-feedback">
                                    error
                                </div>
                            </td>
                            <td class="col-6">
                                <button class="btn btn-dark p-2" id="btnVoucherDM" <?php if(isset($_POST['voucherPost']) && $_POST['voucherPost'] != ''){ echo "disabled"; }?> style="font-size:13px;">Gunakan Kode</button>
                                <a href="{site_url}checkout?unset"> 
                                    <i class="fa fa-times-circle p-2 text-danger" aria-hidden="true" id="removeVoucher"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="row d-none">
                            <th class="col-6" scope="col">
                                <h5 class="p-1">SUBTOTAL</h5>
                            </th>
                            <th class="col-6 numbers" scope="col" style="font-size:22px;"><strong><?php 
                                if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                                $subtotal2 = $_POST['totalBayarPost'];
                            } else{
                                $subtotal2 = $subtotal + $total_price; 
                            }

                if($subtotal2 <= 0) {
                header('Location: {site_url}admin/order-history-user');
                exit;
                } 
                else {
                if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                    echo $_POST['totalBayarPost'];
                } else{
                    echo $subtotal3;
                    }
                }?></strong></th>
                        </tr>
                        <tr>
                            <th class="col-xl-12" scope="col">*Belum termasuk biaya admin</th>
                        </tr>
                    </tbody>
                </table>
                <?php if($subtotal2 != 0){ ?>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-xl-12">
                        <div class="accordion md-accordion accordion-5">
                            <div class="card mb-2">
                                <div class="px-3 py-0">
                                    <a class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        id="pay-button-cc">
                                        <strong> Kartu Kredit / Debit</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="px-3 py-0 ">
                                    <a class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        id="pay-button-transfer">
                                        <strong>Transfer Bank ( Virtual Account )</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <!-- Card header -->
                                <div class="px-3 py-0 ">
                                    <a id="banktransfer" href=""
                                        class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        data-toggle="modal" data-target="#ModalBankTransfer">
                                        <strong>Transfer Bank BCA ( Verifikasi Manual )</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="px-3 py-0 ">
                                    <a class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        id="pay-button-gopay">
                                        <strong>Gopay</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="px-3 py-0 ">
                                    <a class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        id="pay-button-shopeepay">
                                        <strong>Shopee Pay</strong>
                                    </a>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="px-3 py-0 ">
                                    <a class="btn btn-deep-orange w-100 rounded text-capitalize font-weight-bold"
                                        id="pay-button-alfamart">
                                        <img src="https://astronaccishop.com/images/alfamart.png" class="w-25"
                                            alt="" srcset="">
                                        <img src="https://astronaccishop.com/images/alfamidi.png" class="w-25"
                                            alt="" srcset="">
                                        <img src="https://astronaccishop.com/images/dadant.png" class="w-25"
                                            alt="" srcset="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="ModalBankTransfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead text-white">Bank Transfer Manual</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form class="needs-validation" novalidate>
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-sm-12">
                                <div class="grey lighten-4 p-3">
                                    <div class="container text-center my-4">
                                        <img src="{site_url}images/bca.png" class="img-fluid w-75" />
                                    </div>

                                    <ul class="list-group list-group-flush">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <a
                                                            class="text-white btn-floating success-color-dark btn-sm"><i
                                                                class="far fa-check-circle"></i></a>
                                                    </div>
                                                    <div class="col-10 my-3">
                                                        <h5>PT Ashop Karya Astronacci</h5>
                                                    </div>
                                                </div>

                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <a class="btn-floating success-color-dark btn-sm"><i
                                                                class="far fa-check-circle"></i></a>
                                                    </div>
                                                    <div class="col-10 my-3">
                                                        <h5>6600.808.000</h5>
                                                    </div>
                                                </div>

                                            </li>

                                        </ul>
                                    </ul>
                                    <h5 class="text-center my-4">
                                        Terima kasih
                                    </h5>

                                    <h6 class="text-center">Pesanan Anda akan diproses via EMAIL setelah
                                        pembayaran terverifikasi maksimal 2x24 jam hari kerja.</h6>
                                    <h6 class="text-center text-danger">*Cek email Anda untuk melihat detail<br>
                                        produk yang Anda beli.</h6>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xl-7">
                                <h2>ORDER DETAILS</h2>
                                <table class="table product-table table-responsive">
                                    <tbody>
                                        <?php $subtotal = 0; ?>
                                        <?php echo $item_details; ?>
                                        <?php
                                            if(!empty($_SESSION["shopping_cart"]))
                                            {
                                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                                            {
                                            $item1_details = array(
                                                'id' => $values["product_id"],
                                                'price' => $values["product_price"],
                                                'quantity' => 1,
                                                'name' => $values["product_name"]
                                            );
                                            }
                                        }
                                        ?>
                                        {exp:channel:entries channel="cart"
                                        search:cart_member="{logged_in_member_id}"
                                        search:cart_status="open" dynamic="no"}
                                        {if no_results}
                                        <?php $subtotal = 0; ?>
                                        {/if}
                                        <?php $subtotal += {cart_price}; ?>
                                        <?php 
                                        if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] !=''){
                                            $subtotal2 = $_POST['totalBayarPost'];
                                        } else{
                                            $subtotal2 = $total_price + $subtotal; 
                                        }
                                ?>
                                        <?php $subtotal3 = number_format($total_price + $subtotal); ?>

                                        <!-- First row -->
                                        <tr>
                                            <td scope="row" style="width:20%;">
                                                <a href="{site_url}{cart_channel}/detail/{cart_url_title}"><img
                                                        src="{cart_thumbnail}" alt="{cart_title}"
                                                        class="img-fluid z-depth-0"></a>
                                            </td>
                                            <td style="width:20%;">
                                                <h5 class="mt-3" style="font-size:15px;">
                                                    <a href="{site_url}{cart_channel}/detail/{cart_url_title}"
                                                        style="margin-right:0px!important;"><strong>{cart_title}</strong></a>
                                                </h5>
                                                <a href="{site_url}{cart_channel}">
                                                    <p class="text-muted">{cart_category}</p>
                                                </a>
                                            </td>
                                            <td style="width:20%;" class="text-center">
                                                <h6>1</h6>
                                            </td>
                                            <td style="width:20%;" class="text-center">
                                            <?php if(isset($_POST['idProductPost']) && ($_POST['idProductPost'] == "{cart_product}" )){ ?>
                                                <h6 class="numbers prices text-danger" id="{cart_product}" style="text-decoration: line-through;">Rp {cart_price}</h6>
                                                <h6> <?php 
                                                if(isset($_POST['tempNominalHargaCoretPost']) && $_POST['tempNominalHargaCoretPost'] !=''){
                                                    echo $_POST['tempNominalHargaCoretPost']; 
                                                }
                                            ?> </h6>
                                            <?php 
                                                } else{ 
                                            ?>
                                                <h6 class="numbers {cart_product}">Rp&ensp;{cart_price}</h6>
                                            <?php
                                                }
                                            ?>
                                            </td>
                                            <td style="width:20%;" class="text-center">
                                            <form action="" method="POST">
                                                <input id="entry_id_delete" name="entry_id_delete" type="hidden"
                                                    value="{entry_id}">
                                                <input type="hidden" value="{cart_product}">
                                                <input type="hidden" name="XID" value="{XID_HASH}" />
                                                <button type="submit" name="submit_delete" class="btn btn-xs btn-danger p-2"
                                                    data-toggle="tooltip" data-placement="top" title="Remove item"><i
                                                        class="fas fa-trash-alt fa-lg"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                        <!-- /.First row -->
                                        {/exp:channel:entries}
                                        <?php if($subtotal2 != 0){ ?>
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <h6>SUBTOTAL</h6>
                                            </td>
                                            <td>
                                                <h6 class="numbers" id="verifikasiManual">Rp&ensp;<?php echo $subtotal3 ?></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                        <?php
                                            if(isset($_POST['nominalPost']) && $_POST['nominalPost'] != ''){
                                            ?>
                                            <td></td>
                                            <td class="text-center">
                                                <h6 class="mt-3 font-weight-bold">
                                                <strong class="text-danger" id="diskonD">DISKON</strong>
                                                </h6>
                                            </td>
                                            <td>
                                                <h6 class="mt-3 font-weight-bold numbers text-danger" id="diskonValueD">
                                                Rp <?= $_POST['nominalPost']; ?>
                                                </h6>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] != ''){ ?> class="d-none" <?php }?>>
                                                <h6 class="mt-3 font-weight-bold text-center">
                                                    <strong id="totalAkhirD" class="d-none">TOTAL AKHIR</strong>
                                                </h6>
                                            </td>
                                            <td <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] != ''){ ?> class="d-none" <?php }?>>
                                                <h6 class="mt-3 font-weight-bold numbers d-none" id="totalAkhirValueD">
                                                -
                                                </h6>
                                            </td>
                                        <?php if(isset($_POST['totalBayarPost']) && $_POST['totalBayarPost'] != ''){ ?>
                                            <td></td>
                                            <td class="text-center">
                                                <h6 class="mt-3 font-weight-bold text-center">
                                                    <strong id="totalAkhirD">TOTAL AKHIR</strong>
                                                </h6>
                                            </td>
                                            <td >
                                                <h6 class="mt-3 font-weight-bold numbers" id="totalAkhirValueD">
                                                Rp <?= $_POST['totalBayarPost']; ?>
                                                </h6>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } else { ?>
                                        <tr>
                                            <td>
                                                <h4>Your cart is empty.</h4>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <!-- /.Table body -->
                                </table>
                            </div>
                        </div>
                    </form>
                    <!--Modal: Login / Register Form-->
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer">
                <a class="btn btn-danger rounded font-weight-bold text-capitalize"
                    data-dismiss="modal" style="font-weight: 701;">Batal</a>
                    <form action="{site_url}checkout/bank-transfer" method="POST" style="margin:0;">
                        <input type="hidden" name="nP" value="<?php if(isset($_POST['nominalPost'])){ echo $_POST['nominalPost'];}?>">
                        <input type="hidden" name="tBP" value="<?php if(isset($_POST['totalBayarPost'])){ echo $_POST['totalBayarPost'];}?>">
                        <button class="btn btn-deep-orange font-weight-bold tombolsimpan" type="submit">
                            <strong>Proses Pembayaran</strong>
                        </button>
                    </form>
            </div>
        </div>
        <!--/.Content-->
    </div>
    <!-- Central Modal Medium Danger-->
</div>
<!-- /.Main Container -->
</div>
<!--Footer-->
<footer class="page-footer text-center text-md-left stylish-color-dark pt-0"
style="background-image: url(https://catinstitute.org/cat-img/footer.png);">
{footer-shop}
</footer>
<!--/.Footer-->
{default-js-elearning}
<script type="text/javascript">
/* WOW.js init */
new WOW().init();

// Tooltips Initialization
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>
<script>
// Material Select Initialization
$(document).ready(function () {
    $('.mdb-select').material_select();
});
</script>
<script>
// SideNav Initialization
$(".button-collapse").sideNav();
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.13/dist/sweetalert2.all.min.js">
</script>
<!-- Desktop -->
<script>
let btnVoucherDM = document.getElementById('btnVoucherDM');
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//   let prices = document.getElementsByClassName('prices');
//   const totalD = document.getElementById('totalD');
//   let valTotalD = 0;
//   let tempTotalD;
//   for(let i=0; i < prices.length; i++ ){
//     //   totalD += prices[i].
//     tempTotalD = prices[i].textContent.replaceAll(',','') 
//     tempTotalD = tempTotalD.replaceAll('Rp','')
//     tempTotalD = tempTotalD.replace(/\s/g, '')
//     tempTotalD = parseInt(tempTotalD)
//     valTotalD += tempTotalD 
//   }
    
// totalD.textContent = "Rp "+ valTotalD.toLocaleString('id-ID').replaceAll('.',',');

sessionStorage.removeItem('confirm');
sessionStorage.removeItem('userId');
sessionStorage.removeItem('voucher');
sessionStorage.removeItem('stop');
// Total sebelum diskon
let totalSebelumDiskon = document.getElementById('totalD');
// nama/kode voucher
let voucherD;

let btnVoucherD = document.getElementById('btnVoucherD');
let diskonD = document.getElementById('diskonD');
let diskonValueD = document.getElementById('diskonValueD');
let totalAkhirD = document.getElementById('totalAkhirD');
let totalAkhirValueD = document.getElementById('totalAkhirValueD');

let entryId = document.getElementsByClassName('entryIDD');

let userId = document.getElementById('userId').value;

let errorVoucher = document.getElementById('errorVoucher');
document.getElementById('voucherD').addEventListener('focusout', function () {
    sessionStorage.removeItem('stop')
    voucherD = document.getElementById('voucherD').value;
    if (voucherD == '') {
        errorVoucher.style.display = 'none';
        return true;
    }
    $.ajax({
        type: 'POST',
        url: 'https://astronaccishop.com/prosesJson/checkUserVoucher.php',
        dataType: "json",
        data: {
            userId: userId,
            namaVoucher: voucherD
        },
        success: function (data) {
            if (data.code == 200) {
                for (let a = 0; a < entryId.length; a++) {
                    let idProduct = entryId[a].value;
                    $.ajax({
                        type: "POST",
                        url: "https://astronaccishop.com/prosesJson/getVoucher.php",
                        dataType: "json",
                        data: {
                            idProduct: idProduct,
                            voucherD: voucherD
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                for (let i = 0; i < entryId.length; i++) {
                                    if (idProduct == entryId[i].value) {
                                        errorVoucher.textContent =
                                            'Voucher tersedia!'
                                        errorVoucher.style.display =
                                            'inline-block';
                                        errorVoucher.classList.remove(
                                            'invalid-feedback');
                                        errorVoucher.classList.add(
                                            'valid-feedback');
                                        sessionStorage.setItem('stop', 1);
                                    }
                                }
                            } else {
                                if (sessionStorage.getItem('stop') != 1) {
                                    errorVoucher.style.display = 'inline-block';
                                    errorVoucher.textContent =
                                        'Voucher tidak tersedia!';
                                    errorVoucher.classList.remove(
                                        'valid-feedback');
                                    errorVoucher.classList.add(
                                        'invalid-feedback');
                                }
                            }
                        }
                    });
                }
            } else {
                sessionStorage.removeItem('stop')
                errorVoucher.style.display = 'inline-block';
                errorVoucher.textContent = 'Voucher sudah digunakan!';
                errorVoucher.classList.remove('valid-feedback');
                errorVoucher.classList.add('invalid-feedback');
            }
        }
    });
});

btnVoucherD.addEventListener('click', function () {
    voucherD = document.getElementById('voucherD').value;
    let z;
    $.ajax({
        type: 'POST',
        url: 'https://astronaccishop.com/prosesJson/checkUserVoucher.php',
        dataType: "json",
        data: {
            userId: userId,
            namaVoucher: voucherD
        },
        success: function (data) {
            if (data.code == 200) {
                var hh = [];
                for (let a = 0; a < entryId.length; a++) {
                    let idProduct = entryId[a].value;

                    let tempTotalSebelumDiskon = totalD.innerHTML.replaceAll(
                        'Rp', '');
                    tempTotalSebelumDiskon = tempTotalSebelumDiskon.replaceAll(',', '');
                    tempTotalSebelumDiskon = tempTotalSebelumDiskon.replace(/\s/g, '');
                    $.ajax({
                        type: "POST",
                        url: "https://astronaccishop.com/prosesJson/getVoucher.php",
                        dataType: "json",
                        data: {
                            idProduct: idProduct,
                            voucherD: voucherD
                        },
                        success: function (data) {
                            let harga = document.getElementById(idProduct)
                                .innerHTML;
                            let tempHarga = harga.replaceAll('Rp', '');
                            tempHarga = tempHarga.replaceAll(',', '');
                            tempHarga = tempHarga.replaceAll(/\s/g, '');
                            if (data.code == 200) {
                                if (parseInt(data.tempNominalVoucher) > parseInt(tempHarga) && data.msg == 'Voucher berhasil digunakan!') {
                                        // voucher per produk di atas harga produk
                                    let z;
                                    if (a < entryId.length) {
                                        z = confirm('Voucher lebih besar dari harga produk, tetap gunakan?');
                                    }
                                    if (z) {
                                        diskonD.classList.remove('d-none');
                                        diskonValueD.classList.remove('d-none');
                                        totalAkhirD.classList.remove('d-none');
                                        totalAkhirValueD.classList.remove('d-none');

                                        var h;
                                        h = tempHarga;
                                        hh.push(h)
                                        let maxHarga = hh.sort((a, b) => a - b);
                                        let adjust = hh[hh.length - 1];
                                        diskonValueD.innerHTML = "Rp " +
                                            parseInt(adjust).toLocaleString(
                                                'id-ID')
                                            .replaceAll(
                                                '.',
                                                ',');
                                        let tAkhir = tempTotalSebelumDiskon - adjust;
                                        totalAkhirValueD.innerHTML = "Rp " + tAkhir.toLocaleString('id-ID').replaceAll('.',',');
                                        // Total yang harus dibayar
                                        let tempTAkhir = 0;                                          
                                        let jumlahPakaiVoucherUpdate = data
                                            .jumlahPakaiVoucher - 1;
                                        let tempDiskonNominalVoucher = data
                                            .tempNominalVoucher;
                                        
                                        if (data.msg == "Voucher berhasil digunakan!") {
                                            //
                                            Swal.fire(
                                                'Selamat!',
                                                'Voucher berhasil digunakan! :)',
                                                'success'
                                            )
                                            for (let i = 0; i < entryId
                                                .length; i++) {
                                                if (idProduct == entryId[i]
                                                    .value) {
                                                    let hargaCoret = document.getElementById(idProduct);
                                                    hargaCoret.classList.add('text-danger');
                                                    hargaCoret.style.textDecoration = "line-through";
                                                    let nominalHargaCoret = hargaCoret.innerHTML;
                                                    let tempNominalHargaCoret = nominalHargaCoret.replaceAll('Rp','');
                                                    tempNominalHargaCoret = tempNominalHargaCoret.replaceAll(',','');
                                                    tempNominalHargaCoret = tempNominalHargaCoret.replace(/\s/g,'');
                                                    let elementHargaDiskon = document.createElement("h6");
                                                    elementHargaDiskon.innerHTML = "Rp 0";
                                                    hargaCoret.parentNode.insertBefore(elementHargaDiskon,hargaCoret.nextSibling);

                                                    // let hargaCoretManual = document.getElementsByClassName(idProduct)[0];
                                                    // hargaCoretManual.classList.add('text-danger');
                                                    // hargaCoretManual.style.textDecoration = "line-through";
                                                    // let nominalHargaCoretManual = hargaCoretManual.innerHTML;
                                                    // let tempNominalHargaCoretManual = nominalHargaCoretManual.replaceAll('Rp','');
                                                    // tempNominalHargaCoretManual = tempNominalHargaCoretManual.replaceAll(',','');
                                                    // tempNominalHargaCoretManual = tempNominalHargaCoretManual.replace(/\s/g,'');
                                                    // let elementHargaDiskonManual = document.createElement("h6");
                                                    // elementHargaDiskonManual.innerHTML = "Rp 0";
                                                    // hargaCoretManual.parentNode.insertBefore(elementHargaDiskonManual,hargaCoretManual.nextSibling);
                                                    setCookie("tempNominalHargaCoret2", elementHargaDiskon.innerHTML, 1);
                                                    
                                                }
                                            }
                                            document.getElementById('totalBelanja').textContent = "Rp " + tAkhir.toLocaleString('id-ID').replaceAll('.',',');
                                            document.getElementById('verifikasiManual').textContent = "Rp " + tAkhir.toLocaleString('id-ID').replaceAll('.',',');
                                            
                                            btnVoucherD.disabled = true;
                                            btnVoucherDM.disabled = true;
                                            setCookie("userIdPost2", userId, 1);
                                            setCookie("voucherPost2", voucherD, 1);
                                            setCookie("totalBayarPost2", tAkhir, 1);
                                            setCookie("nominalPost2", adjust, 1);
                                            setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdate, 1);
                                            setCookie("idProduct2", idProduct, 1);
                                            sessionStorage.setItem('voucher2', voucherD);
                                            sessionStorage.setItem('userId2', userId);
                                            sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdate);
                                            window.location.href = "https://astronaccishop.com/checkout/diskon";
                                            //
                                            return true; 
                                        } 
                                    } else {
                                        if (a < entryId.length) {
                                            sessionStorage.setItem('confirm',
                                            1);
                                            Swal.fire(
                                                'Maaf!',
                                                'Voucher dibatalkan!',
                                                'error'
                                            )
                                        }
                                    }
                                } else if (parseInt(data.tempNominalVoucher) > parseInt(tempTotalSebelumDiskon) && data.msg =='Voucher semua berhasil digunakan!') {
                                    // voucher semua produk di atas total belanja
                                    if (a <= 1) {
                                        z = confirm(
                                            'Voucher lebih besar dari total belanja, tetap gunakan?'
                                            );
                                    }
                                    if (z) {
                                        diskonD.classList.remove('d-none');
                                        diskonValueD.classList.remove('d-none');
                                        totalAkhirD.classList.remove('d-none');
                                        totalAkhirValueD.classList.remove(
                                            'd-none');

                                        diskonValueD.innerHTML = "Rp " + data
                                            .nominalVoucher;
                                        totalAkhirValueD.innerHTML = "Rp 0";

                                        // Total yang harus dibayar
                                        let tempTAkhir = 0;
                                        let jumlahPakaiVoucherUpdate = data
                                            .jumlahPakaiVoucher - 1;
                                        let tempDiskonNominalVoucher = data
                                            .tempNominalVoucher;
                                        //
                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher semua berhasil digunakan! :)',
                                            'success'
                                        );
                                        document.getElementById('totalBelanja').textContent = "Rp 0"
                                        document.getElementById('verifikasiManual').textContent = "Rp 0"
                                        
                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userId, 1);
                                        setCookie("voucherPost2", voucherD, 1);
                                        setCookie("totalBayarPost2", tempTAkhir, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdate, 1);
                                        setCookie("idProduct2Semua", idProduct, 1);
                                        sessionStorage.setItem('voucher2', voucherD);
                                        sessionStorage.setItem('userId2', userId);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdate);
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    } else {
                                        if (a <= 1) {
                                            Swal.fire(
                                                'Maaf!',
                                                'Voucher dibatalkan!',
                                                'error'
                                            )
                                            sessionStorage.setItem('confirm',
                                            1);
                                        }
                                    }
                                } else {
                                    // per produk di bawah harga produk
                                    diskonD.classList.remove('d-none');
                                    diskonValueD.classList.remove('d-none');
                                    totalAkhirD.classList.remove('d-none');
                                    totalAkhirValueD.classList.remove('d-none');
                                    diskonValueD.innerHTML = "Rp " + data
                                        .nominalVoucher;
                                    let tAkhir = tempTotalSebelumDiskon - data
                                        .tempNominalVoucher;
                                    totalAkhirValueD.innerHTML = "Rp " + tAkhir
                                        .toLocaleString('id-ID').replaceAll(
                                            '.',
                                            ',');
                                    // Total yang harus dibayar
                                    let tempTAkhir = tAkhir;
                                    let jumlahPakaiVoucherUpdate = data
                                        .jumlahPakaiVoucher - 1;
                                    let tempDiskonNominalVoucher = data
                                        .tempNominalVoucher;
                                    if (data.msg =="Voucher berhasil digunakan!") {
                                        //
                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher berhasil digunakan! :)',
                                            'success'
                                        )
                                        for (let i = 0; i < entryId
                                            .length; i++) {
                                            if (idProduct == entryId[i].value) {
                                                let hargaCoret = document.getElementById(idProduct);
                                                hargaCoret.classList.add('text-danger');
                                                hargaCoret.style.textDecoration = "line-through";
                                                let nominalHargaCoret = hargaCoret.innerHTML;
                                                let tempNominalHargaCoret = nominalHargaCoret.replaceAll('Rp','');
                                                tempNominalHargaCoret = tempNominalHargaCoret.replaceAll(',','');
                                                tempNominalHargaCoret = tempNominalHargaCoret.replace(/\s/g,'');
                                                let elementHargaDiskon = document.createElement("h6");
                                                elementHargaDiskon.innerHTML = "Rp " + (tempNominalHargaCoret-tempDiskonNominalVoucher).toLocaleString('id-ID').replaceAll('.', ',');
                                                hargaCoret.parentNode.insertBefore(elementHargaDiskon,hargaCoret.nextSibling);

                                                // let hargaCoretManual = document.getElementsByClassName(idProduct)[0];
                                                // hargaCoretManual.classList.add('text-danger');
                                                // hargaCoretManual.style.textDecoration = "line-through";
                                                // let nominalHargaCoretManual = hargaCoretManual.innerHTML;
                                                // let tempNominalHargaCoretManual = nominalHargaCoretManual.replaceAll('Rp','');
                                                // tempNominalHargaCoretManual = tempNominalHargaCoretManual.replaceAll(',','');
                                                // tempNominalHargaCoretManual = tempNominalHargaCoretManual.replace(/\s/g,'');
                                                // let elementHargaDiskonManual = document.createElement("h6");
                                                // elementHargaDiskonManual.innerHTML = "Rp " + (tempNominalHargaCoretManual -tempDiskonNominalVoucher).toLocaleString('id-ID').replaceAll('.', ',');
                                                // hargaCoretManual.parentNode.insertBefore(elementHargaDiskonManual,hargaCoretManual.nextSibling);
                                                setCookie("tempNominalHargaCoret2", elementHargaDiskon.innerHTML, 1);
                                            }
                                        }
                                        document.getElementById('totalBelanja').textContent = "Rp " + tAkhir
                                        .toLocaleString('id-ID').replaceAll('.',',');
                                        document.getElementById('verifikasiManual').textContent = "Rp " + tAkhir
                                        .toLocaleString('id-ID').replaceAll('.',',');

                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userId, 1);
                                        setCookie("voucherPost2", voucherD, 1);
                                        setCookie("totalBayarPost2", tempTAkhir, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdate, 1);
                                        setCookie("idProduct2", idProduct, 1);
                                        sessionStorage.setItem('voucher2', voucherD);
                                        sessionStorage.setItem('userId2', userId);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdate);
                                        
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    } else {
                                        //
                                        document.getElementById('totalBelanja').textContent = "Rp " + tAkhir
                                        .toLocaleString('id-ID').replaceAll('.',',');
                                        document.getElementById('verifikasiManual').textContent = "Rp " + tAkhir
                                        .toLocaleString('id-ID').replaceAll('.',',');

                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher semua berhasil digunakan! :)',
                                            'success'
                                        );
                                        
                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userId, 1);
                                        setCookie("voucherPost2", voucherD, 1);
                                        setCookie("totalBayarPost2", tempTAkhir, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdate, 1);
                                        setCookie("idProduct2Semua", idProduct, 1);
                                        sessionStorage.setItem('voucher2', voucherD);
                                        sessionStorage.setItem('userId2', userId);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdate);
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    }
                                }
                            } else {
                                if (sessionStorage.getItem('confirm') == 1) {
                                    return false;
                                } else {
                                    //   if (a == 0 && sessionStorage.getItem('confirm') != 1) {
                                    //       Swal.fire(
                                    //         'Maaf!',
                                    //         'Voucher gagal!',
                                    //         'error'
                                    //       )
                                    //     return false;
                                    //   }
                                }
                            }
                        }
                    });
                }
            } else {
                Swal.fire(
                    'Maaf!',
                    'Voucher sudah Anda gunakan',
                    'error'
                )
            }
            return true;
        }
    });
});
</script>

<!-- Mobile -->
<script>
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

    // let pricesM = document.getElementsByClassName('pricesM');
    // const totalDM = document.getElementById('totalDM');
    // let valTotalDM = 0;
    // let tempTotalDM;
    // for(let i=0; i < pricesM.length; i++ ){
    // //   totalD += prices[i].
    // tempTotalDM = pricesM[i].textContent.replaceAll(',','') 
    // tempTotalDM = tempTotalDM.replaceAll('Rp','')
    // tempTotalDM = tempTotalDM.replace(/\s/g, '')
    // tempTotalDM = parseInt(tempTotalDM)
    // valTotalDM += tempTotalDM 
    // }
    
// totalDM.textContent = "Rp "+ valTotalDM.toLocaleString('id-ID').replaceAll('.',',');

sessionStorage.removeItem('confirm');
sessionStorage.removeItem('userId');
sessionStorage.removeItem('voucher');
sessionStorage.removeItem('stop');
// Total sebelum diskon
let totalSebelumDiskonM = document.getElementById('totalDM');
// nama/kode voucher
let voucherDM;

let diskonDM = document.getElementById('diskonDM');
let diskonValueDM = document.getElementById('diskonValueDM');
let totalAkhirDM = document.getElementById('totalAkhirDM');
let totalAkhirValueDM = document.getElementById('totalAkhirValueDM');

let entryIdM = document.getElementsByClassName('entryIDDM');

let userIdM = document.getElementById('userIdM').value;

let errorVoucherM = document.getElementById('errorVoucherM');
document.getElementById('voucherDM').addEventListener('focusout', function () {
    sessionStorage.removeItem('stop')
    voucherDM = document.getElementById('voucherDM').value;
    if (voucherDM == '') {
        errorVoucherM.style.display = 'none';
        return true;
    }
    $.ajax({
        type: 'POST',
        url: 'https://astronaccishop.com/prosesJson/checkUserVoucher.php',
        dataType: "json",
        data: {
            userId: userIdM,
            namaVoucher: voucherDM
        },
        success: function (data) {
            if (data.code == 200) {
                for (let a = 0; a < entryIdM.length; a++) {
                    let idProductM = entryIdM[a].value;
                    $.ajax({
                        type: "POST",
                        url: "https://astronaccishop.com/prosesJson/getVoucher.php",
                        dataType: "json",
                        data: {
                            idProduct: idProductM,
                            voucherD: voucherDM
                        },
                        success: function (data) {
                            if (data.code == 200) {
                                for (let i = 0; i < entryIdM.length; i++) {
                                    if (idProductM == entryIdM[i].value) {
                                        errorVoucherM.textContent =
                                            'Voucher tersedia!'
                                        errorVoucherM.style.display =
                                            'inline-block';
                                        errorVoucherM.classList.remove(
                                            'invalid-feedback');
                                        errorVoucherM.classList.add(
                                            'valid-feedback');
                                        sessionStorage.setItem('stop', 1);
                                    }
                                }
                            } else {
                                if (sessionStorage.getItem('stop') != 1) {
                                    errorVoucherM.style.display = 'inline-block';
                                    errorVoucherM.textContent =
                                        'Voucher tidak tersedia!';
                                    errorVoucherM.classList.remove(
                                        'valid-feedback');
                                    errorVoucherM.classList.add(
                                        'invalid-feedback');
                                }
                            }
                        }
                    });
                }
            } else {
                sessionStorage.removeItem('stop')
                errorVoucherM.style.display = 'inline-block';
                errorVoucherM.textContent = 'Voucher sudah digunakan!';
                errorVoucherM.classList.remove('valid-feedback');
                errorVoucherM.classList.add('invalid-feedback');
            }
        }
    });
});

btnVoucherDM.addEventListener('click', function () {
    voucherDM = document.getElementById('voucherDM').value;
    let z;
    $.ajax({
        type: 'POST',
        url: 'https://astronaccishop.com/prosesJson/checkUserVoucher.php',
        dataType: "json",
        data: {
            userId: userIdM,
            namaVoucher: voucherDM
        },
        success: function (data) {
            if (data.code == 200) {
                var hh = [];
                for (let a = 0; a < entryIdM.length; a++) {
                    let idProductM = entryIdM[a].value;

                    let tempTotalSebelumDiskonM = totalDM.innerHTML.replaceAll(
                        'Rp', '');
                    tempTotalSebelumDiskonM = tempTotalSebelumDiskonM.replaceAll(',', '');
                    tempTotalSebelumDiskonM = tempTotalSebelumDiskonM.replace(/\s/g, '');
                    $.ajax({
                        type: "POST",
                        url: "https://astronaccishop.com/prosesJson/getVoucher.php",
                        dataType: "json",
                        data: {
                            idProduct: idProductM,
                            voucherD: voucherDM
                        },
                        success: function (data) {
                            let hargaM = document.getElementById(idProductM+'M').innerHTML;
                            let tempHargaM = hargaM.replaceAll('Rp', '');
                            tempHargaM = tempHargaM.replaceAll(',', '');
                            tempHargaM = tempHargaM.replaceAll(/\s/g, '');
                            if (data.code == 200) {
                                if (parseInt(data.tempNominalVoucher) > parseInt(tempHargaM) && data.msg == 'Voucher berhasil digunakan!') {
                                        // voucher per produk di atas harga produk
                                    let z;
                                    if (a < entryIdM.length) {
                                        z = confirm('Voucher lebih besar dari harga produk, tetap gunakan?');
                                    }
                                    if (z) {
                                        diskonDM.classList.remove('d-none');
                                        diskonValueDM.classList.remove('d-none');
                                        totalAkhirDM.classList.remove('d-none');
                                        totalAkhirValueDM.classList.remove('d-none');

                                        var h;
                                        h = tempHargaM;
                                        hh.push(h)
                                        let maxHargaM = hh.sort((a, b) => a - b);
                                        let adjustM = hh[hh.length - 1];
                                        diskonValueDM.innerHTML = "Rp " +
                                            parseInt(adjustM).toLocaleString('id-ID').replaceAll('.',',');
                                        let tAkhirM = tempTotalSebelumDiskonM - adjustM;
                                        totalAkhirValueDM.innerHTML = "Rp " + tAkhirM.toLocaleString('id-ID').replaceAll('.',',');
                                        // Total yang harus dibayar
                                        let tempTAkhirM = 0;                                          
                                        let jumlahPakaiVoucherUpdateM = data.jumlahPakaiVoucher - 1;
                                        let tempDiskonNominalVoucherM = data.tempNominalVoucher;
                                        
                                        if (data.msg == "Voucher berhasil digunakan!") {
                                            //
                                            Swal.fire(
                                                'Selamat!',
                                                'Voucher berhasil digunakan! :)',
                                                'success'
                                            )
                                            for (let i = 0; i < entryIdM.length; i++) {
                                                if (idProductM == entryIdM[i].value) {
                                                    let hargaCoretM = document.getElementById(idProductM+'M');
                                                    hargaCoretM.classList.add('text-danger');
                                                    hargaCoretM.style.textDecoration = "line-through";
                                                    let nominalHargaCoretM = hargaCoretM.innerHTML;
                                                    let tempNominalHargaCoretM = nominalHargaCoretM.replaceAll('Rp','');
                                                    tempNominalHargaCoretM = tempNominalHargaCoretM.replaceAll(',','');
                                                    tempNominalHargaCoretM = tempNominalHargaCoretM.replace(/\s/g,'');
                                                    let elementHargaDiskonM = document.createElement("h6");
                                                    elementHargaDiskonM.innerHTML = "Rp 0";
                                                    elementHargaDiskonM.style.marginLeft = "27.5vh";
                                                    hargaCoretM.parentNode.insertBefore(elementHargaDiskonM,hargaCoretM.nextSibling);

                                                    // let hargaCoretManualM = document.getElementsByClassName(idProductM+'M')[0];
                                                    // hargaCoretManualM.classList.add('text-danger');
                                                    // hargaCoretManualM.style.textDecoration = "line-through";
                                                    // let nominalHargaCoretManualM = hargaCoretManualM.innerHTML;
                                                    // let tempNominalHargaCoretManualM = nominalHargaCoretManualM.replaceAll('Rp','');
                                                    // tempNominalHargaCoretManualM = tempNominalHargaCoretManualM.replaceAll(',','');
                                                    // tempNominalHargaCoretManualM = tempNominalHargaCoretManualM.replace(/\s/g,'');
                                                    // let elementHargaDiskonManualM = document.createElement("h6");
                                                    // elementHargaDiskonManualM.innerHTML = "Rp 0";
                                                    // hargaCoretManualM.parentNode.insertBefore(elementHargaDiskonManualM,hargaCoretManualM.nextSibling);
                                                    setCookie("tempNominalHargaCoret2", elementHargaDiskonM.innerHTML, 1);
                                                    
                                                }
                                            }
                                            document.getElementById('totalBelanja').textContent = "Rp " + tAkhirM.toLocaleString('id-ID').replaceAll('.',',');
                                            document.getElementById('verifikasiManual').textContent = "Rp " + tAkhirM.toLocaleString('id-ID').replaceAll('.',',');
                                            
                                            btnVoucherD.disabled = true;
                                            btnVoucherDM.disabled = true;
                                            setCookie("userIdPost2", userIdM, 1);
                                            setCookie("voucherPost2", voucherDM, 1);
                                            setCookie("totalBayarPost2", tAkhirM, 1);
                                            setCookie("nominalPost2", adjustM, 1);
                                            setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdateM, 1);
                                            setCookie("idProduct2", idProductM, 1);
                                            sessionStorage.setItem('voucher2', voucherDM);
                                            sessionStorage.setItem('userId2', userIdM);
                                            sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdateM);
                                            window.location.href = "https://astronaccishop.com/checkout/diskon";
                                            //
                                            return true; 
                                        } 
                                    } else {
                                        if (a < entryIdM.length) {
                                            sessionStorage.setItem('confirm',
                                            1);
                                            Swal.fire(
                                                'Maaf!',
                                                'Voucher dibatalkan!',
                                                'error'
                                            )
                                        }
                                    }
                                } else if (parseInt(data.tempNominalVoucher) > parseInt(tempTotalSebelumDiskonM) && data.msg =='Voucher semua berhasil digunakan!') {
                                    // voucher semua produk di atas total belanja
                                    if (a <= 1) {
                                        z = confirm(
                                            'Voucher lebih besar dari total belanja, tetap gunakan?'
                                            );
                                    }
                                    if (z) {
                                        diskonDM.classList.remove('d-none');
                                        diskonValueDM.classList.remove('d-none');
                                        totalAkhirDM.classList.remove('d-none');
                                        totalAkhirValueDM.classList.remove('d-none');

                                        diskonValueDM.innerHTML = "Rp " + data.nominalVoucher;
                                        totalAkhirValueDM.innerHTML = "Rp 0";

                                        // Total yang harus dibayar
                                        let tempTAkhirM = 0;
                                        let jumlahPakaiVoucherUpdateM = data.jumlahPakaiVoucher - 1;
                                        let tempDiskonNominalVoucherM = data.tempNominalVoucher;
                                        //
                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher semua berhasil digunakan! :)',
                                            'success'
                                        );
                                        document.getElementById('totalBelanja').textContent = "Rp 0"
                                        document.getElementById('verifikasiManual').textContent = "Rp 0"
                                        
                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userIdM, 1);
                                        setCookie("voucherPost2", voucherDM, 1);
                                        setCookie("totalBayarPost2", tempTAkhirM, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdateM, 1);
                                        setCookie("idProduct2Semua", idProductM, 1);
                                        sessionStorage.setItem('voucher2', voucherDM);
                                        sessionStorage.setItem('userId2', userIdM);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdateM);
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    } else {
                                        if (a <= 1) {
                                            Swal.fire(
                                                'Maaf!',
                                                'Voucher dibatalkan!',
                                                'error'
                                            )
                                            sessionStorage.setItem('confirm',1);
                                        }
                                    }
                                } else {
                                    // per produk di bawah harga produk
                                    diskonDM.classList.remove('d-none');
                                    diskonValueDM.classList.remove('d-none');
                                    totalAkhirDM.classList.remove('d-none');
                                    totalAkhirValueDM.classList.remove('d-none');
                                    diskonValueDM.innerHTML = "Rp " + data.nominalVoucher;
                                    let tAkhirM = tempTotalSebelumDiskonM - data.tempNominalVoucher;
                                    totalAkhirValueDM.innerHTML = "Rp " + tAkhirM.toLocaleString('id-ID').replaceAll('.',',');
                                    // Total yang harus dibayar
                                    let tempTAkhirM = tAkhirM;
                                    let jumlahPakaiVoucherUpdateM = data.jumlahPakaiVoucher - 1;
                                    let tempDiskonNominalVoucherM = data.tempNominalVoucher;
                                    if (data.msg =="Voucher berhasil digunakan!") {
                                        //
                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher berhasil digunakan! :)',
                                            'success'
                                        )
                                        for (let i = 0; i < entryIdM.length; i++) {
                                            if (idProductM == entryIdM[i].value) {
                                                let hargaCoretM = document.getElementById(idProductM+'M');
                                                hargaCoretM.classList.add('text-danger');
                                                hargaCoretM.style.textDecoration = "line-through";
                                                let nominalHargaCoretM = hargaCoretM.innerHTML;
                                                let tempNominalHargaCoretM = nominalHargaCoretM.replaceAll('Rp','');
                                                tempNominalHargaCoretM = tempNominalHargaCoretM.replaceAll(',','');
                                                tempNominalHargaCoretM = tempNominalHargaCoretM.replace(/\s/g,'');
                                                let elementHargaDiskonM = document.createElement("h6");
                                                elementHargaDiskonM.innerHTML = "Rp " + (tempNominalHargaCoretM-tempDiskonNominalVoucherM).toLocaleString('id-ID').replaceAll('.', ',');
                                                elementHargaDiskonM.style.marginLeft = "27.5vh";
                                                hargaCoretM.parentNode.insertBefore(elementHargaDiskonM,hargaCoretM.nextSibling);

                                                // let hargaCoretManualM = document.getElementsByClassName(idProductM)[0];
                                                // hargaCoretManualM.classList.add('text-danger');
                                                // hargaCoretManualM.style.textDecoration = "line-through";
                                                // let nominalHargaCoretManualM = hargaCoretManualM.innerHTML;
                                                // let tempNominalHargaCoretManualM = nominalHargaCoretManualM.replaceAll('Rp','');
                                                // tempNominalHargaCoretManualM = tempNominalHargaCoretManualM.replaceAll(',','');
                                                // tempNominalHargaCoretManualM = tempNominalHargaCoretManualM.replace(/\s/g,'');
                                                // let elementHargaDiskonManualM = document.createElement("h6");
                                                // elementHargaDiskonManualM.innerHTML = "Rp " + (tempNominalHargaCoretManualM -tempDiskonNominalVoucherM).toLocaleString('id-ID').replaceAll('.', ',');
                                                // hargaCoretManualM.parentNode.insertBefore(elementHargaDiskonManualM,hargaCoretManualM.nextSibling);
                                                setCookie("tempNominalHargaCoret2", elementHargaDiskonM.innerHTML, 1);
                                            }
                                        }
                                        document.getElementById('totalBelanja').textContent = "Rp " + tAkhirM
                                        .toLocaleString('id-ID').replaceAll('.',',');
                                        document.getElementById('verifikasiManual').textContent = "Rp " + tAkhirM
                                        .toLocaleString('id-ID').replaceAll('.',',');

                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userIdM, 1);
                                        setCookie("voucherPost2", voucherDM, 1);
                                        setCookie("totalBayarPost2", tempTAkhirM, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdateM, 1);
                                        setCookie("idProduct2", idProductM, 1);
                                        sessionStorage.setItem('voucher2', voucherDM);
                                        sessionStorage.setItem('userId2', userIdM);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdateM);
                                        
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    } else {
                                        //
                                        document.getElementById('totalBelanja').textContent = "Rp " + tAkhirM
                                        .toLocaleString('id-ID').replaceAll('.',',');
                                        document.getElementById('verifikasiManual').textContent = "Rp " + tAkhirM
                                        .toLocaleString('id-ID').replaceAll('.',',');

                                        Swal.fire(
                                            'Selamat!',
                                            'Voucher semua berhasil digunakan! :)',
                                            'success'
                                        );
                                        
                                        btnVoucherD.disabled = true;
                                        btnVoucherDM.disabled = true;
                                        setCookie("userIdPost2", userIdM, 1);
                                        setCookie("voucherPost2", voucherDM, 1);
                                        setCookie("totalBayarPost2", tempTAkhirM, 1);
                                        setCookie("nominalPost2", data.tempNominalVoucher, 1);
                                        setCookie("jumlahVoucher2", jumlahPakaiVoucherUpdateM, 1);
                                        setCookie("idProduct2Semua", idProductM, 1);
                                        sessionStorage.setItem('voucher2', voucherDM);
                                        sessionStorage.setItem('userId2', userIdM);
                                        sessionStorage.setItem('jumlahVoucher2', jumlahPakaiVoucherUpdateM);
                                        window.location.href = "https://astronaccishop.com/checkout/diskon";
                                        return true;
                                        //
                                    }
                                }
                            } else {
                                if (sessionStorage.getItem('confirm') == 1) {
                                    return false;
                                } else {
                                    //   if (a == 0 && sessionStorage.getItem('confirm') != 1) {
                                    //       Swal.fire(
                                    //         'Maaf!',
                                    //         'Voucher gagal!',
                                    //         'error'
                                    //       )
                                    //     return false;
                                    //   }
                                }
                            }
                        }
                    });
                }
            } else {
                Swal.fire(
                    'Maaf!',
                    'Voucher sudah Anda gunakan',
                    'error'
                )
            }
            return true;
        }
    });
});
</script>

<script>
function simpanUserVoucher(userId, voucher) {
    $.ajax({
        type: 'POST',
        url: 'https://astronaccishop.com/prosesJson/simpanUserVoucher.php',
        dataType: "json",
        data: {
            userId: userId,
            namaVoucher: voucher
        },
        success: function (data) {
            if (data.code == 200) {
                return true;
            }
            data.msg;
            return false;
        }
    });
}

function saveVoucherUsed(voucher, jumlahVoucher){
    $.ajax({
        type: "POST",
        url: "https://astronaccishop.com/prosesJson/getVoucherUpdate.php",
        dataType: "json",
        data: {
            voucherMinus: 1,
            voucherD2: voucher,
            jumlahPakaiVoucherUpdate: jumlahVoucher
        },
        success: function (data) {
            if (data.code == 200) {
                console.log('berhasil')
            } else {
                console.log('gagal');
            }
        }
        });

    $.ajax({
        type: "POST",
        url: "https://astronaccishop.com/prosesJson/getVoucherUpdate2.php",
        dataType: "json",
        data: {
            voucherMinus: 1,
            voucherD2: voucher,
            jumlahPakaiVoucherUpdated2: jumlahVoucher
        },
        success: function (data) {
            if (data.code == 200) {
                console.log('berhasil')
            } else {
                console.log('gagal');
            }
        }
    });
}
</script>


<script>
$(document).ready(function () {
    $(".tombolsimpan").click(function () {
        var username = $("#username").val();
        var order_id = 'Manual Bank Transfer';
        var transaction_id = 'Manual Bank Transfer';
        var payment_type = 'Manual Bank Transfer';
        var transaction_time = 'Manual Bank Transfer';
        var transaction_status = 'Manual Bank Transfer';
        var pdf_url = 'Manual Bank Transfer';
        var va_bank = 'Manual Bank Transfer';
        var va_number = 'Manual Bank Transfer';
        var status = 'Pending';
        var no_onder = $("#no_onder").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var total_belanja = $("#total_belanja").val();
        $.ajax({
            url: '{site_url}insert.php',
            method: 'POST',
            data: {
                username: username,
                order_id: order_id,
                transaction_id: transaction_id,
                payment_type: payment_type,
                transaction_time: transaction_time,
                transaction_status: transaction_status,
                pdf_url: pdf_url,
                va_bank: va_bank,
                va_number: va_number,
                status: status,
                no_onder: no_onder,
                email: email,
                total_belanja: total_belanja,
                phone: phone
            },
            success: function (data) {
                console.log(data)
                saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            }
        });
    });
});
</script>
<script>
$(document).ready(function () {
    $(".tombolsimpan").click(function () {
        var no_onder_detail = [];
        var image_thumb = [];
        var nama_product = [];
        var price_item = [];
        $('.no_onder_detail').each(function () {
            no_onder_detail.push($(this).text());
        });
        $('.image_thumb').each(function () {
            image_thumb.push($(this).text());
        });
        $('.nama_product').each(function () {
            nama_product.push($(this).text());
        });
        $('.price_item').each(function () {
            price_item.push($(this).text());
        });
        $.ajax({
            url: "{site_url}insert_detail.php",
            method: "POST",
            data: {
                no_onder_detail: no_onder_detail,
                image_thumb: image_thumb,
                nama_product: nama_product,
                price_item: price_item
            },
            success: function (data) {
                saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            }
        });
    });
});
</script>
<?php

if(isset($_POST['nominalPost'])){
$diskon = array(
    'id' => '999',
    'price' => -$_POST['nominalPost'],
    'quantity' => 1,
    'name' => "Diskon"
);
} else{
$diskon = array(
    'id' => '999',
    'price' => 0,
    'quantity' => 1,
    'name' => "Diskon"
);
}
$item1_details_cc = array(
'id' => '998',
'price' => ($subtotal2 * 0.03) + 2000,
'quantity' => 1,
'name' => "Biaya Admin"
);

$item1_details_gopay = array(
'id' => '997',
'price' => ($subtotal2 * 0.021),
'quantity' => 1,
'name' => "Biaya Admin"
);
$item1_details_transfer = array(
'id' => '996',
'price' => 5000,
'quantity' => 1,
'name' => "Biaya Admin"
);
$item1_details_alfamart = array(
'id' => '995',
'price' => 5000,
'quantity' => 1,
'name' => "Biaya Admin"
);
$item1_details_shopeepay = array(
'id' => '994',
'price' => ($subtotal2 * 0.015),
'quantity' => 1,
'name' => "Biaya Admin"
);
array_push($item_details_cc, $item1_details_cc, $diskon);
array_push($item_details_gopay, $item1_details_gopay, $diskon);
array_push($item_details_transfer, $item1_details_transfer, $diskon);
array_push($item_details_alfamart, $item1_details_alfamart, $diskon);
array_push($item_details_shopeepay, $item1_details_shopeepay, $diskon);
{exp:member:custom_profile_data}
$customer_details = array(
'first_name'    => "{logged_in_screen_name}", //optional
'email'         => "{logged_in_email}", //mandatory
'phone'         => "{mobile_phone}", //mandatory
);
$callbacks = array(
'finish' => "{site_url}checkout/thank-you"
);
{/exp:member:custom_profile_data}
$transaction_details_cc = array(
'order_id' => "1"."$randomid",
'gross_amount' => $subtotal2 + ($subtotal2 * 0.03) + 2000, // no decimal allowed for creditcard
);
$transaction_details_gopay = array(
'order_id' => "{current_time format='%y%m%d%H%i%s'}".rand(1000,9999),
'gross_amount' => $subtotal2 + ($subtotal2 * 0.021), // no decimal allowed for creditcard
);
$transaction_details_transfer = array(
'order_id' => "2"."$randomid",
'gross_amount' => $subtotal2 + 5000, // no decimal allowed for creditcard
);
$transaction_details_alfamart = array(
'order_id' => "3"."$randomid",
'gross_amount' => $subtotal2 + 5000, // no decimal allowed for creditcard
);
$transaction_details_shopeepay = array(
'order_id' => "4"."$randomid",
'gross_amount' => $subtotal2 + ($subtotal2 * 0.015), // no decimal allowed for creditcard
);
// Optional, remove this to display all available payment methods
$enable_payments_cc = array('credit_card');
$enable_payments_gopay = array('gopay');
$enable_payments_transfer = array('bca_va', 'bni_va', 'bri_va', 'echannel', 'bca_klikpay', 'mandiri_clickpay', 'cimb_clicks', 'danamon_online', 'bri_epay');
$enable_payments_alfa = array('Alfamart', 'Alfamidi', 'Dan-Dan Fun Healthy Beauty');
$enable_payments_shopeepay = array('shopeepay');
// Fill transaction details
$transaction_cc = array(
'enabled_payments' => $enable_payments_cc,
'transaction_details' => $transaction_details_cc,
'item_details' => $item_details_cc,
'customer_details' => $customer_details,
'callbacks' => $callbacks,
);
$transaction_gopay = array(
'enabled_payments' => $enable_payments_gopay,
'transaction_details' => $transaction_details_gopay,
'item_details' => $item_details_gopay,
'customer_details' => $customer_details,
'callbacks' => $callbacks,
);
$transaction_transfer = array(
'enabled_payments' => $enable_payments_transfer,
'transaction_details' => $transaction_details_transfer,
'item_details' => $item_details_transfer,
'customer_details' => $customer_details,
'callbacks' => $callbacks,
);
$transaction_alfamart = array(
'enabled_payments' => $enable_payments_alfa,
'transaction_details' => $transaction_details_alfamart,
'item_details' => $item_details_alfamart,
'customer_details' => $customer_details,
'callbacks' => $callbacks,
);
$transaction_shopeepay = array(
'enabled_payments' => $enable_payments_shopeepay,
'transaction_details' => $transaction_details_shopeepay,
'item_details' => $item_details_shopeepay,
'customer_details' => $customer_details,
'callbacks' => $callbacks,
);
$snapToken_cc = \Midtrans\Snap::getSnapToken($transaction_cc);
$snapToken_gopay = \Midtrans\Snap::getSnapToken($transaction_gopay);
$snapToken_transfer = \Midtrans\Snap::getSnapToken($transaction_transfer);
$snapToken_alfamart = \Midtrans\Snap::getSnapToken($transaction_alfamart);
$snapToken_shopeepay = \Midtrans\Snap::getSnapToken($transaction_shopeepay);
?>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-o2r3oFxz0SdHSDC7"></script>


<script type="text/javascript">

document.getElementById('pay-button-cc').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('<?=$snapToken_cc?>', {
        // Optional
        onSuccess: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;
            var pdfurl = dataparse.redirect_url;
            var vabank = dataparse.bank;
            var vanumber = dataparse.masked_card;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = pdfurl;
                var va_bank = vabank;
                var va_number = vanumber;
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });

            setTimeout(function () {
                window.location.replace("{site_url}checkout/submit");
            }, 5000);
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function (result) {
            
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;
            var pdfurl = dataparse.transaction_status;
            var vabank = dataparse.transaction_status;
            var vanumber = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = pdfurl;
                var va_bank = vabank;
                var va_number = vanumber;
                var status = 'pending';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}insert.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            setTimeout(function () {
                window.location.replace("{site_url}checkout/submit-pendding");
            }, 5000);
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function (result) {
            window.location.replace("{site_url}checkout/submit-failed");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};

document.getElementById('pay-button-transfer').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('<?=$snapToken_transfer?>', {
        // Optional
        onSuccess: function (result) {
            console.log(result)
            console.log('a')
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;
            var pdfurl = dataparse.pdf_url;
            var vabank = deserialized.va_numbers[0].bank;
            var vanumber = deserialized.va_numbers[0].va_number;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = pdfurl;
                var va_bank = vabank;
                var va_number = vanumber;
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit");
            //document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function (result) {
            console.log(result)
            console.log('b')
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;
            var pdfurl = dataparse.pdf_url;
            var vabank = dataparse.va_numbers[0].bank;
            var vanumber = dataparse.va_numbers[0].va_number;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = pdfurl;
                var va_bank = vabank;
                var va_number = vanumber;
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit-pendding");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function (result) {
            window.location.replace("{site_url}checkout/submit-failed");
            //   document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};

document.getElementById('pay-button-gopay').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('<?=$snapToken_gopay?>', {
        // Optional
        onSuccess: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'gopay';
                var va_bank = 'gopay';
                var va_number = 'gopay';
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'gopay';
                var va_bank = 'gopay';
                var va_number = 'gopay';
                var status = 'pending';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}insert.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit-pendding");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function (result) {
            window.location.replace("{site_url}checkout/submit-failed");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};

document.getElementById('pay-button-alfamart').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('<?=$snapToken_alfamart?>', {
        // Optional
        onSuccess: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'alfamart';
                var va_bank = 'alfamart';
                var va_number = 'alfamart';
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'alfamart';
                var va_bank = 'alfamart';
                var va_number = 'alfamart';
                var status = 'pending';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}insert.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit-pendding");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function (result) {
            window.location.replace("{site_url}checkout/submit-failed");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};
document.getElementById('pay-button-shopeepay').onclick = function () {
    // SnapToken acquired from previous step
    snap.pay('<?=$snapToken_alfamart?>', {
        // Optional
        onSuccess: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'shopeepay';
                var va_bank = 'shopeepay';
                var va_number = 'shopeepay';
                var status = 'success';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}kirim_email.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function (result) {
            saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
            simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
            var datastringify = JSON.stringify(result, null, 2);
            var dataparse = JSON.parse(datastringify);

            var orderid = dataparse.order_id;
            var transactionid = dataparse.transaction_id;
            var paymenttype = dataparse.payment_type;
            var transactiontime = dataparse.transaction_time;
            var transactionstatus = dataparse.transaction_status;

            $(document).ready(function () {
                var username = $("#username").val();
                var order_id = orderid;
                var transaction_id = transactionid;
                var payment_type = paymenttype;
                var transaction_time = transactiontime;
                var transaction_status = transactionstatus;
                var pdf_url = 'shopeepay';
                var va_bank = 'shopeepay';
                var va_number = 'shopeepay';
                var status = 'pending';
                var no_onder = $("#no_onder").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var total_belanja = $("#total_belanja").val();
                $.ajax({
                    url: '{site_url}insert.php',
                    method: 'POST',
                    data: {
                        username: username,
                        order_id: order_id,
                        transaction_id: transaction_id,
                        payment_type: payment_type,
                        transaction_time: transaction_time,
                        transaction_status: transaction_status,
                        pdf_url: pdf_url,
                        va_bank: va_bank,
                        va_number: va_number,
                        status: status,
                        no_onder: no_onder,
                        email: email,
                        total_belanja: total_belanja,
                        phone: phone
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            $(document).ready(function () {
                var no_onder_detail = [];
                var image_thumb = [];
                var nama_product = [];
                var price_item = [];
                $('.no_onder_detail').each(function () {
                    no_onder_detail.push($(this).text());
                });
                $('.image_thumb').each(function () {
                    image_thumb.push($(this).text());
                });
                $('.nama_product').each(function () {
                    nama_product.push($(this).text());
                });
                $('.price_item').each(function () {
                    price_item.push($(this).text());
                });
                $.ajax({
                    url: "{site_url}insert_detail.php",
                    method: "POST",
                    data: {
                        no_onder_detail: no_onder_detail,
                        image_thumb: image_thumb,
                        nama_product: nama_product,
                        price_item: price_item
                    },
                    success: function (data) {
                        saveVoucherUsed(sessionStorage.getItem('voucherCart'), sessionStorage.getItem('jumlahVoucherCart'));
                        simpanUserVoucher(sessionStorage.getItem('userIdCart'), sessionStorage.getItem('voucherCart'));
                    }
                });
            });
            window.location.replace("{site_url}checkout/submit-pendding");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function (result) {
            window.location.replace("{site_url}checkout/submit-failed");
            // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
    });
};

</script>
</body>
{js_add_to_card}

</html>
{/if}
{logout-redirect}