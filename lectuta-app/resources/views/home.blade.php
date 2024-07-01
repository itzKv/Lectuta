@extends('layouts.frontend.master')

@section('content')

<style>


body {
  display: flex;
  height: 100vh;
  width: 100%;
  justify-content: center;
  align-items: center;
  place-items: center;
  overflow: hidden;
}

.calendar {
  height: 34rem;
  width: 56.5;
  background-color: white;
  border-radius: 0.75rem;
  overflow: hidden;
  padding: 35px 35px 0px 35px;
}

.calendar {
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}

.calendar-header {
  background: #e91e63;
  display: flex;
  justify-content: space-between;
  border-radius: 7px;
  align-items: center;
  font-weight: 700;
  color: #ffffff;
  padding: 10px;
}

.calendar-body {
  padding: 10px;
}

.calendar-week-days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  font-weight: 600;
  cursor: pointer;
  color: rgb(104, 104, 104);
}

.calendar-week-days div:hover {
  color: black;
  transform: scale(1.2);
  transition: all .2s ease-in-out;
}

.calendar-week-days div {
  display: grid;
  place-items: center;
  color: #e91e63;
  height: 30px;
}

.calendar-days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 2px;
  align-items: center;
  justify-content: center;
  color: #0A0921;
}

.calendar-days div {
  width: 37px;
  height: 33px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: auto;
  margin-right: auto;
  padding: 5px;
  position: relative;
  cursor: pointer;
  animation: to-top 1s forwards;
}

.month-picker {
  padding: 5px 10px;
  border-radius: 10px;
  cursor: pointer;
}

.year-picker {
  display: flex;
  align-items: center;
}

.year-change {
  height: 30px;
  width: 30px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  margin: 0px 10px;
  padding-top: 15px;
  cursor: pointer;
}

.year-change:hover {
  background-color: #9796f0;
  transition: all .2s ease-in-out;
  transform: scale(1.12);
}

.calendar-footer {
  padding: 10px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

#year:hover {
  cursor: pointer;
  transform: scale(1.2);
  transition: all 0.2 ease-in-out;
}

.calendar-days div span {
  position: absolute;
}

.calendar-days div:hover {
  transition: width 0.2s ease-in-out, height 0.2s ease-in-out;
  background-color: #fbc7d4;
  border-radius: 20%;
  color: #f8fbff;
}

.calendar-days div.current-date {
  color: #f8fbff;
  background-color: #e91e63;
  border-radius: 20%;
}

.month-list {
  position: relative;
  left: 0;
  top: -130px;
  background-color: #ebebeb;
  color: #151426;
  display: grid;
  grid-template-columns: repeat(3, auto);
  gap: 5px;
  border-radius: 20px;
}

.month-list>div {
  display: grid;
  place-content: center;
  margin: 5px 10px;
  transition: all 0.2s ease-in-out;
}

.month-list>div>div {
  border-radius: 15px;
  padding: 10px;
  cursor: pointer;
}

.month-list>div>div:hover {
  background-color: #9796f0;
  color: #f8fbff;
  transform: scale(0.9);
  transition: all 0.2s ease-in-out;
}

.month-list.show {
  visibility: visible;
  pointer-events: visible;
  transition: 0.6s ease-in-out;
  animation: to-left .71s forwards;
}

.month-list.hideonce {
  visibility: hidden;
}

.month-list.hide {
  animation: to-right 1s forwards;
  visibility: none;
  pointer-events: none;
}

.date-time-formate {
  height: 4rem;
  width: 100%;
  font-family: Dubai Light, Century Gothic;
  position: relative;
  display: flex;
  top: 50px;
  justify-content: center;
  align-items: center;
}

.day-text-formate {
  font-family: Microsoft JhengHei UI;
  font-size: 1.4rem;
  padding-right: 5%;
  border-right: 3px solid #e91e63;
}

.date-time-value {
  display: block;
  position: relative;
  text-align: center;
  padding-left: 5%;
}

.time-formate {
  font-size: 1.5rem;
}

