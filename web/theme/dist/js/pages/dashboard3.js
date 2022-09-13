$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
  var urllabel = '/site/getlabels';
  var url1 = '/site/get1';
  var url2 = '/site/get2';
  var url3 = '/site/get3';
  var stlabels=[];

  var $salesChart = $('#sales-chart');
  function getMonths() {
    var labelss=[ 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

      return labelss;
  }
  function getRed() {
      return [1000, 2000, 3000, 2500, 2700, 2500, 3000, 2000, 2000,2000,2000,2000];
  }
  function getYellow() {
      return [700, 1700, 2700, 2000, 1800, 1500, 2000, 1500, 1500, 1500, 1500, 1500];
  }
  function getGreen() {
      return [700, 1700, 2700, 2000, 1800, 1500, 2000, 1500, 1500, 1500, 1500, 1500];
  }
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : getMonths(),
      datasets: [
        {
          backgroundColor: '#DC3545',
          borderColor    : '#ac2a36',
          data           : getRed(),
        },
        {
          backgroundColor: '#FFC107',
          borderColor    : '#bf8e07',
          data           : getYellow(),
        },
        {
          backgroundColor: '#28A745',
          borderColor    : '#1d6e31',
          data           : getGreen(),
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })


})
