<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script>
    function checkSubject(id) {
        var subject = document.getElementById("subject").value;

        if (subject.length == 0) {
            document.getElementById("form").removeAttribute("action");
        }
        else {
            var for_send_id = document.createElement("input");
            for_send_id.type = "hidden";
            for_send_id.value = id;
            for_send_id.name = "update_id";
            document.getElementById("form").appendChild(for_send_id);
            document.getElementById("form").setAttribute("action", "sendUpdate.php");
        }
    }
    // 제목 유무 확인
</script>
<body>
<?php
    $view_id = isset($_GET['id']) ? $_GET['id'] : null;         // 게시글 아이디

    @$db_con = mysql_connect("localhost", "root", "autoset");
    mysql_select_db("ycj_test");
    // DB연결

    $result = mysql_query("select subject, contents from ycj_first_board where board_id = $view_id");
    $result = mysql_fetch_row($result);
    // 게시글 내용 검색
    
    $result[1] = htmlspecialchars_decode($result[1]);
    $result[1] = strip_tags($result[1]);
    // 문자열 처리
    
    echo "<form method=\"post\" id=\"form\">";
    echo "제목 <input type=\"text\" size=\"62px\" id=\"subject\" name=\"notNull\" value='$result[0]'>";
    echo "<br>내용<br>";
    echo "<textarea name=\"content\" style=\"width: 500px; height: 500px;\">";
    echo $result[1];
    echo "</textarea><br>";
    echo "<input type=\"submit\" value=\"수정완료\" onclick=\"checkSubject(this.id)\" id='$view_id'>";
    echo "</form>";
    
    echo "<form action=\"list.php\">";
    echo "<input type=\"submit\" value=\"취소\">";
    echo "</form>";
    // 게시글 내용 출력

    mysql_close($db_con);   // DB 연결 종료
?>
</body>
</html>
