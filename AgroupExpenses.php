<?php
// db를 연결해는 명령어
$con = mysqli_connect("49.247.37.19", "lokia", "lokia0528**", "Agroup") or die("mysql 접속실패 !!");


// 입력구간 start
// isset은 변수가 되었던 무엇이든 컬럼명이든 정수든 실수든 그게 무엇이든 존재를 하느냐 를 점검  현재에서는 컬럼명이 존재를 하느냐를 점검
if (
    isset($_GET["AgroupExpensesRegistrationDate"]) && !empty($_GET["AgroupExpensesRegistrationDate"])
    && isset($_GET["AgroupExpensesDate"]) && !empty($_GET["AgroupExpensesDate"])
    && isset($_GET["AgroupExpensesYM"]) && !empty($_GET["AgroupExpensesYM"])
    && isset($_GET["AgroupExpensesAmount"]) && !empty($_GET["AgroupExpensesAmount"])
    && isset($_GET["AgroupExpensesName"]) && !empty($_GET["AgroupExpensesName"])
    && isset($_GET["AgroupExpensesAccountNumber"]) && !empty($_GET["AgroupExpensesAccountNumber"])
    && isset($_GET["AgroupExpensesRemarks"]) && !empty($_GET["AgroupExpensesRemarks"])
) {
    $AgroupExpensesRegistrationDate = $_GET["AgroupExpensesRegistrationDate"];
    $AgroupExpensesDate = $_GET["AgroupExpensesDate"];
    $AgroupExpensesYM = $_GET["AgroupExpensesYM"];
    $AgroupExpensesAmount = $_GET["AgroupExpensesAmount"];
    $AgroupExpensesName = $_GET["AgroupExpensesName"];
    $AgroupExpensesAccountNumber = $_GET["AgroupExpensesAccountNumber"];
    $AgroupExpensesRemarks = $_GET["AgroupExpensesRemarks"];


    $AgroupExpenses_Insert_sql = "insert into AgroupExpenses
(
    AgroupExpensesRegistrationDate,
    AgroupExpensesDate,
    AgroupExpensesYM,
    AgroupExpensesAmount,
    AgroupExpensesName,
    AgroupExpensesAccountNumber,
    AgroupExpensesRemarks
)

values( 
     '" . $AgroupExpensesRegistrationDate . "',
     '" . $AgroupExpensesDate . "',
     '" . $AgroupExpensesYM . "',
     '" . $AgroupExpensesAmount . "',
     '" . $AgroupExpensesName . "',
     '" . $AgroupExpensesAccountNumber . "',
     '" . $AgroupExpensesRemarks . "'
)";

    $$AgroupExpenses_Insert_ret = mysqli_query($con, $AgroupExpenses_Insert_sql);


    mysqli_close($con);

    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupExpenses.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.

}
// 입력 구간 end


//리스트 만드는 구간 시작
$AgroupExpenses_List_sql = "select * from AgroupExpenses where 1 ";
if (
    (isset($_GET['AgroupExpensesName'])
        && !empty($_GET['AgroupExpensesName']))
) {
    $AgroupExpenses_List_sql .= " and AgroupExpensesName like '%{$_GET['AgroupExpensesName']}%'
    ";
}


$AgroupExpenses_List_ret = mysqli_query($con, $AgroupExpenses_List_sql);

if ($AgroupExpenses_List_ret) {
    $count = mysqli_num_rows($AgroupExpenses_List_ret);
} else {
    echo "AgroupExpenses 데이터 조회 실패!!" . "<br>";
    echo "실패 원인 :" . mysqli_error($con);
    exit();
}


