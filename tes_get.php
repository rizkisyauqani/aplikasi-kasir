                <div>
                     <?php 
                     if(isset($_GET['tanggal_dari'])) {
                      $tanggal_dari = $_GET['tanggal_dari'];
                     if(isset($_GET['kasir'])) {
                      $kasir = $_GET['kasir'];
    
                      $penjualan_by_kasir = mysqli_query($koneksi, "SELECT invoice_tanggal, kasir_nama, SUM(transaksi_jumlah) AS transaksi_jumlah, SUM(produk_harga_jual) AS produk_harga_jual, SUM(produk_harga_modal) AS produk_harga_modal FROM invoice, kasir, produk, transaksi WHERE invoice_id = transaksi_invoice AND transaksi_produk=produk_id AND invoice_kasir=kasir_id AND date(invoice_tanggal) = '$tanggal_dari' AND kasir_nama = '$kasir'");
                      while ($p = mysqli_fetch_array($penjualan_by_kasir)) { ?>
    
                

                      <div class="col-md-2">

                  <div>
                    <span>Total Penjualan</span>
                      <span><?php echo number_format($p['produk_harga_jual']) ?></span>
                  </div>
                </div>
                
                      <!-- <div class="col-md-2">

                  <div>
                    <span>Modal</span>
                      <span><?php echo number_format($p['produk_harga_modal']) ?></span>
                  </div>
                </div>
                
                      <div class="col-md-2">

                  <div>
                    <span>Laba</span>
                  </div><span><?php echo number_format($p['produk_harga_jual'] - $p['produk_harga_modal'])  ?></span>
                </div>

                      <div class="col-md-2">

                  <div>
                    <span>Produk Terjual</span>
                  </div><span><?php echo $p['transaksi_jumlah']  ?></span>
                </div> -->
    
                     <?php }
                     }} ?>
                    </div>