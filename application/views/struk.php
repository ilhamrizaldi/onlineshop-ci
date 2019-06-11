<?php foreach($trx as $tr) {?>
<center><h2>INVOICE #<?php echo $tr->invoice ?></h2></center>
<p>Diterbitkan atas nama :</p>
<table width="1000px">
    <tr>
        <td>Pembeli</td>
        <td><?php echo $tr->customer ?></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td><?php echo $tr->date ?></td>
    </tr>
    <tr>
        <td>Status Pesanan</td>
        <?php
                switch ($tr->status) {
                    case 'waiting':
                        echo "<td><span class='label label-warning'>Menunggu Pembayaran</span></td>";
                        break;
                    case 'paid':
                        echo "<td><span class='label label-success'>Pembayaran Berhasil</span></td>";
                        break;
                    case 'shipped':
                        echo "<td><span class='label label-primary'>Pesanan anda sedang Dikirim</span></td>";
                        break;
                    case 'canceled':
                        echo "<td><span class='label label-danger'>Pesanan anda dibatalkan</span></td>";
                        break;
                    default:
                        echo "<td><span class='label label-warning'>Menunggu Pembayaran</span></td>";
                        break;
                }
            
            ?>
    </tr>
</table>
<?php } ?>
<table width="100%" cellspacing="0" cellpadding="0" style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; margin-top: 20px;">
    <tr style="background-color: rgba(242, 242, 242, 0.74); font-size: 14px; font-weight: 600;">
        <td style="padding: 10px 15px;">Nama Produk</td>
        <td style="padding: 10px 15px; text-align: center;">Jumlah</td>
        <td style="padding: 10px 15px; text-align: center; white-space: nowrap;">Harga Barang</td>
    </tr>
<?php foreach($orders as $ord) {?>
    <tr style="font-size: 14px;">
        <td width="330" style="padding: 15px; font-weight: 600; word-break: break-word;">
           <?php echo $ord->product_name ?>
        </td>
        <td valign="top" style="padding: 15px; text-align: center;">
            <?php echo number_format($ord->product_qty, 0, '.', '.') ?>
        </td>
        <td valign="top" style="padding: 15px; white-space: nowrap; text-align: center;">
            Rp <?php echo number_format($ord->product_price, 0, '.', '.') ?>
        </td>
    </tr>
<?php } ?>
    <tr>
        <td colspan="5" style="padding: 0 15px;">
            <div style="border-bottom: thin solid #e0e0e0"></div>
        </td>
    </tr>

    <tr>
        <td></td>
        <td colspan="4">
            <table width="80%" cellspacing="0" cellpadding="0" style="padding-right: 15px; font-size: 14px; font-weight: 600;">
                <tr>
                    <td colspan="2">
                        <div style="border-bottom: thin solid #e0e0e0"></div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px;">Total</td>
                    <td style="padding: 15px 0 15px 15px;">Rp <?php echo number_format($total->total, 0, '.', '.') ?> </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<!-- separator -->
<div style="margin: 30px 0;">
    <div style="border-bottom: thin dashed #474747; margin-bottom: 10px;"></div>
    <div style="border-bottom: thin dashed #474747"></div>
</div>

<br>
        <?php foreach($customer as $cus) {?>
            <table width="100%" cellspacing="0" cellpadding="0" style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; margin-top: 20px;">
                <tr>
                    <td style="background-color: rgba(242, 242, 242, 0.74); font-size: 20px; font-weight: bold;">Tujuan Pengiriman:</td>
                </tr>
                <tr>
                    <td style="font-size: 14px; padding-bottom: 20px;">
                        <span style="margin-bottom: 3px; font-weight: 600; display: block;"><?php echo $cus->name ?></span>
                        <div>
                            <?php echo $cus->alamat ?> <?php echo $cus->pos ?><br>                                                
                            <?php echo $cus->hp ?>
                        </div>
                    </td>
                </tr>
                
            </table>
        <?php } ?>