//delete sql 만들기 시작
if (
    (
        isset($_GET['AgroupExpensesNumber'])
        && !empty($_GET['AgroupExpensesNumber'])
        && $_GET['mode'] == 'delete'
    )
) {
    $AgroupExpensesDelete_sql =
        "
    delete from AgroupExpenses where AgroupExpensesNumber={$_GET['AgroupExpensesNumber']}
    ";

    $AgroupExpensesDelete_result = mysqli_query($con, $AgroupExpensesDelete_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupExpenses.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}
//delete sql 만들기 종료



//modify(수정)) sql 만들기 시작

//// $info 기본값을 null로 선언하는 부분
$info['AgroupExpensesNumber'] = null;
$info['AgroupExpensesRegistrationDate'] = null;
$info['AgroupExpensesDate'] = null;
$info['AgroupExpensesYM'] = '';
$info['AgroupExpensesAmount'] = '';
$info['AgroupExpensesName'] = '';
$info['AgroupExpensesAccountNumber'] = '';
$info['AgroupExpensesRemarks'] = '';

// 첫번째 전체 데이터 가져오기
if (
    isset($_GET['AgroupExpensesNumber'])
    && !empty($_GET['AgroupExpensesNumber'])
    && $_GET['mode'] == 'modify'
) {
    $AgroupExpenses_List_modify_sql = "select * from AgroupExpenses where AgroupExpensesNumber={$_GET['AgroupExpensesNumber']}";

    $info_result = mysqli_query($con, $AgroupExpenses_List_modify_sql); // 너 몇줄있어>? 컬럼이 몇개있어?

    $info = mysqli_fetch_assoc($info_result);  //그 컬럼이 몇개 있어 중에 한건을 뽑아내는 곳

}
;



// 두번째 업데이트 치기
if (
    (
        isset($_GET['AgroupExpensesNumber'])
        && !empty($_GET['AgroupExpensesNumber'])
        && isset($_GET['action'])
        && $_GET['action'] == 'update'
    )

) {
    $AgroupExpenses_Update_sql =
        "
    update AgroupExpenses set
    
        AgroupExpensesRegistrationDate = '{$_GET["AgroupExpensesRegistrationDate"]}',
        AgroupExpensesDate = '{$_GET["AgroupExpensesDate"]}',
        AgroupExpensesYM = '{$_GET["AgroupExpensesYM"]}',
        AgroupExpensesAmount = '{$_GET["AgroupExpensesAmount"]}',
        AgroupExpensesName = '{$_GET["AgroupExpensesName"]}',
        AgroupExpensesAccountNumber = '{$_GET["AgroupExpensesAccountNumber"]}',
        AgroupExpensesRemarks = '{$_GET["AgroupExpensesRemarks"]}'

    where AgroupExpensesNumber='{$_GET['AgroupExpensesNumber']}'
    ";
    var_dump($AgroupExpenses_Update_sql);
    $AgroupExpenses_Update_result = mysqli_query($con, $AgroupExpenses_Update_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupExpenses.php';

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
        <!-- Left Sidebar -->
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
                <form method="get" action="AgroupExpenses.php">
                    회비지출번호 : <input class="border" type="text" name="AgroupExpensesNumber"
                        value="<?php echo $info['AgroupExpensesNumber'] ?>"><br>
                    회비지출등록일자 : <input required class="border" type="date" name="AgroupExpensesRegistrationDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupExpensesRegistrationDate'])) ?>"><br>
                    회비지출일자 : <input required class="border" type="date" name="AgroupExpensesDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupExpensesDate'])) ?>"><br>
                    회비지출년월 : <input required class="border" type="text" name="AgroupExpensesYM"
                        value="<?php echo $info['AgroupExpensesYM'] ?>"><br>
                    회비지출액 : <input class="border" type="text" name="AgroupExpensesAmount"
                        value="<?php echo $info['AgroupExpensesAmount'] ?>"><br>
                    회비지출자명 : <input class="border" type="text" name="AgroupExpensesName"
                        value="<?php echo $info['AgroupExpensesName'] ?>"><br>
                    회비지출계좌번호 : <input class="border" type="text" name="AgroupExpensesAccountNumber"
                        value="<?php echo $info['AgroupExpensesAccountNumber'] ?>"><br>
                    비고 : <input class="border" type="text" name="AgroupExpensesRemarks"><br>
                    <br><br>


                    <!-- 지출입력 버튼 -->

                    <?php
                    if (
                        !isset($_GET['mode'])
                    ) {
                        ?>
                        <input type="hidden" name="action" value="insert">
                        <input
                            class="mt-4 p-2 bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition"
                            type="submit" value="지출 등록">
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
                <aside class="bg-gray-150 p-4 w-9/12 h-full">
                    <h2 class="text-lg font-semibold">Main Content 2</h2>
                    <p>This is the main content on the right side.</p>
                    <form action="" method="get">
                        <h1> 회비 지출 내역 </h1>
                        <div>
                            <input class="border" type="text" name="AgroupExpensesName" id="">
                            <button type="submit">검색</button>
                        </div>
                        <table border=1>
                            <tr>
                                <th>회비지출번호</th>
                                <th>회비지출등록일자</th>
                                <th>회비지출일자</th>
                                <th>회비지출년월</th>
                                <th>회비지출액</th>
                                <th>회비지출자명</th>
                                <th>회비지출계좌번호</th>
                                <th>비고</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($AgroupExpenses_List_ret)) {
                                echo "<tr>                                                      
                                       <td>{$row['AgroupExpensesNumber']}</td>
                                       <td>" . date('Y-m-d', strtotime($row['AgroupExpensesRegistrationDate'])) . "</td>
                                       <td>" . date('Y-m-d', strtotime($row['AgroupExpensesDate'])) . "</td>
                                       <td>{$row['AgroupExpensesYM']}</td>
                                       <td>{$row['AgroupExpensesAmount']}</td>
                                       <td>{$row['AgroupExpensesName']}</td>
                                       <td>{$row['AgroupExpensesAccountNumber']}</td>
                                       <td>{$row['AgroupExpensesRemarks']}</td>
                                       <td>
                                        <div class=\"flex\">
                                           <div class=\"bg-blue-500\">
                                             <a class=\"text-white\" href='/AgroupExpenses.php?AgroupExpensesNumber={$row['AgroupExpensesNumber']}&mode=modify' >수정</a>
                                           </div>
                                           <div class=\"bg-red-500\">
                                             <a class=\"text-white\" href='/AgroupExpenses.php?AgroupExpensesNumber={$row['AgroupExpensesNumber']}&mode=delete' >삭제</a>
                                           </div>
                                        </div>
                                       </td>                             
                                     </tr>";
                            }
                            ?>
                        </table>
                    </form>
                </aside>



            </div>



        </main>

    </div>

</body>

</html>