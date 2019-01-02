let heroElement = document.getElementById("heroChart").getContext('2d');
let heroChart = new Chart(heroElement, {
  type: 'doughnut',
  data: {
    labels: ["Black", "Blue", "Green", "Red"],
    datasets: [{
      label: 'Spells by Color',
      data: [0, 0, 0, 0],
      backgroundColor: [
        'rgba(0, 0, 0, 1)',
        'rgba(0, 117, 198, 1)',
        'rgba(82, 189, 87, 1)',
        'rgba(197, 54, 44, 1)'
      ]
    }, {
      label: 'Heroes by Color',
      data: [0, 0, 0, 0],
      backgroundColor: [
        'rgba(0, 0, 0, 1)',
        'rgba(0, 117, 198, 1)',
        'rgba(82, 189, 87, 1)',
        'rgba(197, 54, 44, 1)'
      ]
    }]
  },
  options: {
    responsive: true,
    legend: {
      display: false,
      position: 'bottom',
      labels: {
        boxWidth: 12
      }
    },
    title: {
      display: true,
      text: 'Hero / Spell Distribution'
    }
  }
});

let manaElement = document.getElementById("manaChart").getContext('2d');
let manaChart = new Chart(manaElement, {
  type: 'bar',
  data: {
    labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9+'],
    datasets: [{
      label: 'Red',
      data: [0,0,0,0,0,0,0,0,0,0],
      backgroundColor: 'rgba(197, 54, 44, 1)'
    }, {
      label: 'Black',
      data: [0,0,0,0,0,0,0,0,0,0],
      backgroundColor: 'rgba(0, 0, 0, 1)'
    }, {
      label: 'Blue',
      data: [0,0,0,0,0,0,0,0,0,0],
      backgroundColor: 'rgba(0, 117, 198, 1)'
    }, {
      label: 'Green',
      data: [0,0,0,0,0,0,0,0,0,0],
      backgroundColor: 'rgba(82, 189, 87, 1)'
    }]
  },
  options: {
    scales: {
      xAxes: [{
        stacked: true
      }],
      yAxes: [{
        stacked: true
      }]
    },
    responsive: true,
    legend: {
      display: false,
      position: 'bottom',
      labels: {
        boxWidth: 12
      }
    },
    title: {
      display: true,
      text: 'Mana Distribution'
    },
    tooltips: {
      mode: 'label',
      callbacks: {
        title: function () {
          window.total = 0;
          return '';
        },
        label: function (tooltipItem, data) {
          let color = data.datasets[tooltipItem.datasetIndex].label;
          let mana = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

          window.total += mana;
          return color + ": " + mana.toString();
        },
        footer: function () {
          return "Total: " + window.total.toString();
        }
      }
    },
    layout: {
      padding: {
        left: 0,
        right: 0,
        top: 0,
        bottom: 0
      }
    }
  }
});

let goldElement = document.getElementById("goldChart").getContext('2d');
let goldChart = new Chart(goldElement, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: 'Gold',
      data: [],
      backgroundColor: 'rgba(230, 200, 0, 1)'
    }]
  },
  options: {
    responsive: true,
    legend: {
      display: false,
      position: 'bottom',
      labels: {
        boxWidth: 12
      }
    },
    title: {
      display: true,
      text: 'Gold Distribution'
    },
    layout: {
      padding: {
        left: 0,
        right: 0,
        top: 0,
        bottom: 0
      }
    }
  }
});