function animateProgress(elementId, startValue, endValue, speed, maxValue,color) {
    let circularProgress = document.getElementById(elementId);
    let progressValue = circularProgress.querySelector(".progress-value");

    let progress = setInterval(() => {
        if (startValue >= endValue) {
            clearInterval(progress);
            return;
        }

        startValue++;
        progressValue.textContent = `${startValue}`;
        circularProgress.style.background = `conic-gradient(${color} ${startValue * (360 / maxValue)}deg, #ededed 0deg)`;
    }, speed);
}

animateProgress("user-progress", 0, users, 10, 1000,'brown');
animateProgress("book-progress", 0, books, 10, 1000,'brown');
animateProgress("available-progress", 0, available_books, 10, 1000,'brown');
animateProgress("borrowed-progress", 0, borrowed_books, 10, 1000,'brown');
animateProgress("Shelf_1", 0, shelves[0]['totalBooks'], 10, 500,'brown');
animateProgress("Shelf_2", 0, shelves[1]['totalBooks'], 10, 500,'brown');
animateProgress("Shelf_3", 0, shelves[2]['totalBooks'], 10, 500,'brown');
animateProgress("Shelf_4", 0, shelves[3]['totalBooks'], 10, 500,'brown');
