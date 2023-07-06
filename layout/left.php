<aside class="col-md-3">
	<section class="fixfilter">
		<button style="background: #E8E8E8; padding: 15px 30px;border: none;font-size: 14px; font-weight: 500;margin-bottom: 30px">
			<span style="font-weight: bold">HIỆN CÓ <span style="color: red"><?php include"views/countproduct.php";?></span> SẢN PHẨM</span></button>
		<section style="display: flex;margin: 90px 90px;">
			<div>
				<div class="accordion_f">
					<div class="accordion_f-item active">
						<div class="accordion_f-header">
							<h3>GIÁ SẢN PHẨM</h3>
							<i class="fas fa-angle-down"></i>
						</div>
						<div class="accordion_f-body">
							<?php include"views/pricefilter.php";?>
						</div>
					</div>
					<div class="accordion_f-item active">
						<div class="accordion_f-header">
							<h3>KÍCH CỠ</h3>
							<i class="fas fa-angle-down"></i>
						</div>
						<div class="accordion_f-body">
							<?php include"views/sizefilter.php";?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
</aside>