<?php
// db를 연결해는 명령어
require_once 'common.php';


// 입력구간 start
// isset은 변수가 되었던 무엇이든 컬럼명이든 정수든 실수든 그게 무엇이든 존재를 하느냐 를 점검  현재에서는 컬럼명이 존재를 하느냐를 점검
if (
    isset($_GET["AgroupMembersRegistrationDate"]) && !empty($_GET["AgroupMembersRegistrationDate"])
    && isset($_GET["AgroupMembersName"]) && !empty($_GET["AgroupMembersName"])
    && isset($_GET["AgroupMembersWorkPhone"]) && !empty($_GET["AgroupMembersWorkPhone"])
    && isset($_GET["AgroupMembersRemarks"]) && !empty($_GET["AgroupMembersRemarks"])
    && $_GET['action'] == 'insert'

) {
    $AgroupMembersRegistrationDate = $_GET["AgroupMembersRegistrationDate"];
    $AgroupMembersName = $_GET["AgroupMembersName"];
    $AgroupMembersWorkPhone = $_GET["AgroupMembersWorkPhone"];
    $AgroupMembersRemarks = $_GET["AgroupMembersRemarks"];


    $AgroupMembers_Insert_sql = "insert into AgroupMembers
(
    AgroupMembersRegistrationDate,
    AgroupMembersName,
    AgroupMembersWorkPhone,
    AgroupMembersRemarks
)

values( 

    '" . $AgroupMembersRegistrationDate . "',
    '" . $AgroupMembersName . "',
    '" . $AgroupMembersWorkPhone . "',
    '" . $AgroupMembersRemarks . "'
)";

    $ret = mysqli_query($con, $AgroupMembers_Insert_sql);


    mysqli_close($con);

    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupMembers.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.

}
// 입력 구간 end


//리스트 만드는 구간 시작
$AgroupMembers_List_sql =
    "
 select * from AgroupMembers where 1 
 ";
if (
    (isset($_GET['AgroupMembersName']) && !empty($_GET['AgroupMembersName']))
    && !isset($_GET['action'])
) {
    $AgroupMembers_List_sql .=
        "
     and AgroupMembersName like '%{$_GET['AgroupMembersName']}%'        
    ";
}

$AgroupMembers_List_result = mysqli_query($con, $AgroupMembers_List_sql); //$AgroupMembers_List_sql에 담은 쿼리값을 result값에 담음

if ($AgroupMembers_List_result) {
    $count = mysqli_num_rows($AgroupMembers_List_result);
} else {
    echo "AgroupMembers list 데이터 조회 실패!!" . "<br>";
    echo "실패 원인:" . mysqli_error($con);
}
//리스트 만드는 구간 종료


