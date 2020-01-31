	<?php
		$n1 = $pt = $n2 = "";
		$kq = "...";
		if (isset($_POST["n1"]) && isset($_POST["pt"]) && isset($_POST["n2"])) {
			$n1 = $_POST["n1"];
			$pt = $_POST["pt"];
			$n2 = $_POST["n2"];
		}
		if ($pt != null)
		switch ($pt) {
			case '+':
				$kq = $n1 + $n2;
				break;
			case '-':
				$kq = $n1 - $n2;
				break;
			case '*':
				$kq = $n1 * $n2;
				break;
			case '/':
				$kq = $n1 / $n2;
				break;
			case '%':
				$kq = $n1 % $n2;
				break;							
			
			default:
				$kq = "Không hợp lệ"  ;
				break;
		}

	?>







<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Máy Tính</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="content">
		<h1>Máy Tính</h1>
		<div class="form">
			<form method="post" action="#">
				<div class="row">
					<span>Số Thứ Nhất</span>
					<input type="text" name="n1" value="<?php echo $n1; ?>" required >			
				</div>
				<div class="row">
					<span>Phép Tính</span>		
					<input type="text" name="pt" value="<?php echo $pt; ?>" required >		
				</div>
				<div class="row">
					<span>Số Thứ Hai</span>
					<input type="text" name="n2" value="<?php echo $n2; ?>" required >
				</div>
				<hr/>
				<div class="row">
					<button type="submit" >Tính</button>
				</div>
			</form>
			<div class="row">
				<p> Kết quả là : <strong>
									<?php
										if (isset($kq)) echo $kq;
									?>
								</strong>
				</p>
			</div>

			<div class="ly">
				<p>Lưu ý: Chỉ sử dụng các phép toán:</p>
				<div>
					-> Phép Cộng: +
				</div>
				<div>
					-> Phép Trừ: -
				</div>
				<div>
					-> Phép Nhân:-
				</div>
				<div>
					-> Phép Chia lấy thương: /
				</div>
				<div>
					-> Phép Chia lấy dư: %
				</div>				
			</div>
		</div>
	</div>
	<div id="footer">
		Copyright 2019: Developer King.NNT
	</div>
</body>
</html>
