<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agroup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../public/js/common.js"></script>
</head>
<body>
    <!-- Header -->
    <header class="flex bg-gray-800 text-white p-4">
        <a href='index.php' class="text-2xl">Tailwind CSS Header</a>
        <form action="AgroupLogout.php" method="get" class="ml-auto">
            <!-- 버튼 타입의 기본값은 서브밋 -->
            <button type="submit" class="border">로그아웃</button>
        </form>
    </header>
    <!-- Wrap Content Area -->
    <div class="grid grid-cols-1 md:grid-cols-[180px_1fr] h-full justify-center">
        <!-- Left Sidebar ##1-->
        <nav class="bg-gray-200 p-4 h-full">
            <h2 class="text-lg font-semibold hidden">Left Sidebar</h2>
            <ul>
                <a href='AgroupMembers.php'> (1) 회원등록 </a><br><br>
                <a href='AgroupMembershipFees.php'> (2) 회비항목등록 </a><br><br>
                <a href='AgroupDeposits.php'> (3) 입금등록 </a><br><br>
                <a href='AgroupExpenses.php'> (4) 지출등록 </a><br><br>
                <a href=''> (5) 미수현황 </a><br><br>
                <a href=''> (6) 회비현황 </a><br><br>
            </ul>
        </nav>
        <main class="w-full grid grid-cols-1 md:grid-cols-[1fr_3fr] p-4">