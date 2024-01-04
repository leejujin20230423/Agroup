<?php
// db를 연결해는 명령어
$con = mysqli_connect("49.247.37.19", "lokia", "lokia0528**", "Agroup") or die("mysql 접속실패 !!");


// 입력구간 start
// isset은 변수가 되었던 무엇이든 컬럼명이든 정수든 실수든 그게 무엇이든 존재를 하느냐를 점검  현재에서는 컬럼명이 존재를 하느냐를 점검
if (
    isset($_GET["AgroupDepositsRegistrationDate"]) && !empty($_GET["AgroupDepositsRegistrationDate"])
    && isset($_GET["AgroupDepositsDate"]) && !empty($_GET["AgroupDepositsDate"])
    && isset($_GET["AgroupDepositsYM"]) && !empty($_GET["AgroupDepositsYM"])
    && isset($_GET["AgroupDepositsAmount"]) && !empty($_GET["AgroupDepositsAmount"])
    && isset($_GET["AgroupDepositsName"]) && !empty($_GET["AgroupDepositsName"])
    && isset($_GET["AgroupDepositsAccountNumber"]) && !empty($_GET["AgroupDepositsAccountNumber"])
    && isset($_GET["AgroupDepositsRemarks"]) && !empty($_GET["AgroupDepositsRemarks"])
    && $_GET['action'] == 'insert'
) {
    $AgroupDepositsRegistrationDate = $_GET["AgroupDepositsRegistrationDate"];
    $AgroupDepositsDate = $_GET["AgroupDepositsDate"];
    $AgroupDepositsYM = $_GET["AgroupDepositsYM"];
    $AgroupDepositsAmount = $_GET["AgroupDepositsAmount"];
    $AgroupDepositsName = $_GET["AgroupDepositsName"];
    $AgroupDepositsAccountNumber = $_GET["AgroupDepositsAccountNumber"];
    $AgroupDepositsRemarks = $_GET["AgroupDepositsRemarks"];

    $AgroupDeposits_Insert_sql = "insert into AgroupDeposits
(
        AgroupDepositsRegistrationDate,
        AgroupDepositsDate,
        AgroupDepositsYM,
        AgroupDepositsAmount,
        AgroupDepositsName,
        AgroupDepositsAccountNumber,
        AgroupDepositsRemarks
)

values(
     '" . $AgroupDepositsRegistrationDate . "',
     '" . $AgroupDepositsDate . "',
     '" . $AgroupDepositsYM . "',
     '" . $AgroupDepositsAmount . "',
     '" . $AgroupDepositsName . "',
     '" . $AgroupDepositsAccountNumber . "',
     '" . $AgroupDepositsRemarks . "'
)";

    $AgroupDeposits_Insert_result = mysqli_query($con,$AgroupDeposits_Insert_sql);


    mysqli_close($con);

    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupDeposits.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.

}
// 입력 구간 end


//리스트 만드는 구간 시작
$AgroupDeposits_List_sql = "select * from AgroupDeposits where 1 ";
if (
    (
        isset($_GET['AgroupDepositsName'])
        && !empty($_GET['AgroupDepositsName'])
    )
) {
    $AgroupDeposits_List_sql .= " and AgroupDepositsName like '%{$_GET['AgroupDepositsName']}%'
    ";
}

$AgroupDeposits_List_result = mysqli_query($con, $AgroupDeposits_List_sql);

if ($AgroupDeposits_List_result) {
    $count = mysqli_num_rows($AgroupDeposits_List_result);
} else {
    echo "AgroupDeposits 데이터 조회 실패!!" . "<br>";
    echo "실패 원인 :" . mysqli_error($con);
    exit();
}
//리스트 만드는 구간 종료


