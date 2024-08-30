<?php
// Database connection for local development
$servername = "localhost";
$username = "root";
$password = "migikatanochou";
$dbname = "mysample";

// データベース接続の作成
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// データベースからデータを取得
$sql = "SELECT name, uninumber, birthday, position FROM test1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>選手情報</title>
</head>
<body>
    <h2>選手情報</h2>

    <?php
    if ($result->num_rows > 0) {
        // データが存在する場合、テーブルで表示
        echo "<table border='1'>
                <tr>
                    <th>名前</th>
                    <th>背番号</th>
                    <th>生年月日</th>
                    <th>ポジション</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            // ポジションの数値を文字列に変換
            switch ($row['position']) {
                case 1:
                    $position = "投手";
                    break;
                case 2:
                    $position = "捕手";
                    break;
                case 3:
                    $position = "内野手";
                    break;
                case 4:
                    $position = "外野手";
                    break;
                default:
                    $position = "不明";
                    break;
            }

            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['uninumber']) . "</td>
                    <td>" . htmlspecialchars($row['birthday']) . "</td>
                    <td>" . htmlspecialchars($position) . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "データがありません。";
    }

    // データベース接続を最後に閉じる
    $conn->close();
    ?>
</body>
</html>
