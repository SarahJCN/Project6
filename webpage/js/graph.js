$(document).ready(function(){
const ctx = document.getElementById('histogram').getContext('2d');
var color = 'green';

var user = $("#uId").val();
//alert(user)
$.ajax({
  url: "getflrVisited.php",
  type : "POST",
  data: {user:user}
  
}).done(function(data){
  console.log(data)
  const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [1,2,3],
    datasets: [{
      label: 'Number of Floors',
      data: JSON.parse(data),
      backgroundColor: color,
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1,
        ticks: {
          max: 3,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 3,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
})


})