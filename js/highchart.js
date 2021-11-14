/**
 * Créer le graph chartdown avec comme paramètre un JSON.
 * @param {array} param 
 */
function createPaymentChart(param) {
	Highcharts.chart('container', {

		title: {
			text: 'Evolution de la trésorerie au cours de l\'année 2021'
		},
	
		subtitle: {
			text: 'Source: thesolarfoundation.com'
		},
	
		yAxis: {
			title: {
				text: 'Montant de la trésorerie (€)'
			}
		},
	
		xAxis: {
			title: {
				text: 'Mois'
			},
			accessibility: {
				rangeDescription: 'Range: 2010 to 2017'
			}
		},
	
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
	
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 1
			}
		},
	
		// series: [{
		// 	name: 'Installation',
		// 	data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
		// }, {
		// 	name: 'Manufacturing',
		// 	data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
		// }, {
		// 	name: 'Sales & Distribution',
		// 	data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
		// }, {
		// 	name: 'Project Development',
		// 	data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
		// }, {
		// 	name: 'Other',
		// 	data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
		// }],
	
		series: [{
			name: 'Trésorerie',
			data: param
		}],
	
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
}

function createPieUnpaid() {
	// Create the chart
Highcharts.chart('pie-chart', {
  chart: {
    type: 'pie'
  },
  title: {
    text: 'Browser market shares. January, 2018'
  },
  subtitle: {
    text: 'Click the slices to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
  },

  accessibility: {
    announceNewData: {
      enabled: true
    },
    point: {
      valueSuffix: '%'
    }
  },

  plotOptions: {
    series: {
      dataLabels: {
        enabled: true,
        format: '{point.name}: {point.y:.1f}%'
      }
    }
  },

  tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
  },

  series: [
    {
      name: "Browsers",
      colorByPoint: true,
      data: [
        {
          name: "Chrome",
          y: 62.74,
        },
        {
          name: "Firefox",
          y: 10.57,
        },
        {
          name: "Internet Explorer",
          y: 7.23,
        },
        {
          name: "Safari",
          y: 5.58,
        },
        {
          name: "Edge",
          y: 4.02,
        },
        {
          name: "Opera",
          y: 1.92,
        },
        {
          name: "Other",
          y: 7.62,
        }
      ]
    }
  ]
});
}

function createColumnUnpaid() {
	Highcharts.chart('column-chart', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'World\'s largest cities per 2017'
		},
		subtitle: {
			text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Population (millions)'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
		},
		series: [{
			name: 'Population',
			data: [
				['Shanghai', 24.2],
				['Beijing', 20.8],
				['Karachi', 14.9],
				['Shenzhen', 13.7],
				['Guangzhou', 13.1],
				['Istanbul', 12.7],
				['Mumbai', 12.4],
				['Moscow', 12.2],
				['São Paulo', 12.0],
				['Delhi', 11.7],
				['Kinshasa', 11.5],
				['Tianjin', 11.2],
				['Lahore', 11.1],
				['Jakarta', 10.6],
				['Dongguan', 10.6],
				['Lagos', 10.6],
				['Bengaluru', 10.3],
				['Seoul', 9.8],
				['Foshan', 9.3],
				['Tokyo', 9.3]
			],
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				format: '{point.y:.1f}', // one decimal
				y: 10, // 10 pixels down from the top
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
}