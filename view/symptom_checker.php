<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Symptom Checker</title>
  <style>
    .container {
      max-width: 600px;
      margin: auto;
      padding: 30px;
      background: #f9f9f9;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      margin-top: 40px;
    }
    textarea {
      width: 100%;
      height: 100px;
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
      resize: none;
    }
    button {
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
    }
    .result {
      margin-top: 20px;
      background-color: #fff;
      padding: 15px;
      border-left: 4px solid #007BFF;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🧠 Symptom Checker</h2>
  <form method="post">
    <label>Enter your symptoms (comma separated):</label><br>
    <small>e.g. fever, cough, headache</small><br><br>
    <textarea name="symptoms" placeholder="Type here..."></textarea><br>
    <button type="submit">Check</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $symptom_diagnosis = [
          "fever" => "You may have a viral infection or flu.",
          "cough" => "This might indicate a respiratory issue or common cold.",
          "cold" => "Possible signs of flu or allergic reaction.",
          "headache" => "Could be due to stress, dehydration, or migraine.",
          "fatigue" => "Might be due to overwork, anemia, or thyroid issues.",
          "nausea" => "Could indicate food poisoning or stomach infection.",
          "sore throat" => "Often a sign of viral or bacterial infection.",
          "body ache" => "Possible flu, fatigue, or viral infection.",
          "shortness of breath" => "May be related to asthma or cardiac issues."
      ];

      $input = strtolower(trim($_POST['symptoms']));
      $user_symptoms = array_map('trim', explode(",", $input));
      $found = false;

      echo "<div class='result'>";
      foreach ($user_symptoms as $symptom) {
          if (array_key_exists($symptom, $symptom_diagnosis)) {
              echo "<p><strong>" . ucfirst($symptom) . ":</strong> " . $symptom_diagnosis[$symptom] . "</p>";
              $found = true;
          }
      }
      if (!$found) {
          echo "<p>Sorry, we couldn't match your symptoms. Please consult a doctor.</p>";
      }
      echo "</div>";
  }
  ?>
</div>

</body>
</html>
