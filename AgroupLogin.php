<?php

session_start(); // 세션 시작

if (
    isset($_SESSION["loggedin"])
    && $_SESSION["loggedin"] == true
) {

    header("Location: /");
    exit();
}



// db를 연결해는 명령어
require_once 'dbconfig.php';


// print_r($_GET["UserId"].$_GET["UserPassword"]);

// empty는 빈값을 찾는다.반대의 연산자는 !를 붙여넣고 !empty라고 치면 값이 있으면으로 바꾼다.
if (!empty($_GET["UserId"]) && !empty($_GET["UserPassword"])) {

    //db와 연결해서 Id/Pw 검사를 하고 유저가 있을경우 인덱스로 보낸다.


    // User start
    $sql = "select * from User where UserId = '{$_GET["UserId"]}' and UserPassword = '{$_GET["UserPassword"]}' "; // 쿼리를 만들고


    $result = mysqli_query($con, $sql); // 쿼리 실행 결과를 담음



    // print_r($result); //$result 의 값을 프린트 한다.

    $numRows = $result->num_rows; //$numRows의 값을 추출해서 담는다.




    // print_r($numRows);  //$numRows 의 값을 프린트 한다.

    if ($numRows == 1) {

        $_SESSION["loggedin"] = true;
        $_SESSION["UserId"] = $_GET["UserId"];



        header("Location: /");  //인덱스 페이지로 넘어가 라는 명령어
        exit(); // 이 부분이 중요하며, 코드의 실행을 중단시켜야 합니다.
    }





}


?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 테일윈드 적용 스크립트 -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>

<body>

    <!-- form은 작성된 웹 페이지에서 정보를 받을 거야 라는 의미를 가진다. action은 어느 페이지로 정보를 전송할 거야를 정해주는곳, 예를 들어 action="index.php"-->
    <form action="" method="get">
        <div>

            <!-- name는 무엇을 전송할거야 라는 지정 즉, name는 테이블의 컬럼 명으로 보통한다.보안적 코드로는 컬럼명이 노출될수 있음으로 name값 뒤에 약어를 섞어 주는것이 좋다.-->
            <input class="border m-2" type="text" name="UserId"><br>

            <input class="border m-2" type="text" name="UserPassword"><br>

            <!-- 버튼 타입의 기본값은 서브밋 -->
            <button type="submit" class="border">로그인</button>

        </div>
    </form>
</body>

</html>


<!-- 1.id 와 password를 입력하고 로그인 버튼을 클릭



2.form을 만들어서 작성 해서 담는다

3. -->