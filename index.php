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
            </from>
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
        <!-- Main Senter -->

        <main class="flex pt-20 justify-center w-11/12 h-full">
            <span class="text-[50px]">이곳은 시작 화면 입니다.</span>
        </main>

    </div>






</body>

</html>