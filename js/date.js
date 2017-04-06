//https://www.experts-exchange.com/questions/28155045/getting-the-date-of-monday-and-sunday-of-the-current-week.html
var today = new Date();
var dayOfWeekStartingSundayZeroIndexBased = today.getDay();
var sundayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay() + 7);
var sunday = sundayOfWeek.toString();
var t = sunday.substring(4, 15);
document.getElementById("date").innerHTML = "Week ending: " + t;