//delete sql 만들기 시작
if (
    (
        isset($_GET['AgroupMembersNumber'])
        && !empty($_GET['AgroupMembersNumber'])
        && isset($_GET['mode'])
        && $_GET['mode'] == 'delete'
    )

) {
    $Members_delete_sql =
        "
        delete from AgroupMembers where AgroupMembersNumber={$_GET['AgroupMembersNumber']}
        ";

    $Members_delete_result = mysqli_query($con, $Members_delete_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupMembers.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}

//delete sql 만들기 종료

//modify(수정)) sql 만들기 시작
$info['AgroupMembersNumber'] = null;
$info['AgroupMembersRegistrationDate'] = null;
$info['AgroupMembersName'] = '';
$info['AgroupMembersWorkPhone'] = '';
$info['AgroupMembersRemarks'] = '';

//// 첫번째 전체 데이터 가져오기

if (
    isset($_GET['AgroupMembersNumber'])
    && !empty($_GET['AgroupMembersNumber'])
    && isset($_GET['mode'])
    && $_GET['mode'] == 'modify'
) {
    $AgroupMembers_List_modify_sql = "select * from AgroupMembers where AgroupMembersNumber={$_GET['AgroupMembersNumber']}";

    $info_result = mysqli_query($con, $AgroupMembers_List_modify_sql); // 너 몇줄있어>? 컬럼이 몇개있어?

    $info = mysqli_fetch_assoc($info_result);  //그 컬럼이 몇개 있어 중에 한건을 뽑아내는 곳

}
;

// 두번째 업데이트 치기
if (
    (
        isset($_GET['AgroupMembersNumber'])
        && !empty($_GET['AgroupMembersNumber'])
        && isset($_GET['action'])
        && $_GET['action'] == 'update'
    )

) {
    $AgroupMembers_Update_sql = "update AgroupMembers set
    AgroupMembersRegistrationDate = '{$_GET["AgroupMembersRegistrationDate"]}',
    AgroupMembersName = '{$_GET["AgroupMembersName"]}',
    AgroupMembersWorkPhone = '{$_GET["AgroupMembersWorkPhone"]}',
    AgroupMembersRemarks = '{$_GET["AgroupMembersRemarks"]}'

    where AgroupMembersNumber='{$_GET['AgroupMembersNumber']}'
    ";


    $AgroupMembers_Update_result = mysqli_query($con, $AgroupMembers_Update_sql);  //mysqli_query이 함수는 쿼리를 실행한 함수를 담는 함수,즉 데이터를 가져와서 변수에 담는 기능
    // 이동할 페이지의 주소를 설정합니다.
    $new_location = 'AgroupMembers.php';

    // 헤더를 이용하여 페이지를 이동합니다.
    header('Location: ' . $new_location);
    exit; // 페이지 이동 후에는 스크립트를 종료하는 것이 좋습니다.
}

//modify(수정)) sql 만들기 종료
require_once 'template/header.php';
?>



        <!-- Main center -->
        <main class="flex p-4 w-11/12 h-full">
            <div class="w-4/12 h-full">
                <form method="get" action="AgroupMembers.php">
                    회원번호 : <input readonly class="border" type="text" name="AgroupMembersNumber"
                        value="<?php echo $info['AgroupMembersNumber'] ?>"><br>
                    <!--disabled는 input 박스를 사용하지 못하도록 클릭을 방지한다.readonly는 클릭은 되어도 값이 변경되지 않도록 한다. -->
                    회원등록일자 : <input required class="border" type="date" name="AgroupMembersRegistrationDate"
                        value="<?php echo date('Y-m-d', strtotime($info['AgroupMembersRegistrationDate'])) ?>"><br>

                    회원성명 : <input required class="border" type="text" name="AgroupMembersName"
                        value="<?php echo $info['AgroupMembersName'] ?>"><br>

                    회원연락처 : <input required class="border" type="text" name="AgroupMembersWorkPhone"
                        value="<?php echo $info['AgroupMembersWorkPhone'] ?>"><br>

                    비고 : <input class="border" type="text" name="AgroupMembersRemarks"
                        value="<?php echo $info['AgroupMembersRemarks'] ?>"><br>
                    <br><br>

                    <!-- 회원등록 버튼 -->
                    <?php
                    if (
                        !isset($_GET['mode'])
                    ) {
                        ?>
                        <input type="hidden" name="action" value="insert">
                        <input
                            class="mt-4 p-2 bg-blue-500 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition"
                            type="submit" value="회원 등록">
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
                            <input class="border" type="text" name="AgroupMembersName" id="">
                            <button type="submit">회원검색</button>
                        </div>
                        <table border=1>
                            <tr class="border">
                                <th>회원코드</th>
                                <th>회원등록일자</th>
                                <th>회원성명</th>
                                <th>회원연락처</th>
                                <th>비고</th>
                                <th>회원수정</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($AgroupMembers_List_result)) { //위 mysqli_query에서 가져온 쿼리의 결과값을 한행씩 뽑아 내서 배열로 담는 기능의 함수
                                echo "<tr>
                                        <td>{$row['AgroupMembersNumber']}</td>
                                        <td>{$row['AgroupMembersRegistrationDate']}</td>
                                        <td>{$row['AgroupMembersName']}</td>
                                        <td>{$row['AgroupMembersWorkPhone']}</td>
                                        <td>{$row['AgroupMembersRemarks']}</td>
                                        <td>
                                            <a href='/AgroupMembers.php?AgroupMembersNumber={$row['AgroupMembersNumber']}&mode=modify' >수정</a>
                                            <a href='/AgroupMembers.php?AgroupMembersNumber={$row['AgroupMembersNumber']}&mode=delete' >삭제</a>
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