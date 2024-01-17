if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then(function (registration) {
            console.log('서비스 워커 등록 성공:', registration);
        })
        .catch(function (error) {
            console.log('서비스 워커 등록 실패:', error);
        });
}