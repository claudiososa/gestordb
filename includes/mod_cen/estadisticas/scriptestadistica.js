



var ctx = document.getElementById("myChart1").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Arnet","Claro","Fibertel","Otro"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [13, 13, 13,13]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});



var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["M", "T", "W", "A"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [12, 31, 23,]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});


var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["M", "T", "W", "A"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
      data: [12, 31, 23,]
    }]


  },
  options:   {
  pieceLabel: {
    mode: 'percentage',
  }
  }
});
