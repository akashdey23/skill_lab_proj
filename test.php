<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$subject = $_GET['subject'];
$query = "SELECT * FROM {$subject}_questions";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;

    foreach ($_POST as $question_id => $selected_option) {
        $check_query = "SELECT correct_option FROM {$subject}_questions WHERE id=$question_id";
        $correct_option = $conn->query($check_query)->fetch_assoc()['correct_option'];
        if ($selected_option === $correct_option) {
            $score++;
        }
    }

    $update_score = "UPDATE students SET {$subject}_marks=$score WHERE id=" . $_SESSION['user_id'];
    $conn->query($update_score);

    echo "<h2>Your score in $subject: $score</h2>";
    echo "<a href='dashboard.php'>Return to Dashboard</a>";
    exit;
}
?>

<!-- Display Questions -->
<form method="POST">
    <?php while ($row = $result->fetch_assoc()): ?>
        <p><?php echo $row['question']; ?></p>
        <label><input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $row['option1']; ?>"> <?php echo $row['option1']; ?></label><br>
        <label><input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $row['option2']; ?>"> <?php echo $row['option2']; ?></label><br>
        <label><input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $row['option3']; ?>"> <?php echo $row['option3']; ?></label><br>
        <label><input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $row['option4']; ?>"> <?php echo $row['option4']; ?></label><br>
    <?php endwhile; ?>
    <button type="submit">Submit</button>
</form>
