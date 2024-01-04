<?php
session_start(); // 세션 시작

// 모든 세션 변수 삭제
session_unset();

// 세션 파괴
session_destroy();

// 로그인 페이지로 리다이렉트
header("Location: AgroupLogin.php");
exit;
?>