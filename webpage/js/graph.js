const ctx = document.getElementById('histogram').getContext('2d');
var color = 'green';
var dt = [1,2,3];
// var fnum = $("#floorNum").text();
// if(fnum == 1)
//   dt.push(1);
// if(fnum == 2)
//   dt.push(1,2);
// if(fnum == 3)
//   dt.push(1,2,3);
const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: dt,
    datasets: [{
      label: 'Number of Floors',
      data:dt,
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
          display: false,
          beginAtZero: true
        }
      }]
    }
  }
});