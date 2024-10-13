<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: 230101032-login.php");
    exit();
}

include '230101032-db.php';

if (isset($_GET['design'])) {
    $design_id = $_GET['design'];
    $bgcolor = isset($_GET['bgcolor']) ? $_GET['bgcolor'] : '#ffffff';
    $textcolor = isset($_GET['textcolor']) ? $_GET['textcolor'] : '#000000';

    $db = getDBConnection();
    $stmt = $db->prepare("SELECT * FROM cards WHERE username = ?");
    $stmt->bindValue(1, $_SESSION['username']);
    $result = $stmt->execute();
    $card = $result->fetchArray(SQLITE3_ASSOC);
} else {
    header("Location: 230101032-choose_design.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="230101032-styles.css">
    <title>Preview Your Card</title>
    <style>
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            background-color: <?php echo htmlspecialchars($bgcolor); ?>;
            color: <?php echo htmlspecialchars($textcolor); ?>;
        }

        /* Design 1 */
        .design1 {
            text-align: left;
        }

        /* Design 2 */
        .design2 {
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Design 3 */
        .design3 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Design 4 */
        .design4 {
            border-left: 5px solid #007bff;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <?php if ($design_id == 1): ?>
        <div class="card design1">
            <h1><?php echo htmlspecialchars($card['name']); ?></h1>
            <p><?php echo htmlspecialchars($card['designation']); ?></p>
            <p>Email: <?php echo htmlspecialchars($card['email']); ?></p>
            <p>Mobile: <?php echo htmlspecialchars($card['mobile']); ?></p>
            <p>Organization: <?php echo htmlspecialchars($card['organization']); ?></p>
            <img src="images/<?php echo htmlspecialchars($card['logo']); ?>" alt="Logo" style="max-width: 100px;">
        </div>
    <?php elseif ($design_id == 2): ?>
        <div class="card design2">
            <h1><?php echo htmlspecialchars($card['name']); ?></h1>
            <h2><?php echo htmlspecialchars($card['designation']); ?></h2>
            <p><?php echo htmlspecialchars($card['organization']); ?></p>
            <p>Email: <?php echo htmlspecialchars($card['email']); ?></p>
            <p>Mobile: <?php echo htmlspecialchars($card['mobile']); ?></p>
            <img src="images/<?php echo htmlspecialchars($card['logo']); ?>" alt="Logo" style="max-width: 100px;">
        </div>
    <?php elseif ($design_id == 3): ?>
        <div class="card design3">
            <img src="images/<?php echo htmlspecialchars($card['logo']); ?>" alt="Logo" style="max-width: 100px;">
            <h1><?php echo htmlspecialchars($card['name']); ?></h1>
            <p><?php echo htmlspecialchars($card['designation']); ?> | <?php echo htmlspecialchars($card['organization']); ?></p>
            <p><?php echo htmlspecialchars($card['email']); ?> | <?php echo htmlspecialchars($card['mobile']); ?></p>
        </div>
    <?php elseif ($design_id == 4): ?>
        <div class="card design4">
            <h1><?php echo htmlspecialchars($card['name']); ?></h1>
            <h2><?php echo htmlspecialchars($card['designation']); ?></h2>
            <p><?php echo htmlspecialchars($card['organization']); ?></p>
            <p>Email: <?php echo htmlspecialchars($card['email']); ?></p>
            <p>Mobile: <?php echo htmlspecialchars($card['mobile']); ?></p>
            <img src="images/<?php echo htmlspecialchars($card['logo']); ?>" alt="Logo" style="max-width: 100px;">
        </div>
    <?php else: ?>
        <p>Invalid design selection.</p>
    <?php endif; ?>

    <button onclick="window.print()">Print Card</button>
</body>
</html>