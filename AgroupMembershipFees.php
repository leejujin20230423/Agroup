<?php
// db를 연결해는 명령어
$con = mysqli_connect("49.247.37.19", "lokia", "lokia0528**", "Agroup") or die("mysql 접속실패 !!");


// 입력구간 start
// isset은 변수가 되었던 무엇이든 컬럼명이든 정수든 실수든 그게 무엇이든 존재를 하느냐 를 점검  현재에서는 컬럼명이 존재를 하느냐를 점검
if (
    isset($_GET["AgroupMembershipFeesRegistrationDate"]) && !empty($_GET["AgroupMembershipFeesRegistrationDate"])
    && isset($_GET["AgroupMembershipFeesYM"]) && !empty($_GET["AgroupMembershipFeesYM"])
    && isset($_GET["AgroupMembershipFeesAmount"]) && !empty($_GET["AgroupMembershipFeesAmount"])
    && isset($_GET["AgroupMembershipFeesRemarks"]) && !empty($_GET["AgroupMembershipFeesRemarks"])
    && $_GET['action'] == 'insert'

) {
    $AgroupMembershipFeesRegistrationDate = $_GET["AgroupMembershipFeesRegistrationDate"];
    $AgroupMembershipFeesYM = $_GET["AgroupMembershipFeesYM"];
    $AgroupMembershipFeesAmount = $_GET["AgroupMembershipFeesAmount"];
    $AgroupMembershipFeesRemarks = $_GET["AgroupMembershipFeesRemarks"];


    $AgroupMembershipFees_Insert_sql = "insert into AgroupMembershipFees
(
    AgroupMembershipFeesRegistrationDate,
    AgroupMembershipFeesYM,
    AgroupMembershipFeesAmount,
    AgroupMembershipFeesRemarks
)

values( 

    '" . $AgroupMembershipFeesRegistrationDate . "',
    '" . $AgroupMembershipFeesYM . "',
    '" . $AgroupMembershipFeesAmount . "',
    '" . $AgroupMembershipFeesRemarks . "'
)";

    $AgroupMembershipFees_Insert_result = mysqli_query($con, $AgroupMembershipFees_Insert_sql);


    mysqli_close($con);

    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupMembershipFees.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.

}
// 입력 구간 end


//리스트 만드는 구간 시작
$AgroupMembershipFees_List_sql =
    "select * from AgroupMembershipFees where 1 ";
if (
    (isset($_GET['AgroupMembershipFeesRemarks']) && !empty($_GET['AgroupMembershipFeesRemarks']))
) {
    $AgroupMembershipFees_List_sql .= " and AgroupMembershipFeesRemarks like '%{$_GET['AgroupMembershipFeesRemarks']}%'        
    ";
}

$AgroupMembershipFees_List_result = mysqli_query($con, $AgroupMembershipFees_List_sql);

if ($AgroupMembershipFees_List_result) {
    $count = mysqli_num_rows($AgroupMembershipFees_List_result);
} else {
    echo "AgroupMembershipFees 데이터 조회 실패!!" . "<br>";
    echo "실패 원인 :" . mysqli_error($con);
    exit();
}
//리스트 만드는 구간 종료


