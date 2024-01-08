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

    <title>Agroup</title>
</head>

<body>

    <!-- form은 작성된 웹 페이지에서 정보를 받을 거야 라는 의미를 가진다. action은 어느 페이지로 정보를 전송할 거야를 정해주는곳, 예를 들어 action="index.php"-->
    <form action="" method="get">
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    Agroup
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your id</label>
                                <input type="text" name="UserId" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="id" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="UserPassword" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <div class="flex items-center justify-between">
                                <!-- <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                    </div>
                                </div>
                                <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a> -->
                            </div>
                            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    </form>
</body>

</html>


<!-- 1.id 와 password를 입력하고 로그인 버튼을 클릭



2.form을 만들어서 작성 해서 담는다

3. -->