<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>הזמנה</title>
	<link href="../css/form.css" rel="stylesheet" />
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
</head>
<body>
    <div id="header-placeholder"></div>

	<div class="form-container">
		<form action="orderSubmit.php" method="POST">
	        <h1>הזמנה</h1>
            
			<?php
				session_start();
				$username = $_SESSION['user_name'];
                $amount = $_SESSION['order_amount'];
				echo "<label>שם משתמש <input type='text' name='username' value='$username' readonly></label>";
			?>

            <label>תאריך <input type="date" name="orderDate" value="<?= date('Y-m-d') ?>" readonly></label>
			<label>עיר <input type="text" name="city" pattern="(?=.*[\p{L}])[ \p{L}]+" title="יש להזין אותיות בעברית או אנגלית בלבד, עם רווחים" required></label>
			<label>רחוב <input type="text" name="street" pattern="(?=.*[\p{L}])[ \p{L}]+" title="יש להזין אותיות בעברית או אנגלית בלבד, עם רווחים" required></label>
			<label>מספר בית <input type="text" name="houseNumber" pattern="[0-9]+" maxlength="3" required></label>
			<label>מיקוד <input type="text" name="zipCode" pattern="[0-9]+" maxlength="8" required></label>
			
			<label>משלוח</label>
			<select name="shipping" required>
				<option value="1">כן (תוספת של ₪30)</option>
				<option value="0">לא (איסוף עצמי)</option>
			</select>

			<?php
				echo "<p id='amountDisplay'></p>";
			?>
            <input type="hidden" name="amount" id="amountInput" value="<?= $amount ?>">

			<button type="submit">בצע הזמנה</button>
			<input type="reset" value="איפוס">
		</form>
	</div>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script>
    <script>
        const shippingSelect = document.querySelector('select');
        const amountDisplay = document.getElementById('amountDisplay');
        const amountInput = document.getElementById('amountInput');
        const amount = <?php echo json_encode(isset($_SESSION['order_amount']) ? (int)$_SESSION['order_amount'] : 0); ?>;
        const shippingCost = 30;

        function updateAmount() {
            const shipping = parseInt(shippingSelect.value);
            const total = amount + (shipping ? shippingCost : 0);
            amountDisplay.textContent = "סכום הזמנה: ₪" + total;
            amountInput.value = total;
        }

        shippingSelect.addEventListener('change', updateAmount);
        window.addEventListener('DOMContentLoaded', updateAmount);
    </script>
</body>
</html>