//delete sql 만들기 시작
if (
    (
        isset($_GET['AgroupMembershipFeesNumber'])
        && !empty($_GET['AgroupMembershipFeesNumber'])
        && $_GET['mode'] == 'delete'

    )
) {
    $AgroupMembershipFeesDelete_sql =
        "
    delete from AgroupMembershipFees where AgroupMembershipFeesNumber={$_GET['AgroupMembershipFeesNumber']}
    ";

    $AgroupMembershipFeesDelete_result = mysqli_query($con, $AgroupMembershipFeesDelete_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능

    $new_location = 'AgroupMembershipFees.php';  // 이동할 페이지의 주소를 설정합니다.


    header('Location: ' . $new_location);   // 헤더를 이용하여 페이지를 이동합니다.

    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}
//delete sql 만들기 종료



//modify(수정)) sql 만들기 시작
$info['AgroupMembershipFeesNumber'] = null;
$info['AgroupMembershipFeesRegistrationDate'] = null;
$info['AgroupMembershipFeesYM'] = '';
$info['AgroupMembershipFeesAmount'] = '';
$info['AgroupMembershipFeesRemarks'] = '';

//// 첫번째 전체 데이터 가져오기

if (
    isset($_GET['AgroupMembershipFeesNumber'])
    && !empty($_GET['AgroupMembershipFeesNumber'])
    && isset($_GET['mode'])
    && $_GET['mode'] == 'modify'
) {
    $AgroupMembershipFees_List_modify_sql = "select * from AgroupMembershipFees where AgroupMembershipFeesNumber={$_GET['AgroupMembershipFeesNumber']}";

    $info_result = mysqli_query($con, $AgroupMembershipFees_List_modify_sql); // 너 몇줄있어>? 컬럼이 몇개있어?

    $info = mysqli_fetch_assoc($info_result);  //그 컬럼이 몇개 있어 중에 한건을 뽑아내는 곳

}
;

// 두번째 업데이트 치기
if (
    (
        isset($_GET['AgroupMembershipFeesNumber'])
        && !empty($_GET['AgroupMembershipFeesNumber'])
        && isset($_GET['action'])
        && $_GET['action'] == 'update'
    )

) {
    $AgroupMembershipFees_Update_sql = "update AgroupMembershipFees set
    AgroupMembershipFeesRegistrationDate = '{$_GET["AgroupMembershipFeesRegistrationDate"]}',
    AgroupMembershipFeesYM = '{$_GET["AgroupMembershipFeesYM"]}',
    AgroupMembershipFeesAmount = '{$_GET["AgroupMembershipFeesAmount"]}',
    AgroupMembershipFeesRemarks = '{$_GET["AgroupMembershipFeesRemarks"]}'

    where AgroupMembershipFeesNumber='{$_GET['AgroupMembershipFeesNumber']}'
    ";


    $AgroupMembers_Update_result = mysqli_query($con, $AgroupMembershipFees_Update_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupMembershipFees.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}

//modify(수정)) sql 만들기 종료


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
                <form method="get" action="AgroupMembershipFees.php">
                    회비항목번호 : <input readonly class="border" type="text" name="AgroupMembershipFeesNumber"
                        value="<?php echo $info['AgroupMembershipFeesNumber'] ?>"><br>

                    회비항목등록일자 : <input required class="border" type="date" name="AgroupMembershipFeesRegistrationDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupMembershipFeesRegistrationDate'])) ?>"><br>

                    회비항목년월 : <input required class="border" type="text" name="AgroupMembershipFeesYM"
                        value="<?php echo $info['AgroupMembershipFeesYM'] ?>"><br>

                    회비항목금액 : <input required class="border" type="int" name="AgroupMembershipFeesAmount"
                        value="<?php echo $info['AgroupMembershipFeesAmount'] ?>"><br>

                    회비항목내용 : <input class="border" type="text" name="AgroupMembershipFeesRemarks"
                        value="<?php echo $info['AgroupMembershipFeesRemarks'] ?>"><br>

                    <br><br>



                    <!-- 회비 항목 등록 버튼 -->
                    <?php
                    if (
                        !isset($_GET['mode'])
                    ) {
                        ?>
                        <input type="hidden" name="action" value="insert">
                        <input
                            class="mt-4 p-2 bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition"
                            type="submit" value="항목 등록">
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
                        <h1> 회비 항목 내역 </h1>
                        <div>
                            <input class="border" type="text" name="AgroupMembershipFeesRemarks" id="">
                            <button type="submit">검색</button>
                        </div>
                        <table border=1>
                            <tr>
                                <th>회비항목코드</th>
                                <th>회비항목등록일자</th>
                                <th>회비항목년월</th>
                                <th>회비항목금액</th>
                                <th>회비항목내용</th>
                                <th>회비항목수정</th>

                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($AgroupMembershipFees_List_result)) {
                                echo "<tr>                    
                            
                              <td>{$row['AgroupMembershipFeesNumber']}</td>                         
                              <td>".date('Y-m-d',strtotime($row['AgroupMembershipFeesRegistrationDate']))."</td>
                              <td>{$row['AgroupMembershipFeesYM']}</td>
                              <td>{$row['AgroupMembershipFeesAmount']}</td>
                              <td>{$row['AgroupMembershipFeesRemarks']}</td>
                              <td>
                                 <a href='/AgroupMembershipFees.php?AgroupMembershipFeesNumber={$row['AgroupMembershipFeesNumber']}&mode=modify' >수정</a>
                                 <a href='/AgroupMembershipFees.php?AgroupMembershipFeesNumber={$row['AgroupMembershipFeesNumber']}&mode=delete' >삭제</a>
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