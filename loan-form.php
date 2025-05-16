<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loan Application - Sidu International</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f9ff;
      padding: 30px;
    }
    form {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
    h2 {
      text-align: center;
      color: #007BFF;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #aaa;
    }
    button {
      margin-top: 20px;
      background: goldenrod;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 16px;
    }
  </style>
</head>
<body>

<form action="http://localhost/sidu_international/submit-loan.php" method="post">
  <h2>Loan Application Form</h2>

  <label>Full Name:</label>
  <input type="text" name="full_name" required>

  <label>ID/Passport No:</label>
  <input type="text" name="id_number" required>

  <label>Nationality:</label>
  <input type="text" name="nationality" required>

  <label>Phone Number:</label>
  <input type="text" name="phone" required>

  <label>Email Address:</label>
  <input type="email" name="email" required>

  <label>Town / Residence:</label>
  <input type="text" name="town" required>

  <label>Location / Plot:</label>
  <input type="text" name="location" required>

  <label>Nearest Landmark:</label>
  <input type="text" name="landmark">

  <label>Business Ownership:</label>
  <select name="ownership">
    <option value="Sole Proprietorship">Sole Proprietorship</option>
    <option value="Family Business">Family Business</option>
    <option value="Partnership">Partnership</option>
    <option value="Limited Company">Limited Company</option>
  </select>

  <label>Business Name:</label>
  <input type="text" name="business_name">

  <label>Years in Operation:</label>
  <input type="number" name="years_operation">

  <label>Loan Amount Requested (Ksh):</label>
  <input type="number" name="loan_amount" required>

  <label>Purpose of Loan:</label>
  <textarea name="loan_purpose" rows="3" required></textarea>

  <label>Repayment Period (Months):</label>
  <input type="number" name="repayment_period" required>

  <label>Proposed Repayment Plan:</label>
  <textarea name="repayment_plan" rows="2"></textarea>

  <label>Additional Collateral Description:</label>
  <textarea name="collateral" rows="2"></textarea>

  <button type="submit">Submit Loan Application</button>
</form>

</body>
</html>