.time-formate.hideTime {
  animation: hidetime 1.5s forwards;
}

.day-text-formate.hidetime {
  animation: hidetime 1.5s forwards;
}

.date-formate.hideTime {
  animation: hidetime 1.5s forwards;
}

.day-text-formate.showtime {
  animation: showtime 1s forwards;
}

.time-formate.showtime {
  animation: showtime 1s forwards;
}

.date-formate.showtime {
  animation: showtime 1s forwards;
}

.btnOpen {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    padding: 1.25rem 1rem;
    cursor: pointer;
}

@keyframes to-top {
  0% {
    transform: translateY(0);
    opacity: 0;
  }

  100% {
    transform: translateY(100%);
    opacity: 1;
  }
}

@keyframes to-left {
  0% {
    transform: translatex(230%);
    opacity: 1;
  }

  100% {
    transform: translatex(0);
    opacity: 1;
  }
}

@keyframes to-right {
  10% {
    transform: translatex(0);
    opacity: 1;
  }

  100% {
    transform: translatex(-150%);
    opacity: 1;
  }
}

@keyframes showtime {
  0% {
    transform: translatex(250%);
    opacity: 1;
  }

  100% {
    transform: translatex(0%);
    opacity: 1;
  }
}

@keyframes hidetime {
  0% {
    transform: translatex(0%);
    opacity: 1;
  }

  100% {
    transform: translatex(-370%);
    opacity: 1;
  }
}
</style>

<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-3" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask bg-gradient-primary opacity-1"></span>
      <div class="username container-fluid mb-2 ms-6 mt-2">
        <h4 class="text-white" style="font-size: 1.4rem"></h4>
        <h1 class="text-white text-size" style="font-size: 5.9rem">{{ Auth::user()->name }}</h1>
      </div>
    </div>
</div>

<div class="container-fluid px-2 px-md-4 mt-4">
  <div class="row mb-4">
      <div id="containerContainer" class="col-lg-8 col-md-4">
              <div class="container">
                  <div class="calendar">
                      <div class="calendar-header">
                          <span class="month-picker" id="month-picker"> May </span>
                          <div class="year-picker" id="year-picker">
                          <span class="year-change" id="pre-year">
                              <pre><</pre>
                          </span>
                          <span id="year">2020 </span>
                          <span class="year-change" id="next-year">
                              <pre>></pre>
                          </span>
                          </div>
                      </div>

                      <div class="calendar-body">
                          <div class="calendar-week-days">
                          <div>Sun</div>
                          <div>Mon</div>
                          <div>Tue</div>
                          <div>Wed</div>
                          <div>Thu</div>
                          <div>Fri</div>
                          <div>Sat</div>
                          </div>
                              <div class="calendar-days">
                          </div>
                      </div>
                      <div class="calendar-footer">
                      </div>
                      <div class="date-time-formate">
                          <div class="day-text-formate">TODAY</div>
                          <div class="date-time-value">
                          <div class="time-formate">01:41:20</div>
                          <div class="date-formate">03 - March - 2022</div>
                          </div>
                      </div>
                      <div class="month-list"></div>
                  </div>
          </div>

      </div>

      <div class="col-lg-4 col-md-6">
          <div class="card">
              <div class="card-header ms-1 p-3">
                  <h5 class="mb-0" style="color: #000000;">Your Recent Notes</h5>
                  <p class="text-sm mb-0">
                      Choose the latest added notes.
                  </p>
          </div>
          <div class="card-body p-3 pb-0">
            <div class="alert alert-primary alert-dismissible text-white" role="alert">
              <span class="text-sm">Title of the document.</span>
              <a class="btnOpen text-lg py-3 opacity-10 text-white" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">></span>
              </a>
            </div>
          </div>
    </div>
</div>

