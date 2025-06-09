

<h2 style="text-align:center;">🥗 Personalized Diet Plan</h2>

<form method="POST" style="max-width:500px;margin:auto;padding:20px;">
  <label>Diet Type:</label><br>
  <select name="diet_type" required>
    <option value="veg">Vegetarian</option>
    <option value="nonveg">Non-Vegetarian</option>
  </select><br><br>

  <label>Goal:</label><br>
  <select name="goal" required>
    <option value="weight_loss">Weight Loss</option>
    <option value="weight_gain">Weight Gain</option>
  </select><br><br>

  <label>Daily Calorie Requirement:</label><br>
  <input type="number" name="calories" placeholder="e.g. 2000" required><br><br>

  <button type="submit">Generate Plan</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['diet_type'];
    $goal = $_POST['goal'];
    $calories = (int)$_POST['calories'];

    echo "<h3 style='text-align:center;'>Your {$type} diet plan for {$goal} at {$calories} kcal/day</h3>";

    $plans = [
        'veg' => [
            'weight_loss' => [
                "Breakfast: Oats with fruits (~300 kcal)",
                "Lunch: Quinoa + dal + salad (~500 kcal)",
                "Snack: Sprouts or coconut water (~150 kcal)",
                "Dinner: Mixed vegetable soup + roti (~400 kcal)"
            ],
            'weight_gain' => [
                "Breakfast: Banana shake + peanut butter toast (~500 kcal)",
                "Lunch: Paneer curry + rice + roti (~700 kcal)",
                "Snack: Dry fruits + protein bar (~300 kcal)",
                "Dinner: Rajma + paratha + curd (~600 kcal)"
            ]
        ],
        'nonveg' => [
            'weight_loss' => [
                "Breakfast: Boiled eggs + whole grain toast (~350 kcal)",
                "Lunch: Grilled chicken + salad (~500 kcal)",
                "Snack: Greek yogurt or boiled egg (~150 kcal)",
                "Dinner: Fish curry + brown rice (~500 kcal)"
            ],
            'weight_gain' => [
                "Breakfast: Chicken sandwich + milkshake (~600 kcal)",
                "Lunch: Egg curry + rice + ghee roti (~800 kcal)",
                "Snack: Protein shake + nuts (~400 kcal)",
                "Dinner: Mutton curry + pulao (~700 kcal)"
            ]
        ]
    ];

    echo "<ul style='max-width:500px;margin:auto;'>";
    foreach ($plans[$type][$goal] as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
}
?>


<style>
form {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 8px #ccc;
}
input, select, button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
}
button {
  background-color: #28a745;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
ul {
  list-style: square;
  line-height: 1.8;
}
</style>
