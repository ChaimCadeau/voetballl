let timerInterval;
let seconds = 0;
let minutes = 0;
let hours = 0;

function startTimer() {
    timerInterval = setInterval(updateTimer, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
}

function resetTimer() {
    clearInterval(timerInterval);
    seconds = 0;
    minutes = 0;
    hours = 0;
    updateTimer();
}

function updateTimer() {
    seconds++;
    if (seconds === 60) {
        seconds = 0;
        minutes++;
    }
    if (minutes === 60) {
        minutes = 0;
        hours++;
    }

    document.getElementById('timer').textContent = `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
}

function pad(num) {
    return num.toString().padStart(2, '0');
}










const monthNames = ["Januari", "Februari", "Maart", "April", "Mei", "Juni",
    "Juli", "Augustus", "September", "Oktober", "November", "December"
];

let currentDate = new Date();

function renderCalendar() {
    const monthName = document.querySelector(".month-name");
    const daysContainer = document.querySelector(".days");

    // Clear previous content
    monthName.innerHTML = "";
    daysContainer.innerHTML = "";

    // Set month name
    monthName.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;

    // Get first day of the month
    const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const startingDay = firstDayOfMonth.getDay(); // 0 for Sunday, 1 for Monday, etc.

    // Get number of days in the month
    const totalDays = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();

    // Render empty boxes for days before the start of the month
    for (let i = 0; i < startingDay; i++) {
        const dayElement = document.createElement("div");
        daysContainer.appendChild(dayElement);
    }

    // Render days of the month
    for (let i = 1; i <= totalDays; i++) {
        const dayElement = document.createElement("div");
        dayElement.textContent = i;
        dayElement.addEventListener('click', () => selectDay(dayElement, i));
        daysContainer.appendChild(dayElement);
    }

    // Restore selected days from localStorage
    restoreSelectedDays();
}

function selectDay(dayElement, day) {
    const selectedDays = getSelectedDays();
    const currentMonthYear = getCurrentMonthYear();

    // Toggle the selected state
    if (selectedDays.includes(day)) {
        selectedDays.splice(selectedDays.indexOf(day), 1);
        dayElement.classList.remove('selected');
    } else {
        selectedDays.push(day);
        dayElement.classList.add('selected');
    }

    // Save updated selected days to localStorage
    localStorage.setItem(currentMonthYear, JSON.stringify(selectedDays));
}

function getSelectedDays() {
    const currentMonthYear = getCurrentMonthYear();
    const selectedDays = localStorage.getItem(currentMonthYear);
    return selectedDays ? JSON.parse(selectedDays) : [];
}

function getCurrentMonthYear() {
    return `${currentDate.getMonth()}-${currentDate.getFullYear()}`;
}

function restoreSelectedDays() {
    const selectedDays = getSelectedDays();
    const daysContainer = document.querySelector(".days");
    const dayElements = daysContainer.children;

    selectedDays.forEach(day => {
        dayElements[day - 1].classList.add('selected');
    });
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial render
renderCalendar();