//delete sql 만들기 시작
if (
    (
        isset($_GET['AgroupDepositsNumber'])
        && !empty($_GET['AgroupDepositsNumber'])
        && $_GET['mode'] == 'delete'

    )
) {
    $AgroupDepositsDelete_sql =
        "
    delete from AgroupDeposits where AgroupDepositsNumber={$_GET['AgroupDepositsNumber']}
    ";

    $AgroupDepositsDelete_result = mysqli_query($con, $AgroupDepositsDelete_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupDeposits.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}
//delete sql 만들기 종료

//modify(수정)) sql 만들기 시작

//// $info 기본값을 null로 선언하는 부분
$info['AgroupDepositsNumber'] = null;
$info['AgroupDepositsRegistrationDate'] = null;
$info['AgroupDepositsDate'] = null;
$info['AgroupDepositsYM'] = '';
$info['AgroupDepositsAmount'] = '';
$info['AgroupDepositsName'] = '';
$info['AgroupDepositsAccountNumber'] = '';
$info['AgroupDepositsRemarks'] = '';

// 첫번째 전체 데이터 가져오기
if (
    isset($_GET['AgroupDepositsNumber'])
    && !empty($_GET['AgroupDepositsNumber'])
    && $_GET['mode'] == 'modify'
) {
    $AgroupDeposits_List_modify_sql = "select * from AgroupDeposits where AgroupDepositsNumber={$_GET['AgroupDepositsNumber']}";
    $info_result = mysqli_query($con, $AgroupDeposits_List_modify_sql); // 너 몇줄있어>? 컬럼이 몇개있어?

    $info = mysqli_fetch_assoc($info_result);  //그 컬럼이 몇개 있어 중에 한건을 뽑아내는 곳

}
;

// var_dump($_GET);

// 두번째 업데이트 치기
if (
    (
        isset($_GET['AgroupDepositsNumber'])
        && !empty($_GET['AgroupDepositsNumber'])
        && isset($_GET['action'])
        && $_GET['action'] == 'update'
    )
) {
    $AgroupDeposits_Update_sql =
        "
    update AgroupDeposits set
    
        AgroupDepositsRegistrationDate = '{$_GET["AgroupDepositsRegistrationDate"]}',
        AgroupDepositsDate = '{$_GET["AgroupDepositsDate"]}',
        AgroupDepositsYM = '{$_GET["AgroupDepositsYM"]}',
        AgroupDepositsAmount = '{$_GET["AgroupDepositsAmount"]}',
        AgroupDepositsName = '{$_GET["AgroupDepositsName"]}',
        AgroupDepositsAccountNumber = '{$_GET["AgroupDepositsAccountNumber"]}',
        AgroupDepositsRemarks = '{$_GET["AgroupDepositsRemarks"]}'

    where AgroupDepositsNumber='{$_GET['AgroupDepositsNumber']}'
    ";

    $AgroupDeposits_Update_result = mysqli_query($con, $AgroupDeposits_Update_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupDeposits.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}

////modify sql 만들기 종료


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <!-- Header -->
    <header class="flex bg-gray-800 text-white p-4">
        <a href='index.php' class="text-2xl">Tailwind CSS Header</a>
        <form action="AgroupLogout.php" method="get">
            <!-- 버튼 타입의 기본값은 서브밋 -->
            <button type="submit" class="border">로그아웃</button>
        </form>
    </header>

    <!-- Wrap Content Area -->
    <div class="flex h-full items-center justify-center">
        <!-- Left Sidebar ##1-->
        <nav class="bg-gray-200 p-4 w-1/12 h-full">
            <h2 class="text-lg font-semibold">Left Sidebar</h2>
            <ul>
                <a href='AgroupMembers.php'> (1) 회원등록 </a><br><br>
                <a href='AgroupMembershipFees.php'> (2) 회비항목등록 </a><br><br>
                <a href='AgroupDeposits.php'> (3) 입금등록 </a><br><br>
                <a href='AgroupExpenses.php'> (4) 지출등록 </a><br><br>
                <a href=''> (5) 미수현황 </a><br><br>
                <a href=''> (6) 회비현황 </a><br><br>
            </ul>
        </nav>
        <!-- Main center -->
        <main class="flex p-4 w-11/12 h-full">
            <div class="w-4/12 h-full">
                <form method="get" action="AgroupDeposits.php">
                    회비입금번호 : <input readonly class="border" type="text" name="AgroupDepositsNumber"
                        value="<?php echo $info['AgroupDepositsNumber'] ?>"><br>
                    회비입금등록일자 : <input required class="border" type="date" name="AgroupDepositsRegistrationDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupDepositsRegistrationDate'])) ?>"><br>

                    회비입금일자 : <input required class="border" type="date" name="AgroupDepositsDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupDepositsDate'])) ?>"><br>
                        
                    회비입금년월 : <input required class="border" type="text" name="AgroupDepositsYM"
                        value="<?php echo $info['AgroupDepositsYM'] ?>"><br>
                    회비입금액 : <input class="border" type="text" name="AgroupDepositsAmount"
                        value="<?php echo $info['AgroupDepositsAmount'] ?>"><br>
                    회비입금자명 : <input class="border" type="text" name="AgroupDepositsName"
                        value="<?php echo $info['AgroupDepositsName'] ?>"><br>
                    회비계좌번호 : <input class="border" type="text" name="AgroupDepositsAccountNumber"
                        value="<?php echo $info['AgroupDepositsAccountNumber'] ?>"><br>
                    비고 : <input class="border" type="text" name="AgroupDepositsRemarks"
                        value="<?php echo $info['AgroupDepositsRemarks'] ?>"><br>
                    <br><br>

                    <!-- 입금입력 버튼 -->
                    <?php
                    if (
                        !isset($_GET['mode'])
                    ) {
                        ?>
                        <input type="hidden" name="action" value="insert">
                        <input
                            class="mt-4 p-2 bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition"
                            type="submit" value="입금 입력">
                        <?php
                    }
                    ?>

                    <!-- 수정하기 버튼 -->
                    <?php
                    if (
                        isset($_GET['mode'])
                        && ($_GET['mode'] == 'modify')
                    ) {
                        ?>
                        <input type="hidden" name="action" value="update"> <!-- hidden으로 하면 사용자에게 버튼이 보이지 않도록 설정하는 것임-->

                        <input
                            class="mt-4 p-2 bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition"
                            type="submit" value="수정 하기">
                        <?php
                    }
                    ?>
                </form>
            </div>

            <div class="w-8/12 h-full">
                <!-- Main Content 2 -->
                <h2 class="text-lg font-semibold">Main Content 2</h2>
                <p>This is the main content on the right side.</p>
                <form action="" method="get">
                    <h1> 회비 항목 내역 </h1>
                    <div>
                        <input class="border" type="text" name="AgroupDepositsName" id="">
                        <button type="submit">검색</button>
                    </div>
                    <table border=1>
                        <tr>
                            <th>회비입금번호</th>
                            <th>회비입금등록일자</th>
                            <th>회비입금일자</th>
                            <th>회비입금년월</th>
                            <th>회비입금액</th>
                            <th>회비입금자명</th>
                            <th>회비계좌번호</th>
                            <th>비고</th>
                            <th>수정/삭제</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($AgroupDeposits_List_result)) {
                            echo "<tr>
                                       <td>{$row['AgroupDepositsNumber']}</td>                   
                                       <td>".date('Y-m-d',strtotime($row['AgroupDepositsRegistrationDate']))."</td>                                    
                                       <td>".date('Y-m-d',strtotime($row['AgroupDepositsDate']))."</td>
                                       <td>{$row['AgroupDepositsYM']}</td>
                                       <td>{$row['AgroupDepositsAmount']}</td>
                                       <td>{$row['AgroupDepositsName']}</td>
                                       <td>{$row['AgroupDepositsAccountNumber']}</td>
                                       <td>{$row['AgroupDepositsRemarks']}</td>
                                       <td>
                                        <div class=\"flex\">
                                           <div class=\"bg-blue-500\">
                                             <a class=\"text-white\" href='/AgroupDeposits.php?AgroupDepositsNumber={$row['AgroupDepositsNumber']}&mode=modify' >수정</a>
                                           </div>
                                           <div class=\"bg-red-500\">
                                             <a class=\"text-white\" href='/AgroupDeposits.php?AgroupDepositsNumber={$row['AgroupDepositsNumber']}&mode=delete' >삭제</a>
                                           </div>
                                        </div>
                                       </td>                             
                                     </tr>";
                        }
                        ?>
                    </table>
                </form>
            </div>
        </main>
    </div>
</body>

</html>