<script>
  const greetingEl = document.querySelector('.username h4'); // Target the h1 element

  function updateGreeting() {
    const now = new Date();
    const hours = now.getHours();

    let greeting;
    if (hours < 12) {
        greeting = 'Good Morning';
    } else if (hours < 17) {
        greeting = 'Good Afternoon';
    } else {
        greeting = 'Good Evening';
    }

    greetingEl.textContent = greeting; // Update the content
  }
  updateGreeting(); // Call initially to display greeting
  setInterval(updateGreeting, 60000); // Update every minute

    const isLeapYear = (year) => {
  return (
    (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) ||
    (year % 100 === 0 && year % 400 === 0)
  );
    };
    const getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28;
    };
    let calendar = document.querySelector('.calendar');
    const month_names = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
    let month_picker = document.querySelector('#month-picker');
    const dayTextFormate = document.querySelector('.day-text-formate');
    const timeFormate = document.querySelector('.time-formate');
    const dateFormate = document.querySelector('.date-formate');

    month_picker.onclick = () => {
    month_list.classList.remove('hideonce');
    month_list.classList.remove('hide');
    month_list.classList.add('show');
    dayTextFormate.classList.remove('showtime');
    dayTextFormate.classList.add('hidetime');
    timeFormate.classList.remove('showtime');
    timeFormate.classList.add('hideTime');
    dateFormate.classList.remove('showtime');
    dateFormate.classList.add('hideTime');
    };

    const generateCalendar = (month, year) => {
    let calendar_days = document.querySelector('.calendar-days');
    calendar_days.innerHTML = '';
    let calendar_header_year = document.querySelector('#year');
    let days_of_month = [
        31,
        getFebDays(year),
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31,
        ];

    let currentDate = new Date();

    month_picker.innerHTML = month_names[month];

    calendar_header_year.innerHTML = year;

    let first_day = new Date(year, month);


    for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {

        let day = document.createElement('div');

        if (i >= first_day.getDay()) {
        day.innerHTML = i - first_day.getDay() + 1;

        if (i - first_day.getDay() + 1 === currentDate.getDate() &&
            year === currentDate.getFullYear() &&
            month === currentDate.getMonth()
        ) {
            day.classList.add('current-date');
        }
        }
        calendar_days.appendChild(day);
    }
    };

    let month_list = calendar.querySelector('.month-list');
    month_names.forEach((e, index) => {
    let month = document.createElement('div');
    month.innerHTML = `<div>${e}</div>`;

    month_list.append(month);
    month.onclick = () => {
        currentMonth.value = index;
        generateCalendar(currentMonth.value, currentYear.value);
        month_list.classList.replace('show', 'hide');
        dayTextFormate.classList.remove('hideTime');
        dayTextFormate.classList.add('showtime');
        timeFormate.classList.remove('hideTime');
        timeFormate.classList.add('showtime');
        dateFormate.classList.remove('hideTime');
        dateFormate.classList.add('showtime');
    };
    });

    (function() {
    month_list.classList.add('hideonce');
    })();
    document.querySelector('#pre-year').onclick = () => {
    --currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
    };
    document.querySelector('#next-year').onclick = () => {
    ++currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
    };

    let currentDate = new Date();
    let currentMonth = { value: currentDate.getMonth() };
    let currentYear = { value: currentDate.getFullYear() };
    generateCalendar(currentMonth.value, currentYear.value);

    const todayShowTime = document.querySelector('.time-formate');
    const todayShowDate = document.querySelector('.date-formate');

    const currshowDate = new Date();
    const showCurrentDateOption = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    weekday: 'long',
    };
    const currentDateFormate = new Intl.DateTimeFormat(
    'en-US',
    showCurrentDateOption
    ).format(currshowDate);
    todayShowDate.textContent = currentDateFormate;
    setInterval(() => {
    const timer = new Date();
    const option = {
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
    };
    const formateTimer = new Intl.DateTimeFormat('en-us', option).format(timer);
    let time = `${`${timer.getHours()}`.padStart(
        2,
        '0'
        )}:${`${timer.getMinutes()}`.padStart(
        2,
        '0'
        )}: ${`${timer.getSeconds()}`.padStart(2, '0')}`;
    todayShowTime.textContent = formateTimer;
    }, 1000);
</script>

@endsection