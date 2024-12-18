<?php
$idpengguna = $this->session->userdata('idpengguna');
$namapengguna = $this->session->userdata('namapengguna');
$level = $this->session->userdata('level');
$foto = $this->session->userdata('foto');

$profil = $this->db->query("SELECT * FROM profil WHERE id=1 ")->row();
?>

<!-- 
AKSES LEVEL
Manajer
Pelayan
Kasir
Koki
Gudang

-->


<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="javascript:void(0)" class="brand-link">
		<img src="<?php echo (base_url('uploads/' . $profil->logoperusahaan)) ?>" alt="AdminLTE Logo"
			class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light" style="color: black; font-weight: bold;">AKSES MENU -
			<?php echo strtoupper($level) ?></span>
	</a>

	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">

				<?php
				if (empty($foto)) { ?>
					<img src="<?php echo (base_url()) ?>/images/nofoto_l.png" class="img-circle elevation-2"
						alt="User Image">
				<?php
				} else { ?>
					<img src="<?php echo (base_url()) ?>/uploads/<?php echo ($foto) ?>" class="img-circle elevation-2"
						alt="User Image">
				<?php
				}
				?>

			</div>
			<div class="info" style="margin-top: -5px;">
				<a href="#" class="d-block"><?php echo ($namapengguna) ?></a>
				<a href="#" class="d-block" style="color: green; font-size: 11px;"><?php echo ($level) ?></a>
			</div>
		</div>


		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-legacy" data-widget="treeview"
				role="menu" data-accordion="false">

				<li class="nav-header">Daftar Menu</li>

				<li class="nav-item">
					<a href="<?php echo (site_url('Dashboard')) ?>"
						class="nav-link <?php echo ($menu == 'Dashboard') ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>


				<?php
				$menudropdown = array('Profil', 'Profil_kontakkami', 'Profil_slider', 'Profil_blog', 'Profil_sosialmedia', 'Profil_galeri', 'Profil_testimoni', 'Profil_video');
				if (in_array($menu, $menudropdown)) {
					$dropdownselected = true;
				} else {
					$dropdownselected = false;
				}
				?>

				<li class="nav-item has-treeview <?php echo ($dropdownselected) ? 'menu-open' : '' ?> " style="display: none;">
					<a href="#" class="nav-link <?php echo ($dropdownselected) ? 'active' : '' ?> ">
						<i class="nav-icon fa fa-globe"></i>
						<p>
							Web Profil
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil")) ?>"
								class="nav-link <?php echo ($menu == "Profil") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Profil Perusahaan</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_kontakkami")) ?>"
								class="nav-link <?php echo ($menu == "Profil_kontakkami") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Kontak Kami</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_slider")) ?>"
								class="nav-link <?php echo ($menu == "Profil_slider") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Slider</p>
							</a>
						</li>

						<!-- <li class="nav-item">
								<a href="<?php echo (site_url("Profil_layanan")) ?>" class="nav-link <?php echo ($menu == "Profil_layanan") ? 'active' : '' ?> ">
									<i class="far fa-circle nav-icon"></i>
									<p>Layanan Kami</p>
								</a>
							</li> -->

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_blog")) ?>"
								class="nav-link <?php echo ($menu == "Profil_blog") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Blog</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_sosialmedia")) ?>"
								class="nav-link <?php echo ($menu == "Profil_sosialmedia") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Sosial Media</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_galeri")) ?>"
								class="nav-link <?php echo ($menu == "Profil_galeri") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Galeri</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_testimoni")) ?>"
								class="nav-link <?php echo ($menu == "Profil_testimoni") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Testimoni</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Profil_video")) ?>"
								class="nav-link <?php echo ($menu == "Profil_video") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Video</p>
							</a>
						</li>

					</ul>
				</li>

				<?php
				if ($level != 'Pelayan' and $level != 'Koki' and $level != 'Peracik' and $level != 'Kasir') { ?>

					<?php
					$menudropdown = array('Pengguna', 'Kategori', 'Produk', 'Bank', 'Pelanggan', 'Supplier', 'Ekspedisi');
					if (in_array($menu, $menudropdown)) {
						$dropdownselected = true;
					} else {
						$dropdownselected = false;
					}
					?>

					<li class="nav-item has-treeview <?php echo ($dropdownselected) ? 'menu-open' : '' ?> ">
						<a href="#" class="nav-link <?php echo ($dropdownselected) ? 'active' : '' ?> ">
							<i class="nav-icon fas fa-folder"></i>
							<p>
								Master Data
								<i class="right fas fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">

							<?php
							if ($level == 'Manajer') { ?>
								<li class="nav-item">
									<a href="<?php echo (site_url("Pengguna")) ?>"
										class="nav-link <?php echo ($menu == "Pengguna") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Pengguna</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?php echo (site_url("Kategori")) ?>"
										class="nav-link <?php echo ($menu == "Kategori") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Kategori</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="<?php echo (site_url("Produk")) ?>"
										class="nav-link <?php echo ($menu == "Produk") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Produk</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo (site_url("Bank")) ?>"
										class="nav-link <?php echo ($menu == "Bank") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Metode Pembayaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo (site_url("Katalog")) ?>"
										class="nav-link <?php echo ($menu == "Katalog") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Katalog</p>
									</a>
								</li>
							<?php
							}
							?>



							<!-- <li class="nav-item">
							<a href="<?php echo (site_url("Pelanggan")) ?>"
								class="nav-link <?php echo ($menu == "Pelanggan") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Pelanggan</p>
							</a>
						</li> -->


							<?php
							if ($level == 'Gudang') { ?>
								<li class="nav-item">
									<a href="<?php echo (site_url("Supplier")) ?>"
										class="nav-link <?php echo ($menu == "Supplier") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Supplier</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo (site_url("Jenis")) ?>"
										class="nav-link <?php echo ($menu == "Jenis") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Jenis</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo (site_url("Barang")) ?>"
										class="nav-link <?php echo ($menu == "Barang") ? 'active' : '' ?> ">
										<i class="far fa-circle nav-icon"></i>
										<p>Bahan Baku</p>
									</a>
								</li>
							<?php
							}
							?>

							<!-- <li class="nav-item">
							<a href="<?php echo (site_url("Ekspedisi")) ?>"
								class="nav-link <?php echo ($menu == "Ekspedisi") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Ekspedisi</p>
							</a>
						</li> -->

						</ul>
					</li>

				<?php
				}
				?>

				<?php
				$menudropdown = array('Kabupaten', 'Kecamatan', 'Desa');
				if (in_array($menu, $menudropdown)) {
					$dropdownselected = true;
				} else {
					$dropdownselected = false;
				}
				?>
				<li class="nav-item has-treeview <?php echo ($dropdownselected) ? 'menu-open' : '' ?> " style="display: none;">
					<a href="#" class="nav-link <?php echo ($dropdownselected) ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-folder"></i>
						<p>
							Tarif Ekspedisi
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item">
							<a href="<?php echo (site_url("Kabupaten")) ?>"
								class="nav-link <?php echo ($menu == "Kabupaten") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Kabupaten</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Kecamatan")) ?>"
								class="nav-link <?php echo ($menu == "Kecamatan") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Kecamatan</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Desa")) ?>"
								class="nav-link <?php echo ($menu == "Desa") ? 'active' : '' ?> ">
								<i class="far fa-circle nav-icon"></i>
								<p>Desa</p>
							</a>
						</li>

					</ul>
				</li>

				<!-- <li class="nav-item">
                        <a href="<?php echo (site_url("Tarif")) ?>" class="nav-link <?php echo ($menu == "Tarif") ? 'active' : '' ?> ">
                            <i class="fa fa-database nav-icon"></i>
                            <p>Tarif Service</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo (site_url("Jadwal")) ?>" class="nav-link <?php echo ($menu == "Jadwal") ? 'active' : '' ?> ">
                            <i class="fa fa-calendar nav-icon"></i>
                            <p>Jadwal Service</p>
                        </a>
                    </li> -->

				<?php
				if ($level != 'Manajer') { ?>
					<li class="nav-header">Transaksi</li>

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("Perencanaan")) ?>"
							class="nav-link <?php echo ($menu == "Perencanaan") ? 'active' : '' ?> ">
							<i class="fas fa-business-time nav-icon"></i>
							<p>Perencanaan Bisnis</p>
						</a>
					</li> -->

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("Perencanaansurat")) ?>"
							class="nav-link <?php echo ($menu == "Perencanaansurat") ? 'active' : '' ?> ">
							<i class="fas fa-paste nav-icon"></i>
							<p>Surat Perencanaan</p>
							<span class="badge badge-danger right">
								<?php
								$countPerencanaan = $this->db->query("SELECT IFNULL(COUNT(*), 0) AS total FROM v_perencanaan WHERE statusperencanaan='Sedang Diproses' ")->row()->total;
								echo $countPerencanaan;
								?>
							</span>
						</a>
					</li> -->

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("Pengadaan")) ?>"
							class="nav-link <?php echo ($menu == "Pengadaan") ? 'active' : '' ?> ">
							<i class="fas fa-clipboard-list nav-icon"></i>
							<p>Pengadaan</p>
						</a>
					</li> -->

					<?php
					if ($level != 'Pelayan' and $level != 'Koki' and $level != 'Peracik' and $level != 'Kasir' and $level != 'Gudang') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("Pembelian")) ?>"
								class="nav-link <?php echo ($menu == "Pembelian") ? 'active' : '' ?> ">
								<i class="fa fa-exchange-alt nav-icon"></i>
								<p>Pembelian</p>
							</a>
						</li>
					<?php
					}
					?>

					<!-- <li class="nav-item">
                    <a href="<?php echo (site_url("Jadwalboking")) ?>"
                        class="nav-link <?php echo ($menu == "Jadwalboking") ? 'active' : '' ?> ">
                        <i class="fa fa-calendar nav-icon"></i>
                        <p>Boking Service</p>
                        <span class="badge badge-warning right">
                            <?php
							$countBoking = $this->db->query("SELECT COUNT(*) AS total FROM jadwalboking WHERE (`status`='Menunggu' OR `status` IS NULL) ")->row()->total;
							echo $countBoking;
							?>
                        </span>
                    </a>
                </li> -->

					<?php
					if ($level != 'Pelayan' and $level != 'Koki' and $level != 'Peracik' and $level != 'Kasir' and $level != 'Gudang') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("Pemesanan")) ?>"
								class="nav-link <?php echo ($menu == "Pemesanan") ? 'active' : '' ?> ">
								<i class="fa fa-box nav-icon"></i>
								<p>Pemesanan</p>
								<span class="badge badge-success right">
									<?php
									$countPemesanan = $this->db->query("SELECT COUNT(*) AS total FROM pemesanan WHERE (statuskonfirmasi='Menunggu' OR statuskonfirmasi IS NULL) ")->row()->total;
									echo $countPemesanan;
									?>
								</span>
							</a>
						</li>
					<?php
					}
					?>

					<?php
					if ($level != 'Pelayan' and $level != 'Koki' and $level != 'Peracik' and $level != 'Kasir' and $level != 'Gudang') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("Pembayaran")) ?>"
								class="nav-link <?php echo ($menu == "Pembayaran") ? 'active' : '' ?> ">
								<i class="fa fa-credit-card nav-icon"></i>
								<p>Pembayaran</p>
							</a>
						</li>
					<?php
					}
					?>

					<?php
					if (($level == 'Pelayan') or ($level == 'Koki') or ($level == 'Peracik') or ($level == 'Kasir')) { ?>

						<?php
						if ($level != 'Koki' or $level != 'Peracik') { ?>
							<li class="nav-item">
								<a href="<?php echo (site_url("Penjualan/list")) ?>"
									class="nav-link">
									<i class="fa fa-list-alt nav-icon"></i>
									<p>Daftar Pesanan</p>
								</a>
							</li>
						<?php
						}
						?>

						<?php
						if ($level == 'Pelayan') { ?>
							<li class="nav-item">
								<a href="<?php echo (site_url("Penjualan")) ?>"
									class="nav-link <?php echo ($menu == "Penjualan") ? 'active' : '' ?> ">
									<i class="fa fa-cubes nav-icon"></i>
									<p>Pesanan</p>
								</a>
							</li>
						<?php
						}
						?>
					<?php
					}
					?>

					<?php
					if ($level != 'Pelayan' and $level != 'Koki' and $level != 'Peracik' and $level != 'Kasir' and $level != 'Gudang') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("Returpenjualan")) ?>"
								class="nav-link <?php echo ($menu == "Returpenjualan") ? 'active' : '' ?> ">
								<i class="fas fa-undo-alt nav-icon"></i>
								<p>Retur Penjualan</p>
							</a>
						</li>
					<?php
					}
					?>

					<?php
					if ($level == 'Gudang') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("Barangmasuk")) ?>"
								class="nav-link <?php echo ($menu == "Barangmasuk") ? 'active' : '' ?> ">
								<i class="fas fa-box nav-icon"></i>
								<p>Barang Masuk</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("Barangkeluar")) ?>"
								class="nav-link <?php echo ($menu == "Barangkeluar") ? 'active' : '' ?> ">
								<i class="fas fa-boxes nav-icon"></i>
								<p>Barang Keluar</p>
							</a>
						</li>
					<?php
					}
					?>

				<?php
				}
				?>


				<?php
				if (($level == 'Manajer') or ($level == 'Kasir') or ($level == 'Gudang')) { ?>
					<li class="nav-header">Laporan</li>
					<!-- <li class="nav-item">
                        <a href="<?php echo (site_url("LapPengeluaranModal")) ?>" class="nav-link <?php echo ($menu == "LapPengeluaranModal") ? 'active' : '' ?> ">
                            <i class="fa fa-book nav-icon"></i>
                            <p>Lap. Pengeluaran Modal</p>
                        </a>
                    </li> -->

					<!-- <li class="nav-item">
                        <a href="<?php echo (site_url("LapPendapatanKotor")) ?>" class="nav-link <?php echo ($menu == "LapPendapatanKotor") ? 'active' : '' ?> ">
                            <i class="fa fa-book nav-icon"></i>
                            <p>Lap. Pendapatan Kotor</p>
                        </a>
                    </li> -->

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("LapPerencanaanBisnis")) ?>"
							class="nav-link <?php echo ($menu == "LapPerencanaanBisnis") ? 'active' : '' ?> ">
							<i class="fa fa-book nav-icon"></i>
							<p>Lap. Perencanaan Bisnis</p>
						</a>
					</li> -->

					<?php
					if ($level == 'Manajer') { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("LapStok")) ?>"
								class="nav-link <?php echo ($menu == "LapStok") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Stok Barang</p>
							</a>
						</li>
					<?php
					}
					?>

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("LapPengadaan")) ?>"
							class="nav-link <?php echo ($menu == "LapPengadaan") ? 'active' : '' ?> ">
							<i class="fa fa-book nav-icon"></i>
							<p>Lap. Pengadaan</p>
						</a>
					</li> -->

					<?php
					if (($level == 'Manajer') or ($level == 'Gudang')) { ?>

						<li class="nav-item">
							<a href="<?php echo (site_url("LapBarang")) ?>"
								class="nav-link <?php echo ($menu == "LapBarang") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Stok Barang (Bahan Baku)</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("LapBarangMasuk")) ?>"
								class="nav-link <?php echo ($menu == "LapBarangMasuk") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Barang Masuk (Bahan Baku)</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("LapBarangKeluar")) ?>"
								class="nav-link <?php echo ($menu == "LapBarangKeluar") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Barang Keluar (Bahan Baku)</p>
							</a>
						</li>
					<?php
					}
					?>

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("LapPembelian")) ?>"
							class="nav-link <?php echo ($menu == "LapPembelian") ? 'active' : '' ?> ">
							<i class="fa fa-book nav-icon"></i>
							<p>Lap. Barang Masuk (Bahan Baku)</p>
						</a>
					</li> -->

					<?php
					if (($level == 'Manajer') or ($level == 'Kasir')) { ?>
						<li class="nav-item">
							<a href="<?php echo (site_url("LapPenjualan")) ?>"
								class="nav-link <?php echo ($menu == "LapPenjualan") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Penjualan</p>

							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo (site_url("LapPendapatanBersih")) ?>" class="nav-link <?php echo ($menu == "LapPendapatanBersih") ? 'active' : '' ?> ">
								<i class="fa fa-book nav-icon"></i>
								<p>Lap. Pendapatan</p>
							</a>
						</li>
					<?php
					}
					?>

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("LapReturPenjualan")) ?>"
							class="nav-link <?php echo ($menu == "LapReturPenjualan") ? 'active' : '' ?> ">
							<i class="fa fa-book nav-icon"></i>
							<p>Lap. Retur Penjualan</p>
						</a>
					</li> -->

					<!-- <li class="nav-item">
						<a href="<?php echo (site_url("LapPemesanan")) ?>"
							class="nav-link <?php echo ($menu == "LapPemesanan") ? 'active' : '' ?> ">
							<i class="fa fa-book nav-icon"></i>
							<p>Lap. Pemesanan</p>
						</a>
					</li> -->
				<?php
				}
				?>


				<li class="nav-header">Setting</li>

				<li class="nav-item">
					<a href="<?php echo (site_url('Login/settingAkun')) ?>"
						class="nav-link <?php echo ($menu == 'Settingakun') ? 'active' : '' ?> ">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Setting Akun
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo (site_url('Login/logout')) ?>" class="nav-link">
						<i class="nav-icon fas fa-power-off"></i>
						<p>
							Log Out
						</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>