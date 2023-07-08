function animateProgress(elementId, startValue, endValue, speed, maxValue) {
    let circularProgress = document.getElementById(elementId);
    let progressValue = circularProgress.querySelector(".progress-value");

    let progress = setInterval(() => {
        if (startValue >= endValue) {
            clearInterval(progress);
            return;
        }

        startValue++;
        progressValue.textContent = `${startValue}`;
        circularProgress.style.background = `conic-gradient(brown ${startValue * (360 / maxValue)}deg, #ededed 0deg)`;
    }, speed);
}

animateProgress("user-progress", 0, users, 10, 1000);
animateProgress("book-progress", 0, books, 10, 1000);
animateProgress("available-progress", 0, available_books, 10, 1000);
animateProgress("borrowed-progress", 0, borrowed_books, 10, 1